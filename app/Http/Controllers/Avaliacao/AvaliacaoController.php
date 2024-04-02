<?php

namespace App\Http\Controllers\Avaliacao;

use App\Http\Controllers\Controller;
use App\Models\Pergunta;
use App\Models\Tituloedescricao;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function index(){
        //
    }
    public function create($titulo){
        $tituloa = Tituloedescricao::where('id',$titulo)->first();
        
        
        
        return view('provas.createprova')->with('titulo',$tituloa);
    }

    public function store(Request $request, $titulo)
    {

        $data = $request->validate([
            'pergunta' => 'required',
            'optionsTest1'=>'required',
            'criticidade'=>'required',
            'peso'=>'required',   
        ]);
      
        
        $data['tituloedescricao_id'] = $titulo; 
        $obs = $request->input('obs', null);
        $data['obs']=$obs;  
        
        //para receber a criticidade 
        if (is_array($data['criticidade']) && !empty($data['criticidade'])) {
        $selectedOptions = [];

            foreach ($data['criticidade'] as $selectedValue) {
                    switch ($selectedValue) {
                        case 0:
                            $selectedOptions[] = "Muito baixa";
                            break;
                        case 1:
                            $selectedOptions[] = "Baixa";
                            break;
                        case 2:
                            $selectedOptions[] = "Média";
                            break;
                        case 3:
                            $selectedOptions[] = "Alta";
                            break;
                        case 4:
                            $selectedOptions[] = "Muito alta";
                            break;
                        default:
                            break;
                    }
                }

                $data['criticidade'] = json_encode($selectedOptions);
        }


        if (is_array($data['optionsTest1']) && !empty($data['optionsTest1'])) {
  
            $selectedOptions = [];
        

            foreach ($data['optionsTest1'] as $selectedValue) {

                switch ($selectedValue) {
                    case 0:
                        $selectedOptions[] = "Campo de Texto";
                        break;
                    case 1:
                        $selectedOptions[]  = "Campo de Múltipla Escolha";
                        //recebe meu array de alternativas
                        $alternatives = [];
                        foreach ($request->input('alternatives') as $key => $value) {
                            $alternatives[] = $value;
                        }
                        $selectedOptions[] = $alternatives;

                        break;
                    case 2:
                        $selectedOptions[] = "Campo de Seleção Múltipla";
                        $alternatives = $request->input('alternatives'); 
                        $selectedOptions[] =  $alternatives ;
                        break;
                    case 3:
                        $selectedOptions[] = "Campo para anexar documentos";
                        break;
                    default:
                     
                        break;
                }
   
                
            }
        
            $convertString= json_encode($selectedOptions);
            $data['campo_text'] = $convertString;
        }

        
        $pergunta = new Pergunta($data);


        if ($pergunta->save()) {
            if ($request->json == 1) {
                return response()->json(['type' => 'success', 'message' => 'Pergunta inserida com sucesso'], 201);
            }

            return redirect()->route('titulos.avaliacao.create', ['titulo' => $titulo]);
        }
        
    }

}
