@if (Auth::user()->tipo_usuario === 'aluno')
    <x-aluno-painel />
@else
    <x-empty-data titulo="Nenhum Tcc Encontrado" :href="route('tcc.create')" mensagem="Comece agora a criar seus Tcc's !!"
        botao="Crie seu primeiro Tcc" />
@endif