<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Persona;
use App\Log;
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
class PersonaController extends Controller
{
    public function index()
    {
        return view('persona.index');
    }

    public function listar()
    {
        $personas = DB::table('personas')
            ->orderBy('created_at','desc')
            ->paginate(20);       
        return view('persona.listar', compact('personas'));
    }

    public function info($persona_id)
    {
        
        $persona = Persona::find($persona_id);        
       

        return view('persona.info',compact('persona'));
    }
 
    public function buscar($consulta)
    {
        $personas = DB::table('personas')            
            ->where('nombres', 'LIKE', '%'.$consulta.'%')
            ->orWhere('correo', 'LIKE', '%'.$consulta.'%')
            ->orderBy('created_at','desc')
            ->paginate(20);  
            
        return view('persona.listar', compact('personas'));
    }

    public function nuevo()
    {        
        return view('persona.nuevo');
    }


    public function editar($persona_id)
    {
        $persona = Persona::find($persona_id);
        
        return view('persona.editar',compact('persona'));
    } 

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required',
            'correo' => 'required|email',        
        ]);

        if ($validator->passes()) {
            $nombres = $request->nombres;
            $correo = $request->correo;

            $persona = new Persona();
            $persona->nombres = $nombres;
            $persona->correo = $correo;
            $persona->created_at = date('Y-m-d H:i:s');  
            $persona->save();

            $logController = new LogController();
            $response = $logController->registrar('registrar', $persona);

            return response()->json(['success'=>'Se registró correctamente']);
        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    
    public function actualizar(Request $request, $persona_id)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required',
            'correo' => 'required|email',   
        ]);

        if ($validator->passes()) {
            $nombres = $request->nombres;
            $correo = $request->correo;

            $persona = Persona::find($persona_id);
            $persona->nombres = $nombres;
            $persona->correo = $correo;
            $persona->updated_at = date('Y-m-d H:i:s');
            $persona->save();

            $logController = new LogController();
            $response = $logController->registrar('actualizar', $persona);

            return response()->json(['success'=>'Se actualizó correctamente']);

        } 
        return $validator->errors()->all();
        return response()->json(['error'=>$validator->errors()->all()]);  

    }

    public function eliminar($persona_id)
    {
            $persona = Persona::find($persona_id);          

            $logController = new LogController();
            $response = $logController->registrar('eliminar', $persona);

            $persona->delete();

        return response()->json(['success'=>'Se eliminó correctamente']);
    }
   
}