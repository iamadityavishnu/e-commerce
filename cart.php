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
        <title>Cart | Times International</title>

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
                    <?php
                    if(!isset($_SESSION['email'])){
                        if(isset($_COOKIE['cart'])){
                            $guest_cart_count = count(unserialize($_COOKIE['cart']));
                            echo "<h2>Cart (" .count(unserialize($_COOKIE['cart'])). ") items</h2>";
                        }else{
                            echo "<h2>Your cart is empty</h2>";
                        }
                    }
                    ?>
                </div>
                <?php

                if(!isset($_SESSION['email'])){
                    if(isset($_COOKIE['cart'])){
                        $cart = unserialize($_COOKIE['cart']);
                        $total_price = 0;
                        $id_index = 0;
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

                            if($weight >= 1000){
                                $wt = number_format((float)($weight / 1000), 3);
                                $wt_unit = "Kg";
                            }else{
                                $wt = $weight;
                                $wt_unit = "Gms";
                            }
                            
                            $total_price = $total_price + ($price*$qty);

                            echo "
                            <div class='each-item'>
                                <div class='each-item-left'>
                                    <img src='admin/images/product-images/$p_img' alt=''>
                                    <div class='quantity'>
                                        <button
                                            class='btn-tiny'
                                            onclick='document.getElementById(\"quantity$id_index\").value = parseInt(document.getElementById(\"quantity$id_index\").value) - 1;
                                            if(parseInt(document.getElementById(\"quantity$id_index\").value) < 1){document.getElementById(\"quantity$id_index\").value = 1;}'
                                        >
                                            —
                                        </button>
                                        <input
                                            id='quantity$id_index'
                                            type='number'
                                            name='quantity'
                                            value='$qty'
                                            min='1'
                                        />
                                        <button
                                            class='btn-tiny'
                                            onclick='document.getElementById(\"quantity$id_index\").value = parseInt(document.getElementById(\"quantity$id_index\").value) + 1;'
                                        >
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class='each-item-right'>
                                    <div class='product-info'>
                                        <h3>$p_title</h3>
                                        <p>Price: $$price</p>
                                        <p>Weight: $wt $wt_unit</p>
                                    </div>
                                    <div class='remove-btn'>
                                        <button style='color: green' onclick='updateQty($key, document.getElementById(\"quantity$id_index\").value)'>Update</button>
                                        <button onclick='removeItem($key)'>Remove</button>
                                    </div>
                                </div>
                            </div>
                            ";
                            $id_index++;
                        }
                    }
                }else{
                    $cust_id = $_SESSION['cid'];

                    $sql = "SELECT * FROM cart WHERE cust_id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $cust_id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $user_cart_count = count($data);

                    $total_price = 0;
                    $id_index = 0;

                    echo "
                    <div class='section-header'>
                            <h2>Cart (".count($data).") items</h2>
                    </div>
                    ";
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

                        if($weight >= 1000){
                            $wt = number_format((float)($weight / 1000), 3);
                            $wt_unit = "Kg";
                        }else{
                            $wt = $weight;
                            $wt_unit = "Gms";
                        }

                        $total_price = $total_price + ($price*$qty);

                        echo "
                        <div class='each-item'>
                            <div class='each-item-left'>
                                <img src='admin/images/product-images/$p_img' alt=''>
                                <div class='quantity'>
                                    <button
                                        class='btn-tiny'
                                        onclick='document.getElementById(\"quantity$id_index\").value = parseInt(document.getElementById(\"quantity$id_index\").value) - 1;
                                        if(parseInt(document.getElementById(\"quantity$id_index\").value) < 1){document.getElementById(\"quantity$id_index\").value = 1;}'
                                    >
                                        —
                                    </button>
                                    <input
                                        id='quantity$id_index'
                                        type='number'
                                        name='quantity'
                                        value='$qty'
                                        min='1'
                                    />
                                    <button
                                        class='btn-tiny'
                                        onclick='document.getElementById(\"quantity$id_index\").value = parseInt(document.getElementById(\"quantity$id_index\").value) + 1;'
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                            <div class='each-item-right'>
                                <div class='product-info'>
                                    <h3>$p_title</h3>
                                    <p>Price: $$price</p>
                                    <p>Weight: $wt $wt_unit</p>
                                </div>
                                <div class='remove-btn'>
                                    <button style='color: green' onclick='updateQty($slno, document.getElementById(\"quantity$id_index\").value)'>Update</button>
                                    <button onclick='removeItem($slno)'>Remove</button>
                                </div>
                            </div>
                        </div>
                        ";
                        $id_index++;
                    }


                }

                ?>

                <script>
                    function removeItem(n){
                        var xhttp;
                        xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                if(this.responseText == "OK"){
                                    location.reload();
                                }
                            }
                        };
                        xhttp.open("GET", "includes/functions/updatecart.php?index=" + n, true);
                        xhttp.send();
                    }
                    function updateQty(n, qty){
                        var xhttp;
                        xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                if(this.responseText == "OK"){
                                    location.reload();
                                }
                            }
                        };
                        xhttp.open("GET", "includes/functions/updatecart.php?index=" + n + "&qty=" + qty, true);
                        xhttp.send();
                    }
                </script>
                
                <div class="place-order">
                    <?php
                    if(isset($guest_cart_count)){
                        if($guest_cart_count == 0){
                            echo "<a href='search_result.php?search_keyword='><input type='button' name='place-order' value='Start Shopping'></a>";
                        }else{
                            echo "<a href='confirmation.php'><input type='submit' name='place-order' value='Place Order'></a>";
                        }
                    }else if(isset($user_cart_count)){
                        if($user_cart_count == 0){
                            echo "<a href='search_result.php?search_keyword='><input type='submit' name='place-order' value='Start shopping'></a>";
                        }else{
                            echo "<a href='confirmation.php'><input type='submit' name='place-order' value='Place Order'></a>";
                        }
                    }else{
                        echo "<a href='search_result.php?search_keyword='><input type='submit' name='place-order' value='Start shopping'></a>";
                    }
                    ?>
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
                        <p>Shipping charge</p><br>
                        <b style="font-size: 1.2em">Total</b>
                    </div>
                    <div class="" style="text-align: right">
                        <b><?php if(isset($total_price)){ echo "$",$total_price; }else{echo "$0";}?></b>
                        <!-- <p>$0</p> -->
                        <p>$0</p><br>
                        <b style="font-size: 1.2em"><?php if(isset($total_price)){ echo "$",$total_price; }else{echo "$0";}?></b>
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
