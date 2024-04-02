@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="container-fluid">
    <div class="col-md-3">
        @if ($possuiprova > 0)
        <x-adminlte-small-box id="mySmallBox" title="{{$possuiprova}}"  text="você possui avaliações"
            icon="fas fa-user text-teal" />
         
            
      
            <a href="{{ route('titulo.setor.usuario.create',[$titulo ,$setor]) }}""  class="btn btn-success">
                <x-adminlte-button label="Responder agora avaliação" theme="success" icon="fab fa-wpforms"/>

            </a> 
        

        @else
            <x-adminlte-small-box id="mySmallBox" title="{{$possuiprova}}"  text="você não possui avaliações"
                icon="fas fa-user text-teal" />
        @endif
    
    </div>
</div>
@endsection