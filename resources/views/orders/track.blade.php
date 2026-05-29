<!DOCTYPE html>
<html>
<head>
    <title>Track Order - #{{ $order->order_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    @php
        $status = $order->status;
        $dot1 = in_array($status, ['Pending', 'Processing', 'Shipped', 'Delivered']) ? 'bg-green-500' : 'bg-gray-300';
        $dot2 = in_array($status, ['Processing', 'Shipped', 'Delivered']) ? 'bg-green-500' : 'bg-gray-300';
        $dot3 = in_array($status, ['Shipped', 'Delivered']) ? 'bg-green-500' : 'bg-gray-300';
        $dot4 = $status === 'Delivered' ? 'bg-green-500' : 'bg-gray-300';
    @endphp

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">
        <h1 class="text-2xl font-bold mb-4">Order Tracking</h1>
        <p class="text-gray-600 mb-6">Order Number: <span class="font-semibold text-black">#{{ $order->order_number }}</span></p>

        <div class="flex flex-col gap-4 mb-8">
            <div class="flex items-center gap-3">
                <div class="w-4 h-4 rounded-full {{ $dot1 }}"></div>
                <span class="text-sm font-medium">Order Placed & Pending</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-4 h-4 rounded-full {{ $dot2 }}"></div>
                <span class="text-sm font-medium">Processing</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-4 h-4 rounded-full {{ $dot3 }}"></div>
                <span class="text-sm font-medium">Shipped</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-4 h-4 rounded-full {{ $dot4 }}"></div>
                <span class="text-sm font-medium">Delivered</span>
            </div>
        </div>

        <a href="/orders" class="text-blue-600 hover:underline">Back to Orders</a>
    </div>
</body>
</html>