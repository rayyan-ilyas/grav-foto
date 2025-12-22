<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Reservasi - Admin</title>
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
    <div class="min-h-screen">
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <img src="{{ asset('logo.png') }}" alt="Logo" class="max-w-full max-h-full object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight text-gray-900 leading-none">Admin Panel</h1>
                        <p class="text-[11px] text-gray-400 mt-1 font-bold uppercase tracking-wider">Kelola Reservasi</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition-colors">
                        ← Dashboard
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2.5 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <div class="max-w-7xl mx-auto px-6 py-10">
            <div class="mb-8">
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Daftar Reservasi</h2>
                <p class="text-sm text-gray-400 mt-2 font-medium">Filter dan kelola seluruh pesanan pelanggan Anda.</p>
            </div>

            @if(session('success'))
                <div class="flex items-center p-4 mb-8 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-4xl border border-gray-100 shadow-sm p-8 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Status Foto</label>
                        <select name="status" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Pembayaran</label>
                        <select name="payment" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua</option>
                            <option value="pending" {{ request('payment') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('payment') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ request('payment') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Approval</label>
                        <select name="approved" class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                            <option value="">Semua</option>
                            <option value="yes" {{ request('approved') == 'yes' ? 'selected' : '' }}>Sudah Disetujui</option>
                            <option value="no" {{ request('approved') == 'no' ? 'selected' : '' }}>Belum Disetujui</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full py-3.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-all font-bold shadow-lg shadow-indigo-100 active:scale-95 text-sm">
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] bg-gray-50/50">
                                <th class="py-5 px-8">Kode</th>
                                <th class="py-5 px-4">Customer</th>
                                <th class="py-5 px-4 text-center">Layanan</th>
                                <th class="py-5 px-4 text-center">Status</th>
                                <th class="py-5 px-4 text-center">Bayar</th>
                                <th class="py-5 px-4 text-center">Appr.</th>
                                <th class="py-5 px-8 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($reservations as $reservation)
                            <tr class="hover:bg-indigo-50/30 transition-colors group">
                                <td class="py-6 px-8">
                                    <span class="font-mono text-xs font-bold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg">
                                        {{ $reservation->reservation_code }}
                                    </span>
                                </td>
                                <td class="py-6 px-4">
                                    <div>
                                        <p class="text-sm font-bold text-gray-900 leading-none">{{ $reservation->name }}</p>
                                        <p class="text-[11px] text-gray-400 mt-1.5 font-medium">{{ $reservation->photo_date->format('d M, Y') }}</p>
                                    </div>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    <span class="text-sm font-bold text-gray-700">{{ $reservation->photoPackage->name }}</span>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex justify-center">
                                        <span class="inline-flex items-center justify-center pl-1 pr-4 py-1.5 min-w-[120px] bg-{{ $reservation->reservationStatus->color }}-50 text-{{ $reservation->reservationStatus->color }}-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-{{ $reservation->reservationStatus->color }}-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-{{ $reservation->reservationStatus->color }}-500 mr-2"></span>
                                            {{ $reservation->reservationStatus->name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-6 px-4">
                                    <div class="flex justify-center">
                                        <span class="px-3 py-1.5 {{ $reservation->payment_status == 'paid' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-amber-50 text-amber-600 border-amber-100' }} border rounded-full text-[10px] font-black uppercase tracking-widest">
                                            {{ $reservation->payment_status }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-6 px-4 text-center">
                                    @if($reservation->approved_at)
                                        <div class="flex justify-center">
                                            <div class="w-6 h-6 bg-emerald-500 text-white rounded-full flex items-center justify-center text-[10px] shadow-sm">
                                                ✓
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-lg">⏳</span>
                                    @endif
                                </td>
                                <td class="py-6 px-8 text-right">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="inline-flex items-center gap-2 text-sm font-black text-indigo-600 hover:text-indigo-800 group-hover:translate-x-1 transition-transform">
                                        Detail
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="text-5xl mb-4 opacity-20">🗓️</div>
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Tidak ada data ditemukan</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($reservations->hasPages())
                <div class="p-6 bg-gray-50/30 border-t border-gray-50">
                    <div class="pagination-custom">
                        {{ $reservations->links() }}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>