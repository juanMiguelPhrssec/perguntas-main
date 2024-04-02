@extends('adminlte::page')

@section('title', 'prova')

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <x-adminlte-card title="Prova  " theme="light" theme-mode="full" class="elevation-3 text-black"
                        body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                    icon="" collapsible >
                    <x-adminlte-input name="titulo" placeholder="Informar o nome da avaliação:"
                    label="informe um título para sua  Avaliação:" value="{{ $titulo->titulo }}" />
                    
                    <x-adminlte-textarea name="descricao" placeholder="Descrição da avaliação:"
                    label="Descrição da avaliação:" value="" >
                    {{$titulo->descricao}}
                    
                    </x-adminlte-textarea>

                    <form action=" {{ route('titulo.setor.usuario.store', [$titulo , $setor]) }}" method="POST">
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
                            
                        
                            @if (is_array($arrayCampoText))
              
                            @if (count($arrayCampoText) == 1 && $arrayCampoText[0]== "Campo de Texto")
                                    <div class="row">
                                        <div class="col-12">
                             
                                            <x-adminlte-input name="respostas[{{ $pergunta->id }}]"  value="" />
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
                                                    <input type="radio" class="form-check-input" name="respostas[{{ $pergunta->id }}]" value="{{ $alternativa }}" /> 
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
                                
                                                <input type="checkbox" class="ml-1 mr-1" name="respostas[{{ $pergunta->id }}]" value="{{ $opcao }}" /> {{ $opcao }}<br>
                                            @endforeach
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
                            
                                            <x-adminlte-input-file name="respostas[{{ $pergunta->id }}]"  placeholder="Selecione um arquivo..." igroup-size="sm" value="" />
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
                        <x-adminlte-button label="Responder " id="Adicionar_Pergunta" type="submit" theme="success" class="float-right ml-3" icon="fas fa-save"/>
                    </form>

                    </x-adminlte-card>
                </div>
            </div>
        </div>

@endsection