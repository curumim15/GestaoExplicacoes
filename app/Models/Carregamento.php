<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carregamento extends Model
{
    use HasFactory;

    protected $table = 'carregamentos';

    protected $fillable = ['user_id', 'valor', 'estado'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
