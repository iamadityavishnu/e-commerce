<?php
$sql = "SELECT * FROM orders WHERE order_status=?";
$stmt = $conn->prepare($sql);
$order_status = 2;
$stmt->bind_param("i", $order_status);
$stmt->execute();
$result = $stmt->get_result();
$total = mysqli_num_rows($result);
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
                <table>
                    <tr>
                        <h1 style="margin: 20px; color: gray">Packed orders</h1> 
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
                        $sql = "SELECT * FROM orders WHERE order_status=? LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iii", $order_status, $start_from, $per_page);
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
                                        $date<br><br>
                                        <p class='order-status os-pkd'>Packed</p>  
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
                                        <select name='status' onChange='changeStatus(this.options[this.selectedIndex].value, $order_id)'>
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
                                        $date<br><br>
                                        <p class='order-status os-pkd'>Packed</p>  
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
                                        <select name='status' onChange='changeStatus(this.options[this.selectedIndex].value, $order_id)'>
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
                <script>
                    function changeStatus(status_id, n){
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
                        xhttp.send("order_id=" + n + "&status_id=" + status_id);
                    }
                </script>
                <div class="pagination">
                    <ul>
                        <?php

                        $total_pages = ceil($total/$per_page);
                        if(!isset($_GET['page'])){
                            $_GET['page'] = 1;
                        }
                        if(isset($_GET['page'])){
                            $present_page = $_GET['page'];
                            for($i=1; $i<=$total_pages; $i++){
                                if($present_page == $i){
                                    echo "<a href='index.php?packed_orders&page=$i'><li class='active'>$i</li></a>";
                                }else{
                                    echo "<a href='index.php?packed_orders&page=$i'><li>$i</li></a>";
                                }
                            }
                            if($present_page < $total_pages){
                                $next_page = $present_page + 1;
                                echo "<a href='index.php?packed_orders&page=$next_page'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                            }else{
                                echo "<a href='index.php?packed_orders&page=1'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
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