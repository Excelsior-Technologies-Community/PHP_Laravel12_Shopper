<!DOCTYPE html>
<html>
<head>
    <title>All Reviews</title>
</head>
<body>
    <h2>Product Reviews</h2>
    
    @if($reviews->isEmpty())
        <p style="color: red;">No reviews found! Please submit a review first.</p>
    @else
        @foreach($reviews as $review)
            <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;">
                <p><strong>User:</strong> {{ $review->user->full_name ?? $review->user->name ?? 'Unknown User' }}</p>
                <p><strong>Rating:</strong> {{ $review->rating }} Stars</p>
                <p><strong>Comment:</strong> {{ $review->comment }}</p>
            </div>
        @endforeach
    @endif
</body>
</html>