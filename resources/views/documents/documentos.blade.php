@props(['documentos'])
<x-app-layout title="Documentos">

    <div class="p-5 grid gap-3">

        @forelse ($documentos as $tcc)
            <x-documentos.card-docs :tcc="$tcc" />
        @empty

            <x-if-generic />
        @endforelse

    </div>
    <div class="mb-3">{!! $documentos->links()!!}</div>


</x-app-layout>