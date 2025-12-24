<button {!!$attributes->merge(['class' => 'cursor-pointer rounded-t-md bg-purple shadow-[0px_4px_32px_0_rgba(99,102,241,.70)] p-3 border-[1px] border-slate-500 text-white font-medium group '])!!}>
    <div class="relative overflow-hidden">
        <p class="group-hover:-translate-y-7 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">
            {{$slot}}
        </p>
        <p class="absolute top-7 left-0 group-hover:top-0 duration-[1.125s] ease-[cubic-bezier(0.19,1,0.22,1)]">
            {{$slot}}
        </p>
    </div>
</button>