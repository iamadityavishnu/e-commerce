<?php

include('../dbconnection.php');
if(isset($_GET['mail'])){
    $sql = "SELECT * FROM customers WHERE cust_email=?";
    $stmt = $conn->prepare($sql);
    $email = $_GET['mail'];
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    if($data == NULL){
        echo 1;
    }else{
        echo 0;
    }
}

?>