@if (isset($products) && count($products) > 0)
    <div class="product-list">
        @foreach ($products as $product)
            <div class="product-item">
                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image">
                <h3>{{ $product->name }}</h3>
                <p>Price: ${{ $product->price }}</p>
                <div class="details">
                    {{ $product->details }}
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No products added yet.</p>
@endif
