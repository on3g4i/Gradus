@props(['titulo', 'assinatura', 'position' => 'center'])

<x-app-layout class="dark:text-white text-black" title="Termo de Aceite">

    <div class="p-5 bg-white rounded mt-10 flex flex-col gap-5 text-black mb-2" id='documento'>
        <x-documentos.cabecalho />
        <div id="data" {{$attributes->merge(['class' => 'px-2 flex flex-col items-' . $position . ' m-9'])}}>
            @isset($titulo)
                <h3 class="uppercase text-center font-black h5">{{$titulo}}</h3>
            @endisset
            <p class="w-89 mt-5">
                {{$slot}}
            </p>
            <x-documentos.data-documento />
            <div class="self-center flex gap-2">{{$assinatura}}</div>
        </div>

    </div>
    <x-button id="criarDocumento" class="w-30 self-center">
        Criar Documento
    </x-button>



</x-app-layout>
@vite(['resources/js/documents.js']);