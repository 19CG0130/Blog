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
    //hace que se inserte el registro y se guarde la img en la cacrpeta
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

    //no tomar en cuenta la imagen del post a excepcion del default.jpg
    public function destroy($id){
        $registro = Post::find($id);
        if(file_exists( public_path('img/posts/'.$registro->img)) && 
            $registro->img != 'default.jpg' ){
                unlink(public_path('img/posts/'.$registro->img));
            }
            $registro->delete();
            return back()
                ->with('success','Datos eliminados correctamente');
    }
    public function update(Request $request) {
        $reglas = Validator::make($request->all(),[
            'title'=>'required|min:5|max:255',
            'content'=>'required',
            'id_category'=>'required',
        ]);
        if($reglas->fails()){
            return back()
            ->withInput()
            ->with('errorInsertar','Favor de llenar todos los campos')
            ->withErrors($reglas);
        }else{

            //registro que se actualiza
            $registro = Post::find($request->id);
            $registro->title = $request->title; // update post set title='adsadadadad'
            $registro->content = $request->content; // update post set title='adsadadadad'
            $registro->id_category = $request->id_category; // update post set title='adsadadadad'
            $registro->save(); //lo guarda

            return back()
            ->with('success','Datos actualizados correctamente');
            //dd("DATO INSERTADO");
            //dd("CUMPLE");
        }
        //dd($request);
    }//llave store
    
}
