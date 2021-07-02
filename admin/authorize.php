<?php

include('../includes/dbconnection.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admins WHERE admin_email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if($data != NULL && $data['admin_pass'] == $password){
        session_start();
        $_SESSION['admin_email'] = $email;
        $_SESSION['adin_name'] = $data['admin_name'];
        $_SESSION['aid'] = $data['admin_id'];
        $_SESSION['timeout'] = time();
        header('Location: http://localhost/times-international/admin/index.php');
        die();
    }else{
        echo "<script>alert('Incorrect email or password')</script>";
        echo "<script>window.open('admin_login.php','_self')</script>";
    }
}

?>