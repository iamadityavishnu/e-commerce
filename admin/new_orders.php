<div>
    <table class="table table-bordered table-hover">
        <tr>
            <th>Order ID</th>
            <th>Invoice No.</th>
            <th>Date</th>
            <th>Product</th>
            <th>Weight</th>
            <th>Quantity</th>
            <th>Amount Paid</th>
            <th>Address</th>
            <th>Status</th>
        </tr>

        <?php
        include("..\includes\dbconnection.php");
            $sql = "SELECT * FROM orders WHERE order_status=?";
            $stmt = $conn->prepare($sql);
            $order_status = 0;
            $stmt->bind_param("i", $order_status);
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
                        <td>$order_id</td>
                        <td>$invoice_no</td>
                        <td>$date</td>
                        <td>$p_title</td>
                        <td>$weight</td>
                        <td>$qty</td>
                        <td>$amount</td>
                        <td>$cust_name<br>$cust_add1<br>$cust_add2<br>$cust_state<br>$post_code<br>
                        $cust_phone<br>
                        $cust_email</td>
                        <td>PENDING</td>
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
                        <td>$order_id</td>
                        <td>$invoice_no</td>
                        <td>$date</td>
                        <td>$p_title</td>
                        <td>$weight</td>
                        <td>$qty</td>
                        <td>$amount</td>
                        <td>$cust_name<br>$add_1<br>$add_2<br>$state<br>$post_code<br>
                        $cust_phone<br>
                        $cust_email</td>
                        <td>PENDING</td>
                    </tr>
                    ";
                }
            }
        ?>
        
    </table>
</div>