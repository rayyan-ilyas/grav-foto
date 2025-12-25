<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album | Gravity Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen antialiased">
    <div class="min-h-screen">
        @include('admin.partials.header')

        <div class="container mx-auto px-6 py-12 max-w-3xl">
        
        <div class="mb-10">
            <a href="{{ route('admin.albums.index') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Album
            </a>
        </div>

        <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-8 md:p-12 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            
            <div class="relative">
                <h1 class="text-3xl font-black tracking-tight text-gray-900 mb-2">Tambah <span class="text-indigo-600">Album Baru</span></h1>
                <p class="text-sm text-gray-400 font-medium mb-10">Buat koleksi portofolio baru untuk ditampilkan di galeri.</p>

                @if($errors->any())
                    <div class="flex items-start p-4 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                        <svg class="w-5 h-5 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm font-bold">
                            <p class="mb-1 uppercase tracking-wider text-[10px]">Periksa kembali input Anda:</p>
                            <ul class="list-disc list-inside font-medium opacity-80">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.albums.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    <div class="space-y-2">
                        <label for="title" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Koleksi / Album</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Contoh: The Wedding of John & Jane"
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="category" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori Karya</label>
                        <select name="category" id="category" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Pilih Kategori Album</option>
                            <option value="corporate" {{ old('category') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                            <option value="ultah" {{ old('category') == 'ultah' ? 'selected' : '' }}>Ulang Tahun</option>
                            <option value="dokumentasi" {{ old('category') == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                            <option value="lamaran" {{ old('category') == 'lamaran' ? 'selected' : '' }}>Lamaran</option>
                            <option value="martupol" {{ old('category') == 'martupol' ? 'selected' : '' }}>Martupol</option>
                            <option value="personal" {{ old('category') == 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="keluarga" {{ old('category') == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                            <option value="maternity" {{ old('category') == 'maternity' ? 'selected' : '' }}>Maternity</option>
                            <option value="prewedding" {{ old('category') == 'prewedding' ? 'selected' : '' }}>Pre-Wedding</option>
                        </select>
                    </div>

                    <div class="flex items-center p-5 bg-indigo-50 rounded-2xl border border-indigo-100">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_public" id="is_public" value="1" {{ old('is_public', true) ? 'checked' : '' }}
                                   class="w-5 h-5 text-indigo-600 border-gray-300 rounded-lg focus:ring-indigo-500 cursor-pointer transition-all">
                        </div>
                        <label for="is_public" class="ml-3 cursor-pointer">
                            <span class="block text-sm font-black text-indigo-900 uppercase tracking-tight leading-none">Publikasikan Album</span>
                            <span class="text-[11px] text-indigo-600 font-medium opacity-70">Album akan langsung terlihat di halaman Galeri Foto publik.</span>
                        </label>
                    </div>

                    <hr class="border-gray-50">

                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Foto Sampul (Cover)</label>
                        <div class="relative group flex items-center justify-center p-8 border-2 border-gray-100 border-dashed rounded-4xl bg-gray-50 hover:bg-white hover:border-indigo-300 transition-all duration-300">
                            <input type="file" name="cover_image" id="cover_image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center space-y-2">
                                <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center mx-auto shadow-sm text-gray-400 group-hover:text-indigo-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Pilih Gambar Utama</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Koleksi Gambar (Multiple)</label>
                        <div class="relative group flex flex-col items-center justify-center p-12 border-2 border-indigo-100 border-dashed rounded-[2.5rem] bg-indigo-50/30 hover:bg-white hover:border-indigo-400 transition-all duration-300">
                            <input type="file" name="photos[]" id="photos" accept="image/*" multiple class="absolute inset-0 opacity-0 cursor-pointer z-10">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center mx-auto shadow-md text-indigo-500 mb-4 group-hover:scale-110 transition-transform">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <p class="text-sm font-black text-gray-700 uppercase tracking-tight">Upload Karya Terbaik</p>
                                <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest">Anda dapat memilih banyak foto sekaligus</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <a href="{{ route('admin.albums.index') }}"
                           class="flex-1 px-8 py-4 border border-gray-100 text-gray-400 rounded-2xl hover:bg-gray-50 transition-all text-center font-bold text-sm active:scale-95">
                            Batal
                        </a>
                        <button type="submit"
                                class="flex-2 px-8 py-4 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-black text-sm shadow-xl shadow-indigo-100 active:scale-95 uppercase tracking-[0.2em]">
                            Simpan Koleksi
                        </button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</body>
</html>