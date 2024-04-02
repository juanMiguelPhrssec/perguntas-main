<?php

namespace App\Http\Controllers\Empresas;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateEmpresaRequest;
use App\Models\Empresa;
use App\Rules\CnpjValido;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index(){
        return view('empresas.index');

    }
    public function create(){
        return view('empresas.create');

    }
    public function edit(Empresa $empresa){
        $newEmpresa= $empresa->newEmpresa;
        
        $breadcrumb =[
            ['url'=>route('empresas.index'),'text'=>'Empresas'],
            ['url'=> route('empresas.create'),'text'=>'empresas']
        ];
            return view('empresas.EditEmpresa',compact('newEmpresa','breadcrumb','empresa'));

    }


    public function store(Request $request){
        $data = $request->validate([
            'nome_da_empresa' => ['required', 'string', 'max:255'],
            'cnpj' => ['required', new CnpjValido],
            
        ]);
   
        $empresa = new Empresa($data);
        

        if($empresa->save()){
            if($request->json==1){
                return response()->json(['type'=>'success','message'=>'Empresa criada com sucesso'], 201);

            }
            return redirect()->route('empresas.index','empresa');
        }
        if($request->json ==1){
            return response()->json(['type'=>'error','message'=>'Erro ao criar empresa'], 400);
        }
        return back()->withErros("Erro ao processsar");

        
        
    }
    public function empresaJson(){
        $empresas = Empresa::all();
        if($empresas->isEmpty()){
            return response()->json(["type" => "error", "empresas" => []], 200);

        }
        $empresasList = [];
    
        foreach ($empresas as $empresa) {

            $routeEdit = route('empresas.edit', $empresa->id);
            $routeSetores = route('empresas.setor.index',$empresa->id);
            $btnEdit = "<a href='$routeEdit' id='$empresa->id' class='btn btn-xs btn-default text-primary mx-1 shadow' title='Editar'><i class='fa fa-lg fa-fw fa-pen'></i></a>";
    
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow excluir-dado btn-delete" title="Excluir" data-dado-id="' . $empresa->id . '"><i class="fa fa-lg fa-fw fa-trash"></i></button>';
    
            $btnDetails = '<a href="'.$routeSetores.'" class="btn btn-xs btn-default text-teal mx-1 shadow show-dado" data-dado-id="' . $empresa->id . '" title="Setores"><i class="fas fa-fw fa-user" aria-hidden="true"></i></a>';
    
            $empresasList[] = [
                "id" => $empresa->id,
                "nome_da_empresa" => $empresa->nome_da_empresa,
                "cnpj" => preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $empresa->cnpj),
                "btns" => '<nobr>' . $btnEdit . $btnDelete . $btnDetails . '</nobr>',
            ];
        }
    
        return response()->json(compact('empresasList'));

    }
    public function update(UpdateEmpresaRequest $request, Empresa $empresa){

        try {
            $validatedData = $request->validated(); // Valida os dados recebidos no request
    
            $empresa->update($validatedData); // Atualiza os dados da empresa com os dados validados
    
            if ($request->json == 1) {
                return response()->json([
                    "type" => 'success',
                    "message" => "$empresa->nome_da_empresa atualizada com sucesso"
                ]);
            } else {
                return redirect()->route('empresas.index');
            }
    
        } catch (Exception $e) {
            
            return response()->json(["type" => "error", "message" => $e->getMessage()]);
        }
    
    }
    public function delete(){

    }
    public function Buscarporid(string $id){
        $empresa = Empresa::findOrfail($id);
        return response()->json(
            compact('empresa'),
            200
        );
    }
    
}
