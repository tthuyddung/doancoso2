<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $messages = DB::table('messages')->get();
        return view('auth.messages', compact('messages'));
    }

    public function delete($id)
    {
        DB::table('messages')->where('id', $id)->delete();
        return redirect()->route('messages.index')->with('success', 'Message deleted successfully');
    }
    public function store(Request $request)
{
    // Kiểm tra dữ liệu đầu vào
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'number' => 'required|string|max:20', // Thêm cột 'number'
        'message' => 'required|string|max:255',
    ]);

    // Lưu tin nhắn vào cơ sở dữ liệu
    DB::table('messages')->insert([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'number' => $request->input('number'), // Lưu số điện thoại
        'message' => $request->input('message'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('messages.index')->with('success', 'Message added successfully');
}



    
}
