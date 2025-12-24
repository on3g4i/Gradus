@php
    function formatarDataTimestamp($timestamp)
    {
        // Converte o timestamp para objeto DateTime
        $data = new DateTime($timestamp);

        // Extrai os componentes da data
        $dia = $data->format('d');
        $mes = $data->format('m');
        $ano = $data->format('Y');
        $horas = $data->format('H');
        $minutos = $data->format('i');

        // Retorna a string formatada
        return "Data: $dia/$mes/$ano Horário: $horas:$minutos";
    }
@endphp
@props(['tcc', 'usuario'])
<x-documentos.corpo position="'start'" titulo="Composição da Banca examinadora" :rota="route('documentos.store', ['tcc' => $tcc])">

    <p>
        Aluno(a):
        <x-documentos.dados>{{$tcc->aluno->name}}</x-documentos.dados>
    </p>

    <h1 class="h6">
        Título do Trabalho: <x-documentos.dados>{{$tcc->nome_projeto}}</x-documentos.dados>
    </h1>
    <p>Professor(a) Orientador(a): <x-documentos.dados>{{$usuario->name}}</x-documentos.dados></p>
    <p>Formato do Trabalho (artigo ou monografia):
        <x-documentos.input id="formato" type="text" class="h-10" />
    </p>

    <h2 class="h5 my-5 font-bold">Banca Examinadora:</h2>

    <ul class="">

        <li>
            Nome e email: <x-documentos.input id="formato" type="text" class="h-10" />

        </li>
        <li>
            Nome e email: <x-documentos.input id="formato" type="text" class="h-10" />

        </li>
        <li>
            Nome e email: <x-documentos.input id="formato" type="text" class="h-10" />

        </li>
    </ul>
    <h2 class="h5 my-5 font-bold">
        Defesa do Trabalho:
    </h2>

    <p> {{formatarDataTimestamp($tcc->dia_defesa)}} </p>



    <x-slot:assinatura>

        <x-documentos.assinatura>
            Professor Orientador(a)
        </x-documentos.assinatura>


    </x-slot:assinatura>

</x-documentos.corpo>