<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Usuario extends Model
{
    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'foto',
    ];

    public function getEdadCompletaAttribute()
    {
        $fecha = Carbon::parse($this->fecha_nacimiento);
        $ahora = Carbon::now();
        $diff = $fecha->diff($ahora);
        return $diff->y.' años, '.$diff->m.' meses, '.$diff->d.' días';
    }

    public function getFotoUrlAttribute()
    {
        if (!$this->foto) {
            return asset('images/default-user.png');
        }
        if (str_starts_with($this->foto, 'fotos/')) {
            return asset('storage/' . $this->foto);
        }
        if (str_starts_with($this->foto, 'images/')) {
            return asset($this->foto);
        }
        return asset('images/default-user.png');
    }
}
