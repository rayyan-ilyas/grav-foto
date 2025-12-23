<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Paket Foto - Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
    </style>
</head>
<body class="bg-gray-50 text-[#1F2937]">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.packages.index') }}" class="text-indigo-600 hover:text-indigo-700 font-bold flex items-center gap-2 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">Edit Paket Foto</h1>
                    <p class="text-sm text-gray-400">Sesuaikan detail harga dan informasi paket</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-100 text-red-700 px-4 py-3 rounded-xl mb-6 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.packages.update', $package) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Paket</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}" required
                               class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none">{{ old('description', $package->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="price_display" class="block text-sm font-bold text-gray-700 mb-2">Harga Paket</label>
                            <div class="relative flex items-center">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-gray-400 font-bold text-sm">Rp</span>
                                </div>
                                <input type="text" id="price_display" 
                                       class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none font-bold text-gray-900"
                                       placeholder="0">
                                
                                <input type="hidden" name="price" id="price_hidden" value="{{ old('price', $package->price) }}">
                            </div>
                            <p class="mt-2 text-[10px] text-gray-400 font-medium italic">* Maksimal 8 digit angka</p>
                        </div>

                        <div>
                            <label for="duration_minutes" class="block text-sm font-bold text-gray-700 mb-2">Durasi (menit)</label>
                            <div class="relative">
                                <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', $package->duration_minutes) }}" required
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all outline-none">
                                <span class="absolute right-4 top-3.5 text-xs text-gray-400 font-bold">MIN</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center p-4 bg-indigo-50/50 rounded-xl border border-indigo-100/50">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 cursor-pointer">
                        <label for="is_active" class="ml-3 text-sm font-bold text-gray-700 cursor-pointer">Paket Aktif & Tampilkan di Katalog</label>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <a href="{{ route('admin.packages.index') }}" 
                           class="flex-1 px-6 py-4 border border-gray-200 text-gray-500 rounded-xl hover:bg-gray-100 transition text-center font-bold">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-1 px-6 py-4 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition font-bold shadow-lg shadow-indigo-200/50">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    const priceDisplay = document.getElementById('price_display');
    const priceHidden = document.getElementById('price_hidden');

    function formatRupiah(angka) {
        // 1. Pastikan input adalah string dan ambil hanya angka saja
        let stringAngka = angka.toString().replace(/[^0-9]/g, '');
        
        // 2. Limit 8 digit
        if (stringAngka.length > 8) {
            stringAngka = stringAngka.substring(0, 8);
        }
        
        // Jika kosong, kembalikan string kosong
        if (stringAngka === '') return '';

        // 3. Logika pemisah ribuan
        let number_string = stringAngka,
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

    // Handle pengetikan
    priceDisplay.addEventListener('input', function() {
        // Ambil nilai asli (tanpa titik)
        const rawValue = this.value.replace(/[^0-9]/g, '');
        
        // Set ke tampilan (dengan titik)
        this.value = formatRupiah(rawValue);
        
        // Set ke hidden input untuk database (hanya angka)
        priceHidden.value = rawValue.substring(0, 8);
    });

    // Inisialisasi saat load
    window.addEventListener('DOMContentLoaded', () => {
        if (priceHidden.value) {
            // Hilangkan desimal .00 jika ada (dari format database decimal)
            let cleanValue = priceHidden.value.split('.')[0]; 
            // Bersihkan dari karakter non-angka
            cleanValue = cleanValue.replace(/[^0-9]/g, '');
            
            priceDisplay.value = formatRupiah(cleanValue);
            priceHidden.value = cleanValue; // Update kembali hidden value agar bersih
        }
    });
</script>
</body>
</html>