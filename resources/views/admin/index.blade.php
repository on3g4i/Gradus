@props(['usuarios'])
<x-app-layout title="Administração de Usuários">
    <div class="p-5 grid gap-3 ">
        <x-search-bar :action="route('admin.index')" />
        @forelse ($usuarios as $item)
            <x-card-sb :delete="route('admin.delete', ['user' => $item])">
                <div class="col mr-2 flex flex-col gap-3">
                    <div class="uppercase">
                        <h1 class="text-xs font-weight-bold mb-1 ">
                            Usuário: {{$item->name}}
                        </h1>
                    </div>
                    <div class="dark:text-gray-300 text-gray-600">
                        <h2 class="h6 mb-0 ">Email: {{$item->email}}</h2>
                        <h3 class="h6 mb-0 ">Tipo de usuário: {{$item->tipo_usuario}}</h3>
                    </div>
                </div>
            </x-card-sb>
        @empty
            <h2></h2>
        @endforelse
        {{$usuarios->links()}}
    </div>
</x-app-layout>