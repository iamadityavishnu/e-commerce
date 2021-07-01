<?php
include("includes\dbconnection.php");
session_start();

$sql = "SELECT * FROM products WHERE p_id=?";
$stmt = $conn->prepare($sql);
$p_id = $_GET['p_id'];
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$cat_id = $product['cat_id'];
$p_title = $product['p_title'];
$p_price_1 = $product['p_price_1'];
$p_price_2 = $product['p_price_2'];
$p_price_3 = $product['p_price_3'];
$p_wt_1 = $product['p_wt_1'];
$p_wt_2 = $product['p_wt_2'];
$p_wt_3 = $product['p_wt_3'];
$p_desc = $product['p_desc'];
$p_img_1 = $product['p_img_1'];
$p_img_2 = $product['p_img_2'];
$p_img_3 = $product['p_img_3'];

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
        <link rel="stylesheet" href="style/pdt-details.css" />
        <link
            rel="icon"
            href="images/TIMES LOGO.jpg"
            type="image/jpg"
            sizes="16x16"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Times International</title>
        <style>
            .tiny-thumbnail{
                display: flex;
                justify-content: center;
                align-content: center;
                width: 100%;
            }

            .tiny-thumbnail .each-tiny-img img{
                cursor: pointer;
                height: 55px;
                width: 55px;
                margin: 10px 10px;
                border: 2px solid #242424;
                border-radius: 50%;
                box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
                -webkit-box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
            }
            /* .confirmation{
                position: fixed;
                bottom: 40px;
                z-index: 10;
                width: 300px;
                display: none;
                flex-direction: row;
                justify-content: center;
                align-items: center;
                padding: 10px 0;
                background: #fff;
                font-size: 1.2em;
                font-weight: bold;
                border-radius: 40px;
                box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
                -webkit-box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
                -moz-box-shadow: 0px 0px 37px -1px rgba(0,0,0,0.75);
            } */
        </style>
    </head>
    <body>
    <?php
    include("includes/header.php");
    ?>

        <main>
            <div class="container">
                <div class="product-details">
                    <div class="left-content">
                        <div class="product-image">
                            <img
                                style="display: block;"
                                class="productImage"
                                id="productImage1"
                                src="admin\images\product-images\<?php echo $p_img_1 ?>"
                                alt=""
                            />

                            <?php
                                if($p_img_2 != ""){
                                    echo "
                                        <img
                                            class='productImage'
                                            style='display: none;'
                                            id='productImage2'
                                            src='admin\images\product-images/$p_img_2'
                                            alt=''
                                        />
                                    ";
                                }
                                if($p_img_3 != ""){
                                    echo "
                                        <img
                                            class='productImage'
                                            style='display: none;'
                                            id='productImage3'
                                            src='admin\images\product-images/$p_img_3'
                                            alt=''
                                        />
                                    ";
                                }
                            ?>
                        </div>
                        <div class="tiny-thumbnail">
                            <div class="each-tiny-img" onclick="currentImage(1)">
                                <img src="<?php echo "admin/images/product-images/$p_img_1"; ?>" alt="">
                            </div>
                            <?php
                                if($p_img_2 != ""){
                                    echo "
                                    <div class='each-tiny-img' onclick='currentImage(2)'>
                                        <img src='admin/images/product-images/$p_img_2' alt=''>
                                    </div>
                                    ";
                                }
                                if($p_img_3 != ""){
                                    echo "
                                    <div class='each-tiny-img' onclick='currentImage(3)'>
                                        <img src='admin/images/product-images/$p_img_3' alt=''>
                                    </div>
                                    ";
                                }
                            ?>
                        </div>

                        <script>
                            var images = document.getElementsByClassName('productImage');
                            function currentImage(n){
                                for(i = 0; i < images.length; i++){
                                    images[i].style.display = "none";
                                }
                                images[n-1].style.display = "block";
                            }
                        </script>

                        <div class="btn-container">
                            <input
                                id="btn-atc"
                                type="submit"
                                value="Add to cart"
                                class="btn-atc"
                                onclick="addToCart()"
                            />
                            <input
                                type="submit"
                                value="Buy now"
                                class="btn-buy-now"
                            />
                        </div>

                        <script>
                            function addToCart(){
                                $(':input[type="submit"]').attr("disabled", "disabled");

                                var quantity = document.getElementById("quantity").value;
                                console.log(quantity);
                                var weight = document.getElementById("weight").value;
                                console.log(weight);
                                var p_id = <?php echo $p_id; ?>;
                                console.log(p_id);

                                var xhttp;
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if(this.responseText == "OK"){
                                            document.getElementById("btn-atc").value = "Added to cart";
                                            document.getElementById("btn-atc").style.background = "#27b33e";
                                        }
                                    }
                                };
                                xhttp.open("GET", "includes/functions/addtocart.php?p_id=" + p_id + "&qty=" + quantity + "&weight=" + weight, true);
                                xhttp.send();
                            }
                        </script>

                        <!-- <div class="confirmation" id="confirmation">
                            <img src="images/tick.png" alt="">
                            <p style="margin-left: 20px">Added successfully</p> 
                        </div> -->
                    </div>
                    <div class="right-content">
                        <div class="breadcrumb">
                            <!-- TODO BREADCRUMB -->
                        </div>
                        <div class="product-title">
                            <?php echo $p_title; ?>
                        </div>
                        <div class="price">
                            <div class="sale-price" id="sale-price">
                                <?php echo "$$p_price_1"; ?>
                            </div>
                            <!-- <div class="original-price">
                                <strike>$600</strike>
                            </div> -->
                        </div>
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
                        <div class="weight-options">
                            <div class="label-text">Weight:</div>

                            <div>
                                <select
                                    name="product-weights"
                                    id="weight"
                                    onchange="showPrice(this.value, <?php echo $_GET['p_id']; ?>)"
                                >
                                    <option value="1">
                                        <?php echo "$p_wt_1 Kg $$p_price_1"; ?>
                                    </option>
                                    <option value="2">
                                        <?php echo "$p_wt_2 Kg $$p_price_2"; ?>
                                    </option>
                                    <option value="3">
                                        <?php echo "$p_wt_3 Kg $$p_price_3"; ?>
                                    </option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="product-description">
                            <div>
                                <p class="label-text">
                                    <b>Available in:</b>
                                    <?php echo "$p_wt_1 Kg · $p_wt_2 Kg · $p_wt_3 Kg"; ?>
                                </p>
                            </div>
                            <br>
                            <p>
                                <b>Description:</b>
                                <?php echo $p_desc; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- SIMILAR PDTS SECTION BEGINS -->
                <div class="similar-products">
                    <div class="pdt-container-horizontal">
                        <div class="title-horizontal">
                            <h3>Similar products</h3>
                        </div>
                        <a class="arrow-left arrow"><</a>
                        <a class="arrow-right arrow">></a>

                        <!-- PDT LIST BEGINS -->
                        <div class="pdt-list-horizontal similar-products-list">
                            <?php

                        $sql = "SELECT * FROM products WHERE cat_id=? LIMIT 8";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $cat_id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($product = $result->fetch_assoc()){
                        
                        $p_id = $product['p_id'];
                        $p_title = $product['p_title'];
                        $p_price_1 = $product['p_price_1'];
                        $p_wt_1 = $product['p_wt_1'];
                        $p_img_1 = $product['p_img_1'];
                        echo "
                        <div class='each-product product-card'>
                            <a href='product_details.php?p_id=$p_id'>
                            <img
                                src='admin/images/product-images/$p_img_1'
                                alt=''
                            />
                            <div class='product-info'>
                                <div class='product-title'>
                                    <b>$p_title</b>
                                </div>
                                <div class='product-para'>$p_wt_1 Kg</div>
                                <div class='product-price'>$$p_wt_1</div>
                            </div>
                            </a>
                        </div>
                        ";

                        }
                        
                        ?>
                        </div>
                        <!-- PDT LIST ENDS -->
                    </div>

                    <script>
                        var box = $(".similar-products-list"),
                            x;
                        $(".arrow").click(function () {
                            if ($(this).hasClass("arrow-right")) {
                                x = box.width() / 2 + box.scrollLeft();
                                box.animate({
                                    scrollLeft: x,
                                });
                            } else {
                                x = box.width() / 2 - box.scrollLeft();
                                box.animate({
                                    scrollLeft: -x,
                                });
                            }
                        });
                    </script>
                </div>
                <!-- SIMILAR PDTS SECTION ENDS -->
            </div>
        </main>

        <!-- <WARNING> WE VERIFY EACH PURCHASE BEFORE SHIPPING. SO DON'T TRY TO CHEAT </WARNING> -->

        <?php
    include("includes/footer.php");
    ?>
    </body>
</html>

<script>
    function showPrice(index, p_id) {
        $(':input[type="submit"]').attr("disabled", "disabled");
        var xhttp;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("sale-price").innerHTML =
                    "$" + this.responseText;
                $(':input[type="submit"]').removeAttr("disabled");
            }
        };
        xhttp.open("GET", "getprice.php?index=" + index + "&p=" + p_id, true);
        xhttp.send();
    }
</script>
