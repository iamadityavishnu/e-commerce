<?php
include("..\includes\dbconnection.php");

$sql = "SELECT * FROM orders WHERE order_status=?";
$stmt = $conn->prepare($sql);
$order_status = 0;
$stmt->bind_param("i", $order_status);
$stmt->execute();
$result = $stmt->get_result();
$total_results = mysqli_num_rows($result);

$sql = "SELECT * FROM orders WHERE order_status=?";
$stmt = $conn->prepare($sql);
$order_status = 1;
$stmt->bind_param("i", $order_status);
$stmt->execute();
$result = $stmt->get_result();
$total_pending = mysqli_num_rows($result);

$per_page = 5;
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$start_from = ($page - 1) * $per_page;

?>

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
                    <img id="menu-icon" src="images/icons/hamburger.svg" alt="" onclick="toggleSidebar()">
                    <img id="close-icon" style="display: none" src="images/icons/close.svg" alt="" onclick="toggleSidebar()">
                    <p class="expanded" onclick="toggleSidebar()">Close</p>
                </div>
                <div class="each-option">
                    <a href="index.php"><img src="images/icons/home.svg" alt=""></a>
                    <a href="index.php"><p class="expanded">Home</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?orders"><img src="images/icons/orders.svg" alt=""></a>
                    <a href="index.php?orders"><p class="expanded">Orders</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/add.svg" alt=""></a>
                    <a href=""><p class="expanded">Add</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/customers.svg" alt=""></a>
                    <a href=""><p class="expanded">Customers</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/analytics.svg" alt=""></a>
                    <a href=""><p class="expanded">Analytics</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/data.svg" alt=""></a>
                    <a href=""><p class="expanded">Data</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/ui.svg" alt=""></a>
                    <a href=""><p class="expanded">UI Elements</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/logout.svg" alt=""></a>
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
            <hr style="color: #EBEFF2">
            <?php
                if(empty($_GET) or isset($_GET['home'])){
                    include("includes/home.php");
                }elseif(isset($_GET['pending'])){
                    include("includes/pending.php");
                }elseif(isset($_GET['orders'])){
                    include("includes/all_orders.php");
                }elseif(isset($_GET['new_orders'])){
                    include("includes/new_orders.php");
                }elseif(isset($_GET['confirmed_orders'])){
                    include("includes/confirmed_orders.php");
                }elseif(isset($_GET['packed_orders'])){
                    include("includes/packed_orders.php");
                }elseif(isset($_GET['shipped_orders'])){
                    include("includes/shipped_orders.php");
                }elseif(isset($_GET['completed_orders'])){
                    include("includes/delivered_orders.php");
                }else{
                    echo var_dump($_GET);
                }
            ?>
        </div>
    
</body>
</html>