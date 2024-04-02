@extends('adminlte::page')

@section('title', 'Criar Avaliação')



@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-12">
            <x-adminlte-card title="Título e descrição" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-ligth " header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                icon="" collapsible   >

                    
                    <x-adminlte-input name="nome_empresa" placeholder="Informar o nome da avaliação:"
                    label="informe um título para sua  Avaliação:" value="{{$titulo->titulo}}" disabled/>
                    
                    <x-adminlte-textarea name="descricao" placeholder="Descrição da avaliação:"
                    label="Descrição da avaliação:"  disabled>
                    {{$titulo->descricao}}
                    </x-adminlte-textarea>



            </x-adminlte-card>


        </div>
        <div class="col-12">
            <x-adminlte-card title="Criar perguntas:" theme="light" theme-mode="full" class="elevation-3 text-black"
                    body-class="bg-light" header-class="bg-success" footer-class="bg-success border-top rounded border-light"
                icon="" collapsible>
                <form action="{{ route('titulos.avaliacao.store', $titulo->id) }}"  method="POST" id="form">
                    @csrf
                    
                    <x-adminlte-input name="pergunta" id="Descri_Pergunta" placeholder="Digite sua pergunta: "
                        label="1.Informe aqui sua pergunta:" value="{{old('pergunta')}}" />
                    
            
                    <x-adminlte-select label="2.Selecione como o usuário deve responder esta mensagem:" id="tipo_pergunta" name="optionsTest1[]"
                        class="select-options">
                        <x-adminlte-options :options="['Campo de Texto', 'Campo de Múltipla Escolha','Campo de Seleção Múltipla', 'Campo para anexar documentos']" empty-option="Escolha uma opção" />
                    </x-adminlte-select>
            
                    <div class="row">
                        <div class="col-12" id="campotexto" style="display: none;">
                            <x-adminlte-input name="nome_empresa" placeholder="Campo Texto "
                                label="O campo que será utilizado na sua pergunta é o campo Texto:" value="" />
                        </div>
                        <div class="col-12" id="campomarcao" style="display: none;">
                            <a href="#" id="Adicionar_campo" data-num-opcoes="9"><i class="fa fa-plus"></i> Clique aqui para adicionar uma opção:</a>
                            <div id="imendaHTMLemail"></div>
                        </div>
                        <div class="col-12" id="campomarcaomultipla" style="display: none;">
                            <a href="#" id="Adicionar_campo1" data-num-opcoes="8"><i class="fa fa-plus"></i> Clique aqui para adicionar uma opção:</a>
                            <div id="imendaHTML_multipla"></div>
                        </div>
                        
                        <div class="col-12" id="campodoc" style="display: none;">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Campo para adicionar documento </label>
                            </div>
                        </div>
                    </div>
            
        
    
            
                  
                    <div class="row">
                        <div class="col-6">
                            
                            <x-adminlte-select label="3.Qual a críticidade dessa pergunta: Muito Baixa, Baixa, Média  Alta ou Muito Alta:" class="select2-purple" name="criticidade[]">
                                <x-adminlte-options :options="['Muito Baixa','Baixa', 'Média', 'Alta','Muito Alta']" empty-option="Escolha uma opção" />
                            </x-adminlte-select>
                        </div>
                        <div class="col-6">
                            <x-adminlte-input name="nome_empresa" placeholder=" "
                                label="Informe o peso desta questão:"  name="peso" value="" />
                        </div>
                    </div>            
                    <x-adminlte-textarea  placeholder="Informe aqui uma observação para a pessoa que vai responder:"
                        label="Informe aqui uma observação:"   name="obs" value=""  />

                        
                        <x-adminlte-button label="Salvar Questão" id="Adicionar_Pergunta" type="submit" theme="success" class="float-right ml-3" icon="fas fa-save"/>
                        <a href="{{route('titulos.edit', $titulo->id)}}">
                            <x-adminlte-button label="Visualizar Avaliação" type="button" theme="primary" class="float-right" icon="far fa-eye" data-toggle="modal" data-target="#meuModal"/>

                        </a>
                    </form>
                    
            </x-adminlte-card>
        </div>
        
    </div>

</div>
@endsection
@push('js')
<script>
    const textDesc = document.querySelector('#obs');
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
                pergunta: "required",
                optionsTest1: "required",
                criticidade: "required",
                peso: "required",

            },
            messages:{
                pergunta: campoRequired,
                optionsTest1: campoRequired,
                criticidade: campoRequired,
                peso: campoRequired,

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
                // form.submit();
            }

        });
    });
</script>
    
@endpush
@push('js')
<script src="{{ asset('resources/jquery.mask.js') }}"></script>


@endpush
    


@push('js')
<script>

    var idContador = 0;
    var idContador1 = 0;

    function exclui(id) {
        $("#" + id).parent().remove();
        idContador--; // Subtrai 1 do contador quando excluímos um campo
         // Subtrai 1 do contador quando excluímos um campo
    }
    function exclui(id) {
        $("#" + id).parent().remove();
        idContador1--; // Subtrai 1 do contador quando excluímos um campo
         // Subtrai 1 do contador quando excluímos um campo
    }

    $(document).ready(function() {
        $("#Adicionar_campo").click(function(e) {
            e.preventDefault();
            var tipoCampo = "email";
            adicionaCampo(tipoCampo);
        });

        $("#Adicionar_campo1").click(function(e) {
            e.preventDefault();
            var tipoCampo = "_multipla";
            adicionaCampo1(tipoCampo);
        });

        function adicionaCampo(tipo) {
            idContador++;

            var idCampo = "campoExtra" + idContador;
            var idForm = "formExtra" + idContador;

            var html = `<div style='margin-top: 8px;' class='input-group' id='${idForm}'>
                            <div class="input-group" id="${idCampo}">
                                <x-adminlte-input name="nome_empresa" id="alternativa${idContador}" name="alternatives[${idContador}]"  placeholder="Informe aqui:"
                                label="Digite a ${idContador}ª opção:" value="" />
                                <button class='btn' onclick='exclui("${idCampo}")' type='button'><span class='fa fa-trash'></span></button>
                            </div>
                        </div>`;

            // Usamos o tipo de campo para garantir que adicionaremos ao local correto
            $("#imendaHTML" + tipo).append(html);
        }
        function adicionaCampo1(tipo) {
            idContador1++;

            var idCampo = "campoExtra" + idContador1;
            var idForm = "formExtra" + idContador1;

            var html = `<div style='margin-top: 8px;' class='input-group' id='${idForm}'>
                            <div class="input-group" id="${idCampo}">
                                <x-adminlte-input name="nome_empresa" id="alternativa${idContador1}" name="alternatives[${idContador1}]"  placeholder="Informe aqui:"
                                label="Digite a ${idContador1}ª opção:" value="" />
                                <button class='btn' onclick='exclui("${idCampo}")' type='button'><span class='fa fa-trash'></span></button>
                            </div>
                        </div>`;

            // Usamos o tipo de campo para garantir que adicionaremos ao local correto
            $("#imendaHTML" + tipo).append(html);
        }
    });
</script>

@endpush
@push('js')
<script>
        //select
        $(document).ready(function() {
            $('.select-options').change(function() {
                var selectedOption = $(this).val();
                
                switch (selectedOption) {
                    case '0':
                        $('#campotexto').show('slow');
                        $('#campomarcao').hide('slow');
                        $('#campodoc').hide('slow');
                        $('#campomarcaomultipla').hide('slow');

                        console.log('Campo de Texto selecionado');
                        break;
                    case '1':
                        // Caso o valor selecionado seja 'Campo de Marcação', faça algo diferente...
                        console.log('Campo de Marcação selecionado');
                        $('#campomarcao').show('slow');
                        $('#campotexto').hide('slow');
                        $('#campodoc').hide('slow');
                        $('#campomarcaomultipla').hide('slow');
                        break;
                    case'2':
                        console.log('Campo Escolha Múltipla');
                        $('#campomarcaomultipla').show('slow');
                        $('#campodoc').hide('slow');
                        $('#campotexto').hide('slow');
                        $('#campomarcao').hide('slow');
                 
                        break;
                    case'3':
                        console.log('Campo Escolha Múltipla');7
                        $('#campodoc').show('slow');
                        $('#campomarcao').hide('slow');
                        $('#campomarcaomultipla').hide('slow');
                        $('#campotexto').hide('slow');
                        break;
                    default:
                        // Caso não corresponda a nenhum dos casos anteriores, faça algo padrão...
                        console.log('Opção inválida selecionada');
                }
            });
        });
    </script>
    
@endpush
