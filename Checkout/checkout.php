<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "database checkoutsystem"; 


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullName = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $occasionDate = $conn->real_escape_string($_POST['occationDate']);
    $agreedToTerms = isset($_POST['terms']) ? 1 : 0;

 
    $totalQuantity = isset($_POST['totalQuantity']) ? intval($_POST['totalQuantity']) : 0;
    $totalPrice = isset($_POST['totalPrice']) ? floatval($_POST['totalPrice']) : 0;

    
    $cartData = isset($_POST['cartData']) ? json_decode($_POST['cartData'], true) : [];
    $productNames = implode(', ', array_column($cartData, 'name')); // Extract product names

   
    $proofOfPayment = '';
    if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        $proofOfPayment = $uploadDir . basename($_FILES['imageUpload']['name']);
        if (!move_uploaded_file($_FILES['imageUpload']['tmp_name'], $proofOfPayment)) {
            die("File upload failed.");
        }
    }


    $stmt = $conn->prepare("INSERT INTO customers (FullName, PhoneNumber, Email, Address, AgreedToTerms) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $fullName, $phone, $email, $address, $agreedToTerms);

    if ($stmt->execute()) {
        $customerID = $stmt->insert_id;

        
        $stmtOrder = $conn->prepare("INSERT INTO orders (CustomerID, OccasionDate, TotalQuantity, TotalPrice, ProductNames, ProofOfPaymentPath) VALUES (?, ?, ?, ?, ?, ?)");
        $stmtOrder->bind_param("isidss", $customerID, $occasionDate, $totalQuantity, $totalPrice, $productNames, $proofOfPayment);

        if ($stmtOrder->execute()) {
            echo "Order placed successfully!";
        } else {
            echo "Error placing order: " . $stmtOrder->error;
        }
        $stmtOrder->close();
    } else {
        echo "Error saving customer: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <div class="checkoutLayout">
        <div class="returnCart">
            <a href="../Menu/menu.php">Keep shopping</a>
            <h1>List Product in Cart</h1>
            <div class="list"></div>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="right">
                <h1>Checkout</h1>
                <input type="hidden" id="totalQuantityInput" name="totalQuantity">
                <input type="hidden" id="totalPriceInput" name="totalPrice">
                <input type="hidden" id="cartDataInput" name="cartData">

                <div class="form">
                    <div class="group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                    </div>

                    <div class="group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" placeholder="Enter your phone number" required>
                    </div>

                    <div class="group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" placeholder="Enter your exact address" required>
                    </div>

                    <div class="group">
                        <label for="occationDate">Select Date</label>
                        <input type="date" name="occationDate" id="occationDate" required>
                    </div>

                    <div class="group">
                        <label for="imageUpload">Upload proof of payment</label>
                        <input type="file" name="imageUpload" id="imageUpload" accept="image/*" required>
                    </div><br>

                    <div class="group">
                        <input type="checkbox" name="terms" id="terms" required>
                        <label for="terms">I have read and agree to the 
                            <a href="../terms and condition/terms.php" target="_blank" style="color: black;">Terms and Conditions</a>
                        </label>
                    </div>
                </div>

                <div class="return">
                    <div class="row">
                        <div>Total Quantity</div>
                        <div class="totalQuantity">70</div>
                    </div>
                    <div class="row">
                        <div>Total Price</div>
                        <div class="totalPrice">₱900</div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="buttonCheckout">CHECKOUT</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="checkout.js"></script>
</body>
</html>

