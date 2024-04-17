<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaAuditoria extends Model
{
    use HasFactory;

    protected $fillable = [
        "trabajo_auditoria_id",
        "fecha_registro"
    ];

    protected $appends = ["fecha_registro_t"];

    public function getFechaRegistroTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha_registro));
    }

    public function trabajo_auditoria()
    {
        return $this->belongsTo(TrabajoAuditoria::class, 'trabajo_auditoria_id');
    }

    public function etapa_nombres()
    {
        return $this->hasMany(EtapaNombre::class, 'etapa_auditoria_id');
    }
}
