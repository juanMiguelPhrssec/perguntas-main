@extends('adminlte::page')
@section('title', 'Painel de empresas')
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>Setores</h1>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="container-fluid">
        <a href="{{route('empresas.index')}}" class="btn btn-primary mb-2">Empresas</a>
        <a href="{{route('empresas.setor.create',$empresa)}}" class="btn btn-primary mb-2">Cadastrar Setor</a>
        @include('empresas.setores.components.datatable',[
                'idBotao'=>'refresh',
                'idTable' => '#table5',
        ])
    </div>
    
@endsection

@push('js')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resources/jquery.mask.js') }}"></script>
@endpush