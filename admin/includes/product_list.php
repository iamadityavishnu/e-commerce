<div class="includes">

<div class="add-section-options">
    <a href="index.php?product_list" class="each-option" style="background: linear-gradient(90deg, #6D7DD2 0%, #6DACF7 100%);">
        Product list
    </a>
    <a href="index.php?category_list" class="each-option" style="background: linear-gradient(90deg, #7BD26D 0%, #80F76D 100%);">
        Category list
    </a>
    <a href="index.php?brand_list" class="each-option" style="background: linear-gradient(90deg, #D2986D 0%, #F77E6D 100%);">
        Brand list
    </a>
</div>

<div class="list" style="margin-top: 20px">
        <form action="index.php?product_list" method=GET">
            <h1 class="heading">All products</h1>
            <div class="list-search">
                <label for="">Search: </label>
                <input type="text" name="keyword">
                <input type="date" name="date_from">
                <input type="date" name="date_to">
                <input type="submit" name="prod_search" id="" value="SEARCH">
            </div>
            <table>
                
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Weights</th>
                    <th>Prices</th>
                    <th>Keywords</th>
                    <th>Stock</th>
                </tr>
                <?php

                if(isset($_GET['prod_search'])){
                    if(!empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){

                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?) AND (date >= ? AND date <= date_add(?, INTERVAL 7 DAY))";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("ssssss", $keyword, $keyword, $keyword, $keyword, $date_from, $date_from);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = mysqli_num_rows($result);

                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?) AND (date >= ? AND date <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("ssssssii", $keyword, $keyword, $keyword, $keyword, $date_from, $date_from, $start_from, $per_page);

                    }elseif(!empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?) AND (date >= ? AND date <= ?)";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("ssssss", $keyword, $keyword, $keyword, $keyword, $date_from, $date_to);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = mysqli_num_rows($result);

                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?) AND (date >= ? AND date <= ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("ssssssii", $keyword, $keyword, $keyword, $keyword, $date_from, $date_to, $start_from, $per_page);

                    }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && !empty($_GET['date_to'])){
                        
                        $sql = "SELECT * FROM products WHERE (date >= ? AND date <= ?)";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("ss", $date_from, $date_to);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = mysqli_num_rows($result);
                        
                        $sql = "SELECT * FROM products WHERE (date >= ? AND date <= ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $date_to = $_GET['date_to'];
                        $stmt->bind_param("ssii", $date_from, $date_to, $start_from, $per_page);

                    }elseif(empty($_GET['keyword']) && !empty($_GET['date_from']) && empty($_GET['date_to'])){
                        
                        $sql = "SELECT * FROM products WHERE (date >= ? AND date <= date_add(?, INTERVAL 7 DAY))";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("ss", $date_from, $date_from);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = mysqli_num_rows($result);

                        $sql = "SELECT * FROM products WHERE (date >= ? AND date <= date_add(?, INTERVAL 7 DAY)) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $date_from = $_GET['date_from'];
                        $stmt->bind_param("ssii", $date_from, $date_from, $start_from, $per_page);

                    }else{

                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?)";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $stmt->bind_param("ssss", $keyword, $keyword, $keyword, $keyword);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $total = mysqli_num_rows($result);

                        $sql = "SELECT * FROM products WHERE (p_id LIKE ? OR p_title LIKE ? OR p_keywords LIKE ? OR p_desc LIKE ?) LIMIT ?,?";
                        $stmt = $conn->prepare($sql);
                        $keyword = $_GET['keyword'];
                        $keyword = "%$keyword%";
                        $stmt->bind_param("ssssii", $keyword, $keyword, $keyword, $keyword, $start_from, $per_page);

                    }
                }else{

                    $sql = "SELECT * FROM products";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = mysqli_num_rows($result);

                    $sql = "SELECT * FROM products LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $start_from, $per_page);
                }

                $stmt->execute();
                $result = $stmt->get_result();
                while($data = $result->fetch_assoc()){
                    $p_id = $data['p_id'];
                    $c_id = $data['cat_id'];
                    $b_id = $data['b_id'];
                    $date = $data['date'];
                    $p_title = $data['p_title'];
                    $p_image = $data['p_img_1'];
                    $p_wt_1 = $data['p_wt_1'];
                    $p_wt_2 = $data['p_wt_2'];
                    $p_wt_3 = $data['p_wt_3'];
                    $p_price_1 = $data['p_price_1'];
                    $p_price_2 = $data['p_price_2'];
                    $p_price_3 = $data['p_price_3'];
                    $in_liters = $data['in_liters'];
                    $p_keywords = $data['p_keywords'];
                    $p_desc = $data['p_desc'];
                    $stock_left = $data['stock_left'];

                    $sql_c = "SELECT cat_title FROM categories WHERE cat_id=?";
                    $stmt_c = $conn->prepare($sql_c);
                    $stmt_c->bind_param("i", $c_id);
                    $stmt_c->execute();
                    $result_c = $stmt_c->get_result();
                    $data_c = $result_c->fetch_assoc();
                    $cat_name = $data_c["cat_title"];

                    $sql_b = "SELECT b_name FROM brand WHERE b_id=?";
                    $stmt_b = $conn->prepare($sql_b);
                    $stmt_b->bind_param("i", $b_id);
                    $stmt_b->execute();
                    $result_b = $stmt_b->get_result();
                    $data_b = $result_b->fetch_assoc();
                    $brand_name = $data_b["b_name"];

                    echo "
                    <tr>
                        <td>
                            $p_id<br><br>
                            $date
                        </td>
                        <td>
                            <img src='images/product-images/$p_image' height='50px'><br><br>
                            $p_title
                        </td>
                        <td>$p_desc</td>
                        <td>$cat_name</td>
                        <td>$brand_name</td>
                        <td>
                            $p_wt_1<br><br>
                            $p_wt_2<br><br>
                            $p_wt_3
                        </td>
                        <td>
                            $$p_price_1<br><br>
                            $$p_price_2<br><br>
                            $$p_price_3
                        </td>
                        <td>$p_keywords</td>
                        <td>$stock_left</td>
                        
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
                                echo "<a href='index.php?product_list&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&prod_search'><li class='active'>$i</li></a>";
                            }else{
                                echo "<a href='index.php?product_list&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$i&prod_search'><li>$i</li></a>";
                            }
                        }
                        if($present_page < $total_pages){
                            $next_page = $present_page + 1;
                            echo "<a href='index.php?product_list&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=$next_page&prod_search'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                        }else{
                            echo "<a href='index.php?product_list&keyword=$keyword&date_from=$date_from&date_to=$date_to&page=1&prod_search'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
                        }
                    }
                    
                    ?>
                </ul>
            </div>
        </form>
    </div>

</div>
