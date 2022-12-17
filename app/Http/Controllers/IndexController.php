<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Registro;
use App\RegistroGramatical;
use App\RegistroSociolinguistica;
use App\RegistroPragmatica;
use App\RegistroDiatopica;
use App\RegistroDiatecnica;
use App\Entrada;
use App\Mensaje;
use App\Publicacion;
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
class IndexController extends Controller
{
    public function letrasABC()
    {
        $letrasABC = Db::table('entradas')
            ->select(DB::raw('left(entrada,1) as letra'))
            ->where(DB::raw('left(entrada,1)'),'<>','¡')
            ->where(DB::raw('left(entrada,1)'),'<>','¿')
            ->where(DB::raw('left(entrada,1)'),'<>','-')
            ->orderBy(DB::raw('left(entrada,1)'),'asc')
            ->distinct()
            ->get();
        
        return view('sitio_web.letrasABC',compact('letrasABC'));
    }
    public function index()
    {
        $menus = Publicacion::where('estado','publicar')
            ->orderBy('index','desc')
            ->orderBy('orden','asc')
            ->get();
        $publicacion = Publicacion::where('index',1)->first();
        return view('sitio_web.pagina',compact('menus','publicacion'));
    }
    public function pagina($entrada)
    {
        $menus = Publicacion::where('estado','publicar')
            ->orderBy('index','desc')
            ->orderBy('orden','asc')
            ->get();
        $publicacion = Publicacion::where('nombre',$entrada)->first();
        
        return view('sitio_web.pagina',compact('menus','publicacion'));
    }
   
    public function contacto()
    {
        $entrada = 0;

        $publicacion = Publicacion::where('nombre',$entrada)->first();

        $menus = Publicacion::where('estado','publicar')
            ->orderBy('index','desc')
            ->orderBy('orden','asc')
            ->get();

        return view('sitio_web.contacto',compact('menus','publicacion'));
    }

    public function grabarcontacto(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'contacto' => 'required',
            'correo' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
        ]);

        if ($validator->passes()) {
            $contacto = $request->contacto;
            $correo = $request->correo;
            $asunto = $request->asunto;
            $mensaje1 = $request->mensaje;

            $mensaje = new Mensaje();
            $mensaje->contacto = $contacto;
            $mensaje->correo = $correo;
            $mensaje->asunto = $asunto;
            $mensaje->mensaje = $mensaje1;
            $mensaje->created_at = date('Y-m-d H:i:s');  
            $mensaje->save();

            $configuracion = DB::table('configuracion')
                ->orderBy('created_at','desc')
                ->first();  

            $subject = "DiPeru | Formulario de contacto";
            $for = $configuracion->correo;    


            Mail::send('mails.datosFormContacto', ['mensaje' => $mensaje], function ($message) use($subject,$for) {
                $message->from('diperu@apl.org.pe', 'System DiPeru');
                $message->subject($subject);
                $message->to($for);
            });


            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);
    }


    public function listar()
    {
        $entradas = Entrada::whereNull('subentrada_entrada_id')->paginate(20);
        return view('listar',compact('entradas'));
    }

    public function palabraRecomendada()
    {
        $configuracion = DB::table('configuracion')
            ->orderBy('created_at','desc')
            ->first(); 

        if ($configuracion->entrada_recomendada==0) {
            $entrada = Entrada::inRandomOrder()->first();
        }else{
           $entrada = Entrada::find($configuracion->entrada_recomendada);
        }

        $palabraRecomendada = $this->info($entrada->id);

        return $palabraRecomendada;
    }
    public function entrada($entrada_id)
    {


        $entrada = Entrada::find($entrada_id); 

        $entradaRegistros = Registro::leftJoin('entradas','registros.vease_entrada_id','entradas.id')
            ->select('registros.*','entradas.entrada as vease')
            ->where('entrada_id',$entrada_id)
            ->orderBy('created_at','asc')
            ->get();

          
        $subentradas = Entrada::where('subentrada_entrada_id',$entrada_id)
            ->orderBy('created_at','asc')
            ->get();       
       

        $entradaRegistrosArray = array();
        foreach($entradaRegistros as $entradaRegistro){
            $registroGramaticales = RegistroGramatical::leftJoin('gramaticales','registros_gramaticales.gramatical_id','gramaticales.id')
                ->select('gramaticales.id','gramaticales.abreviatura')
                ->where('registro_id',$entradaRegistro->id)
                ->get();
            $registroGramaticales = json_decode($registroGramaticales);
            $registroSociolinguisticas = RegistroSociolinguistica::leftJoin('sociolinguisticas','registros_sociolinguisticas.sociolinguistica_id','sociolinguisticas.id')
                ->select('sociolinguisticas.id','sociolinguisticas.abreviatura')
                ->where('registro_id',$entradaRegistro->id)->get();
            $registroSociolinguisticas = json_decode($registroSociolinguisticas);

            $registroPragmaticas = RegistroPragmatica::leftJoin('pragmaticas','registros_pragmaticas.pragmatica_id','pragmaticas.id')
                ->select('pragmaticas.id','pragmaticas.abreviatura')
                ->where('registro_id',$entradaRegistro->id)->get();
            $registroPragmaticas = json_decode($registroPragmaticas);

            $registroDiatopicas = RegistroDiatopica::leftJoin('diatopicas','registros_diatopicas.diatopica_id','diatopicas.id')
                ->select('diatopicas.id','diatopicas.abreviatura')
                ->where('registro_id',$entradaRegistro->id)->get();
            $registroDiatopicas = json_decode($registroDiatopicas);

            $registroDiatecnicas = RegistroDiatecnica::leftJoin('diatecnicas','registros_diatecnicas.diatecnica_id','diatecnicas.id')
                ->select('diatecnicas.id','diatecnicas.abreviatura')
                ->where('registro_id',$entradaRegistro->id)->get();
            $registroDiatecnicas = json_decode($registroDiatecnicas);

            $entradaRegistrosArray[] = array(
                "id"=>$entradaRegistro->id,
                "marca_frecuencia_uso"=>$entradaRegistro->marca_frecuencia_uso,
                "ejemplo"=>$entradaRegistro->ejemplo,
                "resaltado"=>$entradaRegistro->resaltado,
                "vease"=>$entradaRegistro->vease,
                "gramaticales"=>$registroGramaticales,
                "sociolinguisticas"=>$registroSociolinguisticas,
                "pragmaticas"=>$registroPragmaticas,
                "diatopicas"=>$registroDiatopicas,
                "diatecnicas"=>$registroDiatecnicas
            );
        }

        $entradaSubentradasArray = array();
        foreach($subentradas as $subentrada){
            $subentradaRegistros = Registro::where('entrada_id',$subentrada->id)->get();
            $subentradaRegitrosArray = array();
            foreach ($subentradaRegistros as $subentradaRegistro) {
                $registroGramaticales = RegistroGramatical::leftJoin('gramaticales','registros_gramaticales.gramatical_id','gramaticales.id')
                    ->select('gramaticales.id','gramaticales.abreviatura')
                    ->where('registro_id',$subentradaRegistro->id)
                    ->get();
                $registroGramaticales = json_decode($registroGramaticales);
                $registroSociolinguisticas = RegistroSociolinguistica::leftJoin('sociolinguisticas','registros_sociolinguisticas.sociolinguistica_id','sociolinguisticas.id')
                    ->select('sociolinguisticas.id','sociolinguisticas.abreviatura')
                    ->where('registro_id',$subentradaRegistro->id)->get();
                $registroSociolinguisticas = json_decode($registroSociolinguisticas);

                $registroPragmaticas = RegistroPragmatica::leftJoin('pragmaticas','registros_pragmaticas.pragmatica_id','pragmaticas.id')
                    ->select('pragmaticas.id','pragmaticas.abreviatura')
                    ->where('registro_id',$subentradaRegistro->id)->get();
                $registroPragmaticas = json_decode($registroPragmaticas);

                $registroDiatopicas = RegistroDiatopica::leftJoin('diatopicas','registros_diatopicas.diatopica_id','diatopicas.id')
                    ->select('diatopicas.id','diatopicas.abreviatura')
                    ->where('registro_id',$subentradaRegistro->id)->get();
                $registroDiatopicas = json_decode($registroDiatopicas);

                $registroDiatecnicas = RegistroDiatecnica::leftJoin('diatecnicas','registros_diatecnicas.diatecnica_id','diatecnicas.id')
                    ->select('diatecnicas.id','diatecnicas.abreviatura')
                    ->where('registro_id',$subentradaRegistro->id)->get();
                $registroDiatecnicas = json_decode($registroDiatecnicas);


                $subentradaRegitrosArray[] = array(
                    "id"=>$subentradaRegistro->id,
                    "marca_frecuencia_uso"=>$subentradaRegistro->marca_frecuencia_uso,
                    "ejemplo"=>$subentradaRegistro->ejemplo,
                    "resaltado"=>$subentradaRegistro->resaltado,
                    "vease"=>$subentradaRegistro->vease,
                    "gramaticales"=>$registroGramaticales,
                    "sociolinguisticas"=>$registroSociolinguisticas,
                    "pragmaticas"=>$registroPragmaticas,
                    "diatopicas"=>$registroDiatopicas,
                    "diatecnicas"=>$registroDiatecnicas
                );
            }

            $subentradaRegistros = $subentradaRegitrosArray;
            $entradaSubentradasArray[] = array(
                "id"=>$subentrada->id,
                "entrada"=>$subentrada->entrada,
                "registros"=>$subentradaRegistros
            );

        }

        $entrada['registros'] = $entradaRegistrosArray;
        $entrada['subentradas'] = $entradaSubentradasArray;

        return $entrada;

    }


    public function info($entrada_id)
    {
        
        $entrada = $this->entrada($entrada_id);

        return view('info',compact('entrada'));
    }

    public function indexEntrada($entrada)
    {
        $decode = urldecode($entrada);
        $entrada = Entrada::where('entrada',$entrada)->first();
        $entrada_id = $entrada->id;

        $this->entrada($entrada_id);
    }

    public function buscar($consulta)
    {
        $entradas = DB::table('entradas')            
            ->where('entrada', 'LIKE', $consulta.'%')
            ->paginate(20);  
            
        return view('listar',compact('entradas'));
    }

    public function buscarJson($consulta)
    {
        $entradas = DB::table('entradas')            
            ->select('id','entrada')
            ->where('entrada', 'LIKE', $consulta.'%')
            ->limit(5)
            ->get();  

        
        return  $entradas->toJson();
    }

    public function nuevo()
    {        
        return view('torneo.nuevo');
    }

    public function editar($id)
    {
        $torneo = Torneo::find($id);

        return view('torneo.editar', compact("torneo"));
    } 

    public function grabar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'modalidad' => 'required',
            'ubicacion' => 'required',
        ]);

        if ($validator->passes()) {
            $name = $request->nombre;
            $mode = $request->modalidad;
            $location = $request->ubicacion;
            $start = Carbon::createFromFormat('d-m-Y H:i', $request->inicio, 'America/Lima')->setTimezone('UTC')->toDateTimeString();
            $end = Carbon::createFromFormat('d-m-Y H:i', $request->fin, 'America/Lima')->setTimezone('UTC')->toDateTimeString();

            $empleado = new Torneo();
            $empleado->name = $name;
            $empleado->mode = $mode;
            $empleado->location = $location;
            $empleado->start = $start;
            $empleado->end = $end;
            $empleado->created_at = date('Y-m-d H:i:s');  
            $empleado->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function grabarTorneoEquipo(Request $request, $tournamentID)
    {
        $validator = Validator::make($request->all(), [
            'tournamentID' => 'required',
            'equipo' => 'required',
        ]);

        if ($validator->passes()) {
            $teamID = $request->equipo;

            $empleado = new TorneoEquipo();
            $empleado->tournamentID = $tournamentID;
            $empleado->teamID = $teamID;
            $empleado->created_at = date('Y-m-d H:i:s');  
            $empleado->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function actualizar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'modalidad' => 'required',
            'ubicacion' => 'required',
        ]);

        if ($validator->passes()) {
            $name = $request->nombre;
            $mode = $request->modalidad;
            $location = $request->ubicacion;
            $start = Carbon::createFromFormat('d-m-Y H:i', $request->inicio, 'America/Lima')->setTimezone('UTC')->toDateTimeString();
            $end = Carbon::createFromFormat('d-m-Y H:i', $request->fin, 'America/Lima')->setTimezone('UTC')->toDateTimeString();

            $empleado = Torneo::find($id);
            $empleado->name = $name;
            $empleado->mode = $mode;
            $empleado->location = $location;
            $empleado->start = $start;
            $empleado->end = $end;
            $empleado->updated_at = date('Y-m-d H:i:s');  
            $empleado->save();

            return response()->json(['success'=>'Se registró correctamente']);

        } 

        return response()->json(['error'=>$validator->errors()->all()]);  
    }

    public function eliminar($tournamentID)
    {
        $torneo = Torneo::find($tournamentID)->delete();
        $registros = DB::table('tournament_teams')->where('tournamentID',$tournamentID)->delete();  

    }

}