<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    //declarar campos que se pueden llenar
    protected $fillable=['title','content','img','slug','likes',
    'id_user','id_category'
    ];
}
