<div class="includes">
                
    <div class="home">
        <div class="notification-cards">
            <div class="each-card greetings">
                <b>Hi, Nivin</b>
                <p id="greetings"></p>
                <script>
                    var now = new Date();
                    var hrs = now.getHours();
                    var msg = "";
                    if (0 <= hrs && hrs < 6){ msg = "Mornin' Sunshine!";} // REALLY early
                    else if (6 <= hrs && hrs < 12){ msg = "Good morning!";}      // After 6am
                    else if (12 <= hrs && hrs < 17){ msg = "Good afternoon!";}    // After 12pm
                    else if (17 <= hrs && hrs < 22){ msg = "Good evening!";}      // After 5pm
                    else { msg = "Good to see you 😴!";}  // After 10pm
                    document.getElementById("greetings").innerHTML = msg;
                </script>
            </div>
            <div class="each-card new-orders">
                <a href="index.php?home" class="silent-link">
                    <p>You have</p>
                    <b><?php echo $total_results; ?> New orders</b>
                </a>
            </div>
            <div class="each-card shipping">
                <a href="index.php?pending" class="silent-link">
                    <p>You have</p>
                    <b><?php echo $total_pending; ?> Unshipped orders</b>
                </a>
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
                        <th>Options</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM orders WHERE order_status=? LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $order_status = 0;
                        $stmt->bind_param("iii", $order_status, $start_from, $per_page);
                        $stmt->execute();
                        $result = $stmt->get_result();
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
                                        Email: $cust_email <br>
                                        <button class='status-btn print-btn' onclick='printDiv(\"$cust_name\", \"$cust_add1\", \"$cust_add2\", \"$cust_state\", \"$post_code\", \"$cust_phone\")'>Print</button>
                                    </td>
                                    <td style='vertical-align: middle'>
                                        <button class='status-btn' onclick='changeStatus($order_id, 1)'>Confirm</button><br><br>
                                        <button class='status-btn reject-btn' onclick='changeStatus($order_id, 9)'>Reject</button>
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
                                    <td>$$amount</td>
                                    <td class='print-icon'>
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
                                        <button class='status-btn' onclick='changeStatus($order_id, 1)'>Confirm</button><br><br>
                                        <button class='status-btn reject-btn' onclick='changeStatus($order_id, 9)'>Reject</button>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    ?>
                </table>
                <script>
                    function changeStatus(n, status_id){
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

                        $total_pages = ceil($total_results/$per_page);
                        if(!isset($_GET['page'])){
                            $_GET['page'] = 1;
                        }
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