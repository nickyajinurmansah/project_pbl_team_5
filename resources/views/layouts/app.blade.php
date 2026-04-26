<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PantiCare') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#C6DBA6] flex h-screen overflow-hidden">

    @include('layouts.navigation')

    <div class="flex-1 flex flex-col ml-64 h-screen">
        
        <!-- HEADER -->
        <header class="flex justify-between items-center px-10 py-6 bg-[#C6DBA6]">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-white/40 rounded-xl">
                    <!-- icon -->
                </div>

                <h1 class="text-3xl font-bold text-green-900">
                    {{ $header ?? 'Dashboard' }}
                </h1>
            </div>

            <div class="flex items-center gap-6">

                <!-- notif -->
                <button class="relative p-2 bg-white rounded-full shadow-sm">
                    🔔
                </button>

                <!-- user -->
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                    <div>
                        <span class="font-bold text-green-900">Abimanyu</span>
                        <span class="text-sm text-green-700 block">Admin</span>
                    </div>
                </div>

                <!-- logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">Logout</button>
                </form>

            </div>
        </header>

        <!-- CONTENT -->
        <main class="flex-1 overflow-y-auto px-10 pb-10">
            @yield('content')
        </main>

    </div>

</body>
</html>