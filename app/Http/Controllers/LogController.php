<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Log;
use App\User;
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
class LogController extends Controller
{
    public function index()
    {
        return view('log.index');
    }

    public function listar()
    {
        $logs = DB::table('logs')
            ->orderBy('created_at','desc')
            ->paginate(30);       
        return view('log.listar', compact('logs'));
    }

    public function info($log_id)
    {
        
        $log = Log::find($log_id);        
       
        return view('log.info',compact('log'));
    }
 
    public function buscar($consulta)
    {
        $logs = DB::table('logs')            
            ->where('user_id', 'LIKE', '%'.$consulta.'%')
            ->orWhere('user_nombre', 'LIKE', '%'.$consulta.'%')
            ->orWhere('accion', 'LIKE', '%'.$consulta.'%')
            ->orWhere('tabla', 'LIKE', '%'.$consulta.'%')
            ->orWhere('detalle', 'LIKE', '%'.$consulta.'%')
            ->orWhere('created_at', 'LIKE', '%'.$consulta.'%')
            ->orderBy('created_at','desc')
            ->paginate(30);  
            
        return view('log.listar', compact('logs'));
    }
       
    public function registrar($accion, $registro) 
    {
            
            $user_id = Auth::user()->id;
            $user_nombre= Auth::user()->name;
            $tabla = $registro->getTable();
            $detalle = $registro->toJson();
            $detalle = Str::of($detalle)
                ->replace('{"', '')
                ->replace(',"', ', ')
                ->replace('"', '')
                ->replace('}', '');
            
            $log = new Log();
            $log->user_id = $user_id;
            $log->user_nombre = $user_nombre;
            $log->accion = $accion;
            $log->tabla = $tabla;
            $log->detalle = $detalle;
            $log->created_at = date('Y-m-d H:i:s'); 
            $log->save();

    }

}