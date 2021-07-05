<?php

include('../../includes/dbconnection.php');

if(isset($_POST['confirm_order_id'])){
    $order_id = $_POST['confirm_order_id'];
    $order_status = 1;
    $sql = "UPDATE orders SET order_status=? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $order_status, $order_id);
    if($stmt->execute()){
        echo "OK";
    }else{
        echo "ERR";
    }
}

?>