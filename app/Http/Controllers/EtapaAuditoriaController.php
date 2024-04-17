<?php

namespace App\Http\Controllers;

use App\Models\EtapaArchivos;
use App\Models\EtapaAuditoria;
use App\Models\EtapaNombre;
use App\Models\HistorialAccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class EtapaAuditoriaController extends Controller
{
    public $validacion = [
        "trabajo_auditoria_id" => "required",
    ];

    public $mensajes = [
        "nombre.required" => "Este campo es obligatorio",
    ];

    public function index()
    {
        return Inertia::render("EtapaAuditorias/Index");
    }

    public function listado(Request $request)
    {
        $etapa_auditorias = EtapaAuditoria::select("etapa_auditorias.*");

        if ($request->order && $request->order == "desc") {
            $etapa_auditorias->orderBy("etapa_auditorias.id", $request->order);
        }

        $etapa_auditorias = $etapa_auditorias->get();

        return response()->JSON([
            "etapa_auditorias" => $etapa_auditorias
        ]);
    }

    public function paginado(Request $request)
    {
        $search = $request->search;

        $etapa_auditorias = EtapaAuditoria::with(["trabajo_auditoria", "etapa_nombres.etapa_archivos"])->select("etapa_auditorias.*")
            ->join("trabajo_auditorias", "trabajo_auditorias.id", "=", "etapa_auditorias.trabajo_auditoria_id");

        if (trim($search) != "") {
            $etapa_auditorias->orWhere("trabajo_auditorias.nombre", "LIKE", "%$search%");
        }

        $etapa_auditorias = $etapa_auditorias->paginate($request->itemsPerPage);
        return response()->JSON([
            "etapa_auditorias" => $etapa_auditorias
        ]);
    }

    public function create()
    {
        return Inertia::render("EtapaAuditorias/Create");
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        // validar etapa_nombres1
        if (!isset($request->etapa_nombres1)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa VALORACIÓN DEL RIESGO",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres1 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa VALORACIÓN DEL RIESGO",
                ]);
            }
        }
        // validar etapa_nombres2
        if (!isset($request->etapa_nombres2)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa RESPUESTA AL RIESGO",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres2 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa RESPUESTA AL RIESGO",
                ]);
            }
        }
        // validar etapa_nombres3
        if (!isset($request->etapa_nombres3)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa INFORME DE AUDITORÍA",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres3 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa INFORME DE AUDITORÍA",
                ]);
            }
        }

        DB::beginTransaction();
        try {
            // crear el EtapaAuditoria
            $nueva_etapa_auditoria = EtapaAuditoria::create(array_map('mb_strtoupper', $request->except("etapa_nombres1", "etapa_nombres2", "etapa_nombres3", "eliminados_nombres")));
            $datos_original = HistorialAccion::getDetalleRegistro($nueva_etapa_auditoria, "etapa_auditorias");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->etapa_auditoria . ' REGISTRO UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            foreach ($request->etapa_nombres1 as $item) {
                $etapa_nombre = $nueva_etapa_auditoria->etapa_nombres()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nombre" => mb_strtoupper($item["nombre"]),
                ]);

                if (isset($item["etapa_archivos"])) {
                    $etapa_archivos = $item["etapa_archivos"];
                    foreach ($etapa_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                            $etapa_nombre->etapa_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            foreach ($request->etapa_nombres2 as $item) {
                $etapa_nombre = $nueva_etapa_auditoria->etapa_nombres()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nombre" => mb_strtoupper($item["nombre"]),
                ]);
                if (isset($item["etapa_archivos"])) {
                    $etapa_archivos = $item["etapa_archivos"];
                    foreach ($etapa_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                            $etapa_nombre->etapa_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            foreach ($request->etapa_nombres3 as $item) {
                $etapa_nombre = $nueva_etapa_auditoria->etapa_nombres()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nombre" => mb_strtoupper($item["nombre"]),
                ]);
                if (isset($item["etapa_archivos"])) {
                    $etapa_archivos = $item["etapa_archivos"];
                    foreach ($etapa_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                            $etapa_nombre->etapa_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route("etapa_auditorias.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function show(EtapaAuditoria $etapa_auditoria)
    {
    }

    public function edit(EtapaAuditoria $etapa_auditoria)
    {
        $etapa_auditoria = $etapa_auditoria->load(["trabajo_auditoria", "etapa_nombres.etapa_archivos"]);
        return Inertia::render("EtapaAuditorias/Edit", compact("etapa_auditoria"));
    }

    public function update(EtapaAuditoria $etapa_auditoria, Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);

        // validar etapa_nombres1
        if (!isset($request->etapa_nombres1)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa VALORACIÓN DEL RIESGO",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres1 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa VALORACIÓN DEL RIESGO",
                ]);
            }
        }
        // validar etapa_nombres2
        if (!isset($request->etapa_nombres2)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa RESPUESTA AL RIESGO",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres2 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa RESPUESTA AL RIESGO",
                ]);
            }
        }
        // validar etapa_nombres3
        if (!isset($request->etapa_nombres3)) {
            throw ValidationException::withMessages([
                'error' =>  "Debes agregar al menos un registro de la etapa INFORME DE AUDITORÍA",
            ]);
        } else {
            $vacio = false;
            foreach ($request->etapa_nombres3 as $item) {
                if ($item["nombre"] == '' || trim($item['nombre'] == '')) {
                    $vacio = true;
                }
            }

            if ($vacio) {
                throw ValidationException::withMessages([
                    'error' =>  "Debes completar todos los nombres de la etapa INFORME DE AUDITORÍA",
                ]);
            }
        }

        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($etapa_auditoria, "etapa_auditorias");
            $etapa_auditoria->update(array_map('mb_strtoupper', $request->except("etapa_nombres1", "etapa_nombres2", "etapa_nombres3", "eliminados_nombres")));

            $datos_nuevo = HistorialAccion::getDetalleRegistro($etapa_auditoria, "etapa_auditorias");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->etapa_auditoria . ' MODIFICÓ UN TIPO DE TRABAJOS DE AUDITORIA',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'TIPO DE TRABAJOS DE AUDITORIAS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            if (isset($request->eliminados_nombres)) {
                foreach ($request->eliminados_nombres as $e) {
                    $etapa_nombre = EtapaNombre::find($e);
                    foreach ($etapa_nombre->etapa_archivos as $ea) {
                        \File::delete(public_path("/files/" . $ea->archivo));
                        $ea->delete();
                    }
                    $etapa_nombre->delete();
                }
            }

            foreach ($request->etapa_nombres1 as $item) {
                if ($item["id"] == 0) {
                    $etapa_nombre = $etapa_auditoria->etapa_nombres()->create([
                        "nro_etapa" => $item["nro_etapa"],
                        "nombre" => mb_strtoupper($item["nombre"]),
                    ]);
                } else {
                    $etapa_nombre = EtapaNombre::find($item["id"]);
                    $etapa_nombre->update([
                        "nro_etapa" => $item["nro_etapa"],
                        "nombre" => mb_strtoupper($item["nombre"]),
                    ]);
                }

                if (isset($item["eliminados"])) {
                    foreach ($item["eliminados"] as $elim) {
                        $etapa_archivo = EtapaArchivos::find($elim);
                        \File::delete(public_path("/files/" . $etapa_archivo->archivo));
                        $etapa_archivo->delete();
                    }
                }
                if (isset($item["etapa_archivos"])) {
                    foreach ($item["etapa_archivos"] as $key => $ea) {
                        if ($ea && !is_array($ea)) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                            $etapa_nombre->etapa_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            if (isset($request->etapa_nombres2)) {
                foreach ($request->etapa_nombres2 as $item) {

                    if ($item["id"] == 0) {
                        $etapa_nombre = $etapa_auditoria->etapa_nombres()->create([
                            "nro_etapa" => $item["nro_etapa"],
                            "nombre" => mb_strtoupper($item["nombre"]),
                        ]);
                    } else {
                        $etapa_nombre = EtapaNombre::find($item["id"]);
                    }

                    if (isset($item["eliminados"])) {
                        foreach ($item["eliminados"] as $elim) {
                            $etapa_archivo = EtapaArchivos::find($elim);
                            \File::delete(public_path("/files/" . $etapa_archivo->archivo));
                            $etapa_archivo->delete();
                        }
                    }
                    if (isset($item["etapa_archivos"])) {
                        foreach ($item["etapa_archivos"] as $key => $ea) {
                            if ($ea && !is_array($ea)) {
                                $ext = $ea->getClientOriginalExtension();
                                $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                                $etapa_nombre->etapa_archivos()->create([
                                    "archivo" => $nom_file,
                                    "ext" => $ext
                                ]);
                                $ea->move(public_path("/files/"), $nom_file);
                            }
                        }
                    }
                }
            }

            if (isset($request->etapa_nombres3)) {
                foreach ($request->etapa_nombres3 as $item) {

                    if ($item["id"] == 0) {
                        $etapa_nombre = $etapa_auditoria->etapa_nombres()->create([
                            "nro_etapa" => $item["nro_etapa"],
                            "nombre" => mb_strtoupper($item["nombre"]),
                        ]);
                    } else {
                        $etapa_nombre = EtapaNombre::find($item["id"]);
                    }

                    if (isset($item["eliminados"])) {
                        foreach ($item["eliminados"] as $elim) {
                            $etapa_archivo = EtapaArchivos::find($elim);
                            \File::delete(public_path("/files/" . $etapa_archivo->archivo));
                            $etapa_archivo->delete();
                        }
                    }
                    if (isset($item["etapa_archivos"])) {
                        foreach ($item["etapa_archivos"] as $key => $ea) {
                            if ($ea && !is_array($ea)) {
                                $ext = $ea->getClientOriginalExtension();
                                $nom_file = time() . "_" . $key . $etapa_nombre->id . "." . $ext;
                                $etapa_nombre->etapa_archivos()->create([
                                    "archivo" => $nom_file,
                                    "ext" => $ext
                                ]);
                                $ea->move(public_path("/files/"), $nom_file);
                            }
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route("etapa_auditorias.index")->with("bien", "Registro actualizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }
    public function destroy(EtapaAuditoria $etapa_auditoria)
    {
        DB::beginTransaction();
        try {

            foreach ($etapa_auditoria->etapa_nombres as $en) {
                foreach ($en->etapa_archivos as $ea) {
                    \File::delete(public_path("/files/" . $ea->archivo));
                    $ea->delete();
                }
                $en->delete();
            }

            $datos_original = HistorialAccion::getDetalleRegistro($etapa_auditoria, "etapa_auditorias");
            $etapa_auditoria->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->etapa_auditoria . ' ELIMINÓ UN TIPO DE TRABAJOS DE AUDITORIA',
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
