<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\Multimedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MultimediaController extends Controller
{
    public function index()
    {
        $multimedias  = Multimedia::all();
        return Inertia("Institucions/Multimedias", compact("multimedias"));
    }

    public function show(Multimedia $multimedia)
    {
        return $multimedia;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $multimedias = $request->multimedias;
            if (isset($request->eliminados) && $request->eliminados) {
                $eliminados = $request->eliminados;
                foreach ($eliminados as $e) {
                    $multimedia = Multimedia::find($e);
                    $datos_original = HistorialAccion::getDetalleRegistro($multimedia, "multimedias");

                    \File::delete(public_path("/files/multimedias/" . $multimedia->archivo));

                    $multimedia->delete();
                    HistorialAccion::create([
                        'user_id' => Auth::user()->id,
                        'accion' => 'CREACIÓN',
                        'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ELIMINO UNA MULTIMEDIA',
                        'datos_original' => $datos_original,
                        'modulo' => 'MULTIMEDIAS',
                        'fecha' => date('Y-m-d'),
                        'hora' => date('H:i:s')
                    ]);
                }
            }

            $array_imgs = ["jpg", "jpeg", "png", "webp", "gif"];
            $array_videos = ["mp4", "avi", "flv", "mkv"];


            if (isset($request->multimedias)) {
                foreach ($multimedias as $p) {
                    if ($p["id"] != 0) {
                        $multimedia = Multimedia::find($p["id"]);
                        $multimedia->update(array_map("mb_strtoupper", [
                            "titulo" => $p["titulo"],
                        ]));
                        $datos_original = HistorialAccion::getDetalleRegistro($multimedia, "multimedias");

                        if ($p['archivo']) {
                            if (is_uploaded_file($p["archivo"])) {
                                $file = $p["archivo"];
                                $extension = $file->getClientOriginalExtension();

                                $tipo = "";
                                if (in_array($extension, $array_imgs)) {
                                    $tipo = "imagen";
                                }
                                if (in_array($extension, $array_videos)) {
                                    $tipo = "video";
                                }

                                if ($tipo == "") {
                                    throw ValidationException::withMessages([
                                        'error' =>  "El formato multimedia de uno de los registros no es valido. No se pudo actualizar los registros",
                                    ]);
                                }

                                $antiguo = $multimedia->archivo;
                                \File::delete(public_path() . '/files/multimedias/' . $antiguo);

                                $multimedia->tipo = $tipo;
                                $nom_archivo = time() . '_' . $multimedia->id . '.' . $extension;
                                $multimedia->archivo = $nom_archivo;
                                $file->move(public_path() . '/files/multimedias/', $nom_archivo);
                            }
                        }
                        $multimedia->save();
                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ACTUALIZO UNA MULTIMEDIA',
                            'datos_original' => $datos_original,
                            'modulo' => 'MULTIMEDIAS',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    } else {
                        $multimedia = Multimedia::create(array_map("mb_strtoupper", [
                            "titulo" => $p["titulo"],
                        ]));
                        $datos_original = HistorialAccion::getDetalleRegistro($multimedia, "multimedias");

                        if ($p['archivo']) {
                            if (is_uploaded_file($p["archivo"])) {
                                $file = $p["archivo"];
                                $extension = $file->getClientOriginalExtension();

                                $tipo = "";
                                if (in_array($extension, $array_imgs)) {
                                    $tipo = "imagen";
                                }
                                if (in_array($extension, $array_videos)) {
                                    $tipo = "video";
                                }

                                if ($tipo == "") {
                                    throw ValidationException::withMessages([
                                        'error' =>  "El formato multimedia de uno de los registros no es valido. No se pudo actualizar los registros",
                                    ]);
                                }

                                $multimedia->tipo = $tipo;
                                $nom_archivo = time() . '_' . $multimedia->id . '.' . $extension;
                                $multimedia->archivo = $nom_archivo;
                                $file->move(public_path() . '/files/multimedias/', $nom_archivo);
                            }
                        }
                        $multimedia->save();

                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' REGISTRO UNA MULTIMEDIA',
                            'datos_original' => $datos_original,
                            'modulo' => 'MULTIMEDIAS',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route("multimedias.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function update(Multimedia $multimedia, Request $request)
    {
    }

    public function destroy(Multimedia $multimedia)
    {
    }
}
