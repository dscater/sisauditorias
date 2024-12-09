<?php

namespace App\Http\Controllers;

use App\Models\Biometrico;
use App\Models\Empresa;
use App\Models\EtapaAuditoria;
use App\Models\PapelTrabajo;
use App\Models\Servicio;
use App\Models\SolicitudMantenimiento;
use App\Models\TipoTrabajo;
use App\Models\TrabajoAuditoria;
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
            "reportes.trabajo_auditorias",
            "reportes.g_trabajo_auditorias",
        ],
        "SUPERVISOR DE AUDITORÍA" => [
            "etapa_auditorias.index",
            "etapa_auditorias.create",
            "etapa_auditorias.edit",
            "etapa_auditorias.destroy",

            "papel_trabajos.index",
            "papel_trabajos.create",
            "papel_trabajos.edit",
            "papel_trabajos.destroy",

            "reportes.trabajo_auditorias",
            "reportes.g_trabajo_auditorias",
        ],
        "AUDITOR" => [
            "etapa_auditorias.index",
            "etapa_auditorias.create",
            "etapa_auditorias.edit",
            "etapa_auditorias.destroy",

            "papel_trabajos.index",
            "papel_trabajos.create",
            "papel_trabajos.edit",
            "papel_trabajos.destroy",

            "reportes.trabajo_auditorias",
            "reportes.g_trabajo_auditorias",
        ],
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
                'icon' => asset("imgs/USUARIOS.png") . '?t=' . time(),
                "url" => "usuarios.index"
            ];
        }
        if (in_array('tipo_trabajos.index', self::$permisos[$tipo])) {
            $tipo_trabajos = count(TipoTrabajo::all());
            $array_infos[] = [
                'label' => 'Tipo de Trabajos de Auditoría',
                'cantidad' => $tipo_trabajos,
                'color' => 'bg-principal',
                'icon' => asset("imgs/TIPOSDETRABAJOSDEAUDITORIA.png") . '?t=' . time(),
                "url" => "tipo_trabajos.index"
            ];
        }
        if (in_array('trabajo_auditorias.index', self::$permisos[$tipo])) {
            $trabajo_auditorias = count(TrabajoAuditoria::all());
            $array_infos[] = [
                'label' => 'Trabajos de Auditoría',
                'cantidad' => $trabajo_auditorias,
                'color' => 'bg-principal',
                'icon' => asset("imgs/TRABAJOSDEAUDOTORIA.png") . '?t=' . time(),
                "url" => "trabajo_auditorias.index"
            ];
        }
        if (in_array('etapa_auditorias.index', self::$permisos[$tipo])) {
            $etapa_auditorias = count(EtapaAuditoria::all());
            $array_infos[] = [
                'label' => 'Etapas de Auditoría',
                'cantidad' => $etapa_auditorias,
                'color' => 'bg-principal',
                'icon' => asset("imgs/ETAPASDEAUDITORIA.png") . '?t=' . time(),
                "url" => "etapa_auditorias.index"
            ];
        }
        if (in_array('papel_trabajos.index', self::$permisos[$tipo])) {
            $papel_trabajos = count(PapelTrabajo::all());
            $array_infos[] = [
                'label' => 'Papeles de Trabajo',
                'cantidad' => $papel_trabajos,
                'color' => 'bg-principal',
                'icon' => asset("imgs/PAPELESDETRABAJO.png") . '?t=' . time(),
                "url" => "papel_trabajos.index"
            ];
        }
        return $array_infos;
    }
}
