<?php
include("..\includes\dbconnection.php");

session_start();
    if(isset($_SESSION['admin_email']) && ($_SESSION['timeout'] + 10 * 60 > time())){
        $_SESSION['timeout'] = time();
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
    <script src="https://smtpjs.com/v3/smtp.js"></script>
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
                    <a href="index.php"><img src="images/icons/home.svg" alt="" <?php if(empty($_GET) or isset($_GET['home']) or isset($_GET['pending'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php"><p class="expanded">Home</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?orders"><img src="images/icons/orders.svg" alt="" <?php if(isset($_GET['orders'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php?orders"><p class="expanded">Orders</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?insert_product"><img src="images/icons/add.svg" alt="" <?php if(isset($_GET['insert_product'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php?insert_product"><p class="expanded">Add</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?customers"><img src="images/icons/customers.svg" alt="" <?php if(isset($_GET['customers'])){ echo "class='active'"; } ?>></a>
                    <a href=""><p class="expanded">Customers</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?product_list"><img src="images/icons/data.svg" alt="" <?php if(isset($_GET['product_list'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php?product_list"><p class="expanded">Data</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?ui_elements"><img src="images/icons/ui.svg" alt="" <?php if(isset($_GET['ui_elements'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php?ui_elements"><p class="expanded">UI Elements</p></a>
                </div>
                <div class="each-option">
                    <a href="index.php?settings"><img src="images/icons/settings.svg" alt="" <?php if(isset($_GET['settings'])){ echo "class='active'"; } ?>></a>
                    <a href="index.php?settings"><p class="expanded">Analytics</p></a>
                </div>
                <div class="each-option">
                    <a href="admin_login.php"><img src="images/icons/logout.svg" alt="" <?php if(isset($_GET[''])){ echo "class='active'"; } ?>></a>
                    <a href="admin_login.php"><p class="expanded">Logout</p></a>
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
                <div style="min-width: 120px"></div>
                <div class="title">
                    DASHBOARD
                </div>
                <div class="profile">
                    <div class="admin-name">
                        Hi, <?php echo $_SESSION['admin_name']; ?>
                    </div>
                    <div class="admin-pic">
                        <img src="images/admin-images/ca7b6044398c39b298b9ce6e2f5003ca.png" alt="">
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
                    include("includes/all_orders.php"); //order_search
                }elseif(isset($_GET['order_search'])){
                    include("includes/all_orders.php"); //order_search
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
                }elseif(isset($_GET['cancelled_orders'])){
                    include("includes/cancelled_orders.php");
                }elseif(isset($_GET['returned_orders'])){
                    include("includes/returned_orders.php");
                }elseif(isset($_GET['replaced_orders'])){
                    include("includes/replaced_orders.php");
                }elseif(isset($_GET['lost_orders'])){
                    include("includes/lost_orders.php");
                }elseif(isset($_GET['rejected_orders'])){
                    include("includes/rejected_orders.php");
                }elseif(isset($_GET['insert_product'])){
                    include("includes/insert-product.php");
                }elseif(isset($_GET['insert_category'])){
                    include("includes/add_category.php");
                }elseif(isset($_GET['insert_brand'])){
                    include("includes/add_brand.php");
                }elseif(isset($_GET['customers'])){
                    include("includes/customers.php"); //customers
                }elseif(isset($_GET['cust_search'])){
                    include("includes/customers.php"); //customers
                }elseif(isset($_GET['product_list'])){
                    include("includes/product_list.php"); //product
                }elseif(isset($_GET['prod_search'])){
                    include("includes/product_list.php"); //product
                }elseif(isset($_GET['category_list'])){
                    include("includes/category_list.php"); //category
                }elseif(isset($_GET['cat_search'])){
                    include("includes/category_list.php"); //category
                }elseif(isset($_GET['brand_list'])){
                    include("includes/brand_list.php"); //brand
                }elseif(isset($_GET['brand_search'])){
                    include("includes/brand_list.php"); //brand 
                }elseif(isset($_GET['ui_elements'])){
                    include("includes/ui_elements.php"); //ui_elements
                }elseif(isset($_GET['settings'])){
                    include("includes/settings.php"); //settings
                }elseif(isset($_GET['change_password'])){
                    include("includes/change_password.php"); //change password
                }elseif(isset($_GET['add_admin'])){
                    include("includes/add_admin.php"); //ui_elements
                }else{
                    echo "No such page";
                }
            ?>
        </div>
    
</body>
</html>

<?php
    }
    else{
        echo "<script>window.open('admin_login.php','_self')</script>";
    }
?>
