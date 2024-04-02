<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Pergunta;
use App\Models\ProvaCorrigida;
use App\Models\ProvaparaUsuario;
use App\Models\Resposta;
use App\Models\Setor;
use App\Models\Tituloedescricao;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Contracts\Service\Attribute\Required;

class PararesponderController extends Controller
{
    public function index(){
        //
    }
    
    public function create(Tituloedescricao $titulo, $setor){
        
       
        return view("usuarios.prova",compact('titulo','setor'));
    }

    public function store(Request $request, $titulo , $setor){

        $respostas = $request->validate([
            'respostas.*' => 'required', // Validação para garantir que todas as respostas sejam fornecidas
        ]);
        foreach ($respostas['respostas'] as  $perguntaId =>  $resposta) {
            Resposta::create([
                'titulos_id' => $titulo,
                'setor_id' => $setor,
                'provas_id' => $perguntaId,
                'user_id' => auth()->id(),
                'respostas' => $resposta,
            ]);
        }
        return redirect()->route('home');
    }

    public function show(Tituloedescricao $titulo)
    {
        $usuariosComProva = User::whereHas('provasparausuarios')->get();

        $provas = ProvaparaUsuario::with('user')->whereIn('pessoas_id', $usuariosComProva->pluck('id'))->get();

        foreach($usuariosComProva as $usuario){
            $resposta = Resposta::whereIn('user_id', $usuariosComProva->pluck('id'))->get();
            if($resposta){
                $finalizado = "Usuário respondeu";
                
            }else{
                $finalizado = "Usuário ainda não respondeu ";
            }
            
        }

        
        return view('usuarios.viewAdminprova', compact(["titulo", "provas","finalizado"]));
    }
    public function Respostadousuario(Tituloedescricao $titulo,  $user){
    
        $usuario = User::findOrFail($user);

        return view('usuarios.viewparaadminvisualizarprova', compact(['titulo','usuario']));

    }
    // para desenvolver a pagina de correção

    public function CorrigirProva(Tituloedescricao $titulo, $user){
        $usuario = User::findOrFail($user);

        return view('usuarios.corrigirProva',compact(['titulo','usuario']));
    }


    public function ProvaCorrigida(Request $request, $titulo , $user){
        $corrigidas = $request->validate([
            'peso.*' => 'required',
            'corrigida.*' => 'required'
        ]);
        $peso = '0';
        foreach($corrigidas['corrigida']as $perguntaId => $corrigida){
          
            ProvaCorrigida::create([
                'peso'=> $peso,
                'titulo_id'=>$titulo,
                'corrigida'=>$corrigida,
                'perguntas_id'=>$perguntaId,
                'user_id' =>$user, 

            ]);
        }

        return redirect()->route('resposta.usuario', compact(['titulo','user']));

    }
}
