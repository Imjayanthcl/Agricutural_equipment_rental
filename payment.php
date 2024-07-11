    <!-- payment.php -->
<?php
$paymentDate = $_POST['paymentDate'];
$paymentTime = $_POST['paymentTime'];
$transactionId = $_POST['transactionId'];

// Check if file upload is successful
if (move_uploaded_file($_FILES["transactionImage"]["tmp_name"], $targetFile)) {

   
    $conn = new mysqli('localhost', 'root', '', 'agrirent');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }
     else {
        $stmt = $conn->prepare("INSERT INTO payments (paymentDate, paymentTime, transactionId) VALUES (?, ?, ?)");
        $stmt->bind_param("ssss", $paymentDate, $paymentTime, $transactionId);

        if ($stmt->execute()) {
            echo "Booking information stored successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
} else {
    echo "File upload failed.";
}
?>
