@extends('layouts.app')



@section('content')
    <h1>Danh sách sản phẩm</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="product-list">
        @if ($products->count() > 0)
            @foreach ($products as $product)
                <div class="product-item">
                    <img src="{{ asset('images/' . $product->image) }}" alt="Product Image">
                    <h3>{{ $product->name }}</h3>
                    <p>Price: ${{ $product->price }}</p>
                    <p>{{ \Illuminate\Support\Str::limit($product->details, 100) }}</p>
                    <a href="{{ route('auth.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
                    <form action="{{ route('auth.destroy', $product->id) }}" method="POST">
  @csrf
  @method('DELETE')  <a href="{{ route('auth.edit', $product->id) }}" class="btn btn-primary">Sửa</a>
  <button type="submit" class="btn btn-danger btn-delete">Xóa</button>
</form>
            @endforeach
        @else
            <p>Không có sản phẩm nào.</p>
        @endif
    </div>
@endsection


