<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel="icon" href="images/TIMES LOGO.jpg" type="image/jpg" sizes="16x16"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Times International | Home</title>
</head>
<body>
    <header>
        <div class="brand-container">
            <div class="brand-logo">
                <img src="images/TIMES LOGO.jpg" alt="times international logo" height="70px">
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

    <div class="categories">
        <div class="each-category">
            <img src="images\categories\cereals.png" alt="">
            <div class="category-name">
                <p>Cereals</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\coconut.png" alt="">
            <div class="category-name">
                <p>Coconut products</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\dry-fruits.png" alt="">
            <div class="category-name">
                <p>Dry fruits</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\pickles.png" alt="">
            <div class="category-name">
                <p>Pickles</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\spices.png" alt="">
            <div class="category-name">
                <p>Spices</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\pickles.png" alt="">
            <div class="category-name">
                <p>Pickles</p>
            </div>
        </div>
        <div class="each-category">
            <img src="images\categories\spices.png" alt="">
            <div class="category-name">
                <p>Spices</p>
            </div>
        </div>
    </div>

    <div class="ad-banner">
        <img src="images/ad-banner/ad-banner.png" alt="">
    </div>

    <div class="slideshow-container">
        <div class="mySlides slide-in">
            <img src="images/slideshow/slider-1.png" alt="">
        </div>
        <div class="mySlides slide-in">
            <img src="images/slideshow/slider-2.png" alt="">
        </div>
        <div class="mySlides slide-in">
            <img src="images/slideshow/slider-3.png" alt="">
        </div>
        <div class="mySlides slide-in">
            <img src="images/slideshow/slider-4.png" alt="">
        </div>
    </div>

    <div class="top-products-container">
        <div class="top-products-title">
            <h3>Top products</h3>
        </div>
        <a class="arrow-left arrow"><</a>
        <a class="arrow-right arrow">></a>
        <div class="top-products-list">
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=top" alt="">
            </div>
        </div>
    </div>

    <script>
        var box = $(".top-products-list"), x;
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

    <div class="new-arrivals-container">
        <div class="new-arrivals-title">
            <h3>New arrivals</h3>
        </div>
        <a class="na-arrow-left na-arrow"><</a>
        <a class="na-arrow-right na-arrow">></a>
        <div class="new-arrivals-list">
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
            <div class="each-product">
                <img src="https://dummyimage.com/200x280.png?text=new" alt="">
            </div>
        </div>
    </div>

    <script>
        var na_box = $(".new-arrivals-list"), x;
        $(".na-arrow").click(function() {
        if ($(this).hasClass("na-arrow-right")) {
            x = ((na_box.width() / 2)) + na_box.scrollLeft();
            na_box.animate({
            scrollLeft: x,
            })
        } else {
            x = ((na_box.width() / 2)) - na_box.scrollLeft();
            na_box.animate({
            scrollLeft: -x,
            })
        }
        })
    </script>

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
    if (slideIndex > slides.length) {slideIndex = 1}    
    slides[slideIndex-1].style.display = "block";  
    setTimeout(showSlides, 3000); // Change image every 2 seconds
    }
</script>

</body>
</html>