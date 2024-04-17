<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapaArchivos extends Model
{
    use HasFactory;

    protected $fillable = [
        "etapa_nombre_id",
        "archivo",
        "ext",
    ];

    protected $appends = ["url_file", "url_archivo", "name"];

    public function getUrlFileAttribute()
    {
        $array_imgs = ["jpge", "jpeg", "png", "webp", "gif"];
        if (in_array($this->ext, $array_imgs)) {
            return asset("/files/" . $this->archivo);
        }
        return asset("/imgs/attach.png");
    }

    public function getUrlArchivoAttribute()
    {
        return asset("/files/" . $this->archivo);
    }

    public function getNameAttribute()
    {
        return $this->archivo;
    }

    public function etapa_nombre()
    {
        return $this->belongsTo(EtapaNombre::class, 'etapa_nombre_id');
    }
}
