<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gravity Studio – Reservasi Online</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="flex items-center justify-between px-8 py-4 bg-white shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900">Gravity<span class="text-indigo-500">Photography</span></h1>
        <nav class="space-x-6 hidden md:block">
            <a href="#layanan" class="hover:text-indigo-600">Layanan</a>
            <a href="{{ route('galeri') }}" class="hover:text-indigo-600">Galeri</a>
            <a href="#kontak" class="hover:text-indigo-600">Kontak</a>
        </nav>
        <a href="/reservasi" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            Reservasi
        </a>
    </header>

    <!-- HERO SECTION -->
    <section class="px-8 py-20 text-center">
        <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">
            Abadikan Momen Terbaikmu
        </h2>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto mb-8">
            Studio foto profesional dengan layanan premium. Pilih jadwal, booking online, dan nikmati pengalaman pemotretan terbaik.
        </p>

        <a href="/reservasi"
           class="px-8 py-3 bg-indigo-600 text-white rounded-xl text-lg font-medium shadow hover:bg-indigo-700 transition">
           Mulai Reservasi
        </a>
    </section>

    <!-- FITUR -->
    <section id="layanan" class="px-8 py-16 bg-white">
        <h3 class="text-3xl font-bold text-center mb-10">Layanan Kami</h3>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <div class="p-6 bg-gray-100 rounded-xl shadow hover:shadow-md transition">
                <h4 class="text-xl font-semibold mb-2">Prewedding</h4>
                <p class="text-gray-600">Konsep elegan dengan lighting profesional.</p>
            </div>

            <div class="p-6 bg-gray-100 rounded-xl shadow hover:shadow-md transition">
                <h4 class="text-xl font-semibold mb-2">Family Portrait</h4>
                <p class="text-gray-600">Abadikan kehangatan keluarga dengan foto berkualitas.</p>
            </div>

            <div class="p-6 bg-gray-100 rounded-xl shadow hover:shadow-md transition">
                <h4 class="text-xl font-semibold mb-2">Graduation</h4>
                <p class="text-gray-600">Momen kelulusanmu jadi lebih berkesan.</p>
            </div>

        </div>
    </section>

    <!-- GALERI -->
    <section id="galeri" class="px-8 py-16">
        <h3 class="text-3xl font-bold text-center mb-10">Galeri</h3>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto">
            <div class="bg-gray-300 h-40 rounded-xl"></div>
            <div class="bg-gray-300 h-40 rounded-xl"></div>
            <div class="bg-gray-300 h-40 rounded-xl"></div>
            <div class="bg-gray-300 h-40 rounded-xl"></div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="kontak" class="py-10 bg-gray-900 text-gray-300 text-center">
        <p>© {{ date('Y') }} StudioFoto. Semua hak dilindungi.</p>
    </footer>

</body>
</html>
