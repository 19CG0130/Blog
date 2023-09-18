<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    public function index() {
        $total=rand(5,20);
        //select
        $consulta = Post::all();
        
        return view('front.index')
            ->with('cuantos',$total)
            ->with('datos',$consulta);
    }
}
