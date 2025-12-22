<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
        }
        body {
            background: radial-gradient(circle at top right, #eef2ff, #f8fafc 40%, #f1f5f9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.01em;
        }
        /* Glow aesthetic yang lebih halus */
        .halo::before {
            content: "";
            position: absolute;
            top: -150px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.15), transparent 70%);
            filter: blur(60px);
            z-index: -1;
        }
        .halo::after {
            content: "";
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(199, 210, 254, 0.2), transparent 70%);
            filter: blur(60px);
            z-index: -1;
        }
    </style>
</head>

<body class="antialiased">

    <div class="relative halo w-full max-w-[440px] p-10 bg-white/60 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-white/60">

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

        <form method="POST" action="/login" class="space-y-6">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Email</label>
                <input id="email" name="email" type="email" required placeholder="Masukkan email disini..."
                       class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">
                
                @error('email')
                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <div class="flex justify-between items-center px-1">
                    <label for="password" class="block text-[11px] font-black text-gray-400 uppercase tracking-widest">Kata Sandi</label>
                    <a href="{{ url('/forgot-password') }}" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-800 transition">
                        Lupa?
                    </a>
                </div>
                <input id="password" name="password" type="password" required placeholder="••••••••"
                       class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-white/50 backdrop-blur-sm
                       shadow-sm focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 outline-none font-semibold text-gray-700 placeholder:text-gray-300">

                @error('password')
                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center px-1">
                <label class="flex items-center gap-3 cursor-pointer group">
                    <input id="remember-me" type="checkbox" name="remember"
                           class="w-5 h-5 border-gray-200 text-indigo-600 rounded-lg focus:ring-indigo-500 cursor-pointer">
                    <span class="text-xs font-bold text-gray-500 group-hover:text-gray-700 transition">Ingat Saya</span>
                </label>
            </div>

            <button type="submit"
                    class="w-full py-4 rounded-2xl bg-gray-900 text-white font-black text-sm uppercase tracking-widest
                    shadow-xl shadow-gray-200 hover:bg-black hover:shadow-2xl active:scale-[0.98] transition-all duration-300">
                Masuk Sekarang
            </button>
        </form>

        <div class="mt-10 text-center">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-tight">
                Belum punya akun? 
                <a href="{{ url('/register') }}" class="text-indigo-600 hover:text-indigo-800 ml-1">
                    Daftar Sekarang
                </a>
            </p>
        </div>
    </div>

</body>
</html>