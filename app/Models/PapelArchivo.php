<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PapelArchivo extends Model
{
    use HasFactory;

    protected $fillable = [
        "papel_detalle_id",
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

    public function papel_detalle()
    {
        return $this->belongsTo(PapelDetalle::class, 'papel_detalle_id');
    }
}
