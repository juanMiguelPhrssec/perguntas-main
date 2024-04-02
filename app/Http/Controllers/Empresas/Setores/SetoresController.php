<?php

namespace App\Http\Controllers\Empresas\Setores;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Setor;
use Illuminate\Http\Request;

class SetoresController extends Controller
{
    public function index($empresa, ){
        return view('empresas.setores.index', compact("empresa"));
    }


    public function create(Empresa $empresa){
        
        return view('empresas.setores.create',compact("empresa"));
    }

    public function store(Request $request, $empresa, Setor $setor){
        $data = $request->validate([
            'setor'=>'required|string',
        ]);
        $data['empresas_id']= $empresa;
        $data['setores_id']= $setor;
        
        $setores = new Setor($data);

        if($setores->save()){
            if($request->json==1){
                return response()->json(['type'=>'success','message'=>'Cargo criado com sucesso '],201);
            }
            return redirect()->route('empresas.setor.index',compact(['empresa','setor']));
        }
        if($request->json==1){
            return response()->json(['type'=>'error','message'=>'Erro ao criar o seu cargo'],400);
        }
        return back()->withErros("Erro ao processsar");

    }

    public function setorJson(){
        $setores = Setor::all();
        $empresa = Empresa::first(); 

   
     
     
        
        
        if($setores->isEmpty()){
            return response()->json(["type" => "error", "setores" => []], 200);

        }
        $setoresList = [];

    
        foreach ($setores as $setor) {

            //$routeEdit = route(' empresas.setor.index ');
            $routePessoas=  route('empresas.setor.pessoas.index', ['empresa' => $empresa->id, 'setor' => $setor->id]) ;
           $btnEdit = "<a href='' data-dado-id='' class='btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'><i class='fa fa-lg fa-fw fa-pen'></i></a>";

            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Excluir" data-dado-id=""><i class="fa fa-lg fa-fw fa-trash"></i></button>';
    
            $btnDetails = '<a href="'.$routePessoas.'" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="" title="Pessoas"><i class="fas fa-fw fa-user" aria-hidden="true"></i></a>';

            $setoresList[] = [
                "id" => $setor->id,
                "setor" => $setor->setor,

                "btns" => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
            ];
        }

    
        return response()->json(compact('setoresList'));

    }
    public function edit(){
        //destinado a edição de cargos
    }
    public function update(){

    }
}
