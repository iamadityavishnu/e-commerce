<?php

include('includes/dbconnection.php');

$index = $_GET['index'];
$product_id = $_GET['p'];

$sql = "SELECT p_price_1, p_price_2, p_price_3 FROM products WHERE p_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute(); 
$result = $stmt->get_result();
$product = $result->fetch_assoc();

$p_price_1 = $product['p_price_1'];
$p_price_2 = $product['p_price_2'];
$p_price_3 = $product['p_price_3'];

if($index == 1){
    echo $p_price_1;
}else if($index == 2){
    echo $p_price_2;
}else if($index == 3){
    echo $p_price_3;
}else{
    echo "Some error occured!";
}

?>