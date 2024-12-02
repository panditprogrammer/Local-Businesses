<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'max:255', 'unique:' . User::class],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dob' => ['required', 'date', 'before:2011-01-01'],
            'gender' => ['required', 'string', "in:M,F,O"],
        ]);

        // if file exists 
        $uploadedFile = null;
        if ($request->hasFile('avatar') && $file = $request->file('avatar')) {
            $uploadedFile = $file->store('uploads/users', "public");
        }


        $data['user'] = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'avatar' => $uploadedFile,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => Hash::make($request->phoneNo),
        ]);

        return response()->json(["success" => true, "message" => "Registration successfully completed", "data" => $data]);
    }


    public function show(Request $request)
    {
        $registrationNo = $request->get("registrationNo");
        if (!$registrationNo) {
            return response()->json(["success" => false, "message" => "Please provide registration number", "data" => null], 400);
        }

        // $phoneNo = $request->get("phone");
        // if (!$phoneNo) {
        //     return response()->json(["success" => false, "message" => "Please provide a phone number", "data" => null], 400);
        // }
        $user = User::where("registrationNo", $registrationNo)->first();
        if (!$user) {
            return response()->json(["success" => false, "message" => "User does not exists", "data" => null], 404);
        }

        $data['user'] = $user;
        return response()->json(["success" => true, "message" => "User retrived successfully", "data" => $data]);
    }
}
