@props(['title'])

<div {{ $attributes->merge(['class' => "rounded-lg border shadow-md transition-all duration-300 bg-white border-gray-200 text-gray-800 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 flex cartas hidden"]) }}>
    <div>
        @if($title)
            <div
                class="px-6 py-4 font-semibold text-lg border-gray-200 dark:border-gray-700 text-indigo-600 dark:text-indigo-300">
                {{ $title }}
            </div>
        @endif

        <div class="p-6 text-gray-600 dark:text-gray-300">
            {{ $slot }}
        </div>
    </div>
    <div class="flex p-3 justify-center items-center"><i class="fas  fa-calendar fa-2xl text-gray-100 dark:text-indigo-400 text-lg ml-2"></i></div>

</div>