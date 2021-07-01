<?php

include('includes/dbconnection.php');
session_start();

// if(!isset($_SESSION['email'])){
//     if(!isset($_COOKIE['cart'])){
//         $cart = array(array("pid" => $p_id, "qty" => $qty, "weight" => $weight));
//     }else{
//         $cart = unserialize($_COOKIE['cart']);
//         array_push($cart, array("pid" => $p_id, "qty" => $qty, "weight" => $weight));
//         // echo var_dump($cart);
//         // echo "<br><br>";
//         // echo var_dump($cart[0]["pid"]);
//     }
// }



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
                width: 120px;
                height: 120px;
            }

            .each-item-right{
                margin-left: 30px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
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

            .place-order{
                float: right;
                padding: 20px;
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
                    <h2>Cart (2) items</h2>
                </div>
                <div class="each-item">
                    <div class="each-item-left">
                        <img src="admin/images/product-images/product-dummy.png" alt="">
                        <div class="quantity">
                            <button
                                class="btn-tiny"
                                onclick="document.getElementById('quantity').value = parseInt(document.getElementById('quantity').value) - 1;
                                if(parseInt(document.getElementById('quantity').value) < 1){document.getElementById('quantity').value = 1;}"
                            >
                                —
                            </button>
                            <input
                                id="quantity"
                                type="number"
                                name="quantity"
                                value="1"
                                min="1"
                            />
                            <button
                                class="btn-tiny"
                                onclick="document.getElementById('quantity').value = parseInt(document.getElementById('quantity').value) + 1;"
                            >
                                +
                            </button>
                        </div>
                    </div>
                    <div class="each-item-right">
                        <div class="product-info">
                            <h3>Product name</h3>
                            <p>Price: $4</p>
                            <p>Weight: 1Kg</p>
                        </div>
                        <div class="remove-btn">
                            <button>Remove</button>
                        </div>
                    </div>
                </div>
                <div class="place-order">
                    <input type="submit" name="place-order" value="Place Order">
                </div>
            </div>
            <div class="right-section">
                <div class="price-details">
                    <h3>Price details</h3>
                </div>
                <div class="price-breakdown">
                    <div class="">
                        <p>Price</p>
                        <p>Discount</p>
                        <p>Shipping</p>
                        <p>Total</p>
                    </div>
                    <div class="" style="text-align: right">
                        <p>Price</p>
                        <p>Discount</p>
                        <p>Shipping</p>
                        <p>Total</p>
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