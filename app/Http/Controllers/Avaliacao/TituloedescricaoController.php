<?php

namespace App\Http\Controllers\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Resposta;
use App\Models\Tituloedescricao;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TituloedescricaoController extends Controller
{
    public function index(){
        //
    }
    public function create(){
        //função para a view de titulo 
        return view('provas.titulosedesc');
    }
    public function store(Request $request,  ){
        $data = $request->validate([
            'titulo'=>'required|string|max:255',
            'descricao'=> 'required'
        ]);
        $data['Admin_id'] = Auth::id();
      
        $titulo = new Tituloedescricao($data);
      
        if($titulo->save()){
            if($request->json==1){
                return response()->json(['type'=>'success','message'=>'titulo inserido com sucesso'],201);
            }
            return redirect()->route('titulos.avaliacao.create', ['titulo' => $titulo->id]);

        }
        if($request->json ==1){
            return response()->json(['type'=>'error','message'=>'Erro no processamento'],400);

        }
        return back()->withErrors("Erro ao processar");


    }
    public function TituloedescriJson(){
        $tituloedescris = Tituloedescricao::orderBy('id', 'desc')->get();
        
        $tituloedescriList=[];
        foreach($tituloedescris as $titulo){
 
            $routeEdit = route('titulos.edit', $titulo->id);
            $routedetalhes = route('visualizar.index.prova', $titulo->id);
            $btnEdit = "<a href=' $routeEdit' id='$titulo->id' class='btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'><i class='fa fa-lg fa-fw fa-pen'></i></a>";
            
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Excluir" data-dado-id="' . $titulo->id . '"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
            
            $btnDetails = '<a href="'.$routedetalhes.'" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $titulo->id . '" title="todos usuarios"><i class="fas fa-fw fa-user" aria-hidden="true"></i></a>';
            $usuariorespondeu = Resposta::where('titulos_id', $titulo->id)->count();
            $tituloedescriList[] = [
                'id'=> $titulo->id,
                'titulo' => $titulo->titulo,
                'descricao'=>$titulo->descricao,
                'usuariorespondeu' => $usuariorespondeu,
                "btns" => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
            ];
            
        }
        return response()->json(compact('tituloedescriList'));

    }
    public function edit(Tituloedescricao $titulo){
        //$titulo->find('tituloedescricao_id');"
        $perguntas = $titulo->perguntas();
        foreach($perguntas as $pergunta){
            $pergunta->criticidade = json_decode($pergunta->criticidade, true);
        }
    
    
        
        return view('provas.show',compact(['titulo','perguntas']));
    }

    public function show(){
        //"
    }
}
