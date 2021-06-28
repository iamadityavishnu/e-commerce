<?php

include('includes/dbconnection.php');
session_start();

if(!isset($_SESSION['email'])){
    header('Location: http://localhost/times-international/login.php');
    die();
}

$sql = "SELECT * FROM customers WHERE cust_email=?";
$stmt = $conn->prepare($sql);
$email = $_SESSION['email'];
$stmt->bind_param("s", $email);
$stmt->execute();
$data = $stmt->get_result()->fetch_assoc();

$cust_id = $data['cust_id'];
$_SESSION['cid'] = $cust_id;

$cust_name = $data['cust_name'];
$cust_email = $data['cust_email'];
$cust_phone = $data['cust_phone'];
$cust_add1 = $data['cust_add1'];
$cust_add2 = $data['cust_add2'];
$cust_state = $data['cust_state'];
$post_code = $data['post_code'];
$cust_img = $data['cust_img'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- SEO TAGS -->
        <meta name="title" content="Times International " />
        <meta
            name="description"
            content="Times International PTY LTD. Buy online a range of authentic food products from Times International. Delivery across mainland."
        />
        <meta
            name="keywords"
            content="times international, daily delight, buy online"
        />
        <meta name="robots" content="index, follow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="English" />
        <meta name="revisit-after" content="1 days" />
        <meta name="author" content="Times International " />
        <!-- END OF SEO TAGS -->

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="style/style.css" />
        <!-- <link rel="stylesheet" href="style/home.css" /> -->
        <link
            rel="icon"
            href="images/TIMES LOGO.jpg"
            type="image/jpg"
            sizes="16x16"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>My account | Times International</title>

        <style>
            .container{
                display: flex;
                flex-direction: row;
                align-items: flex-start;
                margin: 40px 10%;
            }
            .left-panel{
                background: #ffffff;
                width: 30%;
                margin: 0 20px;
                padding: 0 0 30px 0;
            }
            .left-panel .user-info{
                display: flex;
                flex-direction: row;
                align-items: center;
                padding: 30px;
            }
            .left-panel .user-info .image-container img{
                margin-right: 30px;
                height: 60px;
                width: 60px;
                border-radius: 50%;
            }
            .left-panel ul{
                list-style: none;
            }
            .left-panel ul a{
                color: #4a4a4a;
                text-decoration: none;
            }
            .left-panel ul li{
                padding: 10px 30px;
            }
            .left-panel ul li:hover{
                background: #f9f9f9;
            }
            .left-panel ul a:hover{
                color: #379af9;
            }
            .left-panel ul li.active{
                color: #379af9;
            }
            .right-section{
                background: #fff;
                width: 80vw;
                min-height: 40vh;
                padding: 50px 20px;
            }
            form table{
                width: 100%;
            }
            form label{
                position: relative;
                top: 12px;
                left: 20px;
                background: #fff;
                padding: 0 5px;
                font-size: 0.8em;
            }
            form input{
                width: 100%;
                height: 40px;
                border: 3px solid #ebebeb;
                border-radius: 10px;
                padding-left: 20px;
            }
            form input[type="submit"]{
                background: #379af9;
                color: #fff;
                border: none;
                cursor: pointer;
                font-weight: bold;
            }
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }
        </style>
    </head>
    
    <body>
    <?php
    include("includes/header.php");
    ?>

    <main>
        <div class="container">
            <div class="left-panel">
                <div class="user-info">
                    <div class="image-container">
                        <img src="admin/images/profile-pictures/ca7b6044398c39b298b9ce6e2f5003ca.png" alt="profile-picture">
                    </div>
                    <div class="name">
                        <p>Hello</p>
                        <h4>John Doe</h4>
                    </div>
                </div>
                <div class="user-account-options">
                    <ul>
                        <a href="my_account.php?my_profile">
                            <li <?php if(isset($_GET['my_profile'])){echo "class='active'";} ?>>My profile</li>
                        </a>
                        <a href="my_account.php?my_orders">
                            <li <?php if(isset($_GET['my_orders'])){echo "class='active'";} ?>>My orders</li>
                        </a>
                        <a href="my_account.php?edit_account">
                            <li <?php if(isset($_GET['edit_account'])){echo "class='active'";} ?>>Edit account</li>
                        </a>
                        <a href="my_account.php?my_address">
                            <li <?php if(isset($_GET['my_address'])){echo "class='active'";} ?>>My address</li>
                        </a>
                        <a href="my_account.php?change_password">
                            <li <?php if(isset($_GET['change_password'])){echo "class='active'";} ?>>Change password</li>
                        </a>
                        <!-- <a href="my_account.php?delete_account">
                            <li>Delete account</li>
                        </a> -->
                        <a href="logout.php">
                            <li>Logout</li>
                        </a>
                    </ul>
                </div>
            </div>
            <div class="right-section">
                <?php
                if(isset($_GET['edit_account'])){
                    include("includes/sub-sections/edit_account.php");
                }
                ?>
            </div>
        </div>
    </main>

    <?php
    include("includes/footer.php");
    ?>
    </body>
</html>

<?php

if(isset($_POST['update-account'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $add1 = $_POST['add1'];
    $add2 = $_POST['add2'];
    $state = $_POST['state'];
    $post_code = $_POST['post-code'];

    $sql = "UPDATE customers SET cust_name=?, cust_email=?, cust_phone=?, cust_add1=?, cust_add2=?, cust_state=?, post_code=? WHERE cust_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $name, $email, $phone, $add1, $add2, $state, $post_code, $cust_id);
    if($stmt->execute()){
        echo "<script>alert('Profile updated successfully!')</script>";
        echo "<script>window.open('my_account.php','_self')</script>";
    }
}

?>