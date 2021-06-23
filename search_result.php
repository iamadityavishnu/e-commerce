<?php
include('includes/dbconnection.php');
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
                <p>Showing 1-12 out of 42 results for: Pickles</p>
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
                            <li>Pickles</li>
                            <li>Sweets</li>
                            <li>Flour</li>
                            <li>Convenience</li>
                            <li>More</li>
                        </ul>
                    </div>

                    <div class="brand-filter-header filter-header">
                        <p>Filter by brand</p>
                    </div>
                    <div class="brand-filter-content filter-content">
                        <ul>
                            <li>Nirapara</li>
                            <li>Daily Delight</li>
                            <li>Flour</li>
                            <li>Convenience</li>
                            <li>More</li>
                        </ul>
                    </div>
                </div>
                <!-- LEFT PANEL ENDS -->

                <!-- RIGHT SECTION BEGINS -->
                <div class="right-section">
                    <div class="search-result">
                        <div class="sort-options"></div>
                        <div class="result-grid">
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="each-product product-card">
                                <a href="product_details.php?p_id=$cat_id">
                                    <img
                                        src="admin/images/product-images/product-dummy.png"
                                        alt=""
                                    />
                                    <div class="product-info">
                                        <div class="product-title">
                                            <b>$p_title</b>
                                        </div>
                                        <div class="product-para">
                                            $p_wt_1 Kg
                                        </div>
                                        <div class="product-price">
                                            $$p_wt_1
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="pagination">
                        <div>
                            <ul>
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                                <li>5</li>
                                <li>Next</li>
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
