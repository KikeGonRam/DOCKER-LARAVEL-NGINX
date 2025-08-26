<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function index()
    {
        // Usuarios por rango de edad
        $rangos = [
            '0-10' => 0,
            '11-17' => 0,
            '18-25' => 0,
            '26-35' => 0,
            '36-50' => 0,
            '51+' => 0,
        ];
        $result = DB::select(<<<SQL
            SELECT
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) <= 10 THEN 1 ELSE 0 END) as r0_10,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 11 AND 17 THEN 1 ELSE 0 END) as r11_17,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 18 AND 25 THEN 1 ELSE 0 END) as r18_25,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 26 AND 35 THEN 1 ELSE 0 END) as r26_35,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) BETWEEN 36 AND 50 THEN 1 ELSE 0 END) as r36_50,
                SUM(CASE WHEN TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) > 50 THEN 1 ELSE 0 END) as r51
            FROM usuarios
        SQL);
        if ($result) {
            $rangos['0-10'] = $result[0]->r0_10;
            $rangos['11-17'] = $result[0]->r11_17;
            $rangos['18-25'] = $result[0]->r18_25;
            $rangos['26-35'] = $result[0]->r26_35;
            $rangos['36-50'] = $result[0]->r36_50;
            $rangos['51+'] = $result[0]->r51;
        }

        // Usuarios por año de nacimiento

    // Usuarios por año de nacimiento (SQL directo)
    $porAnio = collect(DB::select('SELECT YEAR(fecha_nacimiento) as anio, COUNT(*) as total FROM usuarios GROUP BY anio ORDER BY anio'));
    $porAnio = $porAnio->pluck('total', 'anio');

    // Usuarios registrados por mes (SQL directo)
    $porMes = collect(DB::select('SELECT DATE_FORMAT(created_at, "%Y-%m") as mes, COUNT(*) as total FROM usuarios GROUP BY mes ORDER BY mes'));
    $porMes = $porMes->pluck('total', 'mes');

        return view('usuarios.graficas', [
            'rangos' => $rangos,
            'porAnio' => $porAnio,
            'porMes' => $porMes,
        ]);
    }
}
