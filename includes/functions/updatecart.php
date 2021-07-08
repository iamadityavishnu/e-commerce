<?php

include('../dbconnection.php');
session_start();

if(isset($_GET['index']) && !isset($_GET['qty'])){
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
}elseif(isset($_GET['index']) && isset($_GET['qty'])){
    if(!isset($_SESSION['email'])){
        if(isset($_COOKIE['cart'])){
            $cart = unserialize($_COOKIE['cart']);
            $index = $_GET['index'];
            $qty = $_GET['qty'];
            $cart[$index]["qty"] = $qty;
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
        $sql = "UPDATE cart SET qty=? WHERE slno=?";
        $stmt = $conn->prepare($sql);
        $index = $_GET['index'];
        $qty = $_GET['qty'];
        $stmt->bind_param("ii", $qty, $index);
        if($stmt->execute()){
            echo "OK";
        }
    }
}

?>