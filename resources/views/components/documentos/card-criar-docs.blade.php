@props(['tcc', 'route'])

<a href="{!! $route !!}" {!!$attributes->merge()!!}>
    <div class="flex flex-col items-center justify-center rounded m-4 p-4 flex flex-col">
        {{$slot}}
    </div>

</a>