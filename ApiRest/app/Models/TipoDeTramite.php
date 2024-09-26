<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDeTramite extends Model
{
    use HasFactory;
    protected $table = 'tipo_de_tramites';
    protected $fillable = [
        'name',
        'comments',
         'requisitos_id'
    ];


    public function formalities(){
        return $this->hasMany(Tramite::class);
    }
}
