<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';

    protected $fillable = [
        'section_name',
        'roles_id'
    ];


    public function roles(){
        return $this->hasMany(Role::class);
    }
}
