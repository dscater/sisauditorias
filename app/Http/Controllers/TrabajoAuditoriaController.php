<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\PersonalTrabajo;
use App\Models\TrabajoAuditoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class TrabajoAuditoriaController extends Controller
{
    public $validacion = [
        "nombre" => "required|min:1",
        "codigo" => "required",
        "tipo_trabajo_id" => "required",
        "empresa" => "required",
        "responsable_id" => "required",
        "objeto" => "required",
        "objetivo" => "required",
        "periodo" => "required",
        "fecha_ini" => "required",
        "duracion" => "required",
        "fecha_entrega" => "required",
    ];

    public $mensajes = [
        "nombre.required" => "Este campo es obligatorio",
        "nombre.min" => "Debes ingresar al menos :min caracteres",
        "codigo.required" => "Este campo est obligatorio",
        "tipo_trabajo_id.required" => "Este campo est obligatorio",
        "empresa.required" => "Este campo est obligatorio",
        "responsable_id.required" => "Este campo est obligatorio",
        "objeto.required" => "Este campo est obligatorio",
        "objetivo.required" => "Este campo est obligatorio",
        "periodo.required" => "Este campo est obligatorio",
        "fecha_ini.required" => "Este campo est obligatorio",
        "duracion.required" => "Este campo est obligatorio",
        "fecha_entrega.required" => "Este campo est obligatorio",
    ];

    public function index()
    {
        return Inertia::render("TrabajoAuditorias/Index");
    }

    public function listado(Request $request)
    {
        $trabajo_auditorias = TrabajoAuditoria::select("trabajo_auditorias.*");


        if ($request->sin_etapa) {
            if ($request->id && $request->id != '') {
                $trabajo_auditorias = $trabajo_auditorias->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('etapa_auditorias')
                        ->whereRaw('etapa_auditorias.trabajo_auditoria_id = trabajo_auditorias.id');
                })->orWhere(function ($subquery) use ($request) {
                    $subquery->whereIn('trabajo_auditorias.id', [$request->id]);
                });
            } else {
                $trabajo_auditorias = $trabajo_auditorias->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('etapa_auditorias')
                        ->whereRaw('etapa_auditorias.trabajo_auditoria_id = trabajo_auditorias.id');
                });
            }
        }

        if ($request->sin_papeles) {
            if ($request->id && $request->id != '') {
                $trabajo_auditorias = $trabajo_auditorias->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('papel_trabajos')
                        ->whereRaw('papel_trabajos.trabajo_auditoria_id = trabajo_auditorias.id');
                })->orWhere(function ($subquery) use ($request) {
                    $subquery->whereIn('trabajo_auditorias.id', [$request->id]);
                });
            } else {
                $trabajo_auditorias = $trabajo_auditorias->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('papel_trabajos')
                        ->whereRaw('papel_trabajos.trabajo_auditoria_id = trabajo_auditorias.id');
                });
            }
        }


        if ($request->order && $request->order == "desc") {
            $trabajo_auditorias->orderBy("trabajo_auditorias.id", $request->order);
        }




        $trabajo_auditorias = $trabajo_auditorias->get();

        return response()->JSON([
            "trabajo_auditorias" => $trabajo_auditorias
        ]);
    }

    public function paginado(Request $request)
    {

        $search = $request->search;

        $trabajo_auditorias = TrabajoAuditoria::with(["tipo_trabajo", "responsable", "personal_trabajos.personal"])->select("trabajo_auditorias.*")
            ->join("tipo_trabajos", "tipo_trabajos.id", "=", "trabajo_auditorias.tipo_trabajo_id");

        if (trim($search) != "") {
            $trabajo_auditorias->where("trabajo_auditorias.nombre", "LIKE", "%$search%");
            $trabajo_auditorias->orWhere("trabajo_auditorias.codigo", "LIKE", "%$search%");
            $trabajo_auditorias->orWhere("tipo_trabajos.nombre", "LIKE", "%$search%");
        }

        $trabajo_auditorias = $trabajo_auditorias->paginate($request->itemsPerPage);
        return response()->JSON([
            "trabajo_auditorias" => $trabajo_auditorias
        ]);
    }

    public function create()
    {
        return Inertia::render("TrabajoAuditorias/Create");
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        // validar personal
        if (!isset($request->personal_trabajos)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes asignar al menos 1 personal",
            ]);
        } else {
            $vacio = false;
            foreach ($request->personal_trabajos as $item) {
                if ($item["personal_id"] == '' || trim($item['personal_id'] == '')) {
                    $vacio = true;
                }

                if ($item["horas"] == '' || trim($item['horas']) == '' || $item['horas'] <= 0) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Los campos del personal no pueden ser vacios y las horas no pueden ser menores iguales a 0",
                ]);
            }
        }

        DB::beginTransaction();
        try {
            // crear el TrabajoAuditoria
            $nuevo_trabajo_auditoria = TrabajoAuditoria::create(array_map('mb_strtoupper', $request->except("personal_trabajos", "eliminados")));
            $datos_original = HistorialAccion::getDetalleRegistro($nuevo_trabajo_auditoria, "trabajo_auditorias");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->trabajo_auditoria . ' REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            foreach ($request->personal_trabajos as $item) {
                $nuevo_trabajo_auditoria->personal_trabajos()->create([
                    "personal_id" => $item["personal_id"],
                    "horas" => $item["horas"],
                ]);
            }

            DB::commit();
            return redirect()->route("trabajo_auditorias.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function show(TrabajoAuditoria $trabajo_auditoria)
    {
    }

    public function edit(TrabajoAuditoria $trabajo_auditoria)
    {
        $trabajo_auditoria = $trabajo_auditoria->load(["tipo_trabajo", "responsable", "personal_trabajos"]);
        return Inertia::render("TrabajoAuditorias/Edit", compact("trabajo_auditoria"));
    }

    public function update(TrabajoAuditoria $trabajo_auditoria, Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);

        // validar personal
        if (!isset($request->personal_trabajos)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes asignar al menos 1 personal",
            ]);
        } else {
            $vacio = false;
            foreach ($request->personal_trabajos as $item) {
                if ($item["personal_id"] == '' || trim($item['personal_id'] == '')) {
                    $vacio = true;
                }

                if ($item["horas"] == '' || trim($item['horas']) == '' || $item['horas'] <= 0) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Los campos del personal no pueden ser vacios y las horas no pueden ser menores iguales a 0",
                ]);
            }
        }

        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($trabajo_auditoria, "trabajo_auditorias");
            $trabajo_auditoria->update(array_map('mb_strtoupper', $request->except("personal_trabajos", "eliminados")));

            $datos_nuevo = HistorialAccion::getDetalleRegistro($trabajo_auditoria, "trabajo_auditorias");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->trabajo_auditoria . ' MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            if (isset($request->eliminados)) {
                foreach ($request->eliminados as $e) {
                    $personal_trabajo = PersonalTrabajo::find($e);
                    $personal_trabajo->delete();
                }
            }

            if (isset($request->personal_trabajos)) {
                foreach ($request->personal_trabajos as $item) {
                    if ($item["id"] == 0) {
                        $trabajo_auditoria->personal_trabajos()->create([
                            "personal_id" => $item["personal_id"],
                            "horas" => $item["horas"],
                        ]);
                    } else {
                        $personal_trabajo = PersonalTrabajo::find($item["id"]);
                        $personal_trabajo->update([
                            "personal_id" => $item["personal_id"],
                            "horas" => $item["horas"],
                        ]);
                    }
                }
            }


            DB::commit();
            return redirect()->route("trabajo_auditorias.index")->with("bien", "Registro actualizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }
    public function destroy(TrabajoAuditoria $trabajo_auditoria)
    {
        DB::beginTransaction();
        try {
            $trabajo_auditoria->personal_trabajos()->delete();

            $datos_original = HistorialAccion::getDetalleRegistro($trabajo_auditoria, "trabajo_auditorias");
            $trabajo_auditoria->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->trabajo_auditoria . ' ELIMINÓ UN TIPO DE TRABAJOS DE AUDITORIA',
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
