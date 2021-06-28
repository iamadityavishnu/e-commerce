<?php
include("includes\dbconnection.php");

$sql = "SELECT * FROM products WHERE p_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['p_id']);
$stmt->execute(); 
$result = $stmt->get_result();
$product = $result->fetch_assoc();

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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO TAGS -->
    <meta name="title" content="Times International ">
    <meta name="description" content="Times International PTY LTD. Buy online a range of authentic food products from Times International. Delivery across mainland.">
    <meta name="keywords" content="times international, daily delight, buy online">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="revisit-after" content="1 days">
    <meta name="author" content="Times International ">
    <!-- END OF SEO TAGS -->

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/pdt-details.css">
    <link rel="icon" href="images/TIMES LOGO.jpg" type="image/jpg" sizes="16x16"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Times International </title>
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
                        <img src="admin\images\product-images\<?php echo $p_img_1 ?>" alt="">
                    </div>
                    <div class="btn-container">
                        <input type="submit" value="Add to cart" class="btn-atc">
                        <input type="submit" value="Buy now" class="btn-buy-now">
                    </div>
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
                        <button class="btn-tiny">—</button>
                            <input type="number" value="1">
                        <button class="btn-tiny">+</button>
                    </div>
                    <div class="weight-options">
                        <div class="label-text">Weight:</div>
                        <div>
                            <select name="product-weights" id="" onchange="showPrice(this.value, <?php echo $_GET['p_id']; ?>)">
                                <option value="1"> <?php echo "$p_wt_1 Kg $$p_price_1"; ?> </option>
                                <option value="2"> <?php echo "$p_wt_2 Kg $$p_price_2"; ?> </option>
                                <option value="3"> <?php echo "$p_wt_3 Kg $$p_price_3"; ?> </option>
                            </select>
                        </div>
                        <div>
                            <p class="label-text">Available in: <?php echo "$p_wt_1 Kg | $p_wt_2 Kg | $p_wt_3 Kg"; ?></p>
                        </div>
                    </div>
                    <div class="product-description">
                        <p>
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

                        $sql = "SELECT * FROM products LIMIT 8";
                        $stmt = $conn->prepare($sql);
                        // $stmt->bind_param("i", $_GET['p_id']);
                        $stmt->execute(); 
                        $result = $stmt->get_result();
                        while($product = $result->fetch_assoc()){
                            $p_title = $product['p_title'];
                            $p_price_1 = $product['p_price_1'];
                            $p_wt_1 = $product['p_wt_1'];
                            $p_img_1 = $product['p_img_1'];

                            echo "
                            <div class='each-product product-card'>
                                <img src='admin/images/product-images/$p_img_1' alt=''>
                                <div class='product-info'>
                                    <div class='product-title'>
                                        <b>$p_title</b>
                                    </div>
                                    <div class='product-para'>
                                        $p_wt_1 Kg
                                    </div>
                                    <div class='product-price'>
                                        $$p_wt_1
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                        
                        ?>

                    </div>
                    <!-- PDT LIST ENDS -->
                </div>

                <script>
                    var box = $(".similar-products-list"), x;
                    $(".arrow").click(function() {
                    if ($(this).hasClass("arrow-right")) {
                        x = ((box.width() / 2)) + box.scrollLeft();
                        box.animate({
                        scrollLeft: x,
                        })
                    } else {
                        x = ((box.width() / 2)) - box.scrollLeft();
                        box.animate({
                        scrollLeft: -x,
                        })
                    }
                    })
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
  $(':input[type="submit"]').attr('disabled','disabled');
  var xhttp;

  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("sale-price").innerHTML = "$" + this.responseText;
    $(':input[type="submit"]').removeAttr('disabled');
    }
  };
  xhttp.open("GET", "getprice.php?index="+index+"&p="+p_id, true);
  xhttp.send();
}

</script>