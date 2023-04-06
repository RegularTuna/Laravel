<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //dizer ao modelo quais são os campos que podem ser alterados
    /*
    protected $fillable = [
        'name'
    ]
        */

    //outra forma que faz o inverso, ou seja, quais os campos que nao se pode alterar
    protected $guarded = ['id'];
}
