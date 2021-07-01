<?php

include('includes/dbconnection.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM customers WHERE cust_email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if($data != NULL && $data['cust_pass'] == $password){
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $data['cust_name'];
        $_SESSION['cid'] = $data['cust_id'];
        header('Location: http://localhost/times-international/index.php');
        die();
    }else{
        echo "<script>alert('Incorrect email or password')</script>";
        echo "<script>window.open('login.php','_self')</script>";
    }
}

if(isset($_POST['signup'])){
    if(isset($_POST['user-name'])){
        $_SESSION['name'] = $_POST['user-name'];
    }
    if(isset($_POST['user-email'])){
        $_SESSION['email'] = $_POST['user-email'];
    }
    $sql = "INSERT INTO customers (cust_name, cust_email, cust_pass, cust_img) VALUES (?,?,?,?)";

    $stmt = $conn->prepare($sql);

    $cust_name = $_POST['user-name'];
    $cust_email = $_POST['user-email'];
    $cust_pass = md5($_POST['password']);
    $cust_img = "ca7b6044398c39b298b9ce6e2f5003ca.png";

    $stmt->bind_param("ssss", $cust_name, $cust_email, $cust_pass, $cust_img);
    if(!($stmt->execute())){
        session_unset();
        session_destroy();
        echo "<script>alert('Email ID already taken!')</script>";
        echo "<script>window.open('signup.php','_self')</script>";
    }else{
        session_start();
        $_SESSION['email'] = $cust_email;
        $_SESSION['name'] = $cust_name;
        header('Location: http://localhost/times-international/my_account.php?edit_account');
        die();
    }
}

?>