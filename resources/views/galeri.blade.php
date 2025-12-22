<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Portofolio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Rock+Salt&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
            overflow-x: hidden;
        }
        .font-rock-salt { font-family: 'Rock Salt', cursive; }
        
        /* Glassmorphism Sidebar */
        .sidebar-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-right: 1px solid rgba(226, 232, 240, 0.6);
        }

        /* Smooth Gallery Hover */
        .gallery-item {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gallery-item:hover {
            transform: translateY(-10px);
        }
        .gallery-overlay {
            background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
        }

        /* Glow Background */
        .glow-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            pointer-events: none;
        }
        .glow-1 {
            position: absolute;
            top: -10%; right: -5%;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.07), transparent 70%);
            filter: blur(80px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B] antialiased">

    <div class="glow-bg">
        <div class="glow-1"></div>
    </div>

    <div class="flex min-h-screen">
        
        <aside class="w-72 sidebar-glass fixed h-screen z-20 hidden lg:block overflow-y-auto">

            <div class="p-10 flex flex-col h-full">
                <a href="{{ url('/') }}" class="flex flex-col items-center mb-16 group">
                    <div class="w-24 h-24 flex items-center justify-center transition-transform duration-500 group-hover:scale-110">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="max-w-full max-h-full object-contain">
                    </div>
                    <div class="text-center mt-4">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em]">Gravity Photography</p>
                    </div>
                </a>

                <div class="flex-1">
                    <h3 class="text-[11px] font-black text-gray-400 uppercase tracking-[0.2em] mb-8 px-4">Kategori Karya</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#" class="flex items-center px-5 py-4 bg-indigo-600 text-white rounded-2xl font-bold text-sm shadow-xl shadow-indigo-100 transition-all">
                                Semua Karya
                            </a>
                        </li>
                        @php $categories = ['Pre-Wedding', 'Wedding', 'Model / Portrait', 'Wisuda', 'Keluarga']; @endphp
                        @foreach($categories as $cat)
                        <li>
                            <a href="#" class="flex items-center px-5 py-4 text-gray-500 hover:text-indigo-600 hover:bg-white rounded-2xl font-bold text-sm transition-all group">
                                <span class="w-2 h-2 rounded-full bg-gray-200 mr-4 group-hover:bg-indigo-600 group-hover:scale-125 transition-all"></span>
                                {{ $cat }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="pt-10 border-t border-gray-100">
                    <a href="{{ route('reservations.create') }}" class="block text-center py-5 bg-gray-900 text-white rounded-3xl font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl shadow-gray-200 hover:bg-black transition-all active:scale-95">
                        Booking Sekarang
                    </a>
                </div>
            </div>
        </aside>

        <main class="flex-1 lg:ml-72 p-8 lg:p-16">
            
            <div class="lg:hidden flex justify-between items-center mb-12">
                <img src="{{ asset('logo.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                <button class="w-12 h-12 flex items-center justify-center bg-white rounded-2xl shadow-sm border border-gray-100 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <header class="mb-16">
                <h1 class="font-rock-salt text-4xl md:text-5xl text-gray-900 mb-6 leading-relaxed">Our Masterpieces</h1>
                <div class="flex items-center gap-4">
                    <div class="w-16 h-1.5 bg-indigo-600 rounded-full"></div>
                    <p class="text-gray-400 font-bold text-sm uppercase tracking-widest">Koleksi Terkini {{ date('Y') }}</p>
                </div>
            </header>

            @php
                $dummy = [
                    ['title' => 'Golden Hour Love', 'cat' => 'Pre-Wedding', 'img' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800'],
                    ['title' => 'Traditional Soul', 'cat' => 'Wedding', 'img' => 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800'],
                    ['title' => 'Urban Vibe', 'cat' => 'Model', 'img' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=800'],
                    ['title' => 'Success Story', 'cat' => 'Wisuda', 'img' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=800'],
                    ['title' => 'Home Warmth', 'cat' => 'Keluarga', 'img' => 'https://images.unsplash.com/photo-1502086223501-7ea24ec8f4f6?q=80&w=800'],
                    ['title' => 'Classic Couple', 'cat' => 'Pre-Wedding', 'img' => 'https://images.unsplash.com/photo-1522673607200-1648832cee98?q=80&w=800']
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-10">
                @foreach($dummy as $item)
                <div class="gallery-item group relative aspect-4/5 overflow-hidden rounded-[3rem] bg-gray-200 cursor-pointer shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10">
                    <img src="{{ $item['img'] }}" alt="Gallery" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    
                    <div class="gallery-overlay absolute inset-0 opacity-0 group-hover:opacity-100 transition-all duration-500 p-10 flex flex-col justify-end">
                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-3">{{ $item['cat'] }}</span>
                        <h4 class="text-white font-black text-2xl tracking-tight leading-none mb-4">{{ $item['title'] }}</h4>
                        <div class="w-10 h-1 bg-white/30 rounded-full group-hover:w-20 transition-all duration-700"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-24 flex justify-center pb-10">
                <nav class="flex items-center gap-3 p-3 bg-white rounded-3xl shadow-sm border border-gray-100">
                    <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 transition-all">←</button>
                    <span class="w-12 h-12 flex items-center justify-center rounded-2xl bg-indigo-600 text-white font-black text-sm shadow-xl shadow-indigo-100">1</span>
                    <span class="w-12 h-12 flex items-center justify-center rounded-2xl text-gray-400 font-bold text-sm hover:bg-gray-50 cursor-pointer">2</span>
                    <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-indigo-600 hover:bg-indigo-50 transition-all">→</button>
                </nav>
            </div>

        </main>
    </div>

</body>
</html>