<?php

namespace App\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Admin;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20',
            'pass' => 'required|string|max:20',
        ]);

        $name = filter_var($request->input('name'), FILTER_SANITIZE_SPECIAL_CHARS);
        $pass = $request->input('pass');

        Log::info('Login attempt', ['name' => $name]);

        // Lấy thông tin admin từ model Admin
        $admin = Admin::where('name', $name)->first();

        if ($admin) {
            Log::info('Admin found', ['admin_id' => $admin->id]);
        } else {
            Log::warning('Admin not found', ['name' => $name]);
        }

        // Kiểm tra mật khẩu
        if ($admin && Hash::check($pass, $admin->password)) {
            Log::info('Login successful', ['admin_id' => $admin->id]);
            Auth::guard('admin')->login($admin);
            Session::put('admin_id', $admin->id);
            Session::put('admin_name', $admin->name);
            return redirect()->route('auth.dashboard');
        } else {
            Log::warning('Login failed - password mismatch', ['name' => $name]);
        }

        return back()->withErrors(['message' => 'Incorrect username or password!']);
    }

    public function logout()
    {
        // Đăng xuất người dùng
        Auth::logout();

        // Hủy session
        session()->invalidate(); // Đảm bảo phiên làm việc bị hủy
        session()->regenerateToken(); // Tạo lại token CSRF

        // Điều hướng về trang login
        return redirect()->route('login');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        
        $admin = Admin::where('email', $facebookUser->getEmail())->first();
        
        if (!$admin) {
            // Nếu chưa có tài khoản admin, tạo mới
            $admin = Admin::create([
                'name' => $facebookUser->getName(),
                'email' => $facebookUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        Auth::login($admin);

        return redirect()->route('admin.dashboard'); // Chuyển đến trang dashboard sau khi đăng nhập
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        
        $admin = Admin::where('email', $googleUser->getEmail())->first();
        
        if (!$admin) {
            // Nếu chưa có tài khoản admin, tạo mới
            $admin = Admin::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
            ]);
        }

        Auth::login($admin);

        return redirect()->route('auth.dashboard'); // Chuyển đến trang dashboard sau khi đăng nhập
    }
}
