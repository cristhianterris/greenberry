<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use App\Palabra;
use App\Mensaje;
use Carbon\Carbon;
use Validator;
use Excel;
use Auth;
use DB;
use Mail;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class MensajeController extends Controller
{
    public function index()
    {
        return view('mensaje.index');
    }

    public function listar()
    {
        $mensajes = DB::table('mensajes')->orderBy('created_at','desc')
            ->paginate(30);       
        return view('mensaje.listar', compact('mensajes'));
    }

    
    public function info($mensaje_id)
    {
        
        $mensaje = Mensaje::find($mensaje_id);        
       
        return view('mensaje.info',compact('mensaje'));
    }
 
    public function buscar($consulta)
    {
        $mensajes = DB::table('mensajes')            
            ->where('contacto', 'LIKE', '%'.$consulta.'%')
            ->orWhere('correo', 'LIKE', '%'.$consulta.'%')
            ->orWhere('asunto', 'LIKE', '%'.$consulta.'%')
            ->orWhere('mensaje', 'LIKE', '%'.$consulta.'%')
            ->orWhere('created_at', 'LIKE', '%'.$consulta.'%')
            ->paginate(30);  
            
        return view('mensaje.listar', compact('mensajes'));
    }

}