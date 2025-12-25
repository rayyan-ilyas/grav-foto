<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Album | Gravity Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        .album-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .album-card:hover {
            transform: translateY(-8px);
        }
        /* Custom Scrollbar untuk Filter Horizontal pada Mobile */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] antialiased">
    <div class="min-h-screen">
        @include('admin.partials.header')

        <div class="max-w-7xl mx-auto py-12 px-6">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                <div>
                    <h1 class="text-3xl font-black tracking-tight text-gray-900">Manajemen <span class="text-indigo-600">Album</span></h1>
                    <p class="text-sm text-gray-400 mt-2 font-medium uppercase tracking-widest">Koleksi Portofolio Galeri</p>
                </div>
                <a href="{{ route('admin.albums.create') }}" 
                   class="inline-flex items-center px-6 py-3.5 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Album Baru
                </a>
            </div>

            <div class="mb-10">
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-1.5 h-8 bg-indigo-600 rounded-full"></div>
                    <h2 class="text-xl font-black text-gray-900 tracking-tight">Filter Kategori</h2>
                </div>

                <div class="relative">
                    <!-- Tombol Panah Kiri -->
                    <button id="scroll-left" class="absolute left-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/90 backdrop-blur-sm border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-indigo-600 hover:border-indigo-300 transition-all opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>

                    <!-- Container Filter -->
                    <div id="filter-container" class="flex items-center gap-4 overflow-x-auto hide-scrollbar pb-2 px-12 group">
                        <a href="{{ route('admin.albums.index') }}"
                           class="px-6 py-2.5 {{ !request('category') ? 'bg-gray-900 text-white shadow-xl shadow-gray-200' : 'bg-white text-gray-500 border border-gray-100' }} rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                            Semua
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('admin.albums.index', ['category' => $cat]) }}"
                               class="px-6 py-2.5 {{ request('category') == $cat ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-100' : 'bg-white text-gray-500 border border-gray-100 hover:border-indigo-200' }} rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                                {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    <!-- Tombol Panah Kanan -->
                    <button id="scroll-right" class="absolute right-0 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/90 backdrop-blur-sm border border-gray-200 rounded-full shadow-lg flex items-center justify-center text-gray-600 hover:text-indigo-600 hover:border-indigo-300 transition-all opacity-0 group-hover:opacity-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($albums as $album)
                    <div class="album-card group bg-white rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/5 p-5">
                        <div class="relative aspect-4/5 rounded-4xl overflow-hidden bg-gray-50 mb-6 shadow-inner">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/'.$album->cover_image) }}" 
                                     class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-110" 
                                     alt="{{ $album->title }}">
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-gray-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-[10px] font-black uppercase tracking-tighter">No Cover Image</span>
                                </div>
                            @endif

                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-1.5 bg-white/80 backdrop-blur-md text-indigo-600 rounded-full text-[10px] font-black uppercase tracking-widest shadow-sm border border-white/50">
                                    @switch($album->category)
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
                                            {{ $album->category ?? 'General' }}
                                    @endswitch
                                </span>
                            </div>
                        </div>

                        <div class="px-2">
                            <h3 class="font-black text-xl text-gray-900 tracking-tight line-clamp-1 mb-6 uppercase">{{ $album->title }}</h3>
                            
                            <div class="flex items-center gap-3 mt-4 pt-4 border-t border-gray-50">
                                <a href="{{ route('admin.albums.edit', $album) }}" 
                                   class="flex-1 flex justify-center py-3 bg-amber-50 text-amber-600 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-amber-500 hover:text-white transition-all shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.albums.destroy', $album) }}" 
                                      method="POST" 
                                      class="flex-1"
                                      onsubmit="return confirm('Hapus album ini secara permanen?');">
                                    @csrf @method('DELETE')
                                    <button class="w-full py-3 bg-red-50 text-red-500 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-red-500 hover:text-white transition-all shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 bg-white rounded-[3rem] border-2 border-dashed border-gray-100 flex flex-col items-center justify-center">
                        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Tidak ada album ditemukan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        // Filter scroll functionality
        const filterContainer = document.getElementById('filter-container');
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');

        // Show/hide scroll buttons based on scroll position
        function updateScrollButtons() {
            const scrollLeft = filterContainer.scrollLeft;
            const scrollWidth = filterContainer.scrollWidth;
            const clientWidth = filterContainer.clientWidth;

            scrollLeftBtn.style.opacity = scrollLeft > 0 ? '1' : '0';
            scrollRightBtn.style.opacity = scrollLeft < scrollWidth - clientWidth ? '1' : '0';
        }

        // Scroll left
        scrollLeftBtn.addEventListener('click', () => {
            filterContainer.scrollBy({
                left: -200,
                behavior: 'smooth'
            });
        });

        // Scroll right
        scrollRightBtn.addEventListener('click', () => {
            filterContainer.scrollBy({
                left: 200,
                behavior: 'smooth'
            });
        });

        // Update buttons on scroll
        filterContainer.addEventListener('scroll', updateScrollButtons);

        // Initial check
        updateScrollButtons();

        // Update on window resize
        window.addEventListener('resize', updateScrollButtons);
    </script>
</body>
</html>