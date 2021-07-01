<?php

include('../dbconnection.php');
session_start();

if(isset($_GET['index'])){
    if(!isset($_SESSION['email'])){
        if(isset($_COOKIE['cart'])){
            $cart = unserialize($_COOKIE['cart']);
            $index = $_GET['index'];
            unset($cart[$index]);
            setcookie('cart', serialize($cart),[
                'expires' => time() + 86400,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None',
            ]);
            echo "OK";
        }
    }else{
        $sql = "DELETE FROM cart WHERE slno=?";
        $stmt = $conn->prepare($sql);
        $index = $_GET['index'];
        $stmt->bind_param("i", $index);
        if($stmt->execute()){
            echo "OK";
        }
    }
}

?>