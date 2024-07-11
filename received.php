<?php
$renterName = $_POST["renterName"];
$phoneNumber = $_POST["phoneNumber"];
$vehicleName = $_POST["vehicleName"];
$rentPeriod = $_POST["rentPeriod"];
$date = date('Y-m-d', strtotime($_POST["date"]));
$paidAmount = $_POST["paidAmount"];
$fineAmount = $_POST["fineAmount"];
$vehicleDamage = $_POST["vehicleDamage"];
$damageDetails = $_POST["damageDetails"];

$conn = new mysqli('localhost', 'root', '', 'agrirent');
if ($conn->connect_error) {
    die('Connection Failed :' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO received(renterName, phoneNumber, vehicleName, rentPeriod, date, paidAmount, fineAmount, vehicleDamage, damageDetails) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $renterName, $phoneNumber, $vehicleName, $rentPeriod, $date, $paidAmount, $fineAmount, $vehicleDamage, $damageDetails);
    $stmt->execute();
    echo "Received Successfully...";
    $stmt->close();
    $conn->close();
}
?>