<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">My Orders</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="bg-white p-6 rounded-xl shadow text-center text-gray-500">
                No orders found.
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach($orders as $order)
                    <div class="bg-white p-6 rounded-xl shadow">
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <p class="font-semibold text-lg">#{{ $order->order_number }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, h:i A') }}</p>
                            </div>
                            <div>
                                @php
                                    $statusColors = [
                                        'Pending'    => 'bg-yellow-100 text-yellow-800',
                                        'Processing' => 'bg-blue-100 text-blue-800',
                                        'Shipped'    => 'bg-purple-100 text-purple-800',
                                        'Delivered'  => 'bg-green-100 text-green-800',
                                        'Cancelled'  => 'bg-red-100 text-red-800',
                                    ];
                                    $colorClass = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $colorClass }}">
                                    {{ $order->status }}
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <p class="text-gray-700 font-medium">Total: ₹{{ $order->total_amount }}</p>
                            <div class="flex gap-3">
                                <a href="/orders/{{ $order->id }}/track"
                                   class="text-sm text-blue-600 hover:underline">
                                    Track Order
                                </a>
                                <a href="/orders/{{ $order->id }}/invoice"
                                   class="text-sm text-gray-600 hover:underline">
                                    Download Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>