@props(['action'])

<form action="{{$action}}" method="GET" class="d-flex justify-end gap-2 rounded ">

    <label for="search " class="m-0 flex bg-white dark:bg-gray-800 rounded p-1 shadow-md">
        <button type="submit" class="p-2 flex items-center rounded text-white ">
            <i class="fa-solid fa-magnifying-glass dark:text-white text-indigo-500"></i>
        </button>
        <input class="p-2 bg-transparent rounded border-0 " type="text" name="search" placeholder="Pesquisar"></input>
    </label>
</form>