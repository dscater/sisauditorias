<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\PapelArchivo;
use App\Models\PapelDetalle;
use App\Models\PapelTrabajo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class PapelTrabajoController extends Controller
{
    public $validacion = [
        "trabajo_auditoria_id" => "required",
    ];

    public $mensajes = [
        "nombre.required" => "Este campo es obligatorio",
    ];

    public function index()
    {
        return Inertia::render("PapelTrabajos/Index");
    }

    public function listado(Request $request)
    {
        $papel_trabajos = PapelTrabajo::select("papel_trabajos.*");

        if ($request->order && $request->order == "desc") {
            $papel_trabajos->orderBy("papel_trabajos.id", $request->order);
        }

        $papel_trabajos = $papel_trabajos->get();

        return response()->JSON([
            "papel_trabajos" => $papel_trabajos
        ]);
    }

    public function paginado(Request $request)
    {
        $search = $request->search;

        $papel_trabajos = PapelTrabajo::with(["trabajo_auditoria", "papel_detalles.papel_archivos"])->select("papel_trabajos.*")
            ->join("trabajo_auditorias", "trabajo_auditorias.id", "=", "papel_trabajos.trabajo_auditoria_id");

        if (trim($search) != "") {
            $papel_trabajos->orWhere("trabajo_auditorias.nombre", "LIKE", "%$search%");
        }

        $papel_trabajos = $papel_trabajos->paginate($request->itemsPerPage);
        return response()->JSON([
            "papel_trabajos" => $papel_trabajos
        ]);
    }

    public function create()
    {
        return Inertia::render("PapelTrabajos/Create");
    }

    public function store(Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        $request['fecha_registro'] = date('Y-m-d');
        DB::beginTransaction();
        try {
            // crear el PapelTrabajo
            $nuevo_papel_trabajo = PapelTrabajo::create(array_map('mb_strtoupper', $request->except("papel_detalles1", "papel_detalles2", "papel_detalles3", "eliminados_detalles")));
            $datos_original = HistorialAccion::getDetalleRegistro($nuevo_papel_trabajo, "papel_trabajos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'CREACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->papel_trabajo . ' REGISTRO PAPELES DE TRABAJO',
                'datos_original' => $datos_original,
                'modulo' => 'PAPELES DE TRABAJOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            foreach ($request->papel_detalles1 as $item) {
                $papel_detalle = $nuevo_papel_trabajo->papel_detalles()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                    "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                    "estado" => mb_strtoupper($item["estado"]),
                ]);

                if (isset($item["papel_archivos"])) {
                    $papel_archivos = $item["papel_archivos"];
                    foreach ($papel_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                            $papel_detalle->papel_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            foreach ($request->papel_detalles2 as $item) {
                $papel_detalle = $nuevo_papel_trabajo->papel_detalles()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                    "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                    "estado" => mb_strtoupper($item["estado"]),
                ]);
                if (isset($item["papel_archivos"])) {
                    $papel_archivos = $item["papel_archivos"];
                    foreach ($papel_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                            $papel_detalle->papel_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            foreach ($request->papel_detalles3 as $item) {
                $papel_detalle = $nuevo_papel_trabajo->papel_detalles()->create([
                    "nro_etapa" => $item["nro_etapa"],
                    "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                    "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                    "estado" => mb_strtoupper($item["estado"]),
                ]);
                if (isset($item["papel_archivos"])) {
                    $papel_archivos = $item["papel_archivos"];
                    foreach ($papel_archivos as $key => $ea) {
                        if ($ea) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                            $papel_detalle->papel_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route("papel_trabajos.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function show(PapelTrabajo $papel_trabajo)
    {
    }

    public function edit(PapelTrabajo $papel_trabajo)
    {
        $papel_trabajo = $papel_trabajo->load(["trabajo_auditoria", "papel_detalles.papel_archivos"]);
        return Inertia::render("PapelTrabajos/Edit", compact("papel_trabajo"));
    }

    public function update(PapelTrabajo $papel_trabajo, Request $request)
    {
        $request->validate($this->validacion, $this->mensajes);
        DB::beginTransaction();
        try {
            $datos_original = HistorialAccion::getDetalleRegistro($papel_trabajo, "papel_trabajos");
            $papel_trabajo->update(array_map('mb_strtoupper', $request->except("papel_detalles1", "papel_detalles2", "papel_detalles3", "eliminados_detalles")));

            $datos_nuevo = HistorialAccion::getDetalleRegistro($papel_trabajo, "papel_trabajos");
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'MODIFICACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->papel_trabajo . ' MODIFICÓ PAPELES DE TRABAJO',
                'datos_original' => $datos_original,
                'datos_nuevo' => $datos_nuevo,
                'modulo' => 'PAPELES DE TRABAJOS',
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i:s')
            ]);

            if (isset($request->eliminados_detalles)) {
                foreach ($request->eliminados_detalles as $e) {
                    $papel_detalle = PapelDetalle::find($e);
                    foreach ($papel_detalle->papel_archivos as $ea) {
                        \File::delete(public_path("/files/" . $ea->archivo));
                        $ea->delete();
                    }
                    $papel_detalle->delete();
                }
            }

            foreach ($request->papel_detalles1 as $item) {
                if ($item["id"] == 0) {
                    $papel_detalle = $papel_trabajo->papel_detalles()->create([
                        "nro_etapa" => $item["nro_etapa"],
                        "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                        "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                        "estado" => mb_strtoupper($item["estado"]),
                    ]);
                } else {
                    $papel_detalle = PapelDetalle::find($item["id"]);
                    $papel_detalle->update([
                        "nro_etapa" => $item["nro_etapa"],
                        "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                        "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                        "estado" => mb_strtoupper($item["estado"]),
                    ]);
                }

                if (isset($item["eliminados"])) {
                    foreach ($item["eliminados"] as $elim) {
                        $papel_archivo = PapelArchivo::find($elim);
                        \File::delete(public_path("/files/" . $papel_archivo->archivo));
                        $papel_archivo->delete();
                    }
                }
                if (isset($item["papel_archivos"])) {
                    foreach ($item["papel_archivos"] as $key => $ea) {
                        if ($ea && !is_array($ea)) {
                            $ext = $ea->getClientOriginalExtension();
                            $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                            $papel_detalle->papel_archivos()->create([
                                "archivo" => $nom_file,
                                "ext" => $ext
                            ]);
                            $ea->move(public_path("/files/"), $nom_file);
                        }
                    }
                }
            }

            if (isset($request->papel_detalles2)) {
                foreach ($request->papel_detalles2 as $item) {

                    if ($item["id"] == 0) {
                        $papel_detalle = $papel_trabajo->papel_detalles()->create([
                            "nro_etapa" => $item["nro_etapa"],
                            "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                            "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                            "estado" => mb_strtoupper($item["estado"]),
                        ]);
                    } else {
                        $papel_detalle = PapelDetalle::find($item["id"]);
                        $papel_detalle->update([
                            "nro_etapa" => $item["nro_etapa"],
                            "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                            "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                            "estado" => mb_strtoupper($item["estado"]),
                        ]);
                    }

                    if (isset($item["eliminados"])) {
                        foreach ($item["eliminados"] as $elim) {
                            $papel_archivo = PapelArchivo::find($elim);
                            \File::delete(public_path("/files/" . $papel_archivo->archivo));
                            $papel_archivo->delete();
                        }
                    }
                    if (isset($item["papel_archivos"])) {
                        foreach ($item["papel_archivos"] as $key => $ea) {
                            if ($ea && !is_array($ea)) {
                                $ext = $ea->getClientOriginalExtension();
                                $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                                $papel_detalle->papel_archivos()->create([
                                    "archivo" => $nom_file,
                                    "ext" => $ext
                                ]);
                                $ea->move(public_path("/files/"), $nom_file);
                            }
                        }
                    }
                }
            }

            if (isset($request->papel_detalles3)) {
                foreach ($request->papel_detalles3 as $item) {

                    if ($item["id"] == 0) {
                        $papel_detalle = $papel_trabajo->papel_detalles()->create([
                            "nro_etapa" => $item["nro_etapa"],
                            "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                            "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                            "estado" => mb_strtoupper($item["estado"]),
                        ]);
                    } else {
                        $papel_detalle = PapelDetalle::find($item["id"]);
                        $papel_detalle->update([
                            "nro_etapa" => $item["nro_etapa"],
                            "nro_nombre" => mb_strtoupper($item["nro_nombre"]),
                            "aplicabilidad" => mb_strtoupper($item["aplicabilidad"]),
                            "estado" => mb_strtoupper($item["estado"]),
                        ]);
                    }

                    if (isset($item["eliminados"])) {
                        foreach ($item["eliminados"] as $elim) {
                            $papel_archivo = PapelArchivo::find($elim);
                            \File::delete(public_path("/files/" . $papel_archivo->archivo));
                            $papel_archivo->delete();
                        }
                    }
                    if (isset($item["papel_archivos"])) {
                        foreach ($item["papel_archivos"] as $key => $ea) {
                            if ($ea && !is_array($ea)) {
                                $ext = $ea->getClientOriginalExtension();
                                $nom_file = time() . "_" . $key . $papel_detalle->id . "." . $ext;
                                $papel_detalle->papel_archivos()->create([
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
            return redirect()->route("papel_trabajos.index")->with("bien", "Registro actualizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }
    public function destroy(PapelTrabajo $papel_trabajo)
    {
        DB::beginTransaction();
        try {

            foreach ($papel_trabajo->papel_detalles as $en) {
                foreach ($en->papel_archivos as $ea) {
                    \File::delete(public_path("/files/" . $ea->archivo));
                    $ea->delete();
                }
                $en->delete();
            }

            $datos_original = HistorialAccion::getDetalleRegistro($papel_trabajo, "papel_trabajos");
            $papel_trabajo->delete();
            HistorialAccion::create([
                'user_id' => Auth::user()->id,
                'accion' => 'ELIMINACIÓN',
                'descripcion' => 'EL USUARIO ' . Auth::user()->papel_trabajo . ' ELIMINÓ PAPELES DE TRABAJO',
                'datos_original' => $datos_original,
                'modulo' => 'PAPELES DE TRABAJOS',
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
