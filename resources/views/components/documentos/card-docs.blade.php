@props(['tcc'])
{{--Card para expor dados--}}
<div
    class="rounded rounded-tr-none dark:bg-gray-800 bg-white shadow-md dark:text-white text-black p-3 flex flex-col cartas hidden">
    <h1 class="h5">Nome do projeto: {{$tcc->nome_projeto}}</h1>

    <h2 class="h6">Aluno: {{$tcc->aluno->name}}</h2>

    <div class="p-3 flex gap-2 items-center justify-center">
        <div class="flex gap-2">

            @forelse ($tcc->documentos as $documento)
               
                <x-card-corpo-base>
                    <div class="text-center">
                        <i class="fa-solid fa-file-pdf fa-xl text-red-600"></i>
                        <p>{!!$documento->tipo!!}</p>
                    </div>
                    <div class="flex justify-around">
                        <a href="{!!route('baixar', ['documento' => $documento])!!}"><i
                                class="fa-solid fa-download text-white-800"></i></a>
                        <form action="{!!route('documentos.delete', ['documento' => $documento])!!}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit"><i class="fa-solid fa-trash text-white-800"></i></a></button>
                        </form>
                    </div>
                </x-card-corpo-base>
            @empty
                <x-empty-data titulo="Nenhum arquivo Encontrado" :href="route('tipos', ['tcc' => $tcc])"
                    mensagem="Comece agora a organizar seus documentos !!" botao="Crie seu primeiro Documento" />

            @endforelse
        </div>
        <div>
            @if (!$tcc->documentos->isEmpty() )
                <x-documentos.card-criar-docs :tcc="$tcc" :route="route('tipos', ['tcc' => $tcc])">
                    <i class="fa-solid fa-circle-plus text-white-800"></i>
                    <p>Criar</p>
                </x-documentos.card-criar-docs>
                <x-documentos.card-criar-docs :tcc="$tcc" :route="route('salvar', ['tcc' => $tcc])" id="salvar">
                    <i class="fa-solid fa-file-arrow-up text-white-800"></i>
                    <p>Salvar</p>
                </x-documentos.card-criar-docs>
            @endif

        </div>
    </div>

    <h2 class="h6 self-end font-bold">Orientador: {!!$tcc->orientador->name!!}</h2>
</div>