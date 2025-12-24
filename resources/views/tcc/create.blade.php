<x-app-layout title="Criar Novo Tcc">
    <x-form :action=" route('tcc.store')">
        <div>
            <x-label for="nome" value="{{ __('Nome do projeto') }}" />
            <x-input id="nome" class="block mt-1 w-full dark:text-white" type="text" name="nome" :value="old('nome')"
                required autofocus autocomplete="nome" />
        </div>

        <div class="mt-4">
            <x-label for="matricula" value="{{ __('Matrícula do Aluno') }}" />
            <x-input id="matricula" type="matricula" name="matricula" :value="old('matricula')" required autofocus class="w-full"
                autocomplete="matricula">
            </x-input>
        </div>
        <div>
            <x-label for="data" value="{{ __('Data de entrega') }}" />
            <x-input id="data" class="block mt-1 w-full" type="date" name="data" required autofocus
                autocomplete="data" />
        </div>
        <div class="mt-4">
            <x-label for="descricao" value="{{ __('Descrição') }}" />
            <textarea id="descricao"
                class="block mt-1 w-full recize-y p-3 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 text-black focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                type="descricao" name="descricao" :value="old('descricao')" required autofocus
                autocomplete="descricao"> </textarea>
        </div>

        <x-slot name="mensagem">Criar</x-slot>

    </x-form>
</x-app-layout>