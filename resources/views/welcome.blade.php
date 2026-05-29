<form action="/place-order" method="POST" style="margin: 20px; padding: 20px; background: #fff; border-radius: 8px;">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    
    <h3>Test Order Placement</h3>
    
    <label>Shipping Address:</label><br>
    <textarea name="shipping_address" required>123 Test Street, Gujarat</textarea><br><br>

    <input type="hidden" name="cart_items[product_id]" value="1">
    <input type="hidden" name="cart_items[quantity]" value="2">

    <button type="submit" style="background: blue; color: white; padding: 10px;">Place Test Order</button>
</form>