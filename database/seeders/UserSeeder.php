<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "usuario" => "admin",
            "password" => Hash::make("admin"),
            "nombre" => "admin",
            "paterno" => "",
            "materno" => "",
            "ci" => "0",
            "ci_exp" => "",
            "sexo" => "",
            "nacionalidad" => "",
            "dir" => "",
            "email" => "admin@gmail.com",
            "fono" => "",
            "profesion" => "",
            "cargo" => "GERENTE",
            "nivel" => "",
            "tipo" => "GERENTE AUDITOR",
            "foto" => "",
            "acceso" => 1,
            "fecha_registro" => "2024-04-08",
        ]);
    }
}
