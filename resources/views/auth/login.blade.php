<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PantiCare</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-primary-dark { background-color: #2E7D32; }
        .text-primary { color: #2E7D32; }
        .input-field {
            background-color: #E0E0E0;
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            width: 100%;
            outline: none;
            text-align: center; /* Input juga tengah */
        }
        .input-field:focus {
            background-color: #D5D5D5;
            box-shadow: 0 0 0 2px #2E7D32;
        }
        .btn-login {
            background-color: transparent;
            border: 2px solid white;
            color: white;
            padding: 10px 40px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: white;
            color: #2E7D32;
        }
        .dot-decoration {
            width: 40px;
            height: 40px;
            background-color: #D5D5D5;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <!-- Container Utama Card -->
    <div class="flex w-full max-w-4xl bg-white rounded-2xl shadow-xl overflow-hidden min-h-[550px]">
        
        <!-- BAGIAN KIRI: Form Login -->
        <!-- PERUBAHAN: flex-col items-center text-center -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center items-center text-center">
            
            <!-- Judul: Log in to PantiCare -->
            <h1 class="text-3xl font-bold text-primary mb-2">Log in to<br>PantiCare</h1>
            
            <!-- Dekorasi 3 titik (Tengah) -->
            <div class="flex gap-3 justify-center mb-6">
                <span class="dot-decoration"></span>
                <span class="dot-decoration"></span>
                <span class="dot-decoration"></span>
            </div>

            <!-- Pesan Input -->
            <p class="text-gray-600 text-sm mb-6 font-medium">masukan username dan password anda!</p>

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-4 w-full max-w-xs">
                @csrf
                
                {{-- Pesan Error --}}
                @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded text-sm text-left">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Input Username -->
                <div>
                    <input type="text" name="username" value="{{ old('username') }}" 
                           class="input-field" placeholder="username" required>
                </div>

                <!-- Input Password -->
                <div>
                    <input type="password" name="password" 
                           class="input-field" placeholder="password" required>
                </div>

                <!-- Lupa Password (Tengah) -->
                <div class="text-center mt-4">
                    <a href="#" class="text-xs text-gray-500 hover:text-primary underline">lupa password?</a>
                </div>
            </form>
        </div>

        <!-- BAGIAN KANAN: Ilustrasi (Tidak berubah) -->
        <div class="hidden md:flex md:w-1/2 bg-primary-dark text-white flex-col items-center justify-center p-10 relative">
            
            <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
            <p class="text-sm text-center mb-8 opacity-90 max-w-[250px]">
                Untuk melanjutkan silahkan masuk menggunakan identitas anda
            </p>

            <!-- GAMBAR BARU -->
            <div class="flex flex-col items-center justify-center gap-4 mb-8">
                <img src="{{ asset('images/kids-welcome.png') }}" alt="Anak Panti" class="h-48 md:h-64 w-auto object-contain">
            </div>
            
            <button type="submit" form="loginForm" class="btn-login">
                Log In
            </button>
        </div>

    </div>

    {{-- Form tersembunyi untuk tombol kanan --}}
    <form id="loginForm" method="POST" action="{{ route('login') }}" class="hidden">
        @csrf
        <input type="hidden" name="username" id="hiddenUsername">
        <input type="hidden" name="password" id="hiddenPassword">
    </form>

    <script>
        document.querySelector('input[name="username"]').addEventListener('input', function() {
            document.getElementById('hiddenUsername').value = this.value;
        });
        document.querySelector('input[name="password"]').addEventListener('input', function() {
            document.getElementById('hiddenPassword').value = this.value;
        });
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') document.getElementById('loginForm').submit();
        });
    </script>

</body>
</html>