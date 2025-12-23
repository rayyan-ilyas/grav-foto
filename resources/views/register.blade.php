<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* Memastikan html dan body mengambil 100% tinggi layar */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        
        body {
            background: radial-gradient(circle at top right, #eef2ff, #f8fafc 40%, #f1f5f9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
            overflow-x: hidden;
        }

        /* Perbaikan Glow: Menggunakan absolute terhadap body agar tidak menggeser card */
        .halo-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
        }

        .halo-bg::before {
            content: "";
            position: absolute;
            top: 5%;
            right: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent 70%);
            filter: blur(80px);
        }

        .halo-bg::after {
            content: "";
            position: absolute;
            bottom: 5%;
            left: 5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(199, 210, 254, 0.15), transparent 70%);
            filter: blur(80px);
        }
    </style>
</head>

<body class="antialiased p-6">

    <div class="halo-bg"></div>

    <div class="relative z-10 w-full max-w-[480px] p-10 bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-white/60">

         <div class="flex flex-col items-center mb-10">
            <a href="{{ url('/') }}" class="flex flex-col items-center gap-1 group">
                <div class="w-24 h-24 flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="max-w-full max-h-full object-contain">
                </div>

                <div class="text-center">
                    <h1 class="text-2xl font-black text-gray-900 tracking-tighter">
                        Gravity <span class="text-indigo-600">Photography</span>
                    </h1>
                    <p class="mt-2 text-gray-400 text-xs font-bold uppercase tracking-[0.2em]">Sistem Reservasi</p>
                </div>
            </a>
        </div>
        <form method="POST" action="{{ route('register.store') }}" class="space-y-5">
            @csrf

            <div class="space-y-2">
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <input type="text" name="name" required placeholder="Nama lengkap Anda"
                       class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">
            </div>

            <div class="space-y-2">
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nomor WhatsApp</label>
                <input type="text" name="phone" required placeholder="0812xxxx"
                       class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">
            </div>

            <div class="space-y-2">
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                <input type="email" name="email" required placeholder="Masukkan email disini..."
                       class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">
            </div>

            <div class="space-y-2">
                <label class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kata Sandi</label>
                <input type="password" name="password" required placeholder="Minimal 8 karakter"
                       class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full py-4 rounded-2xl bg-gray-900 text-white font-black text-sm uppercase tracking-widest
                        shadow-xl shadow-gray-200 hover:bg-black hover:shadow-2xl active:scale-[0.98] transition-all duration-300">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="mt-10 text-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-tight">
                Sudah punya akun? 
                <a href="{{ url('/login') }}" class="text-indigo-600 hover:text-indigo-800 ml-1 transition-colors">
                    Masuk Di Sini
                </a>
            </p>
        </div>
    </div>

</body>
</html>