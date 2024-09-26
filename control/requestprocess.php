<?php
include '../model/mydb.php';

function generateUniqueRequestId($con) {
    do {
        $randomRequestId = rand(10000, 99999);
        $checkQuery = "SELECT request_id FROM laundry_requests WHERE request_id = $randomRequestId";
        $result = $con->query($checkQuery);
    } while ($result && $result->num_rows > 0);
    return $randomRequestId;
}

$successMessages = []; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $address = $contact = $pdate = $ptime = $item = $sinstruction = "";
    $valid = true;

    if (empty($_POST["customername"]) || !preg_match("/^[a-zA-Z\s]+$/", $_POST["customername"])) {
        echo "Please enter a valid name (alphabets only)";
        $valid = false;
    } else {
        $name = $_POST["customername"];
        $successMessages[] = "Name validation successful.";
    }

    if (empty($_POST["customeraddress"])) {
        echo "Address is required";
        $valid = false;
    } else {
        $address = $_POST["customeraddress"];
        $successMessages[] = "Address validation successful.";
    }

    if (empty($_POST["customercontact"]) || !preg_match("/^(?:\+880|\b01)(?:\d(-?)){9}\b$/", $_POST["customercontact"])) {
        echo "Please enter a valid contact number ";
        $valid = false;
    } else {
        $contact = $_POST["customercontact"];
        $successMessages[] = "Contact validation successful.";
    }

    if (empty($_POST["pickupdate"])) {
        echo "Pickup date is required";
        $valid = false;
    } else {
        $pdate = $_POST["pickupdate"];
        $successMessages[] = "Pickup Date validation successful.";
    }

    if (empty($_POST["pickuptime"])) {
        echo "Pickup time is required";
        $valid = false;
    } else {
        $ptime = $_POST["pickuptime"];
        $successMessages[] = "Pickup Time validation successful.";
    }

    if (empty($_POST["laundereditems"])) {
        echo "Laundered items are required";
        $valid = false;
    } else {
        $item = $_POST["laundereditems"];
        $successMessages[] = "Laundered items validation successful.";
    }

    if (isset($_POST["specialinstruction"])) {
        $sinstruction = $_POST["specialinstruction"];
    }

    if ($valid) {
        $mydb = new Mydb();
        $con = $mydb->conobj();
        $table = "laundry_requests";
        $request_id = generateUniqueRequestId($con);
        $insertRequest = $mydb->insert($con, $table, $request_id, $name, $address, $contact, $pdate, $ptime, $item, $sinstruction);
        

        if ($insertRequest === true) {
            $insertStatus = $mydb->insertStatus($con, $request_id, "pending", "unpaid");
            if ($insertStatus === true) {
                echo "<script>alert('Request placed successfully!');</script>";
            } else {
                echo "<script>alert('Error in placing request status');</script>";
            }
        } else {
            echo "<script>alert('Error in placing request: $insertRequest');</script>";
        } 

        if ($insertRequest) {
            $successMessages[] = "Your request has been submitted successfully with Request ID: $request_id";
        } else {
            echo "Error occurred while submitting the request.";
        }
        $mydb->closecon($con);
    }
   
}
?>
