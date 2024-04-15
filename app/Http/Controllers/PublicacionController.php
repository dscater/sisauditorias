<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicacions  = Publicacion::all();
        return Inertia("Institucions/Publicacions", compact("publicacions"));
    }

    public function show(Publicacion $publicacion)
    {
        return $publicacion;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $publicacions = $request->publicacions;
            if (isset($request->eliminados) && $request->eliminados) {
                $eliminados = $request->eliminados;
                foreach ($eliminados as $e) {
                    $publicacion = Publicacion::find($e);
                    $datos_original = HistorialAccion::getDetalleRegistro($publicacion, "publicacions");
                    $publicacion->delete();
                    HistorialAccion::create([
                        'user_id' => Auth::user()->id,
                        'accion' => 'CREACIÓN',
                        'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ELIMINO UNA PUBLCIACION',
                        'datos_original' => $datos_original,
                        'modulo' => 'PUBLCIACIONES',
                        'fecha' => date('Y-m-d'),
                        'hora' => date('H:i:s')
                    ]);
                }
            }
            if (isset($request->publicacions)) {
                foreach ($publicacions as $p) {
                    if ($p["id"] != 0) {
                        $publicacion = Publicacion::find($p["id"]);
                        $publicacion->update(array_map("mb_strtoupper", $p));
                        $datos_original = HistorialAccion::getDetalleRegistro($publicacion, "publicacions");
                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ACTUALIZO UNA PUBLCIACION',
                            'datos_original' => $datos_original,
                            'modulo' => 'PUBLCIACIONES',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    } else {
                        $publicacion = Publicacion::create(array_map("mb_strtoupper", $p));
                        $datos_original = HistorialAccion::getDetalleRegistro($publicacion, "publicacions");
                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' REGISTRO UNA PUBLCIACION',
                            'datos_original' => $datos_original,
                            'modulo' => 'PUBLCIACIONES',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route("publicacions.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function update(Publicacion $publicacion, Request $request)
    {
    }

    public function destroy(Publicacion $publicacion)
    {
    }
}
