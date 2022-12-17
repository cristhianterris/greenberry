<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        $totUsuarios = DB::table('users')->count();
        $totPersonas = DB::table('personas')->count();
        $totMensajes = DB::table('mensajes')->count();
        $personas = DB::table('personas')  
            ->orderBy('created_at','desc')
            ->paginate(10); 
        $mensajes = DB::table('mensajes')->orderBy('created_at','desc')
            ->paginate(10);      
        return view('home', compact('totUsuarios', 'totPersonas' ,'personas' ,'totMensajes' ,'mensajes'));
    }    

}
