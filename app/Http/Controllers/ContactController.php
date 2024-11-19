<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('user.contact');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:50',
            'number' => 'required|numeric|digits_between:1,10',
            'msg' => 'required|string',
        ]);

        $user_id = Auth::id() ?? null;

        // Kiểm tra tin nhắn đã tồn tại chưa
        $existingMessage = Message::where('name', $request->name)
            ->where('email', $request->email)
            ->where('number', $request->number)
            ->where('message', $request->msg)
            ->first();

        if ($existingMessage) {
            return redirect()->back()->with('message', 'already sent message!');
        }

        // Lưu tin nhắn mới
        Message::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'message' => $request->msg,
        ]);

        return redirect()->back()->with('message', 'sent message successfully!');
    }
}
