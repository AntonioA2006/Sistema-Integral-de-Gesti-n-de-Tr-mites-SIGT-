<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;
    protected $table = 'requisitos';


    protected $fillable = [
        'name',
        'tipo_de_tramites_id'
    ];

    public function formalities(){
        return $this->belongsTo(Tramite::class);
    }
}
