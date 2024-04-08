<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $fillable = [
        "nombre",
        "nombre_sistema",
        "nit",
        "historia",
        "mision",
        "vision",
        "objetivo",
        "nombre_director",
        "foto_director",
        "nombre_subdirector",
        "foto_subdirector",
        "fono1",
        "fono2",
        "correo1",
        "correo2",
        "facebook",
        "youtube",
        "twitter",
        "dir",
        "ubicacion_google",
        "img_organigrama",
        "logo",
        "logo2",
    ];

    protected $appends = [
        "iniciales_nombre",
        "url_logo",
        "url_img_organigrama",

    ];

    public function getInicialesNombreAttribute()
    {
        $array_nombre = explode(" ", $this->nombre);
        $iniciales = "";
        foreach ($array_nombre as $value) {
            $iniciales .= substr($value, 0, 1);
        }

        return $iniciales;
    }

    public function getUrlLogoAttribute()
    {
        if ($this->logo && trim($this->logo) != "") {
            return asset("imgs/" . $this->logo);
        }
        return null;
    }

    public function getUrlImgOrganigramaAttribute()
    {
        if ($this->img_organigrama && trim($this->img_organigrama) != "") {
            return asset("imgs/" . $this->img_organigrama);
        }
        return null;
    }
}
