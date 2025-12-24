@props(['tcc'])
@php
    $defaultValues = ['termo', 'defesa', 'banca'];
    $title = ['Termo de Aceite', 'Solicitação da defesa', 'Composição da Banca'];
    $id = 0;
@endphp
<x-app-layout title="Adicionar Documento" >
    <div class="flex flex-col justify-center gap-2 mt-10 ">
        @foreach ($defaultValues as $values)

            <a href="{{route($values, ['tcc' => $tcc, 'view'=> $values])}}">
                <div
                    class="p-5 dark:bg-gray-700 bg-white rounded flex gap-5 items-center shadow-md text-black dark:text-white transition-all duration-300 hover:scale[1.05] hover:bg-indigo-50 hover:dark:bg-gray-600">

                    <div><i class="fa-solid fa-folder-open text-indigo-500"></i></div>
                    <div>
                        <h2 class="h5">{{$title[$id]}}</h2>
                        <p>
                            Documento referente à(o) {{$title[$id]}}
                        </p>
                    </div>
                    
                </div>
            </a>
            @php
                $id = $id + 1;
            @endphp
        @endforeach
    </div>

</x-app-layout>