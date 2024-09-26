<?php
include '../model/mydb.php';

$mydb = new Mydb();
$con = $mydb->conobj();
$data = $mydb->getAllRecords($con, "laundry_requests");
echo "<h1 class='dashboard-title'>Management Dashboard</h1>";
echo "<h2 class='dashboard-subtitle'>All Laundry Requests:</h2>";
echo "<table class='request-table'>";
echo "<thead>
<tr>
    <th>Request ID</th>
    <th>Customer Name</th>
    <th>Customer Address</th>
    <th>Customer Contact</th>
    <th>Pickup Date</th>
    <th>Pickup Time</th>
    <th>Laundered Items</th>
    <th>Special Instruction</th>
</tr>
</thead>
<tbody>";

if ($data->num_rows > 0) {
    while ($row = $data->fetch_assoc()) {
        $requestId = $row['request_id'];
        $name = $row['customer_name'];
        $address = $row['customer_address'];
        $contact = $row['customer_contact'];
        $pdate = $row['pickup_date'];
        $ptime = $row['pickup_time'];
        $item = $row['laundered_items'];
        $sinstruction = $row['special_instruction'];

        echo "<tr>";
        echo "<td>$requestId</td>";
        echo "<td>$name</td>";
        echo "<td>$address</td>";
        echo "<td>$contact</td>";
        echo "<td>$pdate</td>";
        echo "<td>$ptime</td>";
        echo "<td>$item</td>";
        echo "<td>$sinstruction</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}

echo "</tbody>";
echo "</table>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Management Dashboard</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>

<?php
include '../view/managementajax.php';
?>
<h2 class='update-title'>Update Delivery Status</h2>

<form method="POST" action="" class='update-form'>
    <table>
        <tr>
            <td>
                <label for="request_id">Request ID:</label>
                <input type="number" name="request_id" required class='form-input'>
            </td>
        </tr>
        <tr>
            <td>
                <label for="delivery_status">Delivery Status:</label>
                <select name="delivery_status" required class='form-select'>
                    <option value="pending">Pending</option>
                    <option value="delivered">Delivered</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <label for="shop_name">Shop Name:</label>
                <input type="text" name="shop_name" required class='form-input'>
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" name="update_status" class='submit-button'>Update Status</button>
            </td>
        </tr>
    </table>
</form>

<?php
// delivery status update
if (isset($_POST['update_status'])) {
    $requestId = $_POST['request_id'];
    $deliveryStatus = $_POST['delivery_status'];
    $shopName = $_POST['shop_name'];

    // Update the delivery status and shop name 
    $query = "UPDATE status SET delivery_status = '$deliveryStatus', shop_name = '$shopName' WHERE request_id = '$requestId'";
    if ($con->query($query)) {
        echo "<p>Delivery status updated to '$deliveryStatus' for Request ID: $requestId with Shop Name: $shopName</p>";
    } else {
        echo "<p>Failed to update delivery status: " . $con->error . "</p>";
    }
}

$mydb->closecon($con);
?>
 
 <div class="button-container">
    <a href="laundryHome.php">
        <button type="button" class="back-button">Back</button>
    </a>
</div>
</body>
</html>
