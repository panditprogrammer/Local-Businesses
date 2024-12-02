<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $data['search'] = $search;
        if ($search) {
            $data['admins'] = Admin::where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->paginate(25);
        } else {
            $data['admins'] = Admin::where('role','!=','super')->latest()->paginate(25);
        }

        return view("admin.section.admin.index", $data);
    }

    public function create()
    {
        return view("admin.section.admin.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'boothNo' => 'required|string',
            'email' => 'nullable|email|unique:admins,email',
            'phoneNumber' => 'required|numeric|unique:admins,phoneNumber',
            'password' => 'required|string|min:8',
        ]);


        $validated['password'] = Hash::make($request->password);
        $admin = Admin::create($validated);
        if ($admin) {
            return redirect()->back()->with('success', 'user created successfully');
        }

        return redirect()->back()->with('error', 'Failed to register');
    }


    public function show($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view("admin.section.admin.show", $data);
    }

    public function edit($id)
    {
        $data['admin'] = Admin::findOrFail($id);
        return view("admin.section.admin.edit", $data);
    }


    

    public function changeStatus($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin) {
            $admin->status = !$admin->status;
            $admin->save();
            return back()->with("success", "Status changed successfully");
        }

        return back()->with('error', 'Admin not found');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'boothNo' => 'required|string',
            'phoneNumber' => 'required|numeric|unique:admins,phoneNumber,' . $id,
            'email' => 'nullable|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);

        if($request->has('password')){
            $validated['password'] = $request->password;
        }else{
            unset($validated['password']);
        }

        $admin = Admin::findOrFail($id);

        $admin->update($validated);

        return redirect()->route('admin.admins.index')->with('success', 'Information updated successfully.');
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        if ($admin && $admin->delete()) {
            return redirect()->route('admin.admins.index')->with('success', 'Record deleted successfully.');
        }
        return redirect()->route('admin.admins.index')->with('error', 'Failed to delete record.');
    }



    public function export()
    {
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // Automatically get column names from the User model
            $columns = (new Admin)->getFillable();
            $columns = array_filter($columns, function ($column) {
                return $column !== 'password'; // Exclude password
            });

            fputcsv($handle, $columns);
            // Fetch all users
            $admins = Admin::where('role','manager')->get();
            foreach ($admins as $admin) {
                fputcsv($handle, $admin->only($columns));
            }

            fclose($handle);
        }, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=admins.csv",
        ]);
    }
}
