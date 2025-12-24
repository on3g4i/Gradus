@props(['action', 'mensagem' => 'Criar'])

<div class="p-10  gap-3 ">
    <div class="flex justify-center">
        <form method="POST" action="{!!$action !!}" {!! $attributes->merge(['class' => 'p-5 dark:bg-gray-800 bg-white shadow-md rounded mt-10 w-screen flex flex-col gap-5']) !!}>
            <x-validation-errors class="mb-4" />
            @csrf
            {{$slot}}

            @isset($button)
                {{$button}}
            @else
                <div class="flex items-center justify-end mt-4 ">
                    <x-button class="ms-4">
                        {{$mensagem }}
                    </x-button>
                </div>
            @endisset


        </form>
    </div>
</div>