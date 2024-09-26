<?php
class Mydb
{
    public $host="localhost";
    public $user="root";
    public $password="";
    public $dbname="db_laundry";

    function __construct()
    {
        $this->host="localhost";
        $this->user="root";
        $this->password="";
        $this->dbname="db_laundry";
    }

    function conobj()
    {
        return new mysqli($this->host, $this->user, $this->password, $this->dbname);
    }

   
    function insert($con, $table, $request_id, $name, $address, $contact, $pdate, $ptime, $item, $sinstruction)
    {
        $query = "INSERT INTO $table (request_id, customer_name, customer_address, customer_contact, pickup_date, pickup_time, laundered_items, special_instruction)
                  VALUES ('$request_id', '$name', '$address', '$contact', '$pdate', '$ptime', '$item', '$sinstruction')";
        $result = $con->query($query);
        if ($result == false) {
            return $con->error;
        } else {
            return true;
        }
    }

    // Insert  (delivery and payment) 
    function insertStatus($con, $request_id, $delivery_status, $payment_status)
    {
        $query = "INSERT INTO  status (request_id, delivery_status, payment_status) 
                  VALUES ('$request_id', '$delivery_status', '$payment_status')";
        $result = $con->query($query);
        if ($result == false) {
            return $con->error;
        } else {
            return true;
        }
    }

    // Update  (unpaid to paid)
    function updatePaymentStatus($con, $request_id)
    {
        $query = "UPDATE status SET payment_status = 'paid' WHERE request_id = '$request_id'";
        $result = $con->query($query);
        if ($result == false) {
            return $con->error;
        } else {
            return true;
        }
    }

    // Update d(pending to delivered)
    function updateDeliveryStatus($con, $request_id, $new_status)
    {
        $query = "UPDATE status SET delivery_status = '$new_status' WHERE request_id = '$request_id'";
        $result = $con->query($query);
        if ($result == false) {
            return $con->error;
        } else {
            return true;
        }
    }

    ///
    function showbyId($conn,$table,$request_id){
        $qrystring="SELECT * FROM $table WHERE request_id = '$request_id'";
        $result= $conn->query($qrystring);
        return $result;
    }

    function getAllRecords($con, $table) {
        $query = "SELECT * FROM $table";
        $result = $con->query($query);
        return $result;
    }
    

    function closecon($con)
    {
        $con->close();
    }
}
?>


