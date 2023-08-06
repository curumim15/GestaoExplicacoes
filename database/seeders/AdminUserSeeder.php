<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('nome', 'admin')->first();

        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('password');
        $admin->estado = 'aprovado';
        $admin->telemovel = '962480606';
        $admin->genero = 'masculino';
        $admin->avatar = '/images/default.png';
        $admin->dataNascimento = Carbon::create(2001, 12, 4);
        $admin->role_id = $adminRole->id;
        $admin->save();
    }
}
