<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendEveryOne;
use App\Models\Message;
use App\Models\NewsLetter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{

    // send bulk emails among all public
    public function sendEmailEveryOne(Request $request)
    {
        $request->validate([
            "subject" => "required|string",
            "message" => "required|string",
        ]);


        if (!env('MAIL_USERNAME', null)) {
            return redirect()->back()->with("warning", "ADMIN: Mail configuration not found!")->withInput($request->all());
        }

        try {
            $emails = User::pluck('email')->toArray();
            $emailCount = count($emails);
            if (!$emailCount) {
                return back()->with("error", "No receiver email found");
            }
            foreach ($emails as $email) {
                Mail::to($email)->send(new SendEveryOne((object) $request->all()));
            }

            // Check for any failures
            if (method_exists(Mail::class, 'failures') && count(Mail::failures()) > 0) {
                return redirect()->back()->with("error", "Failed to send email! Please try again later.")->withInput($request->all());
            }

            return redirect()->back()->with("success", "Your email has been sent among " . $emailCount . " peoples");
        } catch (\Throwable $th) {
            // Log::error('Mail sending error: ' . $th->getMessage());
            return redirect()->back()->with("error", "Something went wrong!")->withInput($request->all());
        }
    }


    // Display a listing of the categories.
    public function index()
    {
        $messages = Message::paginate(25);
        return view('admin.section.message.index', compact('messages'));
    }

    // Show the form for creating a new Message.
    public function create()
    {
        $messages = Message::latest()->take(5);
        return view('admin.section.message.create', compact('messages'));
    }

    // Store a newly created Message in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            // 'phone' => 'nullable|unique:messages|required_without_all:email',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            // 'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Message Sent successfully!');
    }

    // Show the form for editing the specified Message.
    public function edit($id)
    {
        $message = Message::findOrFail($id);

        if ($message) {
            return view('admin.section.message.edit', compact('message'));
        }

        return redirect()->route('admin.messages.index')->with('error', 'Message not found.');
    }


    public function changeStatus($id)
    {
        $message = Message::findOrFail($id);
        if ($message) {
            $message->status = !$message->status;
            $message->save();
            return back()->with("success", "Status changed successfully");
        }

        return redirect()->route('admin.messages.index')->with('error', 'Message not found.');
    }

    // Update the specified Message in storage.
    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        if ($message) {
            $request->validate([
                'name' => "required|string|max:50",
                // 'phone' => [
                //     'nullable',
                //     'unique:messages,phone,' . $message->id, // Ignore the current record
                //     'required_without_all:email',
                // ],
                'email' => [
                    'nullable',
                    'email',
                    'unique:messages,email,' . $message->id, // Ignore the current record
                    'required_without_all:phone',
                ],
                'message' => "required|string",

            ]);


            $message->update($request->all());

            return redirect()->route('admin.messages.index')->with('success', 'Message updated successfully!');
        }

        return redirect()->route('admin.messages.index')->with('error', 'Message not found.');
    }

    // Remove the specified Message from storage.
    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        if ($message) {
            $message->delete();
            return redirect()->route('admin.messages.index')->with('success', 'Message deleted successfully!');
        }

        return redirect()->route('admin.messages.index')->with('error', 'Message not found.');
    }
}
