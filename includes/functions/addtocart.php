<?php

include('../dbconnection.php');

if(isset($_GET['p_id']) && isset($_GET['qty']) && isset($_GET['weight'])){
    $p_id = $_GET['p_id'];
    $qty = $_GET['qty'];
    $weight = $_GET['weight'];
    $date = date("Y-m-d h:i:s");
    
    $sql = "SELECT p_price_1, p_price_2, p_price_3 FROM products WHERE p_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $p_id);
    $stmt->execute(); 
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    $p_price_1 = $product['p_price_1'];
    $p_price_2 = $product['p_price_2'];
    $p_price_3 = $product['p_price_3'];

    if($weight == 1){
         $price = $p_price_1;
    }else if($weight == 2){
         $price = $p_price_2;
    }else if($weight == 3){
         $price = $p_price_3;
    }else{
        echo "FAILED";
    }

    session_start();
    if(!isset($_SESSION['email'])){
        $is_guest = 1;
        $cust_id = "";
        if(!isset($_COOKIE['cart'])){
            $cart = array(array("pid" => $p_id, "qty" => $qty, "weight" => $weight));
        }else{
            $cart = unserialize($_COOKIE['cart']);
            array_push($cart, array("pid" => $p_id, "qty" => $qty, "weight" => $weight));
            // echo var_dump($cart);
            // echo "<br><br>";
            // echo var_dump($cart[0]["pid"]);
        }
        setcookie('cart', serialize($cart), time() + (86400 * 30), "/");
        echo "OK";
    }else{
        $is_guest = 0;
        $cust_id = $_SESSION['cid'];
        $sql = "INSERT INTO cart (p_id, cust_id, date, qty, weight, price, is_guest) VALUES
                                (?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issiidi", $p_id, $cust_id, $date, $qty, $weight, $price, $is_guest);
        if($stmt->execute()){
            echo "OK";
        }else{
            echo "FAILED";
        }
    }
}

?>