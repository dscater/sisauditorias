<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\TipoTrabajo;
use App\Models\TrabajoAuditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TipoTrabajoController extends Controller
{
    public $validacion = [
        "nombre" => "required|min:1",
    ];

    public $mensajes = [
        "nombre.required" => "Este campo es obligatorio",
        "nombre.min" => "Debes ingresar al menos :min caracteres",
    ];

    public function index()
    {
        return Inertia::render("TipoTrabajos/Index");
    }

    public function listado(Request $request)
    {
        $tipo_trabajos = TipoTrabajo::select("tipo_trabajos.*");

        if ($request->order && $request->order == "desc") {
            $tipo_trabajos->orderBy("tipo_trabajos.id", $request->order);
        }

        $tipo_trabajos = $tipo_trabajos->get();

        return response()->JSON([
            "tipo_trabajos" => $tipo_trabajos
        ]);
    }

    public function paginado(Request $request)
    {

        $search = $request->search;

        $tipo_trabajos = TipoTrabajo::select("tipo_trabajos.*");

        if (trim($search) != "") {
            $tipo_trabajos->where("nombre", "LIKE", "%$search%");
        }

        $tipo_trabajos = $tipo_trabajos->paginate($request->itemsPerPage);
        return response()->JSON([
            "tipo_trabajos" => $tipo_trabajos
        ]);
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el TipoTrabajo
            $nuevo_tipo_trabajo = TipoTrabajo::create(array_map('mb_strtoupper', $request->all()));
            $datos_original = HistorialAccion::getDetalleRegistro($nuevo_tipo_trabajo, "tipo_trabajos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->tipo_trabajo . ' REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            DB::commit();
            return redirect()->route("tipo_trabajos.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function show(TipoTrabajo $tipo_trabajo)
    {
    }

    public function update(TipoTrabajo $tipo_trabajo, Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($tipo_trabajo, "tipo_trabajos");
            $tipo_trabajo->update(array_map('mb_strtoupper', $request->all()));

            $datos_nuevo = HistorialAccion::getDetalleRegistro($tipo_trabajo, "tipo_trabajos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->tipo_trabajo . ' MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);


            DB::commit();
            return redirect()->route("tipo_trabajos.index")->with("bien", "Registro actualizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }
    public function destroy(TipoTrabajo $tipo_trabajo)
    {
        DB::beginTransaction();
        try {
            $usos = TrabajoAuditoria::where("tipo_trabajo_id", $tipo_trabajo->id)->get();
            if (count($usos) > 0) {
                throw ValidationException::withMessages([
                    'error' =>  "No es posible eliminar esta categoría porque esta siendo utilizada por otros registros",
                ]);
            }

            $datos_original = HistorialAccion::getDetalleRegistro($tipo_trabajo, "tipo_trabajos");
            $tipo_trabajo->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->tipo_trabajo . ' ELIMINÓ UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);
            DB::commit();
            return response()->JSON([
                'sw' => true,
                'message' => 'El registro se eliminó correctamente'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }
}
