<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomePageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSliderController extends Controller
{
    // Display a listing of the media files
    public function index()
    {
        $sliders = HomePageSlider::all();
        return view('admin.section.slider.index', compact('sliders'));
    }

    // Show the form for creating a new media file
    public function create()
    {
        $data['galleryTagEdit'] = null;
        $data['sliders'] = HomePageSlider::all();
        return view('admin.section.slider.create', $data);
    }

    // Store a newly created media file in the database
    // Store a newly created media file in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png,svg|max:2048',
            'title' => 'nullable|string|max:255', // Added max length for title
        ]);

        // Handle file upload
        if ($file = $request->file('image')) {
            // Store the uploaded file and get its path
            $uploadedFile = $file->store('uploads/sliders', "public");
            $validated['type'] = $file->getClientMimeType();

            // Check if the file was uploaded successfully
            if ($uploadedFile) {
                $uploadslider = HomePageSlider::create([
                    'image' => $uploadedFile,
                    'title' => $validated['title'],
                ]);

                if ($uploadslider) {
                    return redirect()->route('admin.sliders.index')
                        ->with('success', 'File uploaded successfully');
                }
            } else {
                return redirect()->back()->with('error', 'Failed to store uploaded file');
            }
        }

        // If the upload fails, return error message
        return redirect()->back()->with('error', 'Failed to upload file');
    }

  
    // Display a specific media file
    public function show($id)
    {
        $slider = HomePageSlider::findOrFail($id);
        if (!$slider)
            return back()->with("error", "Media file not found");

        return view('admin.section.slider.show', compact('slider'));
    }

    // Show the form for editing a specific media file
    public function edit($id)
    {
        $sliders = HomePageSlider::all();
        $slider = HomePageSlider::findOrFail($id);
        if (!$slider)
            return back()->with("error", "Media file not found");

        return view('admin.section.slider.edit', compact('slider','sliders'));
    }


    public function changeStatus($id)
    {
        $slider = HomePageSlider::findOrFail($id);
        if ($slider) {
            $slider->status = !$slider->status;
            $slider->save();
            return back()->with("success", "Status changed successfully");
        }

        return redirect()->route('admin.sliders.index')->with('error', 'Media File not found.');
    }

    // Update a specific media file in the database
    // Update an existing media file entry in the database
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
            'title' => 'nullable|string|max:255', 
        ]);

        $slider = HomePageSlider::findOrFail($id);

        if ($slider && $file = $request->file('image')) {
            // Delete the old file if it exists
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk("public")->delete($slider->image);
            }
            $uploadedFile = $file->store('uploads/sliders', "public");
            $slider->image = $uploadedFile;
        }

        // Update other fields (title)
        $slider->title = $validated['title'];

        // Save the updated entry
        if ($slider->save()) {
            return redirect()->back()->with('success', 'Media file updated successfully');
        }

        // If the update fails, return an error message
        return redirect()->back()->with('error', 'Failed to update media file');
    }

    

    // Remove a specific media file from the database
    public function destroy($id)
    {
        $slider = HomePageSlider::findOrFail($id);

        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk("public")->delete($slider->image);
        }

        if ($slider && $slider->delete())
            return redirect()->route('admin.sliders.index')->with('success', 'Media file deleted successfully');

        return back()->with("error", "Failed to delete media file");
    }

}
