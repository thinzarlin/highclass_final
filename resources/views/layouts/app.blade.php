<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdn.datatables.net/2.2.2/css/dataTables.tailwindcss.css" rel="stylesheet" /> --}}
    <link href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 
    {{-- dark:bg-gray-900  --}}
    md:pl-64">
        {{-- @include('layouts.navigation') --}}

        <header class="flex items-center h-20 md:h-auto" x-data="{ open: false }">
            <nav class="relative flex items-center w-full px-4">
                <!-- Mobile Header -->
                <div class="inline-flex items-center justify-center w-full md:hidden">
                    <a href="#" @click="open = true" @click.away="open = false" class="absolute left-0 pl-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 stroke-blue-600" fill="currentColor"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </a>
                    <a href="#">
                        <h2 class="text-2xl font-extrabold text-blue-600">{{ config('app.name', 'Laravel') }}</h2>
                    </a>
                </div>
                @include('layouts.sidebar')
            </nav>
        </header>
        <div class="p-4 sm:ml-0">
            <div class="ml-2">
                @yield('content')

            </div>
        </div>

        {{-- <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="container min-h-[200px] pt-8 w-full px-4 mx-auto">
            {{ $slot }}
        </main> --}}
    </div>
    {{-- @isset($js)
        {{ $js }}
    @endisset --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js"
        integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    {{-- <script src="https://cdn.datatables.net/2.2.2/js/dataTables.tailwindcss.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('scripts')


</body>

</html>
