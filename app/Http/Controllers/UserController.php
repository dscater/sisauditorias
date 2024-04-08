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

            "empresas.index",
            "empresas.create",
            "empresas.edit",
            "empresas.destroy",

            "biometricos.index",
            "biometricos.create",
            "biometricos.edit",
            "biometricos.destroy",

            "repuestos.index",
            "repuestos.create",
            "repuestos.edit",
            "repuestos.destroy",

            "solicitud_mantenimientos.index",
            "solicitud_mantenimientos.create",
            "solicitud_mantenimientos.edit",
            "solicitud_mantenimientos.destroy",

            "servicios.index",
            "servicios.create",
            "servicios.edit",
            "servicios.destroy",

            "documentos.index",
            "documentos.create",
            "documentos.edit",
            "documentos.destroy",

            "institucions.index",
            "institucions.create",
            "institucions.edit",
            "institucions.destroy",

            "reportes.usuarios",
            "reportes.solicitud_mantenimiento",
            "reportes.servicio",
            "reportes.equipos",
            "reportes.historial_mantenimientos"
        ],
        "JEFE DE ÁREA" => [
            "solicitud_mantenimientos.index",
            "solicitud_mantenimientos.create",
            "solicitud_mantenimientos.edit",
            "solicitud_mantenimientos.destroy",

            "servicios.index",
            "servicios.create",
            "servicios.edit",
            "servicios.destroy",

            "reportes.solicitud_mantenimiento",
            "reportes.servicio",
            "reportes.equipos",
            "reportes.historial_mantenimientos"
        ],
        "TÉCNICO" => [
            "unidad_areas.index",
            "unidad_areas.create",
            "unidad_areas.edit",
            "unidad_areas.destroy",

            "empresas.index",
            "empresas.create",
            "empresas.edit",
            "empresas.destroy",

            "biometricos.index",
            "biometricos.create",
            "biometricos.edit",
            "biometricos.destroy",

            "repuestos.index",
            "repuestos.create",
            "repuestos.edit",
            "repuestos.destroy",

            "solicitud_mantenimientos.index",
            "solicitud_mantenimientos.create",
            "solicitud_mantenimientos.edit",
            "solicitud_mantenimientos.destroy",

            "servicios.index",
            "servicios.create",
            "servicios.edit",
            "servicios.destroy",

            "documentos.index",
            "documentos.create",
            "documentos.edit",
            "documentos.destroy",

            "reportes.solicitud_mantenimiento",
            "reportes.servicio",
            "reportes.equipos",
            "reportes.historial_mantenimientos"
        ],
        "DIRECTOR" => [
            "documentos.index",
            "documentos.create",
            "documentos.edit",
            "documentos.destroy",

            "reportes.solicitud_mantenimiento",
            "reportes.servicio",
            "reportes.equipos",
            "reportes.historial_mantenimientos"
        ]
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
                'color' => 'bg-grey-darken-3',
                'icon' => asset("imgs/icon_users.png"),
                "url" => "usuarios.index"
            ];
        }
        return $array_infos;
    }
}
