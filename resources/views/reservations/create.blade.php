<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi - Gravity Studio</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            letter-spacing: -0.01em;
        }
        /* Custom radio styling */
        .form-radio {
            appearance: none;
            width: 1.25rem;
            height: 1.25rem;
            border: 2px solid #E2E8F0;
            border-radius: 50%;
            transition: all 0.2s;
            cursor: pointer;
            position: relative;
        }
        .form-radio:checked {
            border-color: #4F46E5;
            background-color: #4F46E5;
            box-shadow: inset 0 0 0 3px white;
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-[#1E293B]">
    @include('partials.header')

    <div class="min-h-screen pt-28 pb-20 px-4 md:px-8">
        <div class="max-w-3xl mx-auto">
            
            <div class="mb-10 text-center md:text-left">
                <h1 class="text-4xl font-black tracking-tight text-gray-900">Buat <span class="text-indigo-600">Reservasi</span></h1>
                <p class="text-gray-500 mt-2 font-medium">Abadikan momen berharga Anda bersama tim profesional kami.</p>
            </div>

            @if ($errors->any())
                <div class="flex items-start p-5 mb-8 bg-red-50 border border-red-100 text-red-700 rounded-4xl animate-pulse">
                    <svg class="w-6 h-6 mr-3 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-sm">
                        <p class="font-black uppercase tracking-wider text-[10px] mb-1">Perhatian!</p>
                        <ul class="list-disc list-inside font-medium opacity-80">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                @csrf

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-100 font-bold text-sm">1</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Pilih Paket Foto</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Kategori</label>
                            <div class="relative">
                                <select name="category_filter" id="category_filter" required
                                        class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                    <option value="">— Pilih Kategori —</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="ultah">Ulang Tahun</option>
                                    <option value="dokumentasi">Dokumentasi</option>
                                    <option value="lamaran">Lamaran</option>
                                    <option value="martupol">Martupol</option>
                                    <option value="personal">Personal</option>
                                    <option value="keluarga">Keluarga</option>
                                    <option value="maternity">Maternity</option>
                                    <option value="wedding">Wedding</option>
                                </select>
                                <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Lokasi Sesi</label>
                            <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="location_filter" value="all" checked class="form-radio" />
                                    <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">SEMUA</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="location_filter" value="indoor" class="form-radio" />
                                    <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">INDOOR</span>
                                </label>
                                <label class="inline-flex items-center cursor-pointer group">
                                    <input type="radio" name="location_filter" value="outdoor" class="form-radio" />
                                    <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">OUTDOOR</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- WEDDING SUBCATEGORY -->
                    <div id="wedding_subcategory" class="space-y-2 hidden">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jenis Acara Wedding</label>
                        <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="subcategory" value="prewedding" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">PRE-WEDDING</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="subcategory" value="akad" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">AKAD NIKAH</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="subcategory" value="resepsi" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">RESEPSI</span>
                            </label>
                        </div>
                    </div>

                    <!-- INDOOR STUDIO OPTION -->
                    <div id="indoor_studio_option" class="space-y-2 hidden">
                        <label class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Foto di Studio?</label>
                        <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="is_studio" value="1" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">YA</span>
                            </label>
                            <label class="inline-flex items-center cursor-pointer group">
                                <input type="radio" name="is_studio" value="0" class="form-radio" />
                                <span class="ml-2 text-xs font-black text-gray-500 group-hover:text-indigo-600 transition-colors">TIDAK</span>
                            </label>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="photo_package_id" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Layanan Tersedia</label>
                        <div class="relative">
                            <select name="photo_package_id" id="photo_package_id" required disabled
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none disabled:bg-gray-100 disabled:text-gray-400 disabled:cursor-not-allowed">
                                <option value="">— Pilih Kategori Dahulu —</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" data-category="{{ $package->category ?: 'personal' }}" data-location="{{ $package->location ?: 'indoor' }}" {{ request('photo_package_id') == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} (Rp {{ number_format($package->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-100 font-bold text-sm">2</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Detail Pemesanan</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2 md:col-span-2">
                            <label for="name" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                        </div>

                        <div class="space-y-2">
                            <label for="phone" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">WhatsApp</label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required placeholder="0812..."
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">
                        </div>

                        <div class="space-y-2">
                            <label for="number_of_people" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Peserta</label>
                            <div class="relative">
                                <input type="number" name="number_of_people" id="number_of_people" value="{{ old('number_of_people', 1) }}" min="1" required
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                                <span class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-gray-400">ORANG</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label for="photo_date" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tanggal Sesi</label>
                            <input type="date" name="photo_date" id="photo_date" value="{{ old('photo_date', request('photo_date')) }}" required
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div class="space-y-2">
                            <label for="photo_time" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Jam Sesi</label>
                            <input type="time" name="photo_time" id="photo_time" value="{{ old('photo_time', request('photo_time')) }}" required
                                   class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700">
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="address" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Alamat Domisili</label>
                            <textarea name="address" id="address" rows="2" required placeholder="Alamat lengkap..."
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">{{ old('address') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] border border-gray-100 shadow-xl shadow-indigo-500/5 p-8 md:p-10 space-y-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-8 h-8 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-100 font-bold text-sm">3</div>
                        <h2 class="text-lg font-black text-gray-900 tracking-tight">Metode Pembayaran</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="payment_method" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Metode</label>
                            <select name="payment_method" id="payment_method" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                <option value="">— Pilih Metode —</option>
                                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                <option value="e_wallet" {{ old('payment_method') == 'e_wallet' ? 'selected' : '' }}>E-Wallet</option>
                                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Tunai (Studio)</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="payment_type" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Tipe</label>
                            <select name="payment_type" id="payment_type" required
                                    class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 appearance-none">
                                <option value="">— Pilih Tipe —</option>
                                <option value="dp" {{ old('payment_type') == 'dp' ? 'selected' : '' }}>DP (Down Payment)</option>
                                <option value="lunas" {{ old('payment_type') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="proof_of_payment" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Bukti Transfer (Opsional)</label>
                            <div class="relative group">
                                <input type="file" name="proof_of_payment" id="proof_of_payment" accept="image/*"
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 file:mr-4 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-700">
                            </div>
                        </div>

                        <div class="space-y-2 md:col-span-2">
                            <label for="notes" class="text-[11px] font-black text-gray-400 uppercase tracking-widest ml-1">Catatan Tambahan</label>
                            <textarea name="notes" id="notes" rows="3" placeholder="Informasi tambahan..."
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 transition-all outline-none font-bold text-sm text-gray-700 placeholder:text-gray-300">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row gap-4">
                    <a href="{{ route('dashboard') }}" 
                       class="flex-1 px-8 py-5 border border-gray-100 text-gray-400 rounded-3xl hover:bg-gray-50 transition-all text-center font-black text-xs uppercase tracking-widest">
                        Batal
                    </a>
                    <button type="submit" 
                            class="flex-2 px-8 py-5 bg-indigo-600 text-white rounded-3xl hover:bg-indigo-700 transition-all font-black text-xs uppercase tracking-widest shadow-xl shadow-indigo-100 active:scale-95">
                        Konfirmasi Reservasi
                    </button>
                </div>
            </form>

            <div class="mt-12 text-center">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-xs font-bold text-gray-400 hover:text-indigo-600 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-select package, category, and location from URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const photoPackageId = urlParams.get('photo_package_id');

            if (photoPackageId) {
                console.log('Photo package ID found in URL:', photoPackageId);

                // Find the option with the matching package ID
                const selectedOption = document.querySelector(`option[value="${photoPackageId}"]`);
                console.log('Selected option element:', selectedOption);

                if (selectedOption) {
                    // Set the package select value
                    document.getElementById('photo_package_id').value = photoPackageId;
                    console.log('Package select value set to:', photoPackageId);

                    // Get category and location from data attributes
                    const category = selectedOption.getAttribute('data-category');
                    const location = selectedOption.getAttribute('data-location');
                    console.log('Category from data attribute:', category);
                    console.log('Location from data attribute:', location);

                    // Set category filter
                    if (category && category.trim() !== '') {
                        const categorySelect = document.getElementById('category_filter');
                        if (categorySelect) {
                            categorySelect.value = category;
                            console.log('Category select set to:', category);
                        } else {
                            console.log('Category select element not found');
                        }
                    } else {
                        console.log('Category is empty or null, skipping category selection');
                    }

                    // Set location filter
                    if (location && location.trim() !== '') {
                        const locationRadios = document.querySelectorAll('input[name="location_filter"]');
                        let locationFound = false;
                        locationRadios.forEach(radio => {
                            if (radio.value === location) {
                                radio.checked = true;
                                locationFound = true;
                                console.log('Location radio set to:', location);
                            }
                        });
                        if (!locationFound) {
                            console.log('Location value not found in radios, available values:', Array.from(locationRadios).map(r => r.value));
                        }
                    } else {
                        console.log('Location is empty or null, skipping location selection');
                    }
                } else {
                    console.log('No option found with package ID:', photoPackageId);
                }
            } else {
                console.log('No photo_package_id in URL parameters');
            }
        });

        (function(){
            const catF = document.getElementById('category_filter');
            const pkgS = document.getElementById('photo_package_id');
            const locR = document.querySelectorAll('input[name="location_filter"]');
            const weddingSub = document.getElementById('wedding_subcategory');
            const indoorStudio = document.getElementById('indoor_studio_option');
            const addressField = document.querySelector('textarea[name="address"]').closest('.space-y-2');
            const studioRadios = document.querySelectorAll('input[name="is_studio"]');

            function runFilter() {
                const cat = catF.value;
                const loc = document.querySelector('input[name="location_filter"]:checked')?.value || 'all';
                const currentSelectedPackage = pkgS.value; // Store current selection
                const urlParams = new URLSearchParams(window.location.search);
                const wasPreSelected = urlParams.get('photo_package_id');

                if (!cat) {
                    pkgS.disabled = true;
                    // Don't reset if package was pre-selected from URL
                    if (!wasPreSelected) {
                        pkgS.selectedIndex = 0;
                    }
                    return;
                }

                pkgS.disabled = false;
                let hasVisibleOptions = false;
                let preSelectedOptionVisible = false;
                
                Array.from(pkgS.options).forEach((opt, i) => {
                    if (i === 0) return; // Skip "Pilih Kategori Dahulu" option
                    const optValue = opt.value;
                    const optCategory = opt.getAttribute('data-category');
                    const optLocation = opt.getAttribute('data-location');
                    
                    const matchC = optCategory === cat;
                    const matchL = loc === 'all' || optLocation === loc;
                    const shouldShow = matchC && matchL;
                    
                    opt.style.display = shouldShow ? '' : 'none';
                    
                    if (shouldShow) {
                        hasVisibleOptions = true;
                        if (wasPreSelected && optValue === wasPreSelected) {
                            preSelectedOptionVisible = true;
                        }
                    }
                });

                // Handle selection logic
                if (!hasVisibleOptions) {
                    // No options visible for current filters
                    pkgS.selectedIndex = 0;
                } else if (wasPreSelected && preSelectedOptionVisible) {
                    // Pre-selected package is still visible, keep it selected
                    pkgS.value = wasPreSelected;
                } else if (wasPreSelected && !preSelectedOptionVisible) {
                    // Pre-selected package is no longer visible due to filter change
                    // Keep it selected but show a warning
                    pkgS.value = wasPreSelected;
                    
                    // Show warning message
                    showFilterWarning();
                } else if (pkgS.selectedOptions[0]?.style.display === 'none') {
                    // Current selection is not visible, reset
                    pkgS.selectedIndex = 0;
                }
                // Otherwise keep current selection
            }

            function updateConditionalFields() {
                const cat = catF.value;
                const loc = document.querySelector('input[name="location_filter"]:checked')?.value || 'all';

                // Show/hide wedding subcategory
                if (cat === 'wedding') {
                    weddingSub.classList.remove('hidden');
                } else {
                    weddingSub.classList.add('hidden');
                    // Reset subcategory selection
                    document.querySelectorAll('input[name="subcategory"]').forEach(r => r.checked = false);
                }

                // Show/hide indoor studio option
                if (loc === 'indoor') {
                    indoorStudio.classList.remove('hidden');
                } else {
                    indoorStudio.classList.add('hidden');
                    // Reset studio selection
                    document.querySelectorAll('input[name="is_studio"]').forEach(r => r.checked = false);
                    // Show address field for non-indoor
                    addressField.classList.remove('hidden');
                }
            }

            function updateAddressField() {
                const isStudio = document.querySelector('input[name="is_studio"]:checked')?.value;
                const loc = document.querySelector('input[name="location_filter"]:checked')?.value || 'all';

                if (loc === 'indoor' && isStudio === '1') {
                    // Hide address field for studio shoots
                    addressField.classList.add('hidden');
                    document.querySelector('textarea[name="address"]').required = false;
                } else {
                    // Show address field for non-studio shoots
                    addressField.classList.remove('hidden');
                    document.querySelector('textarea[name="address"]').required = true;
                }
            }

            catF.addEventListener('change', function() {
                runFilter();
                updateConditionalFields();
                updateAddressField();
            });

            locR.forEach(r => r.addEventListener('change', function() {
                runFilter();
                updateConditionalFields();
                updateAddressField();
            }));

            studioRadios.forEach(r => r.addEventListener('change', updateAddressField));

            document.addEventListener('DOMContentLoaded', function() {
                // Handle pre-selected package from URL parameter FIRST
                const urlParams = new URLSearchParams(window.location.search);
                const selectedPackageId = urlParams.get('photo_package_id');
                
                if (selectedPackageId) {
                    const selectedOption = document.querySelector(`option[value="${selectedPackageId}"]`);
                    if (selectedOption) {
                        // Get package details
                        const packageCategory = selectedOption.getAttribute('data-category');
                        const packageLocation = selectedOption.getAttribute('data-location');
                        
                        console.log('Auto-selecting package:', {
                            id: selectedPackageId,
                            category: packageCategory,
                            location: packageLocation,
                            option: selectedOption,
                            optionAttributes: {
                                'data-category': selectedOption.getAttribute('data-category'),
                                'data-location': selectedOption.getAttribute('data-location')
                            }
                        });
                        
                        // Set category filter
                        if (packageCategory) {
                            catF.value = packageCategory;
                            console.log('Set category to:', packageCategory);
                        }
                        
                        // Set location filter
                        if (packageLocation) {
                            const locationRadio = document.querySelector(`input[name="location_filter"][value="${packageLocation}"]`);
                            if (locationRadio) {
                                locationRadio.checked = true;
                                console.log('Set location to:', packageLocation);
                            } else {
                                console.warn('Location radio not found for:', packageLocation);
                            }
                        }
                        
                        // Enable and select the package
                        pkgS.disabled = false;
                        pkgS.value = selectedPackageId;
                        
                        console.log('Package selected, now running updates...');
                        
                        // Run all updates with a small delay to ensure DOM is ready
                        setTimeout(() => {
                            runFilter();
                            updateConditionalFields();
                            updateAddressField();
                            
                            // Additional check for wedding subcategory
                            if (packageCategory === 'wedding') {
                                // For wedding packages, set default subcategory to "prewedding"
                                const preweddingRadio = document.querySelector('input[name="subcategory"][value="prewedding"]');
                                if (preweddingRadio && !document.querySelector('input[name="subcategory"]:checked')) {
                                    preweddingRadio.checked = true;
                                }
                            }
                            
                            // Show success message
                            const packageName = selectedOption.textContent.split(' (')[0];
                            const packagePrice = selectedOption.textContent.match(/Rp ([\d.,]+)/)?.[1] || '';
                            showPackageSelectedMessage(packageName, packageCategory, packageLocation, packagePrice);
                        }, 100);
                        
                        // Scroll to form for better UX
                        setTimeout(() => {
                            const formElement = document.querySelector('.bg-white.rounded-\\[2\\.5rem\\]');
                            if (formElement) {
                                formElement.scrollIntoView({ 
                                    behavior: 'smooth', 
                                    block: 'start' 
                                });
                            }
                        }, 600);
                    } else {
                        console.warn('Selected package option not found:', selectedPackageId);
                        // Fallback: run normal initialization
                        runFilter();
                        updateConditionalFields();
                        updateAddressField();
                    }
                } else {
                    // No pre-selected package, run normal initialization
                    runFilter();
                    updateConditionalFields();
                    updateAddressField();
                }
            });
            
            function showFilterWarning() {
                // Remove existing warning if any
                const existingWarning = document.getElementById('filter-warning');
                if (existingWarning) {
                    existingWarning.remove();
                }
                
                const warningDiv = document.createElement('div');
                warningDiv.id = 'filter-warning';
                warningDiv.className = 'flex items-start p-3 mb-4 bg-amber-50 border border-amber-100 text-amber-700 rounded-xl animate-fade-in-down';
                warningDiv.innerHTML = `
                    <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div class="text-xs">
                        <p class="font-medium">Filter tidak cocok dengan paket terpilih</p>
                        <p class="opacity-80">Paket tetap dipilih, tapi filter mungkin perlu disesuaikan.</p>
                    </div>
                `;
                
                // Insert before the package select
                const packageSelect = document.getElementById('photo_package_id');
                if (packageSelect && packageSelect.parentElement) {
                    packageSelect.parentElement.insertBefore(warningDiv, packageSelect.parentElement.firstChild);
                }
            }
                // Format category display
                let categoryDisplay = category;
                switch(category) {
                    case 'corporate': categoryDisplay = 'Corporate'; break;
                    case 'ultah': categoryDisplay = 'Ulang Tahun'; break;
                    case 'dokumentasi': categoryDisplay = 'Dokumentasi'; break;
                    case 'lamaran': categoryDisplay = 'Lamaran'; break;
                    case 'martupol': categoryDisplay = 'Martupol'; break;
                    case 'personal': categoryDisplay = 'Personal'; break;
                    case 'keluarga': categoryDisplay = 'Keluarga'; break;
                    case 'maternity': categoryDisplay = 'Maternity'; break;
                    case 'prewedding': categoryDisplay = 'Pre-Wedding'; break;
                    default: categoryDisplay = category ? category.charAt(0).toUpperCase() + category.slice(1) : 'General';
                }
                
                // Format location display
                const locationDisplay = location === 'indoor' ? 'Indoor' : 'Outdoor';
                
                const messageDiv = document.createElement('div');
                messageDiv.className = 'flex items-start p-4 mb-6 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl animate-fade-in-down';
                messageDiv.innerHTML = `
                    <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <p class="font-bold text-sm">Paket Terpilih: ${packageName}</p>
                            ${price ? `<p class="font-bold text-sm text-emerald-600">Rp ${price}</p>` : ''}
                        </div>
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-medium">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                ${categoryDisplay}
                            </span>
                            <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                ${locationDisplay}
                            </span>
                        </div>
                        <p class="text-xs opacity-80 mt-2">Silakan lengkapi detail reservasi lainnya.</p>
                    </div>
                `;
                
                // Insert after the title
                const titleElement = document.querySelector('h1');
                if (titleElement && titleElement.parentElement) {
                    titleElement.parentElement.insertBefore(messageDiv, titleElement.nextSibling);
                }
            }
        });
    </script>
</body>
</html>