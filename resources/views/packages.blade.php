<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Foto - Gravity Photography</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

@include('partials.header')

<section class="pt-32 pb-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight" style="font-family: 'Rock Salt', cursive;">Paket Foto Kami</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Berbagai paket foto yang disesuaikan dengan kebutuhan Anda. Pilih paket yang sesuai untuk mendapatkan pengalaman fotografi terbaik.</p>
        </div>

        @if($packages->isEmpty())
            <div class="text-center py-20">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Belum ada paket tersedia</h3>
                <p class="text-gray-500 mt-1">Mohon kembali lagi nanti untuk melihat paket foto terbaru kami.</p>
            </div>
        @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden group">
                        <div class="p-8">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                                <span class="inline-block px-3 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                                    @switch($package->category)
                                        @case('corporate')
                                            Corporate
                                            @break
                                        @case('ultah')
                                            Ulang Tahun
                                            @break
                                        @case('dokumentasi')
                                            Dokumentasi
                                            @break
                                        @case('lamaran')
                                            Lamaran
                                            @break
                                        @case('martupol')
                                            Martupol
                                            @break
                                        @case('personal')
                                            Personal
                                            @break
                                        @case('keluarga')
                                            Keluarga
                                            @break
                                        @case('maternity')
                                            Maternity
                                            @break
                                        @case('prewedding')
                                            Pre-Wedding
                                            @break
                                        @default
                                            {{ $package->category ?? 'General' }}
                                    @endswitch
                                </span>
                            </div>

                            <h3 class="text-2xl font-bold mb-3">{{ $package->name }}</h3>
                            <p class="text-gray-600 mb-6 leading-relaxed">{!! nl2br(e($package->description)) !!}</p>

                            <div class="space-y-4 mb-6">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Durasi: {{ $package->duration_minutes }} menit
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Lokasi: @if($package->location == 'indoor') Indoor @else Outdoor @endif
                                </div>
                            </div>

                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <div>
                                    <p class="text-2xl font-extrabold text-indigo-600">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                                </div>
                                <button onclick="handleReservation({{ $package->id }})"
                                        class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200 active:scale-95">
                                    Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-12">
    <div class="bg-indigo-600 rounded-[40px] p-12 text-center text-white relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-4xl font-extrabold mb-4">Siap Memulai Sesi Foto?</h2>
            <p class="opacity-80 mb-8 max-w-xl mx-auto">Reservasi sekarang dan dapatkan diskon 20% untuk pemesanan pertama Anda melalui website.</p>
            <div class="flex justify-center gap-4">
                <button onclick="handleReservation()" class="bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold hover:bg-gray-100 transition">Reservasi Sekarang</button>
                <button class="bg-indigo-500 text-white px-8 py-4 rounded-2xl font-bold border border-white/20 hover:bg-indigo-400 transition">Hubungi Kami</button>
            </div>
        </div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full"></div>
    </div>
</section>

<script>
    function handleReservation(packageId = null) {
        // Show loading state
        const button = event.target.closest('button');
        if (button) {
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Memproses...
            `;
        }
        
        const url = packageId
            ? '{{ route("reservations.create") }}?photo_package_id=' + packageId
            : '{{ route("reservations.create") }}';

        // Add small delay for better UX
        setTimeout(() => {
            window.location.href = url;
        }, 300);
    }
</script>

</body>
</html>