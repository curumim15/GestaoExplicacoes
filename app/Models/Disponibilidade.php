<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilidade extends Model
{
    use HasFactory;

    public function explicacao()
    {
        return $this->belongsTo(Explicacao::class);
    }
}
