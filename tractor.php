<?php
$farmerName = $_POST["farmerName"];
$phoneNumber = $_POST["phoneNumber"];
$address = $_POST["address"];
$totalHours = $_POST["totalHours"];
$bookingStartDate = $_POST["bookingStartDate"];
$bookingStartTime = $_POST["bookingStartTime"];
$bookingEndDate = $_POST["bookingEndDate"];
$bookingEndTime = $_POST["bookingEndTime"];
$totalPrice = $totalHours * 5000;

// Function to check if there is any overlap with existing bookings
function isBookingOverlap($conn, $startDate, $startTime, $endDate, $endTime)
{
    $sql = "SELECT * FROM tractor WHERE
            (bookingStartDate <= '$endDate' AND bookingEndDate >= '$startDate') AND
            ((bookingStartTime <= '$endTime' AND bookingEndTime >= '$startTime') OR
            (bookingStartTime <= '$startTime' AND bookingEndTime >= '$endTime'))";

    $result = $conn->query($sql);

    return $result->num_rows > 0;
}

$conn = new mysqli('localhost', 'root', '', 'agrirent');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    // Check for overlap before inserting into the database
    if (isBookingOverlap($conn, $bookingStartDate, $bookingStartTime, $bookingEndDate, $bookingEndTime)) {
        // Display a JavaScript alert for overlapping bookings
        echo "<script>alert('Sorry, the tractor is already booked for the selected time and date range. Please choose another time slot.');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO tractor (farmerName, phoneNumber, address, totalHours, bookingStartDate, bookingStartTime, bookingEndDate, bookingEndTime, totalPrice) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssd", $farmerName, $phoneNumber, $address, $totalHours, $bookingStartDate, $bookingStartTime, $bookingEndDate, $bookingEndTime, $totalPrice);

        if ($stmt->execute()) {
            echo "Booking Successfully...";

            // Redirect to payment.html
            header("Location: payment.html");
            exit; // Ensure no further code is executed after the redirection
        } else {
            echo "Booking Failed. Please try again.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>
