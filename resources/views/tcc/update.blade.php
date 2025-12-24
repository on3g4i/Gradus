@props(['tcc', 'nome'])
<x-app-layout>
    <x-slot name="title">
        Tcc do(a) aluno(a) {{ $nome }}
    </x-slot>

    <x-form action="{{ route('tcc.update', ['tcc' => $tcc])}}" mensagem="Salvar Mudanças">
        @method('PUT')
        <div class="flex justify-around flex-wrap gap-5 ">
            <div
                class=" flex flex-column justify-start sm:justify-center size-100 sm:p-5 rounded h-auto sm:h-60 w-full sm:w-auto  ">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Editar Informações</h3>
                <p>Edite as informações sobre o tcc </p>
            </div>
            <div class="flex gap-5 flex-nowrap flex-column w-full sm:w-80 ">
                <div class="col-span-6 sm:col-span-4 ">
                    <x-label for="nome" value="{{ __('Nome do projeto ') }}" />
                    <x-input id="nome" type="text" class="mt-1 block w-full" wire:model="state.nome" 
                        autocomplete="nome" name="nome" value="{{$tcc->nome_projeto}}" />
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-label for="descricao" value="{{ __('Descrição') }}" />
                    <textarea id="descricao"
                        class="block h-fit mt-1 w-full resize-y p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                        type="descricao" name="descricao" :value="old('descricao')" autofocus
                        autocomplete="descricao"> {{$tcc->descricao}} </textarea>
                </div>
                <hr class="bg-white">
                @php
                    $date = $tcc->dia_defesa;
                    $agora = new DateTime($date, new DateTimeZone('America/Sao_Paulo'));
                @endphp
                <div class="col-span-6 sm:col-span-4 ">
                    <x-label for="data" value="{{ __('Data de Defesa Atual') }}" />
                    <div
                        class="mb-5 block w-full p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        {{date_format($agora, 'd/m/Y')}}
                    </div>
                    <x-label for="data" value="{{ __('Nova data de Defesa') }}" />
                    <x-input id="data" type="date" class="mt-1 block w-full" wire:model="state.nome" 
                        autocomplete="nome" name="data" />
                </div>
            </div>
        </div>

    </x-form>


</x-app-layout>