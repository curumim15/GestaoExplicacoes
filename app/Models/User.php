<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'telemovel',
        'dataNascimento',
        'genero',
        'credito',
        'associado',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role->nome === 'admin';
    }

    public function isAluno()
    {
        return $this->role->nome === 'aluno';
    }

    public function isProfessor()
    {
        return $this->role->nome === 'professor';
    }

    public function hasRole($role)
    {
        if ($this->role()->where('nome', $role)->first()) {
            return true;
        }
        return false;
    }

    public function explicacoes()
    {
        return $this->hasMany(Explicacao::class, 'user_id');
    }

    public function compras()
    {
        return $this->hasMany(Compras::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function associados()
    {
        return $this->hasMany(Associado::class, 'user_id');
    }

}
