@extends('adminlte::page')
@section('title', $empresa->nome_da_empresa)

@section('content_header')
  <div class="row">
    <div class="col-sm-6">
        <h1>Registrar setor na Empresa {{$empresa->nome_da_empresa}}</h1>
    </div>

  </div>

@endsection
@section('content')
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <x-adminlte-card title="Registrar setor na Empresa" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-light" footer-class="bg-light border-top rounded border-light"
                    icon="" collapsible>
                    <form action="{{ route('empresas.setor.store',$empresa) }}" method="POST" id="form">
                    @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                {{-- inputs --}}
                                <x-adminlte-input name="setor" placeholder="Nome do setor"
                                            label="Nome do setor" value="{{ old('setor') }}" />
                              
                        
        
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
                setor: "required",



            },
            messages:{
                setor: campoRequired,
     

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


                console.log(form.serialize());
                return;
 
            }

        });
    });
  </script>
@endpush
