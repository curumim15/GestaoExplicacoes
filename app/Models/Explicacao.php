<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explicacao extends Model
{
    use HasFactory;

    protected $table = 'explicacoes';

    protected $fillable = [
        'disciplina',
        'max_alunos',
        'data_hora',
        'descricao',
        'preco',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function compras()
    {
        return $this->hasMany(Compras::class);
    }

    public function professor()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function disponibilidades()
    {
        return $this->hasMany(Disponibilidade::class);
    }
}
