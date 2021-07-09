<?php

include('includes/dbconnection.php');
session_start();

if(isset($_SESSION['email'])){
    $date = date("Y-m-d H:i:s");
    $cust_id = $_SESSION['cid'];

    $sql = "SELECT * FROM cart WHERE cust_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cust_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    $total_price = 0;

    foreach ($data as $row){
        $p_id = $row['p_id'];
        $qty = $row['qty'];
        $weight = $row['weight'];
        $price = $row['price'];
        $slno = $row['slno'];

        $sql = "SELECT * FROM products WHERE p_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $p_id);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $p_data = $result->fetch_assoc();

        $p_img = $p_data['p_img_1'];
        $p_price_1 = $p_data['p_price_1'];
        $p_price_2 = $p_data['p_price_2'];
        $p_price_3 = $p_data['p_price_3'];

        $p_title = $p_data['p_title'];
        $p_img = $p_data['p_img_1'];

        if($weight == 1){
            $price = $p_price_1;
            $weight = $p_data['p_wt_1'];
        }else if($weight == 2){
            $price = $p_price_2;
            $weight = $p_data['p_wt_2'];
        }else if($weight == 3){
            $price = $p_price_3;
            $weight = $p_data['p_wt_3'];
        }else{
            echo "ERROR";
        }

        $invoice_no = rand(100000,9999999);
        $order_status = 0;
        $total_price = $price*$qty;

        $sql = "INSERT INTO orders (cust_id, p_id, p_title, p_image, amount, invoice_no, qty, weight, date, order_status) VALUES
                                (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissiiiisi", $cust_id, $p_id, $p_title, $p_img, $total_price, $invoice_no, $qty, $weight, $date, $order_status);
        if($stmt->execute()){
            $sql = "DELETE FROM cart WHERE slno=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $slno);
            if($stmt->execute()){
                echo "<script>alert('Order placed')</script>";
                echo "<script>window.open('my_account.php?my_orders','_self')</script>";
            }
        }
    }
}else{
    if(isset($_COOKIE['cart'])){
        $date = date("Y-m-d H:i:s");
        $cart = unserialize($_COOKIE['cart']);
        $total_price = 0;
        $cust_name = $_GET['name'];
        $cust_email = $_GET['email'];
        $cust_phone = $_GET['phone'];
        $add_1 = $_GET['add1'];
        $add_2 = $_GET['add2'];
        $state = $_GET['state'];
        $post_code = $_GET['post-code'];
        
        foreach ($cart as $key => $value){
            $qty = $value['qty'];
            $pid = $value['pid'];
            $weight = $value['weight'];

            $sql = "SELECT p_title, p_price_1, p_img_1, p_price_2, p_price_3, p_wt_1, p_wt_2, p_wt_3 FROM products WHERE p_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $pid);
            $stmt->execute(); 
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();

            $p_price_1 = $product['p_price_1'];
            $p_price_2 = $product['p_price_2'];
            $p_price_3 = $product['p_price_3'];

            $p_title = $product['p_title'];
            $p_img = $product['p_img_1'];

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
            
            $total_price = $price*$qty;

            $invoice_no = rand(100000,9999999);
            $order_status = 0;

            $sql = "INSERT INTO orders (cust_id, p_id, p_title, p_image, amount, invoice_no, qty, weight, date, cust_name, cust_email, cust_phone, add_1, add_2, state, post_code, order_status) VALUES
                                    (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);

            $cust_id = 0;

            $stmt->bind_param("iissiiiissssssssi", $cust_id, $pid, $p_title, $p_img, $total_price, $invoice_no, $qty, $weight, $date, $cust_name, $cust_email, $cust_phone, $add_1, $add_2, $state, $post_code, $order_status);
            $stmt->execute();
        }
        // $cart = unserialize($_COOKIE['cart']);
        // unset($cart[$key]);
        $cart = 0;
        setcookie('cart', $cart,[
            'expires' => time() - 86400,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'None',
        ]);
        echo "<script>alert('Order placed')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
}

?>