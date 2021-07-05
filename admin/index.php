<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Admin Panel | Times International</title>
</head>
<body>
    <!-- <div class="container"> -->
        <div class="sidebar" id="sidebar">
            <div class="brand" id="brand">
                TI
            </div>
            <hr style="color: #EBEFF2">
            <div class="menu" id="menu">
                <div class="each-option">
                    <img id="menu-icon" src="images/hamburger.svg" alt="" onclick="toggleSidebar()">
                    <img id="close-icon" style="display: none" src="images/close.svg" alt="" onclick="toggleSidebar()">
                    <p class="expanded" onclick="toggleSidebar()">Close</p>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/home.svg" alt=""></a>
                    <a href=""><p class="expanded">Home</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/orders.svg" alt=""></a>
                    <a href=""><p class="expanded">Orders</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/add.svg" alt=""></a>
                    <a href=""><p class="expanded">Add</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/customers.svg" alt=""></a>
                    <a href=""><p class="expanded">Customers</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/analytics.svg" alt=""></a>
                    <a href=""><p class="expanded">Analytics</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/data.svg" alt=""></a>
                    <a href=""><p class="expanded">Data</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/ui.svg" alt=""></a>
                    <a href=""><p class="expanded">UI Elements</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/logout.svg" alt=""></a>
                    <a href=""><p class="expanded">Logout</p></a>
                </div>
            </div>
        </div>
        <script>
            function toggleSidebar(){
                var text = document.getElementsByClassName("expanded");
                if(text[0].style.display == "block"){
                    document.getElementById("sidebar").style.width = "50px";
                    document.getElementById("brand").innerHTML = "TI";
                    document.getElementById("menu").style.alignItems = "center";
                    document.getElementById("menu").style.marginLeft = "0px";
                    document.getElementById("menu-icon").style.display = "block";
                    document.getElementById("close-icon").style.display = "none";
                    for(var i = 0; i < text.length; i++){
                        text[i].style.display = "none";
                    }
                }else{
                    document.getElementById("sidebar").style.width = "200px";
                    document.getElementById("menu").style.alignItems = "flex-start";
                    document.getElementById("menu").style.marginLeft = "20px";
                    document.getElementById("brand").innerHTML = "Times International";
                    document.getElementById("menu-icon").style.display = "none";
                    document.getElementById("close-icon").style.display = "block";
                    for(var i = 0; i < text.length; i++){
                        text[i].style.display = "block";
                    }
                }
            }
        </script>
        <div class="main">
            <div class="header">
                <div></div>
                <div class="title">
                    DASHBOARD
                </div>
                <div class="profile">
                    <div class="admin-name">
                        Hi, Nivin
                    </div>
                    <div class="admin-pic">
                        <img src="images/profile-pictures/portrait.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="includes">
                <div class="notification-cards">
                    <div class="each-card greetings">
                        <b>Hi, Nivin</b>
                        <p>Good Morning!</p>
                    </div>
                    <div class="each-card new-orders">
                        <p>You have</p>
                        <b>7 New orders</b>
                    </div>
                    <div class="each-card shipping">
                        <p>You have</p>
                        <b>5 Unshipped orders</b>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> END OF CONTAINER -->
</body>
</html>