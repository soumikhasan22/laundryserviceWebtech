<?php
include '../model/mydb.php';
 
$mydb = new Mydb();
$con = $mydb->conobj();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Laundry Customer Dashboard</title>
    <link rel="stylesheet" href="../css/style1.css">
</head>
<body>
    <div class="container">
        <h1 class="h1">Laundry Customer Dashboard</h1>
        <h3>Previous Requests</h3>
 
        
        <table>
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Payment Status</th>
                    <th>Reviews</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $query = "SELECT r.request_id, r.pickup_date, s.delivery_status, s.payment_status
                          FROM laundry_requests r
                          JOIN status s ON r.request_id = s.request_id";
                $result = $con->query($query);
 
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $requestId = $row['request_id'];
                        $pickupDate = $row['pickup_date'];
                        $deliveryStatus = $row['delivery_status'];
                        $paymentStatus = $row['payment_status'];
 
                        echo "<tr>";
                        echo "<td>$requestId</td>";
                        echo "<td>$pickupDate</td>";
                        echo "<td>$deliveryStatus</td>";
                        echo "<td>$paymentStatus</td>";
                        echo "<td>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='review_request_id' value='$requestId'>";
                        echo "<button type='submit' name='request_review'>Review</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No requests found</td></tr>";
                }
                ?>
            </tbody>
        </table>
 
        
        <h2>Make Payment</h2>
        <form method="POST" action="">
            <label for="pay_request_id" >Request ID:</label>
            <input type="number" name="pay_request_id" required>
 
            <label for="payment_amount">Payment Amount:</label>
            <input type="number" name="payment_amount" required>
 
            <button type="submit" name="make_payment">Make Payment</button>
        </form>
 
        <?php
        //  payment update
        if (isset($_POST['make_payment'])) {
            $requestIdToPay = $_POST['pay_request_id'];
           
            if ($mydb->updatePaymentStatus($con, $requestIdToPay)) {
                echo "<p>Payment status updated to 'Paid' for Request ID: $requestIdToPay</p>";
            } else {
                echo "<p>Failed to update payment status</p>";
            }
        }
        ?>
 
        
        <h2>Reviews</h2>
        <div class="review-section">
            <?php
          
            $query = "SELECT s.review_star, s.review_comment, s.shop_name
                      FROM laundry_requests r
                      JOIN status s ON r.request_id = s.request_id";
            $result = $con->query($query);
 
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $reviewStar = $row['review_star'];
                    $reviewComment = $row['review_comment'];
                    $shopName = $row['shop_name'];
 
                    if ($reviewStar && $reviewComment && $shopName) {
                        $stars = str_repeat('⭐', $reviewStar);
                        echo "<p><strong>$shopName:</strong> <span class='stars'>$stars</span><br>$reviewComment</p>";
                    }
                }
            }
            ?>
        </div>
 
        <?php
        // review button was pressed
        if (isset($_POST['request_review'])) {
            $reviewId = $_POST['review_request_id'];
        ?>
            <h2>Submit Your Review for Request ID: <?php echo $reviewId; ?></h2>
            <form method="POST" action="">
                <input type="hidden" name="review_request_id" value="<?php echo $reviewId; ?>">
 
                <label for="review_star">Rating :</label>
                <select name="review_star" required>
                    <option value="1">⭐</option>
                    <option value="2">⭐⭐</option>
                    <option value="3">⭐⭐⭐</option>
                    <option value="4">⭐⭐⭐⭐</option>
                    <option value="5">⭐⭐⭐⭐⭐</option>
                </select>
 
                <label for="review_comment">Comment:</label>
                <textarea name="review_comment" required></textarea>
 
                <button type="submit" name="submit_review">Submit Review</button>
            </form>
        <?php
        }
 
        // review submission
        if (isset($_POST['submit_review'])) {
            $reviewId = $_POST['review_request_id'];
            $reviewStar = $_POST['review_star'];
            $reviewComment = $_POST['review_comment'];
 
            $query = "UPDATE status
                      SET review_star = '$reviewStar', review_comment = '$reviewComment'
                      WHERE request_id = '$reviewId'";
            if ($con->query($query)) {
                echo "<p>Review submitted successfully for Request ID: $reviewId</p>";
            } else {
                echo "<p>Failed to submit review: " . $con->error . "</p>";
            }
        }
 
        $mydb->closecon($con);
        ?>
        <a href="laundryHome.php"><button type="button" >Back</button></a>
    </div>
</body>
</html>
 
