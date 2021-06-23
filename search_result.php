<?php
include('includes/dbconnection.php');

$sql = "SELECT * FROM products WHERE p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?";
$stmt = $conn->prepare($sql);
if(isset($_GET['search_keyword'])){
    $q = $_GET['search_keyword'];
}
$q = "%$q%";
$stmt->bind_param("sss", $q, $q, $q);
$stmt->execute();
$result = $stmt->get_result();

$total_results = mysqli_num_rows($result);
$per_page = 8;

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $_GET['page'] = 1;
    $page = 1;
}

$start_from = ($page - 1) * $per_page;

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
        <link rel="stylesheet" href="style/search-result.css" />
        <link
            rel="icon"
            href="images/TIMES LOGO.jpg"
            type="image/jpg"
            sizes="16x16"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Search results | Times International</title>

    </head>
    <body>
        <?php
        include("includes/header.php");
        ?>

        <main>
            <div class="search-page-info">
                <p>
                    Showing <?php echo ($start_from + 1), " - ", ($start_from + $per_page); ?> out of <?php echo $total_results ?> results for: <b><?php echo "'", $_GET['search_keyword'], "'"; ?></b>
                    <?php 
                    if(isset($_GET['cat_title'])){
                        echo "from category <b>", $_GET['cat_title'], "</b>";
                    }
                    if(isset($_GET['brand_name'])){
                        echo "from brand <b>", $_GET['brand_name'], "</b>";
                    } ?>
                </p>
            </div>
            <div id="filter-toggle" onclick="toggleFilter()">
                <p>Filter <img src="images/down-arrow.png" alt="" height="20px" style="float: right; margin: 15px 20px;"></p>
            </div>

            <script>
                function toggleFilter(){
                    var left_panel = document.getElementById("left-panel");
                    if(left_panel.style.display == "block"){
                        left_panel.style.display = "none";
                    }else{
                        left_panel.style.display = "block";
                    }
                }
            </script>

            <div class="result-container">
                <!-- LEFT PANEL BEGINS -->
                <div class="left-panel" id="left-panel">
                    <div class="category-filter-header filter-header">
                        <p>Filter by category</p>
                    </div>
                    <div class="category-filter-content filter-content">
                        <ul>
                            <?php
                            $q = $_GET['search_keyword'];
                            $sql = "SELECT cat_id, cat_title FROM categories";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($categories = $result->fetch_assoc()){
                                $cat_id = $categories['cat_id'];
                                $cat_title = $categories['cat_title'];
                                echo "<a href='search_result.php?search_keyword=$q&cat=$cat_id&cat_title=$cat_title'><li>$cat_title</li></a>";
                            }
                            ?>
                            <!-- <li>More</li> -->
                        </ul>
                    </div>

                    <div class="brand-filter-header filter-header">
                        <p>Filter by brand</p>
                    </div>
                    <div class="brand-filter-content filter-content">
                        <ul>
                            <?php
                            $sql = "SELECT b_id, b_name FROM brand";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            while ($brands = $result->fetch_assoc()){
                                $b_id = $brands['b_id'];
                                $b_name = $brands['b_name'];
                                echo "<a href='search_result.php?search_keyword=$q&brand=$b_id&brand_name=$b_name'><li>$b_name</li></a>";
                            }
                            ?>
                            <!-- <li>More</li> -->
                        </ul>
                    </div>
                </div>
                <!-- LEFT PANEL ENDS -->

                <!-- RIGHT SECTION BEGINS -->
                <div class="right-section">
                    <div class="search-result">
                        <div class="sort-options"></div>
                        <div class="result-grid">

                            <?php
                            if(isset($_GET['cat'])){
                                $sql = "SELECT * FROM products WHERE cat_id=? HAVING p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ? LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                if(isset($_GET['search_keyword'])){
                                    $q = $_GET['search_keyword'];
                                }
                                $q = "%$q%";
                                $cat_id = $_GET['cat'];
                                $stmt->bind_param("isssii", $cat_id, $q, $q, $q, $start_from, $per_page);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }else if(isset($_GET['brand'])){
                                $sql = "SELECT * FROM products WHERE b_id=? HAVING p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ? LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                if(isset($_GET['search_keyword'])){
                                    $q = $_GET['search_keyword'];
                                }
                                $q = "%$q%";
                                $b_id = $_GET['brand'];
                                $stmt->bind_param("isssii", $b_id, $q, $q, $q, $start_from, $per_page);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }else{
                                $sql = "SELECT * FROM products WHERE p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ? LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                if(isset($_GET['search_keyword'])){
                                    $q = $_GET['search_keyword'];
                                }
                                $q = "%$q%";
                                $stmt->bind_param("sssii", $q, $q, $q, $start_from, $per_page);
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }

                            if(mysqli_num_rows($result) == 0){
                                echo "Sorry! No products match the keyword";
                                // echo !empty($_GET['brand']);
                            }else{
                                while ($product = $result->fetch_assoc()){
                                $p_id = $product['p_id'];
                                $p_img = $product['p_img_1'];
                                $p_title = $product['p_title'];
                                $p_weight = $product['p_wt_1'];
                                $p_price = $product['p_price_1'];

                                echo "
                                <div class='each-product product-card'>
                                    <a href='product_details.php?p_id=$p_id'>
                                        <img
                                            src='admin/images/product-images/$p_img'
                                            alt=''
                                        />
                                        <div class='product-info'>
                                            <div class='product-title'>
                                                <b>$p_title</b>
                                            </div>
                                            <div class='product-para'>
                                                $p_weight Kg
                                            </div>
                                            <div class='product-price'>
                                                $$p_price
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ";
                                }
                            }

                            ?>

                        </div>
                    </div>

                    <div class="pagination">
                        <div>
                            <ul>

                                <?php

                                $total_pages = ceil($total_results/$per_page);
                                $q = $_GET['search_keyword'];
                                if(isset($_GET['page'])){
                                    $present_page = $_GET['page'];
                                    for($i=1; $i<=$total_pages; $i++){
                                        if($present_page == $i){
                                            echo "<a href='search_result.php?search_keyword=$q&page=$i'><li class='active'>$i</li></a>";
                                        }else{
                                            echo "<a href='search_result.php?search_keyword=$q&page=$i'><li>$i</li></a>";
                                        }
                                    }
                                    if($present_page < $total_pages){
                                        $next_page = $present_page + 1;
                                        echo "<a href='search_result.php?search_keyword=$q&page=$next_page'><li>Next</li></a>";
                                    }else{
                                        echo "<a href='search_result.php?search_keyword=$q&page=1'><li style='width: auto;'>First page</li></a>";
                                    }
                                }
                                
                                ?>
                            
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <!-- RIGHT SECTION ENDS -->
            </div>
        </main>

        <?php
        include("includes/footer.php");
        ?>

    </body>
</html>
