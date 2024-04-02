@extends('adminlte::page')
@section('title', "$empresa->nome_da_empresa")
@section('content_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1>{{ $empresa->nome_da_empresa }}</h1>
            </div>

        </div>
    </div>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <x-adminlte-card title="Editar Empresa" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    @csrf 
                    @method('PUT')
                    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST" id="form">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="nome_da_empresa" placeholder="Nome da empresa"
                                            label="Nome Completo" value="{{ $empresa->nome_da_empresa }}" />
                              
                                            
                                <x-adminlte-input name="cnpj" placeholder="00.000.000/0000-00"
                                            label="cnpj" data-mask="00.000.000/0000-00" value="{{ $empresa->cnpj }}" />
                            
                            
                            
        
                            </div>
                        </div>
                        <x-slot name="footerSlot">
                            <x-adminlte-button type="submit" form="form" class="d-flex ml-auto" theme="primary"
                                label="Enviar" icon="fas fa-sign-in" />
                        </x-slot>
                    </form>
            </x-adminlte-card>
        </div>
    </div>
  </div>
  

@endsection
@prepend('js')
    <script src="{{ asset('resources/jquery.mask.js') }}"></script>
@endprepend
@push('js')
    <script>
        $(document).ready(function() {

            $("#cnpj_terceiro").mask('00.000.000/0000-00');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#form").submit(function() {

                $("#cnpj_terceiro").unmask();
            })
        });
    </script>
@endpush






