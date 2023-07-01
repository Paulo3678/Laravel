<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];


    /** Cria um escopo global que é executado por todos os métodos
     * do model
     */
    protected static function booted(){
        self::addGlobalScope('ordered', function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome');
        });
    }



    /**
     * Para definir um relacionamento no Eloquent, nos criamos um 
     * método de relacionamento
     * 
     * O nome desse método, é o nome pelo qual eu quero acessar esse
     * relacionamento
     * 
     * Esse método deve retornar um tipo de relacionament 1:1, 
     * 1:N,  N:1, N:N
     */

    public function temporadas()
    {
        /** 1:N */
        return $this->hasMany(Season::class, "series_id");
    }
}
