@extends('adminlte::page')

@section('title', $titulo->titulo)

@section('content_header')
<div class="row">
    <h2>{{$titulo->titulo}} </h2>

</div>


@endsection
@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-adminlte-card title="Avaliação: {{$titulo->titulo}} respondida por {{$usuario->name}}  " theme="light" theme-mode="full" class="elevation-3 text-black"
                        body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                    icon="" collapsible >
                    <x-adminlte-input name="titulo" placeholder="Titulo da Avaliação:"
                    label="Titulo da Avaliação:" disable value="{{ $titulo->titulo }}" />
                    
                    <x-adminlte-textarea name="descricao" disabled placeholder="Descrição da avaliação:"
                    label="Descrição da avaliação:" value="" >
                    {{$titulo->descricao}}
                    
                    </x-adminlte-textarea>

                    <form action="{{ route('corrigido.usuario.avaliacao', [$titulo->id, $usuario]) }} " method="POST">
                    @csrf

        
                        @foreach ($titulo->perguntas as $index => $pergunta)

                            @php
                                $arrayCampoText = json_decode($pergunta->campo_text, true);
        
                                $arrayCriticidade = json_decode($pergunta->criticidade, true);
                                
                            @endphp
                            @if  ($arrayCriticidade !== null) 
                                @foreach ($arrayCriticidade as $item)
                            
                                    
                                @endforeach
                            @else 
                                echo "Erro ao decodificar a string JSON para criticidade.";
                            
                                
                            @endif
                            
                            <label for="">{{ $index + 1 }}. {{ $pergunta->pergunta }}</label>  <div class="float-right"> </div> <br>
                           @foreach ($pergunta->respostas as $resposta)
                           
                               
                           @endforeach
                           
                           
                           @if (is_array($arrayCampoText))
                           
                           @if (count($arrayCampoText) == 1 && $arrayCampoText[0]== "Campo de Texto")
                           <div class="row">
                                        <div class="col-12">
                                
                             
                                            <x-adminlte-input name="respostas[{{ $pergunta->id }}]" disabled  value="{{$resposta->respostas}}  " />
                                        </div>
                                        <div class="col-12">
                                            <div class="float-left" style="width: 6em;" >
                                            
                                    
                                                <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
                                            </div>
                                            <div class="float-right">
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="1" data-peso="{{ $pergunta->peso }}"  id="">Correta
    
                                                </label>
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="0" id="">Errada
    
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            
                                            
                                            <x-adminlte-card title="OBS:"  theme="light" theme-mode="full" class="elevation-3 text-black"
                                                body-class="bg-ligth " header-class="bg-light" footer-class="bg-warning border-top rounded border-success"
                                            icon="" collapsible >
                                            {{$pergunta->obs}}
                                            </x-adminlte-card>
                                        </div>
                                        
                                        
                    
                                    </div>
                                    
                        
        
             
                                    @elseif ($arrayCampoText[0] == "Campo de Múltipla Escolha" && is_array($arrayCampoText[1]))
      
                                    @php
                                        $alternativas = $arrayCampoText[1];
                                    @endphp
                                
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ml-3">
                                                @foreach ($alternativas as $alternativa)
                                                <input type="radio" class="form-check-input" disabled name="respostas[{{ $pergunta->id }}]" value="{{ $alternativa }}" 
                                                    @if ($resposta->respostas == $alternativa) checked @endif /> 
                                                    <label class="form-check-label" for="{{ $alternativa }}">
                                                        {{ $alternativa }}
                                                    </label>
                                                    <br>
                                                @endforeach
        
                                            </div>
                                      

                                            <div class="col-12 mt-2">
                                                
                                                <x-adminlte-card title="OBS:"  theme="light" theme-mode="full" class="elevation-3 text-black"
                                                    body-class="bg-ligth " header-class="bg-light" footer-class="bg-warning border-top rounded border-success"
                                                icon="" collapsible >
                                                {{$pergunta->obs}}
                                                </x-adminlte-card>
                                            </div>
                                            <div class="col-12">
                                                <div class="float-left" style="width: 6em;" >
                                            
                                        
                                                    <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
                                                </div>
                                                <div class="float-right">
                                                    <label for="">
                                                        <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="1" data-peso="{{ $pergunta->peso }}"  id="">Correta
        
                                                    </label>
                                                    <label for="">
                                                        <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="0" id="">Errada
        
                                                    </label>
    
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                    
                                
                                    </div>
                                <!-- multipla seleção -->
        
        
                                    @elseif ($arrayCampoText[0] == "Campo de Seleção Múltipla" && is_array($arrayCampoText[1]))
        
                                    @php
                                        $alternatives = $arrayCampoText[1];
                                    @endphp
                        
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($alternatives as $opcao)
                                
                                            <input type="radio" class="form-check-input" disabled name="respostas[{{ $pergunta->id }}]" value="{{ $alternatives }}" 
                                            @if ($resposta->respostas == $alternatives) checked @endif />  {{ $opcao }}<br>
                                            @endforeach
                                        </div>
                                        <div class="col-12">
                                            <div class="float-left" style="width: 6em;" >
                                            
                                    
                                                <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
                                            </div>
                                            <div class="float-right">
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="1" data-peso="{{ $pergunta->peso }}" id="">Correta
    
                                                </label>
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="0" id="">Errada
    
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            
                                            <x-adminlte-card title="OBS:"  theme="light" theme-mode="full" class="elevation-3 text-black"
                                                body-class="bg-ligth " header-class="bg-light" footer-class="bg-warning border-top rounded border-success"
                                            icon="" collapsible >
                                            {{$pergunta->obs}}
                                            </x-adminlte-card>
                                        </div>
                                        
        
                                        
                                    
                                    </div>
                                @else
                            
                                    @if (is_string($arrayCampoText[0]) && $arrayCampoText[0] == "Campo para anexar documentos")
                                    <div class="row">
                                        <div class="col-12">
                            
                                            <x-adminlte-input-file name="respostas[{{ $pergunta->id }}]" disabledv  placeholder="Selecione um arquivo..." igroup-size="sm" value="{{$resposta->respostas}}" />
                                        </div>
                                        <div class="col-12">
                                            <div class="float-right">
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="1" data-peso="{{ $pergunta->peso }}"  id="">Correta
    
                                                </label>
                                                <label for="">
                                                    <input type="checkbox" name="corrigida[{{ $pergunta->id }}] " value="0" id="">Errada
    
                                                </label>

                                            </div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            
                                            <x-adminlte-card title="OBS:"  theme="light" theme-mode="full" class="elevation-3 text-black"
                                                body-class="bg-ligth " header-class="bg-light" footer-class="bg-warning border-top rounded border-success"
                                            icon="" collapsible >
                                            {{$pergunta->obs}}
                                            </x-adminlte-card>

                                        </div>
                                        
                            
                                    
                                    </div>
                            
                                
        
                                    @else
                                        <p>Formato de dados inválido para campo_text.</p>
                                    @endif
                                @endif
                            @else
                                <p>Erro ao decodificar a string JSON para campo_text.</p>
                            @endif
                        
                        
                    
                        @endforeach
                        <x-adminlte-button label="Enviar correção " id="Adicionar_Pergunta" type="submit" theme="success" class="float-right ml-3" icon="fas fa-check"/>
                    </form>

                    </x-adminlte-card>
                </div>
            </div>
        </div>

@endsection