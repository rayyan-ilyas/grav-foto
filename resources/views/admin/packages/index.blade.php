<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Paket Foto - Admin</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div class="min-h-screen py-12 px-4 md:px-8">
        <div class="max-w-7xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-all group mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Dashboard
                    </a>
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900">Kelola Paket <span class="text-indigo-600">Foto</span></h1>
                    <p class="text-gray-500 mt-2 font-medium">Atur penawaran terbaik untuk klien Anda melalui katalog paket.</p>
                </div>
                
                <a href="{{ route('admin.packages.create') }}" 
                   class="inline-flex items-center px-6 py-3.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-bold shadow-lg shadow-indigo-200 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Paket Baru
                </a>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <div class="group relative bg-white rounded-4xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 p-8 flex flex-col {{ $package->is_active ? '' : 'bg-gray-50/50' }}">
                        
                        <div class="flex justify-between items-start mb-6">
                            @if($package->is_active)
                                <span class="inline-flex items-center px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-extrabold uppercase tracking-wider border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-extrabold uppercase tracking-wider">
                                    Nonaktif
                                </span>
                            @endif

                            <div class="flex items-center text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-[11px] font-bold">{{ $package->duration_minutes }} Min</span>
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-2xl font-extrabold text-gray-900 group-hover:text-indigo-600 transition-colors mb-2">{{ $package->name }}</h3>
                            <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 font-medium">
                                {{ $package->description }}
                            </p>
                        </div>

                        <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between mb-8">
                            <div class="flex flex-col">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Harga Paket</span>
                                <span class="text-2xl font-black text-gray-900">
                                    <span class="text-sm font-bold text-indigo-500">Rp</span> {{ number_format($package->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.packages.edit', $package) }}" 
                               class="flex-2 inline-flex justify-center items-center px-4 py-3 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition-all font-bold text-sm">
                                Edit Detail
                            </a>
                            
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full h-full inline-flex justify-center items-center p-3 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all group-hover:opacity-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($packages->isEmpty())
                <div class="text-center py-20 bg-white rounded-4xl border-2 border-dashed border-gray-100">
                    <div class="bg-indigo-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Belum ada paket</h3>
                    <p class="text-gray-500 mt-1">Mulai buat paket pertama Anda untuk ditampilkan ke klien.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>