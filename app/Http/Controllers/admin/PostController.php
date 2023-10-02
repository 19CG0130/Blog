<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {

        $datos = Post::all();
        return view('admin.posts')
            ->with('registros', $datos);
    }
}
