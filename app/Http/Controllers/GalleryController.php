<?php

namespace App\Http\Controllers;

use App\Models\JobGallery;
use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = JobGallery::with('jobVacancy')->orderBy('created_at', 'desc')->paginate(12);
        return view('gallery.index', compact('galleries'));
    }

    public function create()
    {
        $jobs = JobVacancy::all();
        return view('gallery.create', compact('jobs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_vacancy_id' => 'required|exists:job_vacancies,id',
            'title'          => 'required|max:200',
            'description'    => 'nullable',
            'picture'        => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('picture')->store('posts_image', 'public');

        JobGallery::create([
            'job_vacancy_id' => $request->job_vacancy_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'picture'        => $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gallery = JobGallery::findOrFail($id);
        $jobs = JobVacancy::all();
        return view('gallery.edit', compact('gallery', 'jobs'));
    }

    public function update(Request $request, $id)
    {
        $gallery = JobGallery::findOrFail($id);

        $request->validate([
            'job_vacancy_id' => 'required|exists:job_vacancies,id',
            'title'          => 'required|max:200',
            'description'    => 'nullable',
            'picture'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('picture')) {
            // Hapus file foto lama dari storage
            if ($gallery->picture && Storage::disk('public')->exists($gallery->picture)) {
                Storage::disk('public')->delete($gallery->picture);
            }
            $gallery->picture = $request->file('picture')->store('posts_image', 'public');
        }

        $gallery->update([
            'job_vacancy_id' => $request->job_vacancy_id,
            'title'          => $request->title,
            'description'    => $request->description,
            'picture'        => $gallery->picture,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = JobGallery::findOrFail($id);

        if ($gallery->picture && Storage::disk('public')->exists($gallery->picture)) {
            Storage::disk('public')->delete($gallery->picture);
        }

        $gallery->delete();

        return redirect()->route('gallery.index')->with('success', 'Foto galeri berhasil dihapus.');
    }
}