<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ShopEasy - Order Checkout</title>
    <link rel="stylesheet" href="order_style.css">
</head>
<body>
<div class="checkout-container">
    <h2>Order Checkout</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input safely
        $fullname = htmlspecialchars($_POST['fullname']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $city = htmlspecialchars($_POST['city']);
        $zipcode = htmlspecialchars($_POST['zipcode']);
        $payment = htmlspecialchars($_POST['payment']);
        $orderDate = date("Y-m-d H:i:s");

        // Generate a simple random tracking/order ID
        $orderId = "ORD" . rand(10000, 99999);

        // Prepare text to write in file
        $orderDetails = "Order ID: $orderId\n" .
                        "Name: $fullname\n" .
                        "Email: $email\n" .
                        "Phone: $phone\n" .
                        "Address: $address, $city - $zipcode\n" .
                        "Payment Method: $payment\n" .
                        "Order Date: $orderDate\n" .
                        "---------------------------------------------\n";

        // Save order details to file
        $file = fopen("orders.txt", "a");
        fwrite($file, $orderDetails);
        fclose($file);

        // Confirmation message
        echo "
        <div class='order-confirmation'>
            <h3>Thank you, $fullname!</h3>
            <p>Your order has been placed successfully.</p>
            <p><strong>Order ID:</strong> $orderId</p>
            <p>We'll deliver to: <strong>$address, $city - $zipcode</strong></p>
            <p>Payment Method: <strong>$payment</strong></p>
            <a href='track.php?order=$orderId' class='track-btn'>Track Order</a>
            <br><br>
            <a href='index.html' class='track-btn'>Return to Home</a>
        </div>";
    } else {
    ?>

    <!-- Checkout Form -->
    <form method="POST" action="">
        <label>Full Name:</label>
        <input type="text" name="fullname" required>

        <label>Email Address:</label>
        <input type="email" name="email" required>

        <label>Phone Number:</label>
        <input type="text" name="phone" required>

        <label>Delivery Address:</label>
        <textarea name="address" rows="2" required></textarea>

        <label>City:</label>
        <input type="text" name="city" required>

        <label>Zip Code:</label>
        <input type="text" name="zipcode" required>

        <label>Payment Method:</label>
        <select name="payment" required>
            <option>Cash on Delivery</option>
            <option>Credit / Debit Card</option>
            <option>UPI / Net Banking</option>
        </select>

        <div class="btn-group">
            <input type="submit" value="Place Order">
            <input type="reset" value="Clear">
        </div>
    </form>

    <p><a href="index.html">⬅ Back to Home</a></p>

    <?php } ?>
</div>
</body>
</html>
