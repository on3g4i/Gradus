@php
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d');
@endphp
<div class="p-5 mt-5 self-end">
    <p {{$attributes->class(['border-b border-b-black p-1'])}}>
        <x-documentos.input id="city" />,
        {{strftime("%d de %B de %Y", strtotime($date))}}
    </p>
</div>