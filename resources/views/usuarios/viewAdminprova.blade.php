@extends('adminlte::page')

@section('title', $titulo->titulo)

@section('content')
@php
    $config = [
    "responsive" => true,
    "dom" => '<"row" <"col-sm-6" B> <"col-sm-6" f> >
    <"row" <"col-12" t> >
    <"row" <"col-sm-6" i> <"col-sm-6" p> >',
    "lengthMenu" => [[10, 25, 50, -1], [10, 25, 50, "All"]],
    "buttons" => ["copy", "csv", "excel", "pdf", "print", "reset", "reload"],
    "initComplete" => "function(settings, json) {
        $('#table2').css('width', '100%');
    }"
];

@endphp
<div class="row">
    <div class="col-12 mt-5">

        <x-adminlte-card title="Status dos Usuários" theme="light" theme-mode="full" class="elevation-3 text-black"
        body-class="bg-ligth " header-class="bg-gradient-info" footer-class="bg-success border-top rounded border-light"
        icon="" collapsible   >
        <x-adminlte-datatable id="tabela-respostas" :heads="[['label' => 'Nome:', 'no-export' => true, 'width' => 10], ['label' => 'Status', 'no-export' => true, 'width' => 10],['label' => 'Visualizar', 'no-export' => true, 'width' => 10]]" :config="$config" :theme="'primary'">
            @foreach($provas as $prova)
            <tr>
                <td>{{ $prova->user->name }}</td>
                <td>{{ $finalizado }}</td>
                @php
                    $usuario = $prova->user->id;
    
                @endphp
                <td> <a href="{{route('resposta.usuario', [$titulo->id , $usuario])}}">
                    <x-adminlte-button label="Visualizar" type="button" theme="primary" class="float-center" icon="far fa-eye" data-toggle="modal" data-target="#meuModal"/>

                </a></td>
            </tr>
            @endforeach
        </x-adminlte-datatable>
        
       
       


    
        
        </x-adminlte-card>
    </div>
</div>

@endsection