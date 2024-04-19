<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrabajoAuditoria extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "codigo",
        "tipo_trabajo_id",
        "empresa",
        "responsable_id",
        "objeto",
        "objetivo",
        "periodo",
        "fecha_ini",
        "duracion",
        "fecha_entrega",
        "fecha_registro",
    ];

    protected $appends = ["fecha_registro_t", "fecha_ini_t", "fecha_entrega_t", "mas"];

    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }

    public function getFechaIniTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_ini));
    }

    public function getFechaEntregaTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_entrega));
    }

    public function getMasAttribute()
    {
        return false;
    }

    public function tipo_trabajo()
    {
        return $this->belongsTo(TipoTrabajo::class, 'tipo_trabajo_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }

    public function personal_trabajos()
    {
        return $this->hasMany(PersonalTrabajo::class, 'trabajo_auditoria_id');
    }

    public function etapa_auditoria()
    {
        return $this->hasOne(EtapaAuditoria::class, 'trabajo_auditoria_id');
    }

    public function papel_trabajo()
    {
        return $this->hasOne(PapelTrabajo::class, 'trabajo_auditoria_id');
    }
}
