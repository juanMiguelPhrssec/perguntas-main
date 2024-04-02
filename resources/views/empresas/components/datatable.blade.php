{{-- Setup data for datatables --}}
@php 
    $heads = ['id','Nome da Empresa', ['label'=>'CNPJ','width'=>10],['label' => 'Actions', 'no-export' => true, 'width' => 5]];
    $config=[
        'ajax'=>([
            
            'url' => route('empresas.json'),
            'dataSrc' => 'empresasList',
            'type' => 'GET',
            'data' => ['_token' => csrf_token()],

        ]),
        'data'=>[
        ],
        'autofill'=>true,
        'order'=>[[0,'asc']],
        'columns'=>[
            ['data'=> 'id'],
            ['data'=>'nome_da_empresa'],
            ['data'=>'cnpj'],
            ['data' => 'btns']
            
        ],
    ];
@endphp   
<x-adminlte-datatable id="table5" :heads="$heads" :config="$config" striped hoverable />
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
    