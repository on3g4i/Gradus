@props(['tcc', 'delete', 'edit', 'show'])

<div {{$attributes->class([ "flex", "flex-col", "cartas", "hidden",])}} >
    <div class=" justify-end gap-3 hidden sm:flex">

        @if (!Auth::user()->isAluno())
            <div class="self-end">
                @if (isset($delete))
                    <form action="{{$delete}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-botoes-card type="submit" class="botao">
                            <i class="fa-solid fa-eraser"></i>
                            Deletar
                        </x-botoes-card>
                    </form>
                @endif

            </div>
            <div class="self-end">
                @isset($edit)
                    <x-link-card href="{{$edit}}" class="botao">
                        <i class="fa fa-pencil " aria-hidden="true"></i>
                        Editar
                    </x-link-card>
                @endisset

            </div>
        @endif
        @isset($show)
            <div class="self-end ">

                <x-link-card href="{{$show}}" class="botao">
                    <i class="fa fa-eye " aria-hidden="true"></i>
                    Vizualizar
                </x-link-card>


            </div>
        @endisset
    </div>
    <div
        class="rounded-bl-lg dark:bg-gray-800 bg-white dark:text-white text-black py-2 transition duration-300 shadow-lg">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                {{$slot}}
            </div>
        </div>
        <div class="gap-1  flex sm:hidden justify-end">

            @if (!Auth::user()->isAluno())

                @if (isset($delete))
                    <form action="{{$delete}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="font-semibold text-xs text-red-500 p-3 block size-fit" type="submit">
                            <i class="fa-solid fa-eraser"></i>
                            Deletar
                        </button>
                    </form>
                @endif

                <div class="self-end">
                    @if (isset($edit))
                        <a class=" text-xs text-green-500 p-3 block size-fit" href="{{$edit}}">
                            <i class="fa fa-pencil " aria-hidden="true"></i>
                            Editar
                        </a>
                    @endif

                </div>

            @endif
            <div class="self-end">
                @if (isset($show))
                    <a class="text-xs text-blue-500 p-3  block size-fit" href="{{$show}}">
                        <i class="fa fa-eye " aria-hidden="true"></i>
                        Vizualizar
                    </a>
                @endif

            </div>
        </div>
    </div>

</div>