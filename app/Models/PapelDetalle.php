<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapelDetalle extends Model
{
    use HasFactory;

    protected $fillable = [
        "papel_trabajo_id",
        "nro_etapa",
        "nro_nombre",
        "aplicabilidad",
        "estado",
    ];

    protected $appends = ["nombre"];

    public function getNombreAttribute()
    {
        $array_nombres = [
            "1" => [
                "1" => "Memorándum de Planificación de Auditoría referenciado a los documentos de respaldo",
                "2" => "Programas de Trabajo",
                "3" => "Documentación de respaldo del memorándum de planificación de auditoría",
                "4" => "Matriz de hallazgos de auditoría y documentación sustentatoria de los mismos",
                "5" => "Detalle de funcionarios de la entidad auditada relacionados con las operaciones sujetas al examen",
                "6" => "Correspondencia recibida y expedida",
                "7" => "Planilla de pendientes",
            ],
            "2" => [
                "1" => "Formulario de inspección de la Gerencia de auditoría",
                "2" => "Informe preliminar de auditoría con indicios de responsabilidad por la función pública, referenciado al Legajo de Prueba y Papeles de Trabajo",
                "3" => "Informe circunstanciado de hechos, referenciado al legajo de prueba de papeles de trabajo",
                "4" => "Informe con pronunciamiento, referenciado a los papeles de trabajo",
                "5" => "Informe sin indicios de responsabilidad con recomendaciones de control interno, referenciado a Papeles de Trabajo",
                "6" => "Nota administrativa, referenciado al legajo de prueba y legajo de papeles de trabajo",
                "7" => "Acta de compatibilización de los informes de auditoría y legal",
                "8" => "Informe legal de la Asesoría Legal",
                "9" => "Formulario de Inspección de la Gerencia de servicios Legales",
                "10" => "Informe de evaluación técnica/opinión técnica y otros, referenciado a los papeles de trabajo, adjuntando el documento de inspección técnica",
                "11" => "Confirmación de la entidad sobre la documentación proporcionada a la comisión de auditoría",
                "12" => "Cédula y formularios de reuniones sostenidas con los funcionarios de la entidad",
                "13" => "Cédula de sugerencias para futuros exámenes",
                "14" => "Acta de entrega y devolución de documentos",
                "15" => "Formulario F-1 y F1-A, éste último si corresponde",
                "16" => "Planilla de control de horas asignadas",
            ]
        ];

        if ($this->nro_etapa != 3) {
            return $array_nombres[$this->nro_etapa][$this->nro_nombre];
        }
        return "";
    }

    public function papel_trabajo()
    {
        return $this->belongsTo(PapelTrabajo::class, 'papel_trabajo_id');
    }

    public function papel_archivos()
    {
        return $this->hasMany(PapelArchivo::class, 'papel_detalle_id');
    }
}
