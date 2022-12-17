<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Usuario;
use App\User;
use App\Log;
use Carbon\Carbon;
use Validator;
use Excel;
use Auth;
use DB;
use Mail;
use Hash;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{
    public function index()
    {
        
        return view('usuario.index');
    }


    public function listar()
    {
        $usuarios = DB::table('users')
            ->paginate(20);       
        return view('usuario.listar', compact('usuarios'));
    }
    
    public function buscar($consulta)
    {
        $usuarios = DB::table('users')            
            ->where('name', 'LIKE', '%'.$consulta.'%')
            ->orwhere('username', 'LIKE', '%'.$consulta.'%')
            ->orwhere('email', 'LIKE', '%'.$consulta.'%')
            ->orwhere('created_at', 'LIKE', '%'.$consulta.'%')
            ->paginate(20);  
            
        return view('usuario.listar', compact('usuarios'));
    }

    public function nuevo()
    {        
        return view('usuario.nuevo');
    }

    public function editar($id)
    {
        $usuario = User::find($id); 

        return view('usuario.editar', compact("usuario"));
    } 

    public function cambiarContrasenia($id)
    {
        $usuario = User::find($id);

        return view('usuario.cambiarContrasenia')->with('usuario', $usuario);
    } 

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users,username',
            'name' => 'required',
            'email' => 'nullable|unique:users,email|email',
        ]);

        if ($validator->passes()) {
            $username = $request->username;
            $name = $request->name;
            $tipo_usuario = $request->tipo_usuario;
            $email = $request->email;

            $configuracion = DB::table('configuracion')
                ->orderBy('created_at','desc')
                ->first();  

            $pass = $configuracion->contrasenia_predeterminada;
            $password = Hash::make($pass);
            
            $usuario = new User();
            $usuario->username = $username;
            $usuario->password = $password;
            $usuario->is_admin = $tipo_usuario;
            $usuario->name = $name;
            $usuario->email = $email;
            $usuario->updated_at = date('Y-m-d H:i:s');
            $usuario->save();

            $logController = new LogController();
            $response = $logController->registrar('registrar', $usuario);

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'username' =>   [
                                'required',
                                Rule::unique('users','username')->ignore($id,'id'),
                            ],
            'name' => 'required',
            'email' => [
                            'nullable',
                            Rule::unique('users','email')->ignore($id,'id'),
                        ]
        ]);

        if ($validator->passes()) {
            $username = $request->username;
            $name = $request->name;
            $email = $request->email;
            $tipo_usuario = $request->tipo_usuario;

            $usuario = User::find($id);
            $usuario->username = $username;
            $usuario->name = $name;
            $usuario->email = $email;
            $usuario->is_admin = $tipo_usuario;
            $usuario->updated_at = date('Y-m-d H:i:s');
            $usuario->save();

            $logController = new LogController();
            $response = $logController->registrar('actualizar', $usuario);

            return response()->json(['success'=>'Se registró correctamente']);

        } 
        return response()->json(['error'=>$validator->errors()->all()]);  

    }

    public function actualizarContrasenia(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed|alpha_num',
        ]);

        if ($validator->passes()) {
            
            $pass = $request->password;
            $password = Hash::make($pass);

            $usuario = User::find($id);
            $usuario->password = $password;
            $usuario->save();

            $logController = new LogController();
            $response = $logController->registrar('cambiar contraseña', $usuario);


            return response()->json(['success'=>'Se registró correctamente']);

        }         
        return response()->json(['error'=>$validator->errors()->all()]); 

    }

    public function info($id)
    {

        $usuario = Usuario::find($id);
		$proyecto = EmpleadosProyecto::leftJoin('proyectos','empleadosproyecto.idProyecto', '=', 'proyectos.id')
			->select('empleadosproyecto.idProyecto','empleadosproyecto.idEmpleado','proyectos.nombre')
            ->where('empleadosproyecto.idEmpleado',$id)
            ->first();

        return view('empleado.infoEmpleado',compact('empleado','proyecto'));
    }


    public function eliminar($usuario_id)
    {
        $usuario = User::find($usuario_id);

        $logController = new LogController();
        $response = $logController->registrar('eliminar', $usuario);

        $usuario->delete();

        return response()->json(['success'=>'Se eliminó correctamente']);
    }

}