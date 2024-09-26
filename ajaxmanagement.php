<?php
include '../model/mydb.php';

$search = $_GET['search'];

$db = new Mydb();
$conobj = $db->conobj();
$data = $db->showbyId($conobj, "status", $search);


?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Order Status</title>
    <link rel="stylesheet" href="../css/style4.css"> 
</head>
<body>
    <h1>Order Status</h1>
    <table>
        <thead>
            <tr>
                <th>Request ID</th>
                <th>Delivery Status</th>
                <th>Payment Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    $requestId = $row['request_id'];
                    $deliveryStatus = $row['delivery_status'];
                    $paymentStatus = $row['payment_status'];

                    echo "<tr>";
                    echo "<td>$requestId</td>";
                    echo "<td>$deliveryStatus</td>";
                    echo "<td>$paymentStatus</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3' class='no-data'>No requests found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    $db->closecon($conobj);
    ?>
</body>
</html>
