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
                    $total_detalles = count($papel_trabajo->papel_detalles);
                    $detalles_estado = PapelDetalle::where("papel_trabajo_id", $papel_trabajo->id)
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
                    if ($estado == 'EN PROCESO') {
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
        $tipo =  $request->tipo;

        return response()->JSON([]);
    }
}
