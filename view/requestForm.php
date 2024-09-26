<?php 
include '../control/requestprocess.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>Laundry Service Request Form</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validationRequest.js"></script>
</head>
<body class="form-body">
    <h1 class="form-heading">Laundry Service Request Form</h1>

   
    <div class="success-msg">
        <?php if (!empty($successMessages)) { 
            foreach ($successMessages as $message) { 
                echo "<p>$message</p>"; 
            } 
        } ?>
    </div>

    <form action="" method="POST" onsubmit="return validateForm()" class="request-form">
        <table class="form-table">
            <tr>
                <td><label for="customername">Customer Name:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <input type="text" name="customername" id="customername" class="form-input">
                    <div id="nameError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="customeraddress">Customer Address:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <textarea name="customeraddress" id="customeraddress" class="form-textarea"></textarea>
                    <div id="addressError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="customercontact">Customer Contact:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <input type="tel" name="customercontact" id="customercontact" class="form-input">
                    <div id="contactError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="pickupdate">Pickup Date:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <input type="date" name="pickupdate" id="pickupdate" class="form-input">
                    <div id="dateError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="pickuptime">Pickup Time:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <input type="time" name="pickuptime" id="pickuptime" class="form-input">
                    <div id="timeError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="laundereditems">Items to be Laundered:</label></td>
            </tr>
            <tr>
                <td class="form-input-container">
                    <textarea name="laundereditems" id="laundereditems" class="form-textarea"></textarea>
                    <div id="itemsError" class="error-msg"></div>
                </td>
            </tr>

            <tr>
                <td><label for="specialinstruction">Special Instruction:</label></td>
            </tr>
            <tr>
                <td>
                    <textarea name="specialinstruction" id="specialinstruction" class="form-textarea"></textarea>
                </td>
            </tr>

            <tr>
                <td>
                    <button type="submit" class="submit-button">Submit Request</button>
                    <a href="laundryHome.php"><button type="button" class="back-button">Back</button></a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
