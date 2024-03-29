<?php
$sql = "SELECT * FROM orders"; // TO REMOVE
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$total_orders = mysqli_num_rows($result);
?>

<div class="includes">
                
    <div class="home">
        <div class="order-status-options">
            <a href="index.php?orders" class="each-option" style="background: linear-gradient(90deg, #BD74EA 0%, #49B6EB 49.8%, #1DF0F0 100%); grid-column-start: span 5;">
                All orders
            </a>
            <a href="index.php?new_orders" class="each-option" style="background: linear-gradient(90deg, #7BD26D 0%, #80F76D 100%);">
                New
            </a>
            <a href="index.php?confirmed_orders" class="each-option" style="background: linear-gradient(90deg, #6DD2D2 0%, #6DD6F7 100%);">
                Confirmed
            </a>
            <a href="index.php?packed_orders" class="each-option" style="background: linear-gradient(90deg, #6D7DD2 0%, #6DACF7 100%);">
                Packed
            </a>
            <a href="index.php?shipped_orders" class="each-option" style="background: linear-gradient(90deg, #CA6DD2 0%, #BA6DF7 100%);">
                Shipped
            </a>
            <a href="index.php?completed_orders" class="each-option" style="background: linear-gradient(90deg, #ACD26D 0%, #F7E16D 100%);">
                Delivered
            </a>
            <a href="index.php?cancelled_orders" class="each-option" style="background: linear-gradient(90deg, #D2986D 0%, #F77E6D 100%)">
                Cancelled
            </a>
            <a href="index.php?returned_orders" class="each-option" style="background: linear-gradient(90deg, #D26D6D 0%, #F76DB7 100%)">
                Returned
            </a>
            <a href="index.php?replaced_orders" class="each-option" style="background: linear-gradient(90deg, #ACD26D 0%, #F7C86D 100%)">
                Replaced
            </a>
            <a href="index.php?lost_orders" class="each-option" style="background: linear-gradient(90deg, #7E7E7E 0%, #A05050 100%)">
                Lost
            </a>
            <a href="index.php?rejected_orders" class="each-option" style="background: linear-gradient(90deg, #D76C6C 0%, #FF6666 100%)">
                Rejected
            </a>
        </div>
        <div class="home-content">
            <div class="new-orders">
                <h1 style="text-align: center; margin-top: 20px; color: gray;">All orders</h1>
                <form class="list" action="index.php?orders">
                    <div class="list-search">
                        <label for="">Search: </label>
                        <input type="text" name="keyword">
                        <input type="date" name="date_from">
                        <input type="date" name="date_to">
                        <input type="submit" name="order_search" id="" value="SEARCH">
                    </div>
                </form>
                <table>
                    <tr>
                         
                    </tr>
                    <tr>
                        <th>Invoice</th>
                        <th>Product</th>
                        <th>Weight</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Address</th>
                        <th>Mark as</th>
                    </tr>
                    <?php

                        if(isset($_GET['order_search'])){
                            if(!empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){

                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?) AND (date >= ? AND date <= date_add(?, INTERVAL 7 DAY))";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $date_from = $_GET['date_from'];
                                $stmt->bind_param("ssssss", $keyword, $keyword, $keyword, $keyword, $date_from, $date_from);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $total = mysqli_num_rows($result);

                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?) AND (date >= ? AND date <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $date_from = $_GET['date_from'];
                                $stmt->bind_param("ssssssii", $keyword, $keyword, $keyword, $keyword, $date_from, $date_from, $start_from, $per_page);

                            }elseif(!empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?) AND (date >= ? AND date <= ?)";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $date_from = $_GET['date_from'];
                                $date_to = $_GET['date_to'];
                                $stmt->bind_param("ssssss", $keyword, $keyword, $keyword, $keyword, $date_from, $date_to);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $total = mysqli_num_rows($result);

                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?) AND (date >= ? AND date <= ?) LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $date_from = $_GET['date_from'];
                                $date_to = $_GET['date_to'];
                                $stmt->bind_param("ssssssii", $keyword, $keyword, $keyword, $keyword, $date_from, $date_to, $start_from, $per_page);

                            }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                                
                                $sql = "SELECT * FROM orders WHERE (date >= ? AND date <= ?)";
                                $stmt = $conn->prepare($sql);
                                $date_from = $_GET['date_from'];
                                $date_to = $_GET['date_to'];
                                $stmt->bind_param("ss", $date_from, $date_to);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $total = mysqli_num_rows($result);
                                
                                $sql = "SELECT * FROM orders WHERE (date >= ? AND date <= ?) LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                $date_from = $_GET['date_from'];
                                $date_to = $_GET['date_to'];
                                $stmt->bind_param("ssii", $date_from, $date_to, $start_from, $per_page);

                            }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){
                                
                                $sql = "SELECT * FROM orders WHERE (date >= ? AND date <= date_add(?, INTERVAL 7 DAY))";
                                $stmt = $conn->prepare($sql);
                                $date_from = $_GET['date_from'];
                                $stmt->bind_param("ss", $date_from, $date_from);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $total = mysqli_num_rows($result);

                                $sql = "SELECT * FROM orders WHERE (date >= ? AND date <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                $date_from = $_GET['date_from'];
                                $stmt->bind_param("ssii", $date_from, $date_from, $start_from, $per_page);

                            }else{

                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?)";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $stmt->bind_param("ssss", $keyword, $keyword, $keyword, $keyword);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $total = mysqli_num_rows($result);

                                $sql = "SELECT * FROM orders WHERE (order_id LIKE ? OR p_title LIKE ? OR cust_name LIKE ? OR state LIKE ?) LIMIT ?,?";
                                $stmt = $conn->prepare($sql);
                                $keyword = $_GET['keyword'];
                                $keyword = "%$keyword%";
                                $stmt->bind_param("ssssii", $keyword, $keyword, $keyword, $keyword, $start_from, $per_page);

                            }
                        }else{
                            $sql = "SELECT * FROM orders";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $total = mysqli_num_rows($result);

                            $sql = "SELECT * FROM orders LIMIT ?,?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("ii", $start_from, $per_page);
                        }
                        
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total_results = mysqli_num_rows($result);
                        $data = $result->fetch_all(MYSQLI_ASSOC);

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
                            $order_status = $row['order_status'];

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
                                        $date<br><br>";
                                        if($order_status == 0){
                                            echo "<p class='order-status os-new'>New</p>";
                                        }elseif($order_status == 1){
                                            echo "<p class='order-status os-cfm'>Confirmed</p>";
                                        }elseif($order_status == 2){
                                            echo "<p class='order-status os-pkd'>Packed</p>";
                                        }elseif($order_status == 3){
                                            echo "<p class='order-status os-shp'>Shipped</p>";
                                        }elseif($order_status == 4){
                                            echo "<p class='order-status os-del'>Delivered</p>";
                                        }elseif($order_status == 5){
                                            echo "<p class='order-status os-cnl'>Cancelled</p>";
                                        }elseif($order_status == 6){
                                            echo "<p class='order-status os-rtn'>Returned</p>";
                                        }elseif($order_status == 7){
                                            echo "<p class='order-status os-rpc'>Replaced</p>";
                                        }elseif($order_status == 8){
                                            echo "<p class='order-status os-lst'>Lost</p>";
                                        }elseif($order_status == 9){
                                            echo "<p class='order-status os-rjt'>Rejected</p>";
                                        }else{
                                            echo "NIL";
                                        }
                                    echo"   
                                    </td>
                                    <td>
                                        <img src='images/product-images/$p_image' height='50px'><br><br>
                                        $p_title
                                    </td>
                                    <td>";
                                        if($weight >= 1000){
                                            $wt = number_format((float)($weight / 1000), 3);
                                            $wt_unit = "Kg";
                                        }else{
                                            $wt = $weight;
                                            $wt_unit = "Gms";
                                        } echo"

                                        $wt $wt_unit
                                    </td>
                                    <td>$qty</td>
                                    <td>$$amount</td>
                                    <td>
                                        $cust_name<br>
                                        $cust_add1<br>
                                        $cust_add2<br>
                                        $cust_state<br>
                                        PIN: $post_code<br>
                                        Ph: $cust_phone<br>
                                        Email: $cust_email<br>
                                        <button class='status-btn print-btn' onclick='printDiv(\"$cust_name\", \"$cust_add1\", \"$cust_add2\", \"$cust_state\", \"$post_code\", \"$cust_phone\")'>Print</button>
                                    </td>
                                    <td style='vertical-align: middle'>
                                        <select name='status' onChange='changeStatus(this.options[this.selectedIndex].value, $order_id, \"$cust_email\", \"$cust_name\")'>
                                            <option value='0'>Pending</option>
                                            <option value='1'>Confirmed</option>
                                            <option value='2'>Packed</option>
                                            <option value='3'>Shipped</option>
                                            <option value='4'>Delivered</option>
                                            <option value='5'>Cancelled</option>
                                            <option value='6'>Returned</option>
                                            <option value='7'>Replaced</option>
                                            <option value='8'>Lost</option>
                                            <option value='9'>Rejected</option>
                                        </select>
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
                                        $date<br><br>";
                                        if($order_status == 0){
                                            echo "<p class='order-status os-new'>New</p>";
                                        }elseif($order_status == 1){
                                            echo "<p class='order-status os-cfm'>Confirmed</p>";
                                        }elseif($order_status == 2){
                                            echo "<p class='order-status os-pkd'>Packed</p>";
                                        }elseif($order_status == 3){
                                            echo "<p class='order-status os-shp'>Shipped</p>";
                                        }elseif($order_status == 4){
                                            echo "<p class='order-status os-del'>Delivered</p>";
                                        }elseif($order_status == 5){
                                            echo "<p class='order-status os-cnl'>Cancelled</p>";
                                        }elseif($order_status == 6){
                                            echo "<p class='order-status os-rtn'>Returned</p>";
                                        }elseif($order_status == 7){
                                            echo "<p class='order-status os-rpc'>Replaced</p>";
                                        }elseif($order_status == 8){
                                            echo "<p class='order-status os-lst'>Lost</p>";
                                        }elseif($order_status == 9){
                                            echo "<p class='order-status os-rjt'>Rejected</p>";
                                        }else{
                                            echo "NIL";
                                        }
                                    echo"   
                                    </td>
                                    <td>
                                        <img src='images/product-images/$p_image' height='50px'><br><br>
                                        $p_title
                                    </td>
                                    <td>$weight</td>
                                    <td>$qty</td>
                                    <td>$$amount</td>
                                    <td>
                                        $cust_name (guest)<br>
                                        $add_1<br>
                                        $add_2<br>
                                        $state<br>
                                        PIN: $post_code<br>
                                        Ph: $cust_phone<br>
                                        Email: $cust_email <br>
                                        <button class='status-btn print-btn' onclick='printDiv(\"$cust_name\", \"$add_1\", \"$add_2\", \"$state\", \"$post_code\", \"$cust_phone\")'>Print</button>
                                    </td>
                                    <td style='vertical-align: middle'>
                                        <select name='status' onChange='changeStatus(this.options[this.selectedIndex].value, $order_id, \"$cust_email\", \"$cust_name\")'>
                                            <option value='0'>Pending</option>
                                            <option value='1'>Confirmed</option>
                                            <option value='2'>Packed</option>
                                            <option value='3'>Shipped</option>
                                            <option value='4'>Delivered</option>
                                            <option value='5'>Cancelled</option>
                                            <option value='6'>Returned</option>
                                            <option value='7'>Replaced</option>
                                            <option value='8'>Lost</option>
                                            <option value='9'>Rejected</option>
                                        </select>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?>
                </table>
                <script src="https://smtpjs.com/v3/smtp.js"></script>
                <script>
                    function changeStatus(status_id, n, email, name){
                        var xhttp;
                        xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                if(this.responseText == "OK"){
                                    alert("Updated! Notifying customer via mail...");
                                    updateCustomerWithMail(n, email, name);
                                }
                            }
                        };
                        xhttp.open("POST", "functions/change_order_status.php", true);
                        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhttp.send("order_id=" + n + "&status_id=" + status_id);
                    }
                    function updateCustomerWithMail(n, email, name){
                        var msg_body = '';
                        if(n = 1){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been confirmed. <br/><br/> Thank you for shopping with us.';
                        }else if(n = 2){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been packed. <br/><br/> Thank you for shopping with us.';
                        }else if(n = 3){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been shipped. <br/><br/> Thank you for shopping with us.';
                        }else if(n = 4){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been delivered. <br/><br/> Thank you for shopping with us.';
                        }else if(n = 5){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been cancelled. <br/><br/> Continue shopping with us.';
                        }else if(n = 6){
                            msg_body = 'Dear ' + name + ', <br/><br/> We have received the consignment back. <br/><br/> Continue shopping with us.';
                        }else if(n = 7){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been replaced. <br/><br/> Thank you for shopping with us.';
                        }else if(n = 8){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been lost while in shipment. We are sorry for the inconvenience. <br/><br/> Please contact our customer care for further assistance.';
                        }else if(n = 9){
                            msg_body = 'Dear ' + name + ', <br/><br/> Your order has been rejected. Please contact our customer care for further assistance. <br/><br/> Continue shopping with us.';
                        }
                        Email.send({
                            Host : "smtp.gmail.com",
                            Username : "times.mailing.service@gmail.com",
                            Password : "mmszmnxcpejqhzjd",
                            To : email,
                            From : "times.mailing.service@gmail.com",
                            Subject : "Your order update from Times International",
                            Body : msg_body
                        }).then(
                        message => window.location.reload()
                        );
                    }
                </script>
                <div class="pagination">
                    <ul>
                        <?php

                        $total_pages = ceil($total/$per_page);
                        if(!isset($_GET['page'])){
                            $_GET['page'] = 1;
                        }

                        (isset($_GET['keyword'])) ? ($keyword = $_GET['keyword']) : $keyword = "";
                        (isset($_GET['date_from'])) ? ($date_from = $_GET['date_from']) : $date_from = "";
                        (isset($_GET['date_to'])) ? ($date_to = $_GET['date_to']) : $date_to = "";
                        
                        if(isset($_GET['page'])){
                            $present_page = $_GET['page'];
                            for($i=1; $i<=$total_pages; $i++){
                                if($present_page == $i){
                                    echo "<a href='index.php?orders&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&order_search'><li class='active'>$i</li></a>";
                                }else{
                                    echo "<a href='index.php?orders&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&order_search'><li>$i</li></a>";
                                }
                            }
                            if($present_page < $total_pages){
                                $next_page = $present_page + 1;
                                echo "<a href='index.php?orders&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$next_page&order_search'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                            }else{
                                echo "<a href='index.php?orders&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=1&order_search'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
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