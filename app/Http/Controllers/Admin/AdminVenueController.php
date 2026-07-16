<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Venue;
use App\Models\VenueImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminVenueController extends Controller
{
    public function index(Request $request)
    {
        $query = Venue::with('mainImage');

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $isActive = $request->input('status') === 'active';
            $query->where('is_active', $isActive);
        }

        $sortBy = $request->input('sort', 'name_asc');
        switch ($sortBy) {
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            default:
                $query->orderBy('name', 'asc');
                break;
        }

        $venues = $query->paginate(9)->appends($request->query());

        return view('admin.venues.index', compact('venues'));
    }

    public function create()
    {
        return view('admin.venues.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'address'           => 'required|string',
            'description'       => 'nullable|string',
            'price'             => 'required|integer|min:0',
            'time_unit_minutes' => 'required|integer|min:1',
            'max_capacity'      => 'required|integer|min:1',
            'is_active'         => 'required|boolean',
            'main_image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $slug = Str::slug($validated['name']);
        // Pastikan slug unik
        $originalSlug = $slug;
        $counter = 1;
        while (Venue::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $venue = Venue::create([
            'name'              => $validated['name'],
            'slug'              => $slug,
            'address'           => $validated['address'],
            'description'       => $validated['description'],
            'price'             => $validated['price'],
            'time_unit_minutes' => $validated['time_unit_minutes'],
            'max_capacity'      => $validated['max_capacity'],
            'is_active'         => $validated['is_active'],
        ]);

        // Upload main image
        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('venues', 'public');
            VenueImage::create([
                'venue_id'   => $venue->id,
                'image_path' => $path,
                'is_main'    => true,
            ]);
        }

        // Upload gallery images (max 3)
        if ($request->hasFile('gallery_images')) {
            $galleryFiles = array_slice($request->file('gallery_images'), 0, 3);
            foreach ($galleryFiles as $file) {
                $path = $file->store('venues', 'public');
                VenueImage::create([
                    'venue_id'   => $venue->id,
                    'image_path' => $path,
                    'is_main'    => false,
                ]);
            }
        }

        return redirect()->route('admin.venues.index')
            ->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function show(Venue $venue)
    {
        $venue->load(['images', 'mainImage']);
        $bookings = $venue->bookings()
            ->with('user')
            ->latest('booking_date')
            ->paginate(10);

        return view('admin.venues.show', compact('venue', 'bookings'));
    }

    public function edit(Venue $venue)
    {
        $venue->load('images');
        return view('admin.venues.edit', compact('venue'));
    }

    public function update(Request $request, Venue $venue)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'address'           => 'required|string',
            'description'       => 'nullable|string',
            'price'             => 'required|integer|min:0',
            'time_unit_minutes' => 'required|integer|min:1',
            'max_capacity'      => 'required|integer|min:1',
            'is_active'         => 'required|boolean',
            'main_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'gallery_images.*'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // Update slug jika nama berubah
        if ($venue->name !== $validated['name']) {
            $slug = Str::slug($validated['name']);
            $originalSlug = $slug;
            $counter = 1;
            while (Venue::where('slug', $slug)->where('id', '!=', $venue->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        $venue->update([
            'name'              => $validated['name'],
            'slug'              => $validated['slug'] ?? $venue->slug,
            'address'           => $validated['address'],
            'description'       => $validated['description'],
            'price'             => $validated['price'],
            'time_unit_minutes' => $validated['time_unit_minutes'],
            'max_capacity'      => $validated['max_capacity'],
            'is_active'         => $validated['is_active'],
        ]);

        // Replace main image jika ada upload baru
        if ($request->hasFile('main_image')) {
            $oldMain = $venue->mainImage;
            if ($oldMain) {
                Storage::disk('public')->delete($oldMain->image_path);
                $oldMain->delete();
            }
            $path = $request->file('main_image')->store('venues', 'public');
            VenueImage::create([
                'venue_id'   => $venue->id,
                'image_path' => $path,
                'is_main'    => true,
            ]);
        }

        // Hapus gambar gallery tertentu
        if ($request->has('delete_images')) {
            $deleteIds = $request->input('delete_images', []);
            $imagesToDelete = VenueImage::where('venue_id', $venue->id)
                ->where('is_main', false)
                ->whereIn('id', $deleteIds)
                ->get();
            foreach ($imagesToDelete as $img) {
                Storage::disk('public')->delete($img->image_path);
                $img->delete();
            }
        }

        // Tambah gallery images baru
        if ($request->hasFile('gallery_images')) {
            $currentGalleryCount = $venue->images()->where('is_main', false)->count();
            $maxNew = 3 - $currentGalleryCount;
            if ($maxNew > 0) {
                $galleryFiles = array_slice($request->file('gallery_images'), 0, $maxNew);
                foreach ($galleryFiles as $file) {
                    $path = $file->store('venues', 'public');
                    VenueImage::create([
                        'venue_id'   => $venue->id,
                        'image_path' => $path,
                        'is_main'    => false,
                    ]);
                }
            }
        }

        return redirect()->route('admin.venues.show', $venue)
            ->with('success', 'Lapangan berhasil diperbarui.');
    }

    public function destroy(Venue $venue)
    {
        // Soft delete: set is_active = false
        $venue->update(['is_active' => false]);

        return redirect()->route('admin.venues.index')
            ->with('success', 'Lapangan berhasil dinonaktifkan.');
    }
}
