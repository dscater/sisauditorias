<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaNombre extends Model
{
    use HasFactory;

    protected $fillable = [
        "etapa_auditoria_id",
        "nro_etapa",
        "nombre",
    ];

    public function etapa_auditoria()
    {
        return $this->belongsTo(EtapaAuditoria::class, 'etapa_auditoria_id');
    }

    public function etapa_archivos()
    {
        return $this->hasMany(EtapaArchivos::class, 'etapa_nombre_id');
    }
}
