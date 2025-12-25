<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoPackage;
use Illuminate\Http\Request;

class PhotoPackageController extends Controller
{
    // Tampilkan daftar paket foto
    public function index()
    {
        $packages = PhotoPackage::orderBy('name')->get();
        return view('admin.packages.index', compact('packages'));
    }

    // Tampilkan form untuk menambahkan paket foto baru
    public function create()
    {
        return view('admin.packages.create');
    }

    // Simpan paket foto baru ke database
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'location' => 'required|in:indoor,outdoor',
            'category' => 'required|string|in:corporate,ultah,dokumentasi,lamaran,martupol,personal,keluarga,maternity,wedding',
        ];

        // Add subcategory validation for wedding
        if ($request->category === 'wedding') {
            $rules['subcategory'] = 'required|in:prewedding,akad,resepsi';
        }

        $validated = $request->validate($rules);

        PhotoPackage::create($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket foto berhasil ditambahkan.');
    }

    // Tampilkan form untuk mengedit paket foto
    public function edit(PhotoPackage $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    // Update paket foto di database
    public function update(Request $request, PhotoPackage $package)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'is_active' => 'boolean',
            'location' => 'required|in:indoor,outdoor',
            'category' => 'required|string|in:corporate,ultah,dokumentasi,lamaran,martupol,personal,keluarga,maternity,wedding',
        ];

        // Add subcategory validation for wedding
        if ($request->category === 'wedding') {
            $rules['subcategory'] = 'required|in:prewedding,akad,resepsi';
        }

        $validated = $request->validate($rules);

        $package->update($validated);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket foto berhasil diperbarui.');
    }

    // Hapus paket foto dari database
    public function destroy(PhotoPackage $package)
    {
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket foto berhasil dihapus.');
    }
}
