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
    <title>Times International | Home</title>
</head>
<body>
    <header>
        <div class="brand-container">
            <div class="brand-logo">
                <img src="images/TIMES LOGO.png" alt="times international logo">
            </div>
            <div class="brand-name">
                <h1>Times <br> International</h1>
            </div>
        </div>

        <div class="search-bar">
            <div><input class="search-field type="text" placeholder="Search"></div>
            <div><button class="search-field">&#x1F50D;</button></div>
        </div>

        <div class="account-options">
            <div><a href="">My account</a></div>
            <div><a href="">Cart 🛒</a></div>
            <div class="dropdown">
                <a class="drop-btn" href="">More</a>
                <dropdown class="dropdown-content">
                    <a href="">About us</a>
                    <a href="">Legal</a>
                    <a href="">Contact us</a>
                </dropdown>
            </div>
            <div id="hamburger" onclick="toggleHam()">
                <p>☰</p>
                <dropdown class="ham-dropdown-content" id="dropdown">
                    <a href="">About us</a>
                    <a href="">Legal</a>
                    <a href="">Contact us</a>
                </dropdown>
            </div>
        </div>

        <script>
            function toggleHam(){
                var dropd = document.getElementById("dropdown");
                console.log("Click click!");
                if (dropd.style.display == "flex"){
                    console.log("None aa!");
                    dropd.style.display = "none";
                }else{
                    dropd.style.display = "flex";
                    console.log("block aa");
                }
            }
        </script>

    </header>

    <main>
        <div class="container">
            <div class="product-details">
                <div class="left-content">
                    <div class="product-image">
                        <img src="https://dummyimage.com/200x200.png?text=product" alt="">
                    </div>
                    <div class="btn-container">
                        <button class="btn-atc">
                            Add to cart
                        </button>
                        <button class="btn-buy-now">
                            Buy now
                        </button>
                    </div>
                </div>
                <div class="right-content">
                    <div class="breadcrumb">
                        <!-- TODO BREADCRUMB -->
                    </div>
                    <div class="product-title">
                        This is the product title 100 gms canned product
                    </div>
                    <div class="price">
                        <div class="sale-price">
                            $500
                        </div>
                        <div class="original-price">
                            <strike>$600</strike>
                        </div>
                    </div>
                    <div class="quantity">
                        <button class="btn-tiny">—</button>
                            <input type="number" value="1">
                        <button class="btn-tiny">+</button>
                    </div>
                    <div class="weight-options">
                        <div class="label-text">Weight:</div>
                        <div>
                            <select name="product-weights" id="">
                                <option>1kg $500</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <div>
                            <p class="label-text">Available in:</p>
                        </div>
                    </div>
                    <div class="product-description">
                        <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Animi magni voluptatem facere,
                        sunt perspiciatis deleniti et pariatur tempora delectus ratione iusto enim quia dignissimos 
                        ipsa maiores sapiente nihil laudantium? Cupiditate.
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
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title bla bla bla vla sdhsjdsd kkdsj dksjd ksdj ds</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
                        <div class="each-product product-card">
                            <img src="images/product-images/product-dummy.png" alt="">
                            <div class="product-info">
                                <div class="product-title">
                                    <b>Dummy Title</b>
                                </div>
                                <div class="product-para">
                                    1 Kg
                                </div>
                                <div class="product-price">
                                    $ 5
                                </div>
                            </div>
                        </div>
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

    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h4>Your account</h4>
                <div class="footer-column-list">
                    <ul>
                        <li>Log in</li>
                        <li>Sign-up</li>
                    </ul>
                </div>
            </div>
            <div class="footer-column">
                <h4>Quick links</h4>
                <div class="footer-column-list">
                    <ul>
                        <li>Categories</li>
                        <li>My account</li>
                        <li>Cart</li>
                        <li>Privacy policy</li>
                        <li>Delivery policy</li>
                    </ul>
                </div>
            </div>
            <div class="footer-column">
                <h4>Contact</h4>
                <div class="footer-column-list">
                    <ul>
                        <li>TIMES INTERNATIONAL PTY LTD</li>
                        <li>Australia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-column">
                <h4>Trading hours</h4>
                <div class="footer-column-list">
                    <ul>
                        <li>Monday to Saturday: 8.30am to 5.30pm</li>
                        <li>Closed Sundays and Public Holidays</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-credits">
            <div>
                <p>Copyright &copy; 2021 Times International</p>
            </div>
            <div class="payment-stripe">
                <img src="" alt="">
            </div>
        </div>
    </footer>
</body>
</html>