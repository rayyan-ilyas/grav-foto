<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    <div class="min-h-screen py-12 px-4 md:px-8">
        <div class="max-w-5xl mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-black tracking-tight text-gray-900">Riwayat <span class="text-indigo-600">Reservasi</span></h1>
                    <p class="text-gray-500 mt-2 font-medium">Pantau status dan detail pemesanan sesi foto Anda.</p>
                </div>
                <a href="{{ route('reservations.create') }}" 
                   class="inline-flex items-center px-6 py-3.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all font-bold shadow-lg shadow-indigo-100 active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    Booking Sesi Baru
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

            @if($reservations->isEmpty())
                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm p-16 text-center">
                    <div class="w-24 h-24 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">Belum ada reservasi</h3>
                    <p class="text-gray-400 mt-2 font-medium max-w-xs mx-auto text-sm leading-relaxed">Sepertinya Anda belum memesan sesi foto. Mulai abadikan momen Anda sekarang!</p>
                    <a href="{{ route('reservations.create') }}" 
                       class="inline-block mt-8 px-8 py-3 bg-gray-900 text-white rounded-xl hover:bg-black transition-all font-bold text-sm shadow-xl shadow-gray-100 active:scale-95">
                        Buat Reservasi Pertama
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6">
                    @foreach($reservations as $reservation)
                        <div class="group bg-white rounded-4xl border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 p-8">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                                
                                <div class="flex-1">
                                    <div class="flex flex-wrap items-center gap-3 mb-6">
                                        <span class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100">
                                            {{ $reservation->reservation_code }}
                                        </span>
                                        <span class="inline-flex items-center pl-1 pr-4 py-1.5 bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2"></span>
                                            {{ $reservation->reservationStatus->name }}
                                        </span>
                                        <span class="px-4 py-1.5 {{ $reservation->payment_status == 'paid' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }} border rounded-full text-[10px] font-black uppercase tracking-widest">
                                            {{ $reservation->payment_status }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Paket Layanan</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $reservation->photoPackage->name }}</p>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Atas Nama</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $reservation->name }}</p>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jadwal Sesi</p>
                                            <div class="flex items-center gap-1.5 text-sm font-bold text-gray-900">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ $reservation->photo_date->format('d M Y') }}
                                            </div>
                                        </div>
                                        <div class="space-y-1">
                                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jumlah Orang</p>
                                            <p class="text-sm font-bold text-gray-900">{{ $reservation->number_of_people }} Orang</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center justify-end border-t lg:border-t-0 lg:border-l border-gray-50 pt-6 lg:pt-0 lg:pl-8">
                                    <a href="{{ route('reservations.show', $reservation) }}" 
                                       class="w-full lg:w-auto inline-flex items-center justify-center px-8 py-3.5 bg-gray-900 text-white rounded-2xl hover:bg-black transition-all font-bold text-sm shadow-lg active:scale-95 group/btn">
                                        Lihat Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-12 text-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>