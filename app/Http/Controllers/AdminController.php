<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\admin;
use Illuminate\Support\Facades\Log;
use App\Models\Order; 


class AdminController extends Controller
{
    public function dashboard()
{
    // Kiểm tra xem admin đã đăng nhập hay chưa
    if (!Session::has('admin_id')) {
        return redirect()->route('login'); // Chuyển hướng nếu chưa đăng nhập
    }
    
    // Lấy thông tin profile của admin
    $admin_id = session('admin_id'); // Lấy ID admin từ session
    $profile = DB::table('admins')->where('id', $admin_id)->first(); // Lấy thông tin admin

    // Lấy số lượng tin nhắn
    $numberOfMessages = DB::table('messages')->count(); // Lấy số lượng tin nhắn
    $totalPendings = DB::table('orders')->where('payment_status', 'pending')->sum('total_price');
    $totalCompletes = DB::table('orders')->where('payment_status', 'completed')->sum('total_price');
    $numberOfOrders = DB::table('orders')->count();
    $numberOfProducts = DB::table('products')->count();
    $numberOfUsers = DB::table('users')->count();
    $numberOfAdmins = DB::table('admins')->count();
    
    // Truyền dữ liệu đến view dashboard
    return view('auth.dashboard', compact(
        'profile',
        'totalPendings',
        'totalCompletes',
        'numberOfOrders',
        'numberOfProducts',
        'numberOfUsers',
        'numberOfAdmins',
        'numberOfMessages' // Thêm số lượng tin nhắn vào view
    ));
}

public function edit()
{
    // Nếu đang dùng Auth guard cho admin
    $admin = Auth::guard('admin')->user();

    // Nếu không tìm thấy admin trong Auth, thử session
    if (!$admin) {
        $admin_id = session('admin_id');
        $admin = DB::table('admins')->where('id', $admin_id)->first();
    }

    // Nếu vẫn không có admin, chuyển hướng về trang đăng nhập
    if (!$admin) {
        return redirect()->route('login')->withErrors(['message' => 'Bạn cần đăng nhập để cập nhật thông tin cá nhân.']);
    }

    // Ghi lại thông tin admin vào log
    Log::info('Admin:', ['id' => $admin->id, 'name' => $admin->name]);

    // Trả về view với thông tin admin
    return view('auth.update_profile', compact('admin'));
}




public function update(Request $request)
{
    $admin = Auth::guard('admin')->user();

    if (!$admin) {
        return redirect()->route('login')->withErrors(['login' => 'Bạn cần đăng nhập để thực hiện hành động này.']);
    }

    $request->validate([
        'name' => 'required|string|max:20',
        'old_pass' => 'nullable|string|max:20',
        'new_pass' => 'nullable|string|confirmed|max:20',
    ]);

    $admin->name = $request->name;

    if ($request->filled('old_pass') && $request->filled('new_pass')) {
        if (Hash::check($request->old_pass, $admin->password)) {
            $admin->password = Hash::make($request->new_pass);
            Log::info('Password updated for admin:', [$admin->id]);
        } else {
            return redirect()->route('auth.updateProfile')->withErrors(['old_pass' => 'Old password does not match!']);
        }
    }

    $admin->save();
    return redirect()->route('auth.updateProfile')->with('message', 'Profile updated successfully!');
}




    public function products()
    {
        // Kiểm tra xem admin đã đăng nhập hay chưa
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login'); // Chuyển hướng nếu chưa đăng nhập
        }

        // Lấy tất cả sản phẩm từ cơ sở dữ liệu
        $products = DB::table('products')->get();

        // Truyền dữ liệu đến view products
        return view('auth.products', compact('products'));
    }

    public function users()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $users = DB::table('users')->get();
        return view('auth.users', compact('users'));
    }

    public function admins()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $admins = DB::table('admins')->get();
        return view('auth.admins', compact('admins'));
    }

    public function messages()
    {
        if (!Session::has('admin_id')) {
            return redirect()->route('admin.login');
        }

        $messages = DB::table('messages')->get();
        return view('auth.messages', compact('messages'));
    }

    public function showRegisterForm()
    {
        // Trả về view đăng ký
        return view('auth.register_admin');
    }

    public function register(Request $request)
    {
        // Xác thực dữ liệu từ yêu cầu
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed', // Sử dụng 'confirmed' để xác nhận mật khẩu
        ]);

        // Nếu xác thực thành công, tiến hành tạo admin
        DB::table('admins')->insert([
            'name' => $request->name,
            'password' => Hash::make($request->password), // Lưu mật khẩu đã mã hóa
        ]);

        return redirect()->route('auth.login')->with('success', 'Admin registered successfully!');
    }

    public function showRevenueChart()
    {
        // Lấy tổng doanh thu theo từng ngày
        $revenueData = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total_revenue')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Chuẩn bị dữ liệu cho biểu đồ
        $dates = $revenueData->pluck('date')->toArray();
        $revenues = $revenueData->pluck('total_revenue')->toArray();

        return view('auth.revenue_chart', compact('dates', 'revenues'));
    }




}
