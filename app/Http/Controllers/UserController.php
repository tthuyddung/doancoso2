<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // Make sure to create this model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $admins = Admin::all(); // Fetch all admin accounts
        return view('admin.admin_accounts', compact('admins'));
    }

    public function create()
    {
        return view('admin.register_admin'); // Create a view for registering a new admin
    }

    public function store(Request $request)
    {
        // Validate and create a new admin
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.accounts')->with('message', 'Admin registered successfully!');
    }

    public function destroy($id)
    {
        Admin::destroy($id); // Delete the admin account
        return redirect()->route('admin.accounts')->with('message', 'Admin account deleted successfully!');
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Xử lý cập nhật thông tin người dùng
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'old_pass' => 'nullable|string',
            'new_pass' => 'nullable|string|min:6',
            'cpass' => 'nullable|string|same:new_pass',
        ]);

        // Cập nhật tên và email
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Xử lý cập nhật mật khẩu
        if ($request->filled('old_pass')) {
            if (Hash::check($request->old_pass, $user->password)) {
                if ($request->new_pass) {
                    $user->password = Hash::make($request->new_pass);
                    $user->save();
                    return back()->with('success', 'Password updated successfully!');
                } else {
                    return back()->with('error', 'Please enter a new password!');
                }
            } else {
                return back()->with('error', 'Old password not matched!');
            }
        }

        return back()->with('success', 'Profile updated successfully!');
    }
}
