<?php

include('includes/dbconnection.php');
session_start();

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
        <title>Order Confirmation | Times International</title>

        <style>
            main {
                min-height: 60vh;
            }
            .container{
                display: flex;
                align-items: flex-start;
                justify-content: space-around;
                margin: 40px 10%;
            }
            .left-section{
                background: #fff;
                width: 100%;
            }
            .section-header{
                padding: 20px;
            }
            .each-item{
                display: flex;
                padding: 20px;
                background: #f3f3f3;
                margin-bottom: 10px;
            }
            .each-item img{
                width: 70px;
                height: 70px;
            }

            .each-item-right{
                margin-left: 30px;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }

            .each-item-right button{
                padding: 5px 10px;
                color: #d41717;
                cursor: pointer;
                font-weight: bold;
            }

            .quantity input{
                width: 50px;
                height: 30px;
                text-align: center;
            }

            button.btn-tiny{
                height: 30px;
                width: 30px;
                background: #379af9;
                font-weight: bold;
                color: #fff;
                border: none;
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
            
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
            }

            /* Firefox */
            input[type=number] {
            -moz-appearance: textfield;
            }

            .place-order{
                float: right;
                padding: 20px;
                margin-top: 30px;
            }

            .place-order input[type="submit"]{
                background: #379af9;
                color: white;
                padding: 10px 15px;
                border: none;
                font-weight: bold;
                cursor: pointer;
            }

            .right-section{
                background: #fff;
                margin-left: 30px;
                padding: 20px 30px;
                width: 50%; 
            }

            .price-breakdown{
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }
            @media (max-width: 768px){
                .container{
                    flex-direction: column;
                }
                .left-section, .right-section{
                    width: 100%;
                    margin: 10px 0px;
                }
            }
        </style>
    </head>
    
    <body>
    <?php
    include("includes/header.php");
    ?>

    <main>
        <div class="container">
            <div class="left-section">
                <div class="section-header">
                    <h1>Review order</h1>
                </div>
                    <?php

                    if(isset($_SESSION['email'])){
                        $sql = "SELECT p_id, qty, weight, price FROM cart WHERE cust_id=?";
                        $stmt = $conn->prepare($sql);
                        $cust_id = $_SESSION['cid'];
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
                            // $slno = $row['slno'];

                            $sql = "SELECT * FROM products WHERE p_id=?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $p_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $products = $result->fetch_assoc();

                            $p_img = $products['p_img_1'];
                            $p_price_1 = $products['p_price_1'];
                            $p_price_2 = $products['p_price_2'];
                            $p_price_3 = $products['p_price_3'];

                            $p_title = $products['p_title'];
                            $p_img = $products['p_img_1'];

                            if($weight == 1){
                                $price = $p_price_1;
                                $weight = $products['p_wt_1'];
                            }else if($weight == 2){
                                $price = $p_price_2;
                                $weight = $products['p_wt_2'];
                            }else if($weight == 3){
                                $price = $p_price_3;
                                $weight = $products['p_wt_3'];
                            }else{
                                echo "ERROR";
                            }

                            $total_price = $total_price + ($price*$qty);
                        }
                        echo "
                        <div class='each-item'>
                            <div class='each-item-left'>
                                <img src='admin/images/product-images/$p_img' alt=''>
                            </div>
                            <div class='each-item-right'>
                                <b>$p_title</b>
                                <p>$qty nos x $weight gms</p>
                                <p>$".$price*$qty."</p>
                            </div>
                        </div>
                        ";
                    }else{
                        if(isset($_COOKIE['cart'])){
                            $cart = unserialize($_COOKIE['cart']);
                            $total_price = 0;
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

                                $total_price = $total_price + ($price*$qty);
                                
                                echo "
                                    <div class='each-item'>
                                    <div class='each-item-left'>
                                        <img src='admin/images/product-images/$p_img' alt=''>
                                    </div>
                                    <div class='each-item-right'>
                                        <b>$p_title</b>
                                        <p>$qty nos x $weight gms</p>
                                        <p>$".$price*$qty."</p>
                                    </div>
                                    </div>
                                ";
                            }
                        }
                    }

                    ?>
                <div class="each-item" style="display: block">
                    <h2>Delivering to:</h2>
                    <?php

                    if(isset($_SESSION['email'])){
                        $sql = "SELECT * FROM customers WHERE cust_id=?";
                        $stmt = $conn->prepare($sql);
                        $cust_id = $_SESSION['cid'];
                        $stmt->bind_param("i", $cust_id);
                        $stmt->execute(); 
                        $result = $stmt->get_result();
                        $data = $result->fetch_assoc();

                        $cust_name = $data['cust_name'];
                        $cust_email = $data['cust_email'];
                        $cust_add1 = $data['cust_add1'];
                        $cust_add2 = $data['cust_add2'];
                        $cust_state = $data['cust_state'];
                        $post_code = $data['post_code'];
                        $cust_phone = $data['cust_phone'];

                        echo "
                            <b>$cust_name</b>
                            <p>$cust_add1</p>
                            <p>$cust_add2</p>
                            <p>$cust_state</p>
                            <p>Post code:$post_code</p>
                            <p>$cust_phone</p>
                            <p>$cust_email</p>
                        ";
                    }else{
                        if(isset($_COOKIE['cart'])){
                            echo "
                            <form action='place-order.php' method='GET'>
                            <table>
                                <tr>
                                    <td>
                                        <label>Name:</label><br />
                                        <input
                                            type='text'
                                            name='name'
                                            value=''
                                            placeholder='John Doe'
                                            required
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Email:</label><br />
                                        <input
                                            type='email'
                                            name='email'
                                            value=''
                                            placeholder='example@example.com'
                                            required
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Phone:</label><br />
                                        <input type='number' name='phone' value=''
                                        placeholder='Eg: 61399476640' required min='0'>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address line 1:</label><br />
                                        <input
                                            type='text'
                                            name='add1'
                                            value=''
                                            placeholder='Street name'
                                            required
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Address line 2:</label><br />
                                        <input
                                            type='text'
                                            name='add2'
                                            value=''
                                            placeholder='Suburb'
                                            required
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>State:</label><br />
                                        <input
                                            type='text'
                                            name='state'
                                            value=''
                                            placeholder='State'
                                            required
                                        />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>Post code:</label><br />
                                        <input
                                            type='number'
                                            name='post-code'
                                            value=''
                                            placeholder='Eg: 6109'
                                            min='0'
                                            required
                                        />
                                    </td>
                                </tr>
                            </table>
                            ";
                        }
                    }

                    ?>
                </div>
                <div class="each-item" style="display: block">
                    <h2>Payment method</h2>
                    <?php
                    if(isset($_SESSION['email'])){
                        echo "
                            <form action='place-order.php' method='POST'>
                        ";
                    }
                    ?>
                        <p>Select a payment option:</p><br>
                        <input type="radio" id="visa" name="payment-option" value="1">
                        <label for="visa">VISA</label><br>
                        <input type="radio" id="mastercard" name="payment-option" value="2">
                        <label for="mastercard">Mastercard</label><br>  
                        <input type="radio" id="internet-banking" name="payment-option" value="3">
                        <label for="internet-banking">Internet banking</label><br><br>
                        <div class="place-order">
                            <input type="submit" name="place-order" value="Make Payment">
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="right-section">
                <div class="price-details">
                    <h3>Price details</h3>
                </div>
                <div class="price-breakdown">
                    <div class="">
                        <p>Price (all items)</p>
                        <!-- <p>Discount</p> -->
                        <p>Shipping</p><br>
                        <b style="font-size: 1.2em">Total</b>
                    </div>
                    <div class="" style="text-align: right">
                        <b>$<?php echo $total_price; ?></b>
                        <!-- <p>$0</p> -->
                        <p>$0</p><br>
                        <b style="font-size: 1.2em">$<?php echo $total_price; ?></b>
                    </div>
                </div>
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