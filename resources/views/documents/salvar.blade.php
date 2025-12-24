<x-app-layout title="Salvar Documentos">
    <x-form mensagem="Salvar" enctype="multipart/form-data" action="{!!route('upload', ['tcc' => $tcc])!!}" method="POST" class="text-white ">
        @csrf
        <div>
            <x-label name="tipo" value="Selecione o Documento para envio" />
            <x-input type="text" name="tipo" value="{{old('tipo')}}" required class="w-50"/>
    
        </div>
        <div>
            <x-label name="file" value="Adicione um Documento" />
            <x-input type="file" name="file" required class="file:p-2 w-50
                file:rounded-lg file:border-0
                file:text-sm
                file:bg-gray-800 file:text-white
                hover:file:bg-indigo-500
                file:disabled:opacity-50 " />
    
        </div>
        
        
    
    </x-form>
</x-app-layout>