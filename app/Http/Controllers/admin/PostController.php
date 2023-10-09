<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\Category;

class PostController extends Controller
{
    /* protege si no estas logueado */
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $datos = Post::select(['posts.*','categorys.category'])
            ->join('categorys','posts.id_category','=','categorys.id')
            ->where('posts.id_user','=',Auth::user()->id)
            ->get();
            $c = Category::all();

        return view('admin.posts')
            ->with('registros', $datos)
            ->with('categorys',$c);
    }
    public function store(Request $request) {
        $reglas = Validator::make($request->all(),[
            'title'=>'required|min:5|max:255',
            'content'=>'required',
            'img'=>'required|mimes:jpg,png,gif,wep|max:2048',
            'id_category'=>'required',
        ]);
        if($reglas->fails()){
            return back()
            ->withInput()
            ->with('errorInsertar','Favor de llenar todos los campos')
            ->withErrors($reglas);
        }else{
            
            //subir la imagen de usuarios a public_path("img/posts")
            $file = $request->file('img');
            $name = time().'.'.$file->getClientOriginalExtension();
            $destino = public_path("img/posts");
            $request->img->move($destino, $name);
            //

            //registro
            $data = Post::create([
                'title'=>$request->title,
                'content'=>$request->content,
                'img'=>$name,
                'slug'=>'',
                'likes'=>0,
                'id_user'=>Auth::user()->id,
                'id_category'=>$request->id_category
            ]);

            return back()
            ->with('success','Datos insertados correctamente');
            //dd("DATO INSERTADO");
            //dd("CUMPLE");
        }
        //dd($request);
    }//llave store
}
