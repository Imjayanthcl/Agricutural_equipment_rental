<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Received Details</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <h1>Received Details</h1>

    <?php
    $conn = new mysqli('localhost', 'root', '', 'agrirent');

    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    $sql = "SELECT * FROM received";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Renter Name</th><th>Phone Number</th><th>Vehicle Name</th><th>Rent Period</th><th>Date</th><th>Paid Amount</th><th>Fine Amount</th><th>Vehicle Damage</th><th>Damage Details</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["renterName"] . "</td>";
            echo "<td>" . $row["phoneNumber"] . "</td>";
            echo "<td>" . $row["vehicleName"] . "</td>";
            echo "<td>" . $row["rentPeriod"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["paidAmount"] . "</td>";
            echo "<td>" . $row["fineAmount"] . "</td>";
            echo "<td>" . $row["vehicleDamage"] . "</td>";
            echo "<td>" . $row["damageDetails"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No received details available.";
    }

    $conn->close();
    ?>
</body>
</html>
