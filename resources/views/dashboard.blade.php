<x-app-layout>
        @empty($tccs->first())
                @if (Auth::user()->tipo_usuario === 'aluno')
                        <x-aluno-painel />
                @else
                        <x-empty-data titulo="Nenhum Tcc Encontrado" :href="route('tcc.create')"
                                mensagem="Comece agora a criar seus Tcc's !!" botao="Crie seus Tcc's" />
                @endif
        @else
                @if (Auth::user()->tipo_usuario === 'aluno')
                        <div class="space-y-6">

                                <!-- Título -->
                                <div>
                                        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                                                Meu Trabalho de Conclusão de Curso
                                        </h1>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">
                                                Acompanhe o andamento e as informações do seu TCC
                                        </p>
                                </div>

                                <!-- Cards principais -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                        <!-- Status do TCC -->
                                        <div class="p-5 rounded-2xl bg-white dark:bg-gray-800 shadow">
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                        Última atualização: {{ $tcc->updated_at->format('d/m/Y') }}
                                                </p>
                                        </div>

                                        <!-- Orientador -->
                                        <div class="p-5 rounded-2xl bg-white dark:bg-gray-800 shadow">
                                                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                        Orientador
                                                </h2>

                                                <p class="mt-2 text-lg font-semibold text-gray-800 dark:text-gray-100">
                                                        {{ $tcc->orientador->nome }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $tcc->orientador->email }}
                                                </p>
                                        </div>

                                        <!-- Prazo -->
                                        <div class="p-5 rounded-2xl bg-white dark:bg-gray-800 shadow">
                                                <h2 class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                        Prazo final
                                                </h2>

                                                <p class="mt-2 text-lg font-semibold text-red-600 dark:text-red-400">
                                                        {{ $tcc->dia_defesa->format('d/m/Y') }}
                                                </p>

                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                        Entrega da versão final
                                                </p>
                                        </div>

                                </div>

                                <!-- Informações detalhadas -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                        <!-- Tema do TCC -->
                                        <div class="p-6 rounded-2xl bg-white dark:bg-gray-800 shadow">
                                                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                                                        Tema do TCC
                                                </h2>

                                                <p class="text-sm text-gray-700 dark:text-gray-300">
                                                        {{ $tcc->nome_projeto ?? 'Tema ainda não definido pelo orientador.' }}
                                                </p>
                                        </div>
                                </div>
                        </div>
                @else
                        <div class="min-w-screen  rounded flex items-center justify-center p-6 ">
                                <x-data-card-sb title="Defesa mais próxima">

                                        <p>Nome do Projeto: {!!$tccs->first()->nome_projeto!!}</p>
                                        <p class="text-sm text-gray-400">
                                                Dia da defesa: <span
                                                        class="text-green-400 font-bold">{!!$dashboard->formatarData($tccs->first()->dia_defesa)!!}</span>
                                        </p>
                                </x-data-card-sb>
                        </div>
                        <div class=" dark:bg-gray-800 bg-white text-dark rounded my-2 shadow-md transition-all duration-300 ">
                                <h2 class="dark:text-white text-black p-5 font-bold">Informações sobre os TCC's</h2>
                                {{-- O de barra --}}
                                <div class="sm:grid sm:gap-2 sm:grid-cols-2 sm:justify-around p-2">
                                        <div class="p-5 sm:p-6 ">
                                                <div class="flex items-center justify-between mb-3">
                                                        <h3 class="text-sm font-semibold dark:text-white ">Quantidade de
                                                                TCC por
                                                                palavra-chave</h3>
                                                </div>
                                                <div class="w-auto h-full flex justify-center">
                                                        <canvas id="bar-chart" class="w-full "></canvas>
                                                </div>
                                        </div>

                                        {{-- O de pizza --}}
                                        <div class=" p-5 sm:p-6">
                                                <div class="flex items-center justify-between ">
                                                        <h3 class="text-sm font-semibold dark:text-white">Distribuição de
                                                                TCCs nos meses
                                                        </h3>
                                                </div>
                                                <div class="w-auto h-48 flex items-center justify-center p-5">
                                                        <canvas id="pie-chart" class="w-full"></canvas>
                                                </div>
                                        </div>
                                </div>
                        </div>
                @endif
        @endempty
        <div id="dashboard-data" data-palavra="@json($palavraChave ?? [])" data-meses="@json($qntdDeTccPorMes ?? [])"
                style="display:none;"></div>
</x-app-layout>
<script>
        window.dashboardData = {
                palavra: @json($palavraChave ?? []),
                meses: @json($qntdDeTccPorMes ?? [])
        };
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite('resources/js/wordCloud.js')