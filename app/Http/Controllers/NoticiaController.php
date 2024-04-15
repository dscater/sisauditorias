<?php

namespace App\Http\Controllers;

use App\Models\HistorialAccion;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias  = Noticia::all();
        return Inertia("Institucions/Noticias", compact("noticias"));
    }

    public function show(Noticia $noticia)
    {
        return $noticia;
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $noticias = $request->noticias;
            if (isset($request->eliminados) && $request->eliminados) {
                $eliminados = $request->eliminados;
                foreach ($eliminados as $e) {
                    $noticia = Noticia::find($e);
                    $datos_original = HistorialAccion::getDetalleRegistro($noticia, "noticias");
                    $noticia->delete();
                    HistorialAccion::create([
                        'user_id' => Auth::user()->id,
                        'accion' => 'CREACIÓN',
                        'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ELIMINO UNA NOTICIA',
                        'datos_original' => $datos_original,
                        'modulo' => 'NOTICIAS',
                        'fecha' => date('Y-m-d'),
                        'hora' => date('H:i:s')
                    ]);
                }
            }
            if (isset($request->noticias)) {
                foreach ($noticias as $p) {
                    if ($p["id"] != 0) {
                        $noticia = Noticia::find($p["id"]);
                        $noticia->update(array_map("mb_strtoupper", $p));
                        $datos_original = HistorialAccion::getDetalleRegistro($noticia, "noticias");
                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' ACTUALIZO UNA NOTICIA',
                            'datos_original' => $datos_original,
                            'modulo' => 'NOTICIAS',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    } else {
                        $noticia = Noticia::create(array_map("mb_strtoupper", $p));
                        $datos_original = HistorialAccion::getDetalleRegistro($noticia, "noticias");
                        HistorialAccion::create([
                            'user_id' => Auth::user()->id,
                            'accion' => 'CREACIÓN',
                            'descripcion' => 'EL USUARIO ' . Auth::user()->usuario . ' REGISTRO UNA NOTICIA',
                            'datos_original' => $datos_original,
                            'modulo' => 'NOTICIAS',
                            'fecha' => date('Y-m-d'),
                            'hora' => date('H:i:s')
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route("noticias.index")->with("bien", "Registro realizado");
        } catch (\Exception $e) {
            DB::rollBack();
            throw ValidationException::withMessages([
                'error' =>  $e->getMessage(),
            ]);
        }
    }

    public function update(Noticia $noticia, Request $request)
    {
    }

    public function destroy(Noticia $noticia)
    {
    }
}
