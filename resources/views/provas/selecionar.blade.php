@extends('adminlte::page')

@section('title', $pessoa->name)

@section('content')
<div class="row mt-5">
    <div class="col-12">
        <x-adminlte-card title="Selecione uma avaliação para o {{$pessoa->name}} " theme="light" theme-mode="full" class="elevation-3 text-black"
        body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
    icon="" collapsible  >
            <form action="{{route("empresas.setor.pessoas.prova.store",[$pessoa->id,$setor, $empresa])}}" method="POST">
                @csrf
                    
                <x-adminlte-select label="Selecione aqui uma avaliação para o usuário responder" id="tipo_pergunta" name="nome_aval"
                class="select-options">
                    @foreach ($titulo as $item)
                        
                            <option value="{{$item->id}}">{{$item->titulo}}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-button class="float-right" type="submit" label="Enviar para {{$pessoa->name}}" theme="success" />
            
            </form>

        </x-adminlte-card>
    </div>
</div>

@endsection;

