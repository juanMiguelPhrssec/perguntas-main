@extends('adminlte::page')
@section('tiltle','Painel de Pessoas')
@section('content_header')
    <h1>Pessoa</h1>
@endsection
@section('content')
@php
$heads = [
'ID',
'Name',
['label' => 'Email', 'width' => 30],
['label' => 'Actions', 'no-export' => true, 'width' => 10],
];

$config = [
"paging" =>true,
"search" =>[
"return" => true
],
"ajax"=>[
'url'=>'/pessoasJson/'.$setor. '/'. $empresa,
'dataSrc'=>"pessoasDataList"
],
'data' => [
],
'order' => [[1, 'asc']],
"columns"=>[
["data"=> "id"],
["data"=> "name"],
["data"=> "email"],
["data"=> "btns"]

],
];

@endphp

<button class="btn btn-primary mb-2" id="refresh">Atualizar</button>
<a href="{{ route('empresas.setor.pessoas.create', ['empresa' => $empresa, 'setor' => $setor]) }}">
    <x-adminlte-button label="Nova Pessoa"   class="bg-purple mb-2" />

</a>



<x-adminlte-datatable id="table2" :heads="$heads" :config="$config" with-buttons />

@endsection

@push('js')
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    $('#form').submit(function(event) {
    
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: "{{route('empresas.setor.pessoas.create', [$empresa, $setor])}}",
            data: formData,
            success: function(response) {
                // Lógica de sucesso
                // alert(response.message);
                // Atualize a página ou faça outras ações necessárias
                $(document).add(function() {
                    Toast.fire({
                        icon: 'success',
                        title: 'pessoa',
                    })
                });
                $('#table2').DataTable().ajax.reload();
                // console.log(response.card)
            },
            error: function(xhr, status, error) {
                // Lógica de erro
                console.log(xhr.responseJSON)
                $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.warning(value)
                });
            }
        });
    });
    $(document).on('click', '.excluir-dado', function() {
        var dadoId = $(this).data('dado-id');
        var $button = $(this);
        if (confirm('Tem certeza de que deseja excluir este dado?')) {
            $.ajax({
                type: 'DELETE',
                url: '/pessoas/' + dadoId,
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Lógica de sucesso
                    toastr.success(response.message)
                    // Atualize a página ou faça outras ações necessárias
                    $button.parent().parent().parent().remove()
                    $('#table2').DataTable().ajax.reload();
                },
                error: function(xhr, status, error) {
                    // Lógica de erro
                    console.error(xhr.responseText);
                    $.each(xhr.responseJSON.errors, function(key, value) {
                    toastr.warning(value)
                });
                }
            });
        }
    });
    $("#refresh").click(function() {
        $("#table2").DataTable().ajax.reload();
    })
</script>
<script>
    function GeradordeSenha(){
        const upperCase="ABCDEFGHIJKLMNOPQRSTUV";
        const lowerCase = "abcdefghijklmnopqrstuvwxyz";
        const caracters = "!@\$%/&";
        const numeros = "0123456789";
        const allchars = upperCase + lowerCase + caracters + numeros;
        const comprimentoSenha = 9;
        let senha ="";

        senha += upperCase.charAt(Math.floor(Math.random()*upperCase.length));
        senha += lowerCase.charAt(Math.floor(Math.random()*lowerCase.length));
        senha += caracters.charAt(Math.floor(Math.random()*caracters.length));
        senha += numeros.charAt(Math.floor(Math.random()*numeros.length));

        for(let i =4; i < comprimentoSenha; i++){
            const randomIndex = Math.floor(Math.random()*allchars.length)
            senha += allchars.charAt(randomIndex);
        }
        senha = senha.split('').sort(()=> Math.random()-0.5).join('');
        document.getElementById("password").value = senha;
    }
</script>
@endpush
@push('js')
<script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('resources/jquery.mask.js') }}"></script>
@endpush
@section('plugins.Datatables', true)
@section('plugins.DatatablesExport', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Toastr', true)