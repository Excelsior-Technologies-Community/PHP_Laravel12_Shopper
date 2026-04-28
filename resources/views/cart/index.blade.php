<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
</head>

<body>

    <h1>Your Cart</h1>

    <!-- Continue Shopping -->
    <a href="{{ url('/cpanel/products') }}" style="padding:10px;background:green;color:white;text-decoration:none;">
        ← Continue Shopping
    </a>

    <br><br>

    @if(session('success'))
        <div style="padding:10px; background:green; color:white; margin:10px 0;">
            {{ session('success') }}
        </div>
    @endif


    @if(session()->has('cart') && count(session('cart')) > 0)

        @php $total = 0; @endphp

        @foreach(session('cart') as $id => $item)
            <div style="border:1px solid #ddd; padding:10px; margin:10px;">

                <h3>{{ $item['name'] }}</h3>
                <p>Price: ₹{{ $item['price'] }}</p>
                <p>Qty: {{ $item['qty'] }}</p>

                @php
                    $total += $item['price'] * $item['qty'];
                @endphp

                <!-- Remove Button -->
                <a href="{{ url('/cart/remove/' . $id) }}" style="color:red;">
                    Remove
                </a>

            </div>
        @endforeach

        <h2>Total: ₹{{ $total }}</h2>

        <!-- Checkout -->
        <form method="POST" action="{{ url('/checkout') }}">
            @csrf
            <button type="submit" style="padding:10px;background:black;color:white;">
                Checkout
            </button>
        </form>

    @else

        <p>Cart is empty</p>

        <a href="{{ url('/cpanel/products') }}" style="padding:10px;background:blue;color:white;text-decoration:none;">
            Start Shopping
        </a>

    @endif

</body>

</html>