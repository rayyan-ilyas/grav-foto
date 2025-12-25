<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumPhoto;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Album::with('photos');

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        $albums = $query->orderBy('created_at', 'desc')->get();

        // Get all unique categories for filter
        $categories = Album::whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->pluck('category')
            ->sort()
            ->values();

        return view('admin.albums.index', compact('albums', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'is_public' => 'boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $coverPath = $request->file('cover_image')->store('albums/covers', 'public');
        }

        $album = Album::create([
            'title' => $validated['title'],
            'category' => $validated['category'] ?? null,
            'cover_image' => $coverPath,
            'is_public' => $request->has('is_public') ? (bool) $validated['is_public'] : true,
        ]);

        // handle multiple photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('albums/photos/' . $album->id, 'public');
                AlbumPhoto::create([
                    'album_id' => $album->id,
                    'photo_path' => $path,
                    'caption' => null,
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('admin.albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('admin.albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $album = Album::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'remove_photo_ids' => 'nullable|array',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $album->cover_image = $request->file('cover_image')->store('albums/covers', 'public');
        }

        $album->title = $validated['title'];
        $album->category = $validated['category'] ?? null;
        $album->description = $validated['description'] ?? null;
        $album->is_public = $request->has('is_public') ? (bool)$validated['is_public'] : $album->is_public;
        $album->save();

        // remove selected photos
        if (!empty($validated['remove_photo_ids'])) {
            foreach ($validated['remove_photo_ids'] as $pid) {
                $photo = AlbumPhoto::find($pid);
                if ($photo && $photo->album_id == $album->id) {
                    Storage::disk('public')->delete($photo->photo_path);
                    $photo->delete();
                }
            }
        }

        // add new photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('albums/photos/' . $album->id, 'public');
                AlbumPhoto::create([
                    'album_id' => $album->id,
                    'photo_path' => $path,
                    'caption' => null,
                    'order' => 0,
                ]);
            }
        }

        return redirect()->route('admin.albums.index')->with('success', 'Album berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $album = Album::with('photos')->findOrFail($id);
        // delete photos from storage
        foreach ($album->photos as $photo) {
            Storage::disk('public')->delete($photo->photo_path);
            $photo->delete();
        }
        if ($album->cover_image) {
            Storage::disk('public')->delete($album->cover_image);
        }
        $album->delete();

        return redirect()->route('admin.albums.index')->with('success', 'Album dihapus.');
    }

    /**
     * Remove a specific photo from an album.
     */
    public function destroyPhoto(string $albumId, string $photoId)
    {
        $album = Album::findOrFail($albumId);
        $photo = AlbumPhoto::where('album_id', $albumId)->findOrFail($photoId);

        // Delete the photo file from storage
        Storage::disk('public')->delete($photo->photo_path);

        // Delete the photo record
        $photo->delete();

        return redirect()->back()->with('success', 'Photo removed successfully.');
    }
}
