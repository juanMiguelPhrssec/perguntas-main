@extends('adminlte::page')
@section('title', $empresa->nome_da_empresa . ' - Setor: ')



@section('content_header')
    <h1> Cadastrar Usuario na {{$setor->setor}} </h1>
@endsection
@section('content')
<x-adminlte-card id="cardEdicaoUsuario" title="Cadastrar Usuário" theme="purple" icon="" size='lg'
    disable-animations>
    <form action="{{ route('empresas.setor.pessoas.store', [$empresa->id, $setor->id]) }}" method="POST">


        @csrf

        <div class="card-body">
            <div class="form-group">
                <x-adminlte-input label="E-mail" name="email" type="email" placeholder="example@hotmail.com" />
            </div>
            <div class="form-group">
                <x-adminlte-input label="Nome" name="name" type="text" placeholder="Nome e Sobrenome" />
            </div>
            <x-adminlte-select name="type" label="Permissao">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </x-adminlte-select>
            <x-adminlte-select name="finalizado" label="Finalizado">
                <option value="0">Não finalizado</option>
                <option value="1">Finalizado</option>
            </x-adminlte-select>
            <div class="form-group">
                <x-adminlte-input label="Password" name="password" type="text" placeholder="password" id="password" />
                <button type="button" class="btn btn-primary" onclick="GeradordeSenha()">Gerar Senha</button>
            </div>
        </div>
        <x-adminlte-button type="submit" label="Criar usuário" theme="success" />
    </form>
</x-adminlte-card>
@endsection
{{-- Example button to open card --}}
{{-- <x-adminlte-button label="Open card"  /> --}}
{{--  --}}

@push('js')
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
