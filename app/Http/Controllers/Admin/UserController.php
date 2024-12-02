<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $authUser = auth("adminGuard")->user();
        $search = $request->search;
        $data['search'] = $search;
        if ($search) {
            $query = User::query();

            // If the authenticated user is a manager, limit users by admin_id
            if ($authUser->role === "manager") {
                $query->where('admin_id', $authUser->id);
            }

            // Apply search conditions
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('village', 'like', "%{$search}%")
                    ->orWhere('wardNo', 'like', "%{$search}%")
                    ->orWhere('boothNo', 'like', "%{$search}%")
                    ->orWhere('panchayat', 'like', "%{$search}%");
            });

            // final 
            $data['users'] = $query->paginate(25);
        } else {
            if ($authUser->role === "manager") {
                $data['users'] = User::where('admin_id', $authUser->id)->latest()->paginate(25);
            } else {
                $data['users'] = User::latest()->paginate(25);
            }
        }

        return view("admin.section.user.index", $data);
    }

    public function create()
    {
        return view("admin.section.user.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'dob' => 'required|date|before:2011-01-01',
            'gender' => 'required|in:M,F,O',
            'phoneNo' => 'required|numeric|unique:users,phoneNo',
            'whatsappNo' => 'nullable|numeric',
            'email' => 'nullable|email|unique:users,email',
        ]);

        // if file exists 
        $uploadedFile = null;
        if ($request->hasFile('avatar') && $file = $request->file('avatar')) {
            $uploadedFile = $file->store('uploads/users', "public");
        }

        $validated['password'] = Hash::make($request->dob);
        // add admin user id 
        $validated['avatar'] = $uploadedFile;
        $validated['admin_id'] = auth('adminGuard')->id();

        $user = User::create($validated);
        if ($user) {
            return redirect()->back()->with('success', 'Registration successfull');
        }

        return redirect()->back()->with('error', 'Failed to register');
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        $authUser = auth('adminGuard')->user();
        if ($authUser->role === "manager" && !$user->isCreated()) {
            return abort(403, "unauthorized access");
        }

        $data['user'] = $user;
        return view("admin.section.user.show", $data);
    }

    public function edit($id)
    {
        $data['user'] = User::findOrFail($id);
        return view("admin.section.user.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|mimes:jpg,png,jpeg|max:1024',
            'dob' => 'required|date|before:2011-01-01',
            'gender' => 'required|in:M,F,O',
            'phoneNo' => 'required|numeric|unique:users,phoneNo,' . $id,
            'whatsappNo' => 'nullable|numeric',
            'email' => 'nullable|email|unique:users,email,' . $id,
        ]);


        $uploadedFile = $request->avatar;
        if ($request->hasFile('avatar') && $file = $request->file('avatar')) {
            // Delete old avatar if a new one is uploaded
            if ($uploadedFile && Storage::disk('public')->exists($uploadedFile)) {
                Storage::disk("public")->delete($uploadedFile);
            }
            $uploadedFile = $file->store('users', "public");
            $validated['avatar'] = $uploadedFile;
        }

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'Information updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user && $user->delete()) {
            return redirect()->route('admin.users.index')->with('success', 'Record deleted successfully.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Failed to delete record.');
    }


    public function discussion()
    {
        return view("admin.section.user.discussion");
    }



    public function export()
    {
        if (auth('adminGuard')->user()->role !== 'super') {
            return back()->with('error', 'you do not have access to this page');
        }
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Automatically get column names from the User model
            $columns = (new User)->getFillable();
            $columns = array_filter($columns, function ($column) {
                return $column !== 'password'; // Exclude password
            });

            fputcsv($handle, $columns);
            // Fetch all users
            $users = User::all();
            foreach ($users as $user) {
                fputcsv($handle, $user->only($columns));
            }

            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
        ]);
    }
}
