<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $fillable = [
        "institucion",
        "nombre_sistema",
        "nit",
        "img_organigrama",
        "mision",
        "vision",
        "principios",
        "valores",
        "administracion",
        "codigo_etica",
        "informacion_financiera",
        "ubicacion_google",
        "ciudad",
        "dir",
        "fonos",
        "horario",
        "correo",
        "logo",
    ];

    protected $appends = [
        "iniciales_nombre",
        "url_logo",
        "url_img_organigrama",
        "logo_b64",
    ];


    public function getLogoB64Attribute()
    {
        $path = public_path("imgs/" . $this->logo);
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

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
