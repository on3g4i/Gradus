@props(['tcc', 'nome'])
<x-app-layout>
    <x-slot name="title">
        Tcc do(a) aluno(a): {{ $nome }}
    </x-slot>

</x-app-layout>