<?php

namespace App\Http\Controllers\Empresas\Pessoas;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Setor;
use App\Models\Tituloedescricao;
use App\Models\User;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index($empresa, $setor){
        return view("pessoas.index",compact(["empresa","setor"]));
    }

    public function create(Empresa $empresa, Setor $setor){
        return view("pessoas.create",compact(["empresa","setor"]));
    }

    public function store(Request $request, Empresa $empresa , Setor $setor){
        $data = $request->validate([
            'name'=> "required",
            'email'=>'required|unique:users,email',
            'type'=>'required',
            'password'=>'required|string'
        ]);
        $data ['empresas_id'] = $empresa->id;
        $data ['setors_id'] = $setor->id;
        $p=User::create($data);
        
   

        return response()->json(["message"=>"Usuario Adicionado com sucesso"]);
        return route('empresas.setor.pessoas.index', ["empresa"=> $empresa, "setor"=>$setor]);

    }

    public function indexJson($setor,$empresa){
        $pessoas =  User::all();
        $setores = Setor::FindOrFail($setor);
        $empresas = Empresa::findOrFail($empresa);
   

       
        if($pessoas->isEmpty()){
            return response()->json(["type" => "error", "empresas" => []], 200);
        }
        $pessoasDataList =[];
        foreach($pessoas as $pessoa){
            $setorId = $setor;
            $empresaId = $empresa;
       
     
    
            $routedetail = route('empresas.setor.pessoas.prova.create', [
                'pessoa' => $pessoa->id,
                'empresa' => $empresaId,
                'setor' => $setorId,
            ]);
            
            $btnEdit    = '<a  class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
            <i class = "fa fa-lg fa-fw fa-pen"></i>
            </a>';
            $btnDelete  = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado" title="Delete" data-dado-id="' . $pessoa->id . '">
            <i class = "fa fa-lg fa-fw fa-trash"></i>
            </button>';
            $btnDetails = '<a href="'.$routedetail.'" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="'.$pessoa->id. $empresaId . $setorId.'" title="Adicionar Prova"><i class="fas fa-file-alt" aria-hidden="true"></i></a>';
            

            $pessoasDataList []=[
                'id'=>$pessoa->id,
                'name'=>$pessoa->name,
                'email'=>$pessoa->email,
                "btns" => '<nobr>' . $btnEdit . $btnDelete . $btnDetails.  '</nobr>'
            ];

        }
  
      
        return response()->json(compact('pessoasDataList'));
    }
    public function show(){
 
       //
    }
    
}
