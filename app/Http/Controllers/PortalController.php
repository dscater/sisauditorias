<?php

namespace App\Http\Controllers;

use App\Models\Multimedia;
use App\Models\Noticia;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PortalController extends Controller
{
    public function inicio()
    {
        return Inertia::render('Inicio');
    }

    public function comunicacion()
    {

        $publicacions = Publicacion::all();
        $noticias = Noticia::all();
        $multimedias = Multimedia::all();

        return Inertia::render('Comunicacion', compact("publicacions", "noticias", "multimedias"));
    }

    public function transparencia()
    {
        return Inertia::render('Transparencia');
    }

    public function contactos()
    {
        return Inertia::render('Contactos');
    }
}
