<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserManagement extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_management';

    protected $fillable = [
        'curp',
        'name',
        'last_name',
        'first_name',
        'birthdate',
        'state',
        'city',
        'section_id',
        'password', // Asegúrate de manejar la contraseña de manera segura
    ];

    // Puedes agregar métodos adicionales aquí según sea necesario
}

