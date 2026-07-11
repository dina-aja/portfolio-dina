<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return redirect('/dashboard');
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'demo' => 'required|url',
        ], [
    
            // Pesan Error
            'title.required' => 'Judul project wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
    
            'description.required' => 'Deskripsi wajib diisi.',
            'description.min' => 'Deskripsi minimal 10 karakter.',
    
            'image.required' => 'Gambar wajib diupload.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
    
            'demo.required' => 'Link Demo wajib diisi.',
            'demo.url' => 'Link Demo harus berupa URL.',
        ]);
    
        // Upload gambar
        $image = $request->file('image')->store('projects', 'public');
    
        // Simpan data
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'demo' => $request->demo,
        ]);
    
        return redirect('/dashboard')
            ->with('success', 'Project berhasil ditambahkan');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // Validasi
        $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10',
            'demo' => 'required|url',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
    
            'title.required' => 'Judul project wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
    
            'demo.required' => 'Link Demo wajib diisi.',
            'demo.url' => 'Link Demo harus berupa URL.',
    
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpg, jpeg, atau png.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    
        // Jika upload gambar baru
        if ($request->hasFile('image')) {
    
            $imagePath = $request->file('image')->store('projects', 'public');
    
            $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'demo' => $request->demo,
            ]);
    
        } else {
    
            $project->update([
                'title' => $request->title,
                'description' => $request->description,
                'demo' => $request->demo,
            ]);
        }
    
        return redirect('/dashboard')
            ->with('success', 'Project berhasil diupdate');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/dashboard')
        ->with('success', 'Project berhasil dihapus');
    }
}