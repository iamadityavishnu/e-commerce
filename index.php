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
        <link rel="stylesheet" href="style/home.css" />
        <link
            rel="icon"
            href="images/TIMES LOGO.jpg"
            type="image/jpg"
            sizes="16x16"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Times International | Home</title>
    </head>
    <body>
        <?php
        include("includes/header.php");
        ?>

        <div class="categories">
            
            <?php

            $sql = "SELECT * FROM categories LIMIT 6";
            $stmt = $conn->prepare($sql);
            $stmt->execute(); 
            $result = $stmt->get_result();
            while($categories = $result->fetch_assoc()){
                $cat_id = $categories['cat_id'];
                $cat_title = $categories['cat_title'];
                $cat_image = $categories['cat_image'];

                echo "
                <div class='each-category'>
                    <a href='http://localhost/times-international/search_result.php?search_keyword=&cat=$cat_id&cat_title=$cat_title'>
                        <img src='admin/images/categories/$cat_image' alt='$cat_title' />
                    </a>
                    <div class='category-name'>
                        <p><a href='http://localhost/times-international/search_result.php?search_keyword=&cat=$cat_id&cat_title=$cat_title'>$cat_title</a></p>
                    </div>
                </div>
                ";
            }

            ?>
        </div>

        <div class="ad-banner">

            <?php
                $sql = "SELECT * FROM ad_banner";
                $stmt = $conn->prepare($sql);
                $stmt->execute(); 
                $result = $stmt->get_result();
                while($categories = $result->fetch_assoc()){
                    $b_image = $categories['banner_img'];
                    echo "
                        <img src='admin/images/ad-banner/$b_image' alt='' />
                    ";
                }
            ?>
            
        </div>

        <div class="slideshow-container">

            <?php
                $sql = "SELECT * FROM slider_images";
                $stmt = $conn->prepare($sql);
                $stmt->execute(); 
                $result = $stmt->get_result();
                while($categories = $result->fetch_assoc()){
                    $image = $categories['slider_img'];
                    echo "
                        <div class='mySlides slide-in'>
                            <img src='admin/images/slideshow/$image' alt='' />
                        </div>
                    ";
                }
            ?>
            
        </div>

        <div class="pdt-container-horizontal">
            <div class="title-horizontal">
                <h3>Top products</h3>
            </div>
            <a class="arrow-left arrow"><</a>
            <a class="arrow-right arrow">></a>
            <div class="pdt-list-horizontal top-products-list">
                <?php

                $sql = "SELECT * FROM products LIMIT 8";
                $stmt = $conn->prepare($sql);
                // $stmt->bind_param("i", $_GET['p_id']);
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
                        </a>
                    </div>
                    ";
                }

                ?>
            </div>
        </div>

        <script>
            var box = $(".top-products-list"),
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

        <div class="pdt-container-horizontal">
            <div class="title-horizontal">
                <h3>New arrivals</h3>
            </div>
            <a class="na-arrow-left na-arrow"><</a>
            <a class="na-arrow-right na-arrow">></a>
            <div class="pdt-list-horizontal new-arrival-list">
                <?php

                $sql = "SELECT * FROM products ORDER BY p_id DESC LIMIT 8";
                $stmt = $conn->prepare($sql);
                // $stmt->bind_param("i", $_GET['p_id']);
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
                        </a>
                    </div>
                    ";
                }

                ?>
            </div>
        </div>

        <script>
            var na_box = $(".new-arrival-list"),
                x;
            $(".na-arrow").click(function () {
                if ($(this).hasClass("na-arrow-right")) {
                    x = na_box.width() / 2 + na_box.scrollLeft();
                    na_box.animate({
                        scrollLeft: x,
                    });
                } else {
                    x = na_box.width() / 2 - na_box.scrollLeft();
                    na_box.animate({
                        scrollLeft: -x,
                    });
                }
            });
        </script>

        <?php
        include("includes/footer.php");
        ?>

        <script>
            var slideIndex = 0;
            showSlides();

            function showSlides() {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1;
                }
                slides[slideIndex - 1].style.display = "block";
                setTimeout(showSlides, 3000); // Change image every 2 seconds
            }
        </script>
    </body>
</html>
