<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UsersController extends Controller
{
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
            dd("CUMPLE");
        }
        //dd($request);
    }//llave store
}
