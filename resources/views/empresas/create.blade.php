@extends('adminlte::page')
@section('title', 'Empresa')

@section('content_header')
  <div class="row">
    <div class="col-sm-6">
        <h1>Registro de empresas</h1>
    </div>

  </div>

@endsection
@section('content')
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <x-adminlte-card title="Registrar nova empresa" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('empresas.store') }}" method="POST" id="form">
                    @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="nome_da_empresa" placeholder="Nome da empresa"
                                            label="Nome Completo" value="{{ old('nome_da_empresa') }}" />
                              
                                            
                                <x-adminlte-input name="cnpj" placeholder="00.000.000/0000-00"
                                            label="cnpj" data-mask="00.000.000/0000-00" value="{{ old('cnpj') }}" />
                            
                            
                            
        
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
@push('js')

<script src="{{ asset('resources/jquery.mask.js') }}"></script>


@endpush
@push('js')
    <script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>

  <script>
    $(document).ready(function(){
        const campoRequired = "Por favor preencher esse campo";
        $('#form').validate({
            rules:{
                nome_da_empresa: "required",

                cnpj: "required",

            },
            messages:{
                nome_da_empresa: campoRequired,
                cnpj: campoRequired,

            },
            errorElement: 'span',
            errorPlacement:function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-valid');
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            submitHandler: function(form) {
                $('#cnpj').unmask();

                console.log(form.serialize());
                return;
                // form.submit();
            }

        });
    });
  </script>
@endpush
