@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="container-fluid">
        <div class="d-flex">
            <div class="p-2">
                <h1>Dashboard</h1>

            </div>


        </div>
        <div class="row">
            <div class="col-md-3">
                <x-adminlte-small-box theme="card bg-gradient-success" body-class="bg-light" header-class="bg-success" footer-class="bg-success border-top rounded border-light" id="mySmallBox" title="{{$statusprovaAvaliado}}"  text="Usuários selecionados"
                    icon="fas fa-user text-teal" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box theme="card bg-gradient-warning"  class="bg-primary"  id="mySmallBox" title="{{$statusprova}}"  text="Usuários registrados"
                    icon="fas fa-user text-danger" />
            </div>
            <div class="col-md-4">
                <x-adminlte-small-box theme="card bg-gradient-danger" body-class="bg-light" header-class="bg-success" footer-class="bg-success border-top rounded border-light" id="mySmallBox" title="{{$provas}}"  text="Avaliações criadas"
                    icon="fab fa-wpforms" />
        </div>
    </div>
@stop

@section('content')

    <div class="container-fluid">
        

            
            
        </div>
        
        @include('componentsdash.datatable',[
                'idBotao'=>'refresh',
                'idTable' => '#table5',
        ])
    </div>
       

@endsection

@push('js')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resources/jquery.mask.js') }}"></script>

@endpush

