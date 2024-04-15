<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        "titulo",
        "archivo",
        "tipo",
    ];

    protected $appends = ["url_archivo"];

    public function getUrlArchivoAttribute()
    {
        return asset("/files/multimedias/" . $this->archivo);
    }
}
