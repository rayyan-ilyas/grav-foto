<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Album | Gravity Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen antialiased">
    <div class="min-h-screen">
        @include('admin.partials.header')

        <div class="container mx-auto px-6 py-12 max-w-4xl">
        
        <div class="mb-10 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-black tracking-tight text-gray-900">Edit <span class="text-indigo-600">Album</span></h1>
                <p class="text-sm text-gray-500 mt-2 font-medium">Modifikasi detail karya dan koleksi foto portofolio.</p>
            </div>
            <a href="{{ route('admin.albums.index') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                ← Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="flex items-start p-4 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-2xl">
                <svg class="w-5 h-5 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div class="text-sm font-bold">
                    <p class="mb-1 uppercase tracking-wider text-[10px]">Terdapat Kesalahan:</p>
                    <ul class="list-disc list-inside font-medium opacity-80">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-12 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-full h-2 bg-indigo-600"></div>

            <form action="{{ route('admin.albums.update', $album) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label for="title" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Judul Album</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $album->title) }}" required
                               class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 shadow-sm placeholder:text-gray-300">
                    </div>

                    <div class="space-y-2">
                        <label for="category" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                        <select id="category" name="category" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 shadow-sm appearance-none">
                            <option value="">Pilih Kategori Album</option>
                            <option value="corporate" {{ old('category', $album->category) == 'corporate' ? 'selected' : '' }}>Corporate</option>
                            <option value="ultah" {{ old('category', $album->category) == 'ultah' ? 'selected' : '' }}>Ulang Tahun</option>
                            <option value="dokumentasi" {{ old('category', $album->category) == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                            <option value="lamaran" {{ old('category', $album->category) == 'lamaran' ? 'selected' : '' }}>Lamaran</option>
                            <option value="martupol" {{ old('category', $album->category) == 'martupol' ? 'selected' : '' }}>Martupol</option>
                            <option value="personal" {{ old('category', $album->category) == 'personal' ? 'selected' : '' }}>Personal</option>
                            <option value="keluarga" {{ old('category', $album->category) == 'keluarga' ? 'selected' : '' }}>Keluarga</option>
                            <option value="maternity" {{ old('category', $album->category) == 'maternity' ? 'selected' : '' }}>Maternity</option>
                            <option value="prewedding" {{ old('category', $album->category) == 'prewedding' ? 'selected' : '' }}>Pre-Wedding</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label for="description" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Deskripsi Karya</label>
                    <textarea id="description" name="description" rows="4"
                              class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 shadow-sm resize-none placeholder:text-gray-300">{{ old('description', $album->description) }}</textarea>
                </div>

                <!-- Cover Image Section -->
                <div class="space-y-4">
                    <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Cover Album</label>

                    <!-- Current Cover Preview -->
                    @if($album->cover_image)
                        <div class="flex items-center gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                            <div class="w-24 h-24 rounded-xl overflow-hidden border-2 border-white shadow-lg">
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="Current Cover"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-gray-700 mb-1">Cover Saat Ini</p>
                                <p class="text-xs text-gray-500">Ganti cover dengan upload gambar baru di bawah ini.</p>
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Cover -->
                    <div class="group relative flex flex-col items-center justify-center p-8 border-2 border-gray-200 border-dashed rounded-2xl bg-gray-50 transition-all hover:bg-indigo-50/50 hover:border-indigo-300">
                        <input id="cover_image" name="cover_image" type="file" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-sm mb-3 transition-transform group-hover:scale-110">
                            <svg class="h-6 w-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700">Upload Cover Baru</p>
                        <p class="text-[10px] text-gray-400 mt-1 font-black uppercase tracking-widest">PNG, JPG up to 4MB</p>
                    </div>
                    <div id="cover-preview" class="hidden mt-4">
                        <img id="cover-img" src="" alt="Cover Preview" class="w-32 h-32 object-cover rounded-xl border-2 border-gray-200">
                    </div>
                </div>

                <div class="flex items-center p-4 bg-indigo-50 rounded-2xl border border-indigo-100">
                    <div class="flex items-center h-5">
                        <input type="checkbox" id="is_public" name="is_public" value="1" {{ old('is_public', $album->is_public) ? 'checked' : '' }}
                               class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded-lg cursor-pointer">
                    </div>
                    <label for="is_public" class="ml-3 cursor-pointer">
                        <span class="block text-sm font-black text-indigo-900 uppercase tracking-tight">Publikasikan Album</span>
                        <span class="text-xs text-indigo-600 font-medium">Tampilkan album ini di halaman galeri publik website.</span>
                    </label>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-6">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Koleksi Foto Saat Ini</label>
                        <span class="text-[10px] font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full uppercase">{{ $album->photos->count() }} Foto</span>
                    </div>
                    
                    @if($album->photos->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 p-6 bg-gray-50 rounded-4xl border border-gray-100 shadow-inner">
                            @foreach($album->photos as $photo)
                                <div class="relative group aspect-4/5 overflow-hidden rounded-2xl border-2 border-white shadow-sm transition-all hover:shadow-xl">
                                    <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Album Photo"
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center backdrop-blur-[2px]">
                                        <button type="button" onclick="removePhoto({{ $photo->id }})"
                                                class="bg-white/90 text-red-600 p-2.5 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-xl active:scale-90">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-10 bg-gray-50 rounded-4xl border border-dashed border-gray-200">
                            <p class="text-gray-400 text-sm font-bold uppercase tracking-widest">Belum ada foto yang diupload.</p>
                        </div>
                    @endif
                </div>

                <div class="space-y-4">
                    <label for="photos" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Unggah Foto Tambahan</label>
                    <div class="group relative flex flex-col items-center justify-center p-10 border-2 border-gray-200 border-dashed rounded-4xl bg-gray-50 transition-all hover:bg-indigo-50/50 hover:border-indigo-300">
                        <input id="photos" name="photos[]" type="file" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-4 transition-transform group-hover:scale-110">
                            <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-700">Tarik foto ke sini atau <span class="text-indigo-600">klik untuk pilih</span></p>
                        <p class="text-[10px] text-gray-400 mt-2 font-black uppercase tracking-widest leading-relaxed">PNG, JPG up to 10MB per file</p>
                    </div>
                    <div id="file-list" class="grid grid-cols-1 gap-2 mt-4 font-bold text-xs"></div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-8 border-t border-gray-100">
                    <button type="submit" class="flex-2 bg-gray-900 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black shadow-xl shadow-gray-100 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.albums.index') }}" class="flex-1 bg-white text-gray-500 border border-gray-200 px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest text-center hover:bg-gray-50 transition-all active:scale-95">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('photos').addEventListener('change', function(e) {
            const fileList = document.getElementById('file-list');
            fileList.innerHTML = '';
            Array.from(e.target.files).forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'flex items-center justify-between bg-white p-4 rounded-xl border border-gray-100 shadow-sm animate-fade-in';
                div.innerHTML = `
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[11px] text-gray-900">${file.name}</span>
                            <span class="text-[9px] text-gray-400 uppercase tracking-tighter">${Math.round(file.size / 1024)} KB</span>
                        </div>
                    </div>
                    <button type="button" onclick="removeFile(${index})" class="text-gray-300 hover:text-red-500 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                `;
                fileList.appendChild(div);
            });
        });

        function removeFile(index) {
            const input = document.getElementById('photos');
            const dt = new DataTransfer();
            const files = Array.from(input.files);
            files.splice(index, 1);
            files.forEach(file => dt.items.add(file));
            input.files = dt.files;
            input.dispatchEvent(new Event('change'));
        }

        function removePhoto(photoId) {
            if (confirm('Hapus foto ini dari album? Foto akan hilang permanen.')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/albums/${{ $album->id }}/photos/${photoId}`;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        }

        // Cover image preview
        document.getElementById('cover_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('cover-preview');
            const img = document.getElementById('cover-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>
    </div>
</body>
</html>