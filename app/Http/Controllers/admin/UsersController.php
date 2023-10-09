<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /* protege si no estas logueado */
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index () {
        $data = User::OrderBy('id','DESC')->get();
        return view('admin.users')
        ->with('registros',$data);
    }
    public function store(Request $request) {
        $reglas = Validator::make($request->all(),[
            'name'=>'required|min:5|max:255',
            'email'=>'required|email',
            'password'=>'required|min:3|required_with:password_confirm|same:password_confirm',
            'password_confirm'=>'required'
        ]);
        if($reglas->fails()){
            return back()
            ->withInput()
            ->with('errorInsertar','Favor de llenar todos los campos')
            ->withErrors($reglas);
        }else{
            $usuario = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'nickname'=>'user_',
                'img'=>'default.jpg'
            ]);
            //parametros del nickname
            $usuario->nickname = 'user_'.$usuario->id;
            $usuario->save();
            
            return back()
            ->with('success','Datos insertados correctamente');
            //dd("DATO INSERTADO");
            //dd("CUMPLE");
        }
        //dd($request);
    }//llave store
}
