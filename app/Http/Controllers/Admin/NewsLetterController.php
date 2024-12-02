<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsLetter;
use Illuminate\Http\Request;

class NewsLetterController extends Controller
{
    // Display a listing of the categories.
    public function index()
    {
        $newsletters = NewsLetter::paginate(25);
        return view('admin.section.newsletter.index', compact('newsletters'));
    }

    // Show the form for creating a new News Letter.
    public function create()
    {
        $newsletters = NewsLetter::latest()->take(5);
        return view('admin.section.newsletter.create', compact('newsletters'));
    }

    // Store a newly created News Letter in storage.
    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|unique:news_letters|required_without_all:email',
            'email' => 'nullable|email|unique:news_letters|required_without_all:phone',
        ]);

        NewsLetter::create([
            'email' => strtolower($request->email),
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.newsletters.index')->with('success', 'News Letter created successfully!');
    }

    // Show the form for editing the specified News Letter.
    public function edit($id)
    {
        $newsletter = NewsLetter::findOrFail($id);

        if ($newsletter) {
            return view('admin.section.newsletter.edit', compact('newsletter'));
        }

        return redirect()->route('admin.newsletters.index')->with('error', 'News Letter not found.');
    }


    public function changeStatus($id)
    {
        $newsletter = NewsLetter::findOrFail($id);
        if ($newsletter) {
            $newsletter->status = !$newsletter->status;
            $newsletter->save();
            return back()->with("success", "Status changed successfully");
        }

        return redirect()->route('admin.newsletters.index')->with('error', 'News Letter not found.');
    }

    // Update the specified News Letter in storage.
    public function update(Request $request, $id)
    {
        $newsletter = NewsLetter::findOrFail($id);

        if ($newsletter) {
            $request->validate([
                'phone' => [
                    'nullable',
                    'unique:news_letters,phone,' . $newsletter->id, // Ignore the current record
                    'required_without_all:email',
                ],
                'email' => [
                    'nullable',
                    'email',
                    'unique:news_letters,email,' . $newsletter->id, // Ignore the current record
                    'required_without_all:phone',
                ],
            ]);
            

            $newsletter->update($request->all());

            return redirect()->route('admin.newsletters.index')->with('success', 'News Letter updated successfully!');
        }

        return redirect()->route('admin.newsletters.index')->with('error', 'News Letter not found.');
    }

    // Remove the specified News Letter from storage.
    public function destroy($id)
    {
        $newsletter = NewsLetter::findOrFail($id);

        if ($newsletter) {
            $newsletter->delete();
            return redirect()->route('admin.newsletters.index')->with('success', 'News Letter deleted successfully!');
        }

        return redirect()->route('admin.newsletters.index')->with('error', 'News Letter not found.');
    }
}
