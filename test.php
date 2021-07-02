<?php

// $cart = [];

// setcookie('cart', serialize($cart), time() - (86400 * 30), "/");
// echo "COOKIE CLEARED"

include("includes/dbconnection.php");

$date = date("Y-m-d H:i:s");
$cart = unserialize($_COOKIE['cart']);
$total_price = 0;
echo "I am outside foreach";
foreach ($cart as $key => $value){
    echo "I am inside foreach 1";

    $qty = $value['qty'];
    $pid = $value['pid'];
    $weight = $value['weight'];
    echo "I am inside foreach 2";

    $sql = "SELECT p_title, p_price_1, p_img_1, p_price_2, p_price_3, p_wt_1, p_wt_2, p_wt_3 FROM products WHERE p_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $pid);
    $stmt->execute(); 
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    echo "I am inside foreach 3";

    $p_price_1 = $product['p_price_1'];
    $p_price_2 = $product['p_price_2'];
    $p_price_3 = $product['p_price_3'];

    $p_title = $product['p_title'];
    $p_img = $product['p_img_1'];
    echo "I am inside foreach 4";

    if($weight == 1){
        $price = $p_price_1;
        $weight = $product['p_wt_1'];
    }else if($weight == 2){
        $price = $p_price_2;
        $weight = $product['p_wt_2'];
    }else if($weight == 3){
        $price = $p_price_3;
        $weight = $product['p_wt_3'];
    }else{
        echo "ERROR";
    }
    echo "I am inside foreach 5";
    
    $total_price = $price*$qty;

    $invoice_no = rand(100000,9999999);
    $order_status = 0;
    echo "I am inside foreach 6";

    $sql = "INSERT INTO orders (cust_id, p_id, p_title, p_image, amount, invoice_no, qty, weight, date, cust_name, cust_email, cust_phone, add_1, add_2, state, post_code, order_status) VALUES
                            (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    echo "I am inside foreach 7";

    $cust_id = 0;
    $cust_name = $_GET['name'];
    $cust_email = $_GET['email'];
    $cust_phone = $_GET['phone'];
    $add_1 = $_GET['add1'];
    $add_2 = $_GET['add2'];
    $state = $_GET['state'];
    $post_code = $_GET['post-code'];
    echo "I am inside foreach 8";

    $stmt->bind_param("iissiiiissssssssi", $cust_id, $pid, $p_title, $p_img, $total_price, $invoice_no, $qty, $weight, $date, $cust_name, $cust_email, $cust_phone, $add_1, $add_2, $state, $post_code, $order_status);
    echo "I am inside foreach 9";
    
    if($stmt->execute()){
    echo "I am inside foreach 10";

        $cart = unserialize($_COOKIE['cart']);
        unset($cart[$key]);
        setcookie('cart', serialize($cart),[
            'expires' => time() + 86400,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'None',
        ]);
    }else{
        echo $conn->error;
    }
}

?>