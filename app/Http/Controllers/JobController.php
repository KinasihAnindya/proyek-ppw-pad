<?php
namespace App\Http\Controllers;

use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'location'    => 'required',
            'company'     => 'required',
            'type'        => 'required',
            'salary'      => 'nullable|numeric',
            'logo'        => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        Job::create([
            'title'       => $request->title,
            'job_seo'     => Str::slug($request->title),
            'description' => $request->description,
            'location'    => $request->location,
            'company'     => $request->company,
            'type'        => $request->type,
            'salary'      => $request->salary,
            'logo'        => $logoPath
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan kerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $request->validate([
            'title'       => 'required',
            'description' => 'required',
            'location'    => 'required',
            'company'     => 'required',
            'type'        => 'required',
            'salary'      => 'nullable|numeric',
            'logo'        => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $logoPath = $job->logo;
        if ($request->hasFile('logo')) {
            if ($job->logo && Storage::disk('public')->exists($job->logo)) {
                Storage::disk('public')->delete($job->logo);
            }
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        $job->update([
            'title'       => $request->title,
            'job_seo'     => Str::slug($request->title),
            'description' => $request->description,
            'location'    => $request->location,
            'company'     => $request->company,
            'type'        => $request->type,
            'salary'      => $request->salary,
            'logo'        => $logoPath
        ]);

        return redirect()->route('jobs.index')->with('success', 'Lowongan kerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        if ($job->logo && Storage::disk('public')->exists($job->logo)) {
            Storage::disk('public')->delete($job->logo);
        }
        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Lowongan kerja berhasil dihapus.');
    }

    public function galeriLowongan($title) {
        $job = Job::where('job_seo', $title)->firstOrFail();
        $galleries = $job->photos()->orderBy('id', 'desc')->paginate(6);

        return view('jobs.galeri', compact('job', 'galleries'));
    }
}