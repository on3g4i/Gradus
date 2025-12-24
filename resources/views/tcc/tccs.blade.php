<x-app-layout title="Tcc's">

    <div class="p-5 grid  gap-3 ">
        @forelse ($tccs as $item)
            <x-card-sb :tcc="$item" :delete="route('tcc.destroy', ['tcc' => $item])" :edit="route('tcc.edit', ['tcc' => $item])">
                <div class="col mr-2 flex flex-col gap-3">
                    <div class="uppercase">
                        <h1 class="text-xs font-weight-bold mb-1 ">
                            Aluno: {{$item->aluno->name}}
                        </h1>
                        <h1 class="text-xs font-weight-bold mb-1 ">
                            Orientador: {{$item->orientador->name}}
                        </h1>
                    </div>
                    <div class="dark:text-gray-300 text-gray-600">
                        <h2 class="h6 mb-0 ">Nome do projeto: {{$item->nome_projeto}}</h2>
                        <h3 class="h6 mb-0 ">Descrição: {{$item->descricao}}</h3>
                    </div>
                </div>
            </x-card-sb>
        @empty
            <x-if-generic />
       
        @endforelse
        <div>{{ $tccs->links() }}</div>
    </div>

</x-app-layout>