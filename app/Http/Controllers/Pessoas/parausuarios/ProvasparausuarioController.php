<?php

namespace App\Http\Controllers\Pessoas\parausuarios;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Empresas\Pessoas\PessoaController;
use App\Models\ProvaparaUsuario;
use App\Models\Tituloedescricao;
use App\Models\User;
use Illuminate\Http\Request;

class ProvasparausuarioController extends Controller
{
    public function create($empresa, $setor, User $pessoa){
        $titulo = Tituloedescricao::orderBy('id', 'asc')->get();
        return view("provas.selecionar", compact("pessoa", "setor", "empresa", "titulo"));
    }
    
    public function store(Request $request,  $pessoa, $empresa, $setor)
    {
        // Defina as regras de validação para o campo 'nome_aval'

        $data = $request->validate([
            'nome_aval' => 'required',]);
        $data['pessoas_id'] = $pessoa;
        $data['empresas_id'] = $empresa;
  
        $data['setor_id'] = $setor;

    

        $pergunta = new ProvaparaUsuario($data);
     

        if($pergunta->save()){
            if($request->json==1){
                return response()->json(['type'=>'success','message'=>'enviado avaliação para o usuario'],201);

            }
           // return redirect()->route(' empresas.setor.pessoas.prova.index', compact('empresa','pessoa','setor'));
        }
        if($request->json==1){
            return response()->json(['type'=>'error','message'=>'Erro no envio '],400);
        }


        return back()->withErrors("Erro ao processar");
    }
    
}
