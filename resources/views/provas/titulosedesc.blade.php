@extends('adminlte::page')

@section('title', 'Criar Avaliação')



@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Crie um Título e uma descrição para suas perguntas:" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                icon="" collapsible   >

                <form action="{{ route('titulos.store') }}" method="POST">
                    @csrf
                    <x-adminlte-input name="titulo" placeholder="Informar o nome da avaliação:"
                    label="informe um título para sua  Avaliação:" value="{{ old('titulo') }}" />
                    
                    <x-adminlte-textarea name="descricao" placeholder="Descrição da avaliação:"
                    label="Descrição da avaliação:" value="{{ old('descricao') }}" />
                    <x-adminlte-button label="Adicionar" type="submit" theme="success" class="float-right" icon="fas fa-plus"/>


                </form>

            </x-adminlte-card>


        </div>
    </div>
</div>
@stop
@push('js')
<script>
    const textDesc = document.querySelector('#descricao');
        textDesc .addEventListener("keyup", e =>{
            let cHeight = e.target.scrollHeight;
            console.log(cHeight)
            textDesc.style.height = `${cHeight}px`
    })

</script>
<script src="{{ asset('vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function(){
        console.log('carregando')
        const campoRequired = "Por favor preencher esse campo";
        $('#form').validate({
            rules:{
                titulo: "required",
                descricao: "required",


            },
            messages:{
                titulo: campoRequired,
                descricao: campoRequired,


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
                $('#peso').unmask();
            
                console.log(form.serialize());
                return;
                // form.submit();
            }

        });
    });
</script>
    
@endpush