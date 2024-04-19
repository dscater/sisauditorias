<?php

namespace App\Http\Controllers;

use App\Models\Biometrico;
use App\Models\PapelDetalle;
use App\Models\PapelTrabajo;
use App\Models\Servicio;
use App\Models\SolicitudMantenimiento;
use App\Models\TrabajoAuditoria;
use App\Models\UnidadArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ReporteController extends Controller
{
    public function usuarios()
    {
        return Inertia::render("Reportes/Usuarios");
    }

    public function r_usuarios(Request $request)
    {
        $tipo =  $request->tipo;
        $usuarios = User::where('id', '!=', 1)->orderBy("paterno", "ASC")->get();

        if ($tipo != 'TODOS') {
            $request->validate([
                'tipo' => 'required',
            ]);
            $usuarios = User::where('id', '!=', 1)->where('tipo', $request->tipo)->orderBy("paterno", "ASC")->get();
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('legal', 'landscape');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 85, $alto - 35, date("d/m/Y"), null, 9, array(0, 0, 0));
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
    }

    public function trabajo_auditorias()
    {
        return Inertia::render("Reportes/TrabajoAuditorias");
    }

    public function r_trabajo_auditorias(Request $request)
    {
        $tipo_trabajo_id =  $request->tipo_trabajo_id;
        $trabajo_id =  $request->trabajo_id;
        $estado =  $request->estado;
        $trabajo_auditorias = TrabajoAuditoria::select("trabajo_auditorias.*");


        if ($tipo_trabajo_id != 'todos') {
            $trabajo_auditorias->where("tipo_trabajo_id", $tipo_trabajo_id);
        }

        if ($trabajo_id != 'todos') {
            $trabajo_auditorias->where("id", $trabajo_id);
        }

        if ($estado != 'todos') {
            $trabajos = $trabajo_auditorias->get();
            $trabajo_auditorias = [];

            foreach ($trabajos as $item) {
                // buscar si tiene papeles
                $papel_trabajo = PapelTrabajo::where("trabajo_auditoria_id", $item->id)->get()->first();
                if ($papel_trabajo) {
                    $total_detalles = count(apelDetalle::where("papel_trabajo_id", $papel_trabajo->id)
                        ->where("nro_etapa", "!=", 3)
                        ->get());
                    $detalles_estado = PapelDetalle::where("papel_trabajo_id", $papel_trabajo->id)
                        ->where("nro_etapa", "!=", 3)
                        ->where("estado", $estado)
                        ->get();
                    if ($estado != 'EN PROCESO') {
                        if ($total_detalles == count($detalles_estado)) {
                            $trabajo_auditorias[] = $item;
                        }
                    } else {
                        $trabajo_auditorias[] = $item;
                    }
                } else {
                    if ($estado == 'NO INICIADO') {
                        $trabajo_auditorias[] = $item;
                    }
                }
            }
        } else {
            $trabajo_auditorias = $trabajo_auditorias->get();
        }

        $pdf = PDF::loadView('reportes.trabajo_auditorias', compact('trabajo_auditorias'))->setPaper('legal', 'portrait');

        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 85, $alto - 35, date("d/m/Y"), null, 9, array(0, 0, 0));
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 9, array(0, 0, 0));

        return $pdf->stream('trabajo_auditorias.pdf');
    }

    public function g_trabajo_auditorias()
    {
        return Inertia::render("Reportes/GTrabajoAuditorias");
    }

    public function r_g_trabajo_auditorias(Request $request)
    {
        $tipo_trabajo_id =  $request->tipo_trabajo_id;
        $trabajo_id =  $request->trabajo_id;
        $estado =  $request->estado;

        $estados = [
            "NO INICIADO",
            "EN PROCESO",
            "TERMINADO AUDITOR",
            "REVISADO POR SUPERVISOR",
            "APROBADO GERENTE AUDITOR",
        ];

        if ($estado != 'todos') {
            $estados = [$estado];
        }

        $data = [];

        foreach ($estados as $value) {
            $trabajo_auditorias = TrabajoAuditoria::select("trabajo_auditorias.*");

            if ($tipo_trabajo_id != 'todos') {
                $trabajo_auditorias->where("tipo_trabajo_id", $tipo_trabajo_id);
            }
            if ($trabajo_id != 'todos') {
                $trabajo_auditorias->where("id", $trabajo_id);
            }
            $trabajo_auditorias = $trabajo_auditorias->get();

            $total_registros = 0;

            foreach ($trabajo_auditorias as $trabajo_auditoria) {
                $papel_trabajo = PapelTrabajo::where("trabajo_auditoria_id", $trabajo_auditoria->id)->get()->first();
                if ($papel_trabajo) {
                    $total_detalles = PapelDetalle::where("papel_trabajo_id", $papel_trabajo->id)
                        ->where("nro_etapa", "!=", 3)
                        ->pluck('estado') // Obtener solo los valores de la columna 'estado'
                        ->unique() // Obtener valores únicos
                        ->count();

                    $detalles_estado = PapelDetalle::where("papel_trabajo_id", $papel_trabajo->id)
                        ->where("nro_etapa", "!=", 3)
                        ->where("estado", $value)
                        ->pluck('estado') // Obtener solo los valores de la columna 'estado'
                        ->unique() // Obtener valores únicos
                        ->count();
                    // Log::debug("-----------------------------");
                    // Log::debug($detalles_estado);
                    // Log::debug($total_detalles);
                    if ($value != 'EN PROCESO') {
                        if ($total_detalles == $detalles_estado) {
                            $total_registros++;
                        }
                    } else {
                        if ($total_detalles == $detalles_estado) {
                            $total_registros++;
                        } else {
                            if ($total_detalles > 1) {
                                $total_registros++;
                            }
                        }
                    }
                } else {
                    if ($value == 'NO INICIADO') {
                        $total_registros++;
                    }
                }
            }
            $data[] = [
                "name" => $value,
                "y" => (float)$total_registros
            ];
        }


        return response()->JSON([
            "data" => $data,
        ]);
    }
}
