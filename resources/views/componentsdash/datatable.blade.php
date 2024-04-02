{{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Titulo da Avaliação',
    'Usuários selecionados',
    'Usuários que finalizaram',
    'Usuários para finalizar',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];
$config = [
    'ajax' => [
        'url'=>'/tituloJson',
        'dataSrc' => "tituloedescriList",
    ],
    'data' => [],
    'order' => [[0, 'asc']],
    'columns' => [
        ['data' => 'id'],
        ['data' => 'titulo'],
        ['data' => 'usuariorespondeu'],
        ['data' => 'usuariorespondeu'],
        ['data' => 'usuariorespondeu2'],
        ['data' => 'btns']
    ],
];
@endphp   
<x-adminlte-datatable id="table2" :heads="$heads" :config="$config" striped hoverable bordered compressed  />

<x-adminlte-modal id="modalMin" title="Exclusão">
    <div>Tem certeza que deseja excluir?</div>
    <x-slot name="footerSlot">
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal" id="cancel" />
        <x-adminlte-button class="mr-auto" theme="success" label="Confirmar" id="confirmation" />
    </x-slot>
</x-adminlte-modal>

@push('js')




<script>
    $("{{ $idBotao }}").click(function() {
        $("{{ $idTable }}").DataTable().ajax.reload();
    })
</script>

    <script src="{{ asset('resources/requisicaoAjax.js') }}"></script>
@endpush 
    