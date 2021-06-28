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


?>