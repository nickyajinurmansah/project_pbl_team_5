<aside class="w-64 bg-[#B9D582] flex flex-col h-screen shadow-lg rounded-r-3xl fixed">

    <!-- LOGO -->
    <div class="flex items-center gap-3 px-8 mt-10 mb-12">
        <div class="w-8 h-8 bg-white/50 rounded-full"></div>
        <h2 class="text-white text-2xl font-bold">PantiCare</h2>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 space-y-2">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-2xl font-semibold
           {{ request()->routeIs('dashboard') ? 'bg-white text-[#A3C673]' : 'text-white hover:bg-white/20' }}">
            Dashboard
        </a>

        <!-- Manajemen Akun -->
        <a href="#"
           class="flex items-center gap-4 px-4 py-3 text-white hover:bg-white/20 rounded-2xl">
            Menejemen akun
        </a>

        <!-- Donatur -->
        <a href="#"
           class="flex items-center gap-4 px-4 py-3 text-white hover:bg-white/20 rounded-2xl">
            Data donatur
        </a>

        <!-- Donasi -->
        <a href="#"
           class="flex items-center gap-4 px-4 py-3 text-white hover:bg-white/20 rounded-2xl">
            Data donasi
        </a>

        <!-- Anak -->
        <a href="{{ route('data-anak.index') }}"
           class="flex items-center gap-4 px-4 py-3 text-white hover:bg-white/20 rounded-2xl">
            Data anak
        </a>

        <!-- Pengurus (INI YANG PENTING) -->
        <a href="{{ route('pengurus.index') }}"
           class="flex items-center gap-4 px-4 py-3 rounded-2xl font-semibold
           {{ request()->routeIs('pengurus.*') ? 'bg-white text-[#A3C673]' : 'text-white hover:bg-white/20' }}">
            Data pengurus
        </a>

    </nav>

    <!-- LOGOUT -->
    <!-- <div class="p-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full bg-red-500 text-white py-2 rounded-xl">
                Logout
            </button>
        </form>
    </div> -->

</aside>