<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppRelease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppReleaseController extends Controller
{

    // Display a listing of the files
    public function index()
    {
        $appReleases = AppRelease::all();
        return view('admin.section.app-release.index', compact('appReleases'));
    }

    // Show the form for creating a new file
    public function create()
    {
        $data['appReleases'] = AppRelease::all();
        return view('admin.section.app-release.create', $data);
    }

    // Store a newly created file in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string',
            'version' => 'required|string|unique:app_releases',
        ]);


        $release = AppRelease::create($validated);

        if ($release) {
            return redirect()->route('admin.app-release.index')
                ->with('success', 'App release created successfully');
        }

        return redirect()->back()->with('error', 'Failed to create release');
    }


    // Remove a specific file from the database
    public function destroy($id)
    {
        $appRelease = AppRelease::findOrFail($id);

        if ($appRelease->url && Storage::disk('public')->exists($appRelease->url)) {
            Storage::disk("public")->delete($appRelease->url);
        }

        if ($appRelease && $appRelease->delete())
            return redirect()->route('admin.app-release.index')->with('success', 'file deleted successfully');

        return back()->with("error", "Failed to delete file");
    }
}
