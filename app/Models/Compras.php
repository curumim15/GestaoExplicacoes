<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;

    protected $table = 'compras';

    protected $fillable = [
        'user_id',
        'explicacao_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function explicacao()
    {
        return $this->belongsTo(Explicacao::class);
    }

    public function professor()
    {
        return $this->hasMany(User::class);
    }
}
