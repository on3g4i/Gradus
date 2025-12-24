@props(['titulo', 'mensagem', 'href', 'botao'])
<div {!!$attributes->merge(['class' => 'm-auto flex flex-col items-center  p-6 text-center dark:text-white text-black'])!!}>
    <!-- Ícone de pasta vazia -->
    <i class="far fa-folder fa-xl text-indigo-500 mb-6"></i>

    <!-- Mensagem principal -->
    <h2 class="text-xl font-medium mb-2">{{$titulo}}</h2>
    
    <p class="text-white-200 mb-6">{{$mensagem}}</p>

    <!-- Botão de ação -->
    <a href="{{$href}}">
        <x-button class="gap-2">
            <i class="fa-solid fa-circle-plus"></i>
            {{$botao}}
        </x-button>
    </a>
</div>