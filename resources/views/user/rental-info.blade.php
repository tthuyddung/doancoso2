@extends('layouts.on')

@section('content')
<div class="containerr">
    <!-- Thông tin sản phẩm -->
    <div class="product-details">
        <h3>Thông tin sản phẩm</h3>
        <div class="product">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; border-radius: 10px;">
            <h4>{{ $product->name }}</h4>
            <p>Giá thuê mỗi giờ: <span id="hourly_price" data-price="{{ $product->price }}">{{ number_format($product->price, 0, ',', '.') }}</span> VNĐ</p>
        </div>
    </div>

    <!-- Form thuê xe -->
    <div class="rental-form">
        <h3>Thông tin thuê xe</h3>
        <form action="{{ route('storeRentalDetails', $product->id) }}" method="POST">
            @csrf
            <div class="flex">
                <div class="inputBox">
                    <span>Tên của bạn:</span>
                    <input type="text" name="name" placeholder="Nhập tên" required>
                </div>
                <div class="inputBox">
                    <span>Số điện thoại:</span>
                    <input type="text" name="number" placeholder="Nhập số điện thoại" required>
                </div>
                <div class="inputBox">
                    <span>Email:</span>
                    <input type="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="inputBox">
                    <span>Phương thức thanh toán:</span>
                    <select name="method" required>
                        <option value="cash on delivery">Thanh toán khi nhận</option>
                        <option value="credit card">Thẻ tín dụng</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Nơi đến:</span>
                    <input type="text" name="destination" placeholder="Địa điểm" required>
                </div>
                <div class="inputBox">
                    <span>Số giờ thuê:</span>
                    <input type="number" name="rental_hours" id="rental_hours" min="1" value="1" required>
                </div>
                <div class="inputBox">
                    <span>Địa chỉ:</span>
                    <textarea name="address" placeholder="Nhập địa chỉ" required></textarea>
                </div>
            </div>

            <!-- Tổng tiền -->
            <div class="inputBox">
                <h4>Tổng tiền:</h4>
                <p id="total_price">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
            </div>

            <input type="submit" value="Tiếp tục" class="btn">
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.addEventListener('DOMContentLoaded', function () {
    const rentalHoursInput = document.getElementById('rental_hours');
    const totalPriceElement = document.getElementById('total_price');
    const hourlyPriceElement = document.getElementById('hourly_price');  // Không cần thiết nếu bạn không có phần tử này, có thể bỏ qua

    // Lấy giá thuê mỗi giờ từ thẻ 'p' có id 'hourly_price' hoặc giá mặc định từ PHP
    const hourlyPrice = parseInt(hourlyPriceElement ? hourlyPriceElement.textContent.replace(/\./g, '') : '{{ $product->price }}', 10);

    // Hàm tính toán và cập nhật tổng tiền
    function updateTotalPrice() {
        const rentalHours = parseInt(rentalHoursInput.value, 10);
        if (isNaN(rentalHours) || rentalHours < 1) {
            totalPriceElement.textContent = '0 VNĐ';
            return;
        }

        // Tính tổng tiền
        const totalPrice = rentalHours * hourlyPrice;
        totalPriceElement.textContent = totalPrice.toLocaleString('vi-VN') + ' VNĐ';
    }

    // Lắng nghe sự kiện thay đổi số giờ thuê
    rentalHoursInput.addEventListener('input', updateTotalPrice);

    // Cập nhật tổng tiền khi trang được tải
    updateTotalPrice();
});


</script>
@endsection
