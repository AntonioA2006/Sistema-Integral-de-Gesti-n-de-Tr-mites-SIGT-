<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

   protected $fillable = ['name','tipo_de_tramite_id'];

    public function requirements(){
        return $this->hasMany(Requisito::class);
    }
    // public function type(){
    //     return $this->belongsTo(TipoDeTramite::class);
    // }
}

