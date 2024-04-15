<?php

namespace App\Http\Controllers;

use App\Models\Biometrico;
use App\Models\Empresa;
use App\Models\Servicio;
use App\Models\SolicitudMantenimiento;
use App\Models\UnidadArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public static $permisos = [
        "GERENTE AUDITOR" => [
            "usuarios.index",
            "usuarios.create",
            "usuarios.edit",
            "usuarios.destroy",

            "institucions.index",
            "institucions.create",
            "institucions.edit",
            "institucions.destroy",

            "publicacions.index",
            "publicacions.create",
            "publicacions.edit",
            "publicacions.destroy",

            "noticias.index",
            "noticias.create",
            "noticias.edit",
            "noticias.destroy",

            "multimedias.index",
            "multimedias.create",
            "multimedias.edit",
            "multimedias.destroy",

            "tipo_trabajos.index",
            "tipo_trabajos.create",
            "tipo_trabajos.edit",
            "tipo_trabajos.destroy",

            "trabajo_auditorias.index",
            "trabajo_auditorias.create",
            "trabajo_auditorias.edit",
            "trabajo_auditorias.destroy",

            "etapa_auditorias.index",
            "etapa_auditorias.create",
            "etapa_auditorias.edit",
            "etapa_auditorias.destroy",

            "papel_trabajos.index",
            "papel_trabajos.create",
            "papel_trabajos.edit",
            "papel_trabajos.destroy",

            "reportes.usuarios",
        ],
        "SUPERVISOR DE AUDITORÍA" => [

            "tipo_trabajos.index",
            "tipo_trabajos.create",
            "tipo_trabajos.edit",
            "tipo_trabajos.destroy",

            "trabajo_auditorias.index",
            "trabajo_auditorias.create",
            "trabajo_auditorias.edit",
            "trabajo_auditorias.destroy",
        ],
        "AUDITOR" => [],
    ];


    public static function getPermisosUser()
    {
        $array_permisos = self::$permisos;
        if ($array_permisos[Auth::user()->tipo]) {
            return $array_permisos[Auth::user()->tipo];
        }
        return [];
    }


    public static function verificaPermiso($permiso)
    {
        if (in_array($permiso, self::$permisos[Auth::user()->tipo])) {
            return true;
        }
        return false;
    }

    public function permisos(Request $request)
    {
        return response()->JSON([
            "permisos" => $this->permisos[Auth::user()->tipo]
        ]);
    }

    public function getUser()
    {
        return response()->JSON([
            "user" => Auth::user()
        ]);
    }

    public static function getInfoBoxUser()
    {
        $tipo = Auth::user()->tipo;
        $array_infos = [];
        if (in_array('usuarios.index', self::$permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Usuarios',
                'cantidad' => count(User::where('id', '!=', 1)->get()),
                'color' => 'bg-principal',
                'icon' => asset("imgs/icon_users.png"),
                "url" => "usuarios.index"
            ];
        }
        if (in_array('tipo_trabajos.index', self::$permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Tipo de Trabajos de Auditoría',
                'cantidad' => 0,
                'color' => 'bg-principal',
                'icon' => asset("imgs/checklist.png"),
                "url" => "tipo_trabajos.index"
            ];
        }
        if (in_array('trabajo_auditorias.index', self::$permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Trabajos de Auditoría',
                'cantidad' => 0,
                'color' => 'bg-principal',
                'icon' => asset("imgs/icon_recursos.png"),
                "url" => "trabajo_auditorias.index"
            ];
        }
        if (in_array('etapa_auditorias.index', self::$permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Etapas de Auditoría',
                'cantidad' => 0,
                'color' => 'bg-principal',
                'icon' => asset("imgs/documents.png"),
                "url" => "etapa_auditorias.index"
            ];
        }
        if (in_array('papel_trabajos.index', self::$permisos[$tipo])) {
            $array_infos[] = [
                'label' => 'Papeles de Trabajo',
                'cantidad' => 0,
                'color' => 'bg-principal',
                'icon' => asset("imgs/documentos.png"),
                "url" => "papel_trabajos.index"
            ];
        }
        return $array_infos;
    }
}
