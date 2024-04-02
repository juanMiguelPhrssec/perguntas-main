@extends('adminlte::page')

@section('title', "$titulo->titulo")


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mt-5">
                <x-adminlte-card title="Editar {{$titulo->titulo}}" theme="light" theme-mode="full" class="elevation-3 text-black"
                        body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                    icon="" collapsible >
                    <form action="{{ route('titulos.store') }}" method="POST">
                        @csrf
                        <x-adminlte-input name="titulo" placeholder="Informar o nome da avaliação:"
                        label="informe um título para sua  Avaliação:" value="{{ $titulo->titulo }}" />
                        
                        <x-adminlte-textarea name="descricao" placeholder="Descrição da avaliação:"
                        label="Descrição da avaliação:" value="" >
                        {{ $titulo->descricao }}
                        </x-adminlte-textarea>
                        <x-adminlte-button label="Editar" type="submit" theme="primary" class="float-right" icon="fas fa-plus"/>
    
    
                    </form>
                </x-adminlte-card>
                <x-adminlte-card title="Editar perguntas" theme="light" theme-mode="full" class="elevation-3 text-black"
                        body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                    icon="" collapsible >

                    <form action="">
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
                            <label for="">{{ $index + 1 }}. {{ $pergunta->pergunta }}</label>  <div class="float-right"><label for="">Criticidade:</label><span>  {{$item}} </span> </div> <br>
                            <div class="col-12 mt-2">
                                <x-adminlte-card title="OBS:"  theme="light" theme-mode="full" class="elevation-3 text-black"
                                    body-class="bg-ligth " header-class="bg-light" footer-class="bg-warning border-top rounded border-success"
                                icon="" collapsible >
                                {{$pergunta->obs}}
                                </x-adminlte-card>
                            </div>
                        
                            @if (is_array($arrayCampoText))
                            <!-- verifica se o campo é de texto -->
                            @if (count($arrayCampoText) == 1 && $arrayCampoText[0]== "Campo de Texto")
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Campo para a descrição da avaliação -->
                                            <x-adminlte-input name="descricao"  value="" />
                                        </div>
                                        
                                        <div class="col-12 ">
        
                                            <div style="width: 6em;" >
                            
                                            <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
                                            </div>
                                        </div>
                                    </div>
                                    
                        
        
                                    <!--verifica se o campo é de multipla escolha -->
                                    @elseif ($arrayCampoText[0] == "Campo de Múltipla Escolha" && is_array($arrayCampoText[1]))
        
                                    <!-- Pergunta com opções -->
                                    @php
                                        $alternativas = $arrayCampoText[1];
                                    @endphp
                                
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            @foreach ($alternativas as $alternativa)
                                                <input type="radio" class="form-check-input" name="alternativa[]" value="{{ $alternativa }}" /> 
                                                <label class="form-check-label" for="{{ $alternativa }}">
                                                    {{ $alternativa }}
                                                </label>
                                                <br>
                                            @endforeach
                                        </div>
                                       
                                        <div class="col-8 d-flex ">
                                            <!-- Campo para o peso da pergunta com máscara de entrada -->
                                            <div style="width: 6em;" class="float-righ">
                                                <!-- Campo para o peso da pergunta com máscara de entrada -->
                                                <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
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
                                
                                                <input type="checkbox" class="ml-1 mr-1" name="selecao_multipla[]" value="{{ $opcao }}" /> {{ $opcao }}<br>
                                            @endforeach
                                        </div>
                                      
        
                                        <div class="col-12 d-flex ">
                                            <!-- Campo para o peso da pergunta com máscara de entrada -->
                                            <div style="width: 6em;" class="float-righ">
                                                <!-- Campo para o peso da pergunta com máscara de entrada -->
                                                <strong class="text-danger"  data-mask="00:00">peso: {{ $pergunta->peso }} </strong>
                                            </div>
                                        </div>
                                    
                                    </div>
                                @else
                            
                                    @if (is_string($arrayCampoText[0]) && $arrayCampoText[0] == "Campo para anexar documentos")
                                    <div class="row">
                                        <div class="col-12">
                            
                                            <x-adminlte-input-file name="arquivo"  placeholder="Selecione um arquivo..." igroup-size="sm" value="" />
                                        </div>
                                        
                            
                                        <div class="col-12 ">
                                
                                            <div style="width: 6em;" >
                                            
                                    
                                            <strong class="text-danger"  data-mask="00:00"> peso: {{ $pergunta->peso }} </strong>
                                            </div>
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
                        <div></div>
                        <x-adminlte-button label="Editar" type="submit" theme="primary" class="float-right ml-3" icon="fas fa-plus"/>
                        <a href="{{ route('admin.home') }}" ><x-adminlte-button label="Pagina Inicial" type="button" theme="success" class="float-right" icon="fas fa-home"/></a>
              
    


                    </form>    
                    
             

                
               
                </x-adminlte-card>
                

            </div>
        </div>
    </div>

@endsection
@push('')
    
@endpush
@push('css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush
@push('js')

<script>
    const amostragem = document.getElementById('mostrar');
     console.log(amostragem);

</script>
    
@endpush



