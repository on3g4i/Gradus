@php
    $sideBar = Route::currentRouteName() != 'profile.show';

@endphp
@props(['title' => 'Painel de Controle'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!--Font awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans antialiased dark:bg-gray-900">
    @livewire('navigation-menu')
    <div class="min-h-screen bg-gray-200 dark:bg-gray-900">
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 sm:py-3 lg:py-2">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!-- Page Content -->
        <div id="wrapper">
            @if ($sideBar)
                <x-side_bar_sb />
            @endif
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column mt-5">
                <main id="content" {!! $attributes->merge(['class' => 'bg-gray-200 dark:bg-gray-900']) !!}>
                    <div class="container-fluid">

                        @if (isset($title) && $sideBar)
                            <h1 id="titulo" {{$attributes->class(['h3', 'mb-0', 'dark:text-white text-black'])}}> {{ $title }}</h1>
                        @endif
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>
    @if ($sideBar)
        <!-- Footer -->
        <x-footer_sb />
        <!-- End of Footer -->
    @endif
    @stack('modals')
    @livewireScripts
    @vite(['resources/js/app.js'])
</body>

</html>