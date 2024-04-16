<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalTrabajo extends Model
{
    use HasFactory;

    protected $fillable = [
        "trabajo_auditoria_id",
        "personal_id",
        "horas",
    ];

    public function trabajo_auditoria()
    {
        return $this->belongsTo(TrabajoAuditoria::class, 'trabajo_auditoria_id');
    }

    public function personal()
    {
        return $this->belongsTo(User::class, 'personal_id');
    }
}
