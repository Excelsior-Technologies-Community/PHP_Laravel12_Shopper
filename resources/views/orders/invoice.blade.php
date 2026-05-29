<!DOCTYPE html>
<html>
<head>
    <title>Invoice - {{ $order->order_number }}</title>
    <style>
        body { font-family: sans-serif; padding: 30px; color: #333; }
        .invoice-box { max-width: 800px; margin: auto; }
        .header { border-bottom: 2px solid #ddd; padding-bottom: 20px; margin-bottom: 20px; }
        .title { font-size: 28px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
        .total { text-align: right; font-size: 18px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div class="header">
            <span class="title">INVOICE</span>
            <p>Order Number: #{{ $order->order_number }}</p>
            <p>Date: {{ $order->created_at->format('Y-m-d') }}</p>
        </div>

        <h3>Shipping Address:</h3>
        <p>{{ $order->shipping_address }}</p>

        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ $item->price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total Amount: ₹{{ $order->total_amount }}
        </div>
    </div>
</body>
</html>