<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Foto | Gravity Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        /* Animasi sederhana untuk sub-kategori */
        .animate-fade-in-down {
            animation: fadeInDown 0.3s ease-out;
        }
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen antialiased">
    <div class="min-h-screen">
        @include('admin.partials.header')

        <div class="container mx-auto px-6 py-12 max-w-3xl">
        
        <div class="mb-10">
            <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Paket
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            
            <div class="relative">
                <h1 class="text-3xl font-black tracking-tight text-gray-900 mb-2">Tambah <span class="text-indigo-600">Paket Baru</span></h1>
                <p class="text-sm text-gray-400 font-medium mb-10">Definisikan layanan fotografi baru untuk pelanggan Anda.</p>

                @if($errors->any())
                    <div class="flex items-start p-4 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                        <svg class="w-5 h-5 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm font-bold">
                            <p class="mb-1 uppercase tracking-wider text-[10px]">Mohon periksa kembali:</p>
                            <ul class="list-disc list-inside font-medium opacity-80">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.packages.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label for="name" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Layanan Paket</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Contoh: Portrait Essential"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="description" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi & Detail</label>
                        <textarea name="description" id="description" rows="3" placeholder="Jelaskan apa saja yang didapat dalam paket ini..."
                                  class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label for="price_display" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Harga (IDR)</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">Rp</span>
                                <input type="text" id="price_display" value="{{ old('price') }}" required placeholder="0"
                                       class="w-full pl-12 pr-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                <input type="hidden" name="price" id="price" value="{{ old('price') }}">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="duration_minutes" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Durasi Sesi</label>
                            <div class="relative">
                                <input type="number" name="duration_minutes" id="duration_minutes" value="{{ old('duration_minutes', 60) }}" required min="1"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400 uppercase">Menit</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-4">
                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Sesi</label>
                            <div class="flex items-center gap-4 bg-gray-50 p-2 rounded-2xl border border-gray-100 w-fit">
                                <label class="flex items-center gap-2 px-4 py-2 rounded-xl cursor-pointer has-checked:bg-white has-checked:text-indigo-600 has-checked:shadow-sm transition-all text-gray-400 font-bold text-xs">
                                    <input type="radio" name="location" value="indoor" {{ old('location', 'indoor') == 'indoor' ? 'checked' : '' }} class="hidden" />
                                    ● Indoor
                                </label>
                                <label class="flex items-center gap-2 px-4 py-2 rounded-xl cursor-pointer has-checked:bg-white has-checked:text-indigo-600 has-checked:shadow-sm transition-all text-gray-400 font-bold text-xs">
                                    <input type="radio" name="location" value="outdoor" {{ old('location') == 'outdoor' ? 'checked' : '' }} class="hidden" />
                                    ● Outdoor
                                </label>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status Ketersediaan</label>
                            <div class="flex items-center p-3 bg-indigo-50 rounded-2xl border border-indigo-100">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                           class="w-5 h-5 text-indigo-600 border-gray-300 rounded-lg focus:ring-indigo-500 cursor-pointer">
                                </div>
                                <label for="is_active" class="ml-3 cursor-pointer text-sm font-black text-indigo-900 uppercase tracking-tight">Aktifkan Paket</label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="category" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori Utama</label>
                        <div class="relative">
                            <select name="category" id="category" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                <option value="">— Pilih Kategori —</option>
                                <option value="corporate" {{ old('category') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                <option value="ultah" {{ old('category') == 'ultah' ? 'selected' : '' }}>Ulang Tahun</option>
                                <option value="dokumentasi" {{ old('category') == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                                <option value="lamaran" {{ old('category') == 'lamaran' ? 'selected' : '' }}>Lamaran</option>
                                <option value="martupol" {{ old('category') == 'martupol' ? 'selected' : '' }}>Martupol</option>
                                <option value="personal" {{ old('category') == 'personal' ? 'selected' : '' }}>Personal</option>
                                <option value="keluarga" {{ old('category') == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                                <option value="maternity" {{ old('category') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                                <option value="wedding" {{ old('category') == 'wedding' ? 'selected' : '' }}>Wedding</option>
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div id="wedding_subcategory_field" class="hidden animate-fade-in-down">
                        <div class="space-y-2">
                            <label for="subcategory" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Sub-Kategori Wedding</label>
                            <div class="relative">
                                <select name="subcategory" id="subcategory"
                                        class="w-full px-5 py-4 bg-gray-50 border border-indigo-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                    <option value="">— Pilih Sub-Kategori —</option>
                                    <option value="prewedding" {{ old('subcategory') == 'prewedding' ? 'selected' : '' }}>Pre-Wedding</option>
                                    <option value="akad" {{ old('subcategory') == 'akad' ? 'selected' : '' }}>Akad Nikah</option>
                                    <option value="resepsi" {{ old('subcategory') == 'resepsi' ? 'selected' : '' }}>Resepsi</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-indigo-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('admin.packages.index') }}" 
                           class="flex-1 px-8 py-4 border border-gray-100 text-gray-400 rounded-2xl hover:bg-gray-50 transition-all text-center font-bold text-sm active:scale-95">
                            Batal
                        </a>
                        <button type="submit" 
                                class="flex-2 px-8 py-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-black text-sm shadow-xl shadow-indigo-100 active:scale-95 uppercase tracking-widest">
                            Simpan Paket Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. LOGIKA KATEGORI & SUBKATEGORI
            const categorySelect = document.getElementById('category');
            const subcategoryField = document.getElementById('wedding_subcategory_field');
            const subcategorySelect = document.getElementById('subcategory');

            function toggleSubcategoryField() {
                if (categorySelect.value === 'wedding') {
                    subcategoryField.classList.remove('hidden');
                    subcategorySelect.required = true;
                } else {
                    subcategoryField.classList.add('hidden');
                    subcategorySelect.required = false;
                    subcategorySelect.value = '';
                }
            }

            categorySelect.addEventListener('change', toggleSubcategoryField);
            toggleSubcategoryField();

            // 2. LOGIKA FORMAT RUPIAH & BATAS 8 DIGIT
            const priceDisplay = document.getElementById('price_display');
            const priceReal = document.getElementById('price');

            priceDisplay.addEventListener('input', function(e) {
                // Ambil hanya angka
                let rawValue = this.value.replace(/[^0-9]/g, '');

                // Batasi maksimal 8 digit angka
                if (rawValue.length > 8) {
                    rawValue = rawValue.substring(0, 8);
                }

                // Update input hidden untuk backend
                priceReal.value = rawValue;

                // Format tampilan dengan titik setiap 3 digit
                if (rawValue !== "") {
                    this.value = formatRupiah(rawValue);
                } else {
                    this.value = "";
                }
            });

            function formatRupiah(angka) {
                return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Inisialisasi format jika ada data lama (misal saat validasi error)
            if (priceDisplay.value) {
                let initial = priceDisplay.value.replace(/[^0-9]/g, '');
                priceDisplay.value = formatRupiah(initial);
                priceReal.value = initial;
            }
        });
    </script>
    </div>
</body>
</html>