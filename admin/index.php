<?php
include("..\includes\dbconnection.php");

$sql = "SELECT * FROM orders WHERE order_status=?";
$stmt = $conn->prepare($sql);
if(isset($_GET['search_keyword'])){
    $q = $_GET['search_keyword'];
}
$order_status = 0;
$stmt->bind_param("i", $order_status);
$stmt->execute();
$result = $stmt->get_result();
$total_results = mysqli_num_rows($result);

$per_page = 5;
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
                    <a href=""><img src="images/icons/home.svg" alt=""></a>
                    <a href=""><p class="expanded">Home</p></a>
                </div>
                <div class="each-option">
                    <a href=""><img src="images/icons/orders.svg" alt=""></a>
                    <a href=""><p class="expanded">Orders</p></a>
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
            <div class="includes">
                
                <div class="home">
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
                    <div class="home-content">
                        <div class="new-orders">
                            <table>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Product</th>
                                    <th>Weight</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                </tr>
                                <?php
                                    $sql = "SELECT * FROM orders WHERE order_status=? LIMIT ?,?";
                                    $stmt = $conn->prepare($sql);
                                    $order_status = 0;
                                    $stmt->bind_param("iii", $order_status, $start_from, $per_page);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $data = $result->fetch_all(MYSQLI_ASSOC);
                                    $total_price = 0;

                                    foreach ($data as $row){
                                        $order_id = $row['order_id'];
                                        $invoice_no = $row['invoice_no'];
                                        $date = $row['date'];
                                        $p_id = $row['p_id'];
                                        $p_title = $row['p_title'];
                                        $p_image = $row['p_image'];
                                        $qty = $row['qty'];
                                        $weight = $row['weight'];
                                        $amount = $row['amount'];
                                        $cust_id = $row['cust_id'];

                                        if($cust_id != 0){
                                            $sql = "SELECT * FROM customers WHERE cust_id=?";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("i", $cust_id);
                                            $stmt->execute();
                                            $result = $stmt->get_result();
                                            $customers = $result->fetch_assoc();

                                            $cust_name = $customers['cust_name'];
                                            $cust_add1 = $customers['cust_add1'];
                                            $cust_add2 = $customers['cust_add2'];
                                            $cust_state = $customers['cust_state'];
                                            $post_code = $customers['post_code'];
                                            $cust_phone = $customers['cust_phone'];
                                            $cust_email = $customers['cust_email'];

                                            echo "
                                            <tr>
                                                <td>
                                                    $invoice_no<br><br>
                                                    $date
                                                </td>
                                                <td>
                                                    <img src='images/product-images/$p_image' height='50px'><br><br>
                                                    $p_title
                                                </td>
                                                <td>$weight</td>
                                                <td>$qty</td>
                                                <td>$amount</td>
                                                <td class='print-icon' onclick='printDiv(\"$cust_name\", \"$cust_add1\", \"$cust_add2\", \"$cust_state\", \"$post_code\", \"$cust_phone\")'>
                                                    $cust_name<br>
                                                    $cust_add1<br>
                                                    $cust_add2<br>
                                                    $cust_state<br>
                                                    PIN: $post_code<br>
                                                    Ph: $cust_phone<br>
                                                    Email: $cust_email
                                                </td>
                                                <td>
                                                    <button class='status-btn' onclick='changeStatus($order_id)'>Confirm</button>
                                                </td>
                                            </tr>
                                            ";
                                        }else{
                                            $cust_name = $row['cust_name'];
                                            $cust_email = $row['cust_email'];
                                            $cust_phone = $row['cust_phone'];
                                            $add_1 = $row['add_1'];
                                            $add_2 = $row['add_2'];
                                            $state = $row['state'];
                                            $post_code = $row['post_code'];

                                            echo "
                                            <tr>
                                                <td>
                                                    $invoice_no<br><br>
                                                    $date
                                                </td>
                                                <td>
                                                    <img src='images/product-images/$p_image' height='50px'><br><br>
                                                    $p_title
                                                </td>
                                                <td>$weight</td>
                                                <td>$qty</td>
                                                <td>$amount</td>
                                                <td class='print-icon' onclick='printDiv(\"$cust_name\", \"$add_1\", \"$add_2\", \"$state\", \"$post_code\", \"$cust_phone\")'>
                                                    $cust_name<br>
                                                    $add_1<br>
                                                    $add_2<br>
                                                    $state<br>
                                                    PIN: $post_code<br>
                                                    Ph: $cust_phone<br>
                                                    Email: $cust_email (guest)
                                                </td>
                                                <td>
                                                    <button class='status-btn' onclick='changeStatus($order_id)'>Confirm</button>
                                                </td>
                                            </tr>
                                            ";
                                        }
                                    }
                                ?>
                            </table>
                            <script>
                                function changeStatus(n){
                                    var xhttp;
                                    xhttp = new XMLHttpRequest();
                                    xhttp.onreadystatechange = function () {
                                        if (this.readyState == 4 && this.status == 200) {
                                            if(this.responseText == "OK"){
                                                window.location.reload();
                                            }
                                        }
                                    };
                                    xhttp.open("POST", "functions/change_order_status.php", true);
                                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                    xhttp.send("confirm_order_id=" + n);
                                }
                            </script>
                            <div class="pagination">
                                <ul>
                                    <?php

                                    $total_pages = ceil($total_results/$per_page);
                                    $q = $_GET['home'];
                                    if(isset($_GET['page'])){
                                        $present_page = $_GET['page'];
                                        for($i=1; $i<=$total_pages; $i++){
                                            if($present_page == $i){
                                                echo "<a href='index.php?home&page=$i'><li class='active'>$i</li></a>";
                                            }else{
                                                echo "<a href='index.php?home&page=$i'><li>$i</li></a>";
                                            }
                                        }
                                        if($present_page < $total_pages){
                                            $next_page = $present_page + 1;
                                            echo "<a href='index.php?home&page=$next_page'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                                        }else{
                                            echo "<a href='index.php?home&page=1'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
                                        }
                                    }
                                    
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <script>
                            function printDiv(name, add_1, add_2, state, post_code, phone) {
                                var divContents = document.getElementsByClassName("print-icon").innerHTML;
                                var a = window.open('', '', 'height=500, width=500');
                                a.document.write('<html>');
                                a.document.write('<body > <h1 style="font-family: sans-serif">To, <br>');
                                a.document.write(name);
                                a.document.write('<br>');
                                a.document.write(add_1);
                                a.document.write('<br>');
                                a.document.write(add_2);
                                a.document.write('<br>');
                                a.document.write(state);
                                a.document.write('<br> PIN: ');
                                a.document.write(post_code);
                                a.document.write('<br> Phone: ');
                                a.document.write(phone);
                                a.document.write('</body></html>');
                                a.document.close();
                                a.print();
                            }
                        </script>
                        <div class="home-messages">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    
</body>
</html>