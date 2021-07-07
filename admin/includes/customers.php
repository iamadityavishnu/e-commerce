<div class="includes">
    <!-- <div class="heading">
        Customers
    </div> -->
    <div class="list">
        <form action="index.php?customers">
            <div class="heading">
                <h1>Customers</h1>
            </div>
            <div class="list-search">
                <label for="">Search: </label>
                <input type="text" name="keyword">
                <input type="date" name="date_from">
                <input type="date" name="date_to">
                <input type="submit" name="cust_search" id="" value="SEARCH">
            </div>
            <table>
                
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Orders</th>
                </tr>
                <?php

                if(isset($_GET['&cust_search'])){
                    if(!empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){
                        $sql = "SELECT * FROM customers WHERE (cust_name LIKE ? OR cust_email LIKE ? OR cust_add1 LIKE ? OR cust_add2 LIKE ? OR cust_state LIKE ? OR post_code LIKE ? OR cust_phone LIKE ?) AND (created_at >= ? AND created_at <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("sssssssssii", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $date_from, $date_from, $start_from, $per_page);
                    }elseif(!empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                        $sql = "SELECT * FROM customers WHERE (cust_name LIKE ? OR cust_email LIKE ? OR cust_add1 LIKE ? OR cust_add2 LIKE ? OR cust_state LIKE ? OR post_code LIKE ? OR cust_phone LIKE ?) AND (created_at >= ? AND created_at <= ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("sssssssssii", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $date_from, $date_to, $start_from, $per_page);
                    }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                        $sql = "SELECT * FROM customers WHERE (created_at >= ? AND created_at <= ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("ssii", $date_from, $date_to, $start_from, $per_page);
                    }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){
                        $sql = "SELECT * FROM customers WHERE (created_at >= ? AND created_at <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("ssii", $date_from, $date_from, $start_from, $per_page);
                    }else{
                        $sql = "SELECT * FROM customers WHERE (cust_name LIKE ? OR cust_email LIKE ? OR cust_add1 LIKE ? OR cust_add2 LIKE ? OR cust_state LIKE ? OR post_code LIKE ? OR cust_phone LIKE ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $stmt->bind_param("sssssssii", $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $keyword, $start_from, $per_page);
                    }
                }else{
                    $sql = "SELECT * FROM customers LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $start_from, $per_page);
                }

                $stmt->execute();
                $result = $stmt->get_result();
                $total = mysqli_num_rows($result);
                while($data = $result->fetch_assoc()){
                    $cust_id = $data['cust_id'];
                    $created_at = $data['created_at'];
                    $cust_name = $data['cust_name'];
                    $cust_email = $data['cust_email'];
                    $cust_add1 = $data['cust_add1'];
                    $cust_add2 = $data['cust_add2'];
                    $cust_state = $data['cust_state'];
                    $post_code = $data['post_code'];
                    $cust_phone = $data['cust_phone'];

                    echo "
                    <tr>
                        <td>
                            $cust_id<br><br>
                            $created_at
                        </td>
                        <td>$cust_name</td>
                        <td>
                            $cust_add1<br>
                            $cust_add2<br>
                            $cust_state<br>
                            PIN: $post_code<br>
                            PH: $cust_phone<br>
                            Email: <a href='mailto:$cust_email'>$cust_email</a>
                        </td>";
                        $sql_c = "SELECT COUNT(cust_id) FROM orders WHERE cust_id=?";
                        $stmt_c = $conn->prepare($sql_c);
                        $stmt_c->bind_param("i", $cust_id);
                        $stmt_c->execute();
                        $result_c = $stmt_c->get_result();
                        $data_c = $result_c->fetch_assoc();
                        $ee = $data_c["COUNT(cust_id)"];
                        echo "
                        <td>$ee</td>
                    </tr>
                    ";
                }

                ?>
            </table>
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
                                echo "<a href='index.php?customers&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&cust_search'><li class='active'>$i</li></a>";
                            }else{
                                echo "<a href='index.php?customers&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&cust_search'><li>$i</li></a>";
                            }
                        }
                        if($present_page < $total_pages){
                            $next_page = $present_page + 1;
                            echo "<a href='index.php?customers&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$next_page&cust_search'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                        }else{
                            echo "<a href='index.php?customers&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=1&cust_search'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
                        }
                    }
                    
                    ?>
                </ul>
            </div>
        </form>
    </div>

</div>