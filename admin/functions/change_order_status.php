<?php

include('../../includes/dbconnection.php');

if(isset($_POST['order_id']) && isset($_POST['status_id'])){
    $order_id = $_POST['order_id'];
    $status_id = $_POST['status_id'];
    $sql = "UPDATE orders SET order_status=? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status_id, $order_id);
    if($stmt->execute()){
        echo "OK";
    }else{
        echo "ERR";
    }
}

?>