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
        <form action="index.php?category_list" method=GET">
            <h1 class="heading">All brands</h1>
            <div class="list-search">
                <label for="">Search: </label>
                <input type="text" name="keyword">
                <input type="submit" name="brand_search" id="" value="SEARCH">
            </div>
            <table>
                
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Total products</th>
                </tr>
                <?php

                if(isset($_GET['brand_search'])){

                    $sql = "SELECT * FROM brand WHERE (b_id LIKE ? OR b_name LIKE ? OR b_desc LIKE ?)";
                    $stmt = $conn->prepare($sql);
                    $keyword = $_GET['keyword'];
                    $keyword = "%$keyword%";
                    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = mysqli_num_rows($result);

                    $sql = "SELECT * FROM brand WHERE (b_id LIKE ? OR b_name LIKE ? OR b_desc LIKE ?) LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $keyword = $_GET['keyword'];
                    $keyword = "%$keyword%";
                    $stmt->bind_param("sssii", $keyword, $keyword, $keyword, $start_from, $per_page);

                }else{

                    $sql = "SELECT * FROM brand";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = mysqli_num_rows($result);

                    $sql = "SELECT * FROM brand LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $start_from, $per_page);

                }

                $stmt->execute();
                $result = $stmt->get_result();
                while($data = $result->fetch_assoc()){
                    $b_id = $data['b_id'];
                    $b_name = $data['b_name'];
                    $b_desc = $data['b_desc'];
                    $b_logo = $data['b_logo'];

                    $sql_c = "SELECT COUNT(b_id) FROM products WHERE b_id=?";
                    $stmt_c = $conn->prepare($sql_c);
                    $stmt_c->bind_param("i", $b_id);
                    $stmt_c->execute();
                    $result_c = $stmt_c->get_result();
                    $data_c = $result_c->fetch_assoc();
                    $b_count = $data_c["COUNT(b_id)"];

                    echo "
                    <tr>
                        <td>
                            $b_id
                        </td>
                        <td>
                            <img src='images/brand-logos/$b_logo' height='50px'><br><br>
                            $b_name
                        </td>
                        <td>$b_desc</td>
                        <td>$b_count</td>
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

                    if(isset($_GET['page'])){
                        $present_page = $_GET['page'];
                        for($i=1; $i<=$total_pages; $i++){
                            if($present_page == $i){
                                echo "<a href='index.php?brand_list&keyword=$keyword&page=$i&brand_search'><li class='active'>$i</li></a>";
                            }else{
                                echo "<a href='index.php?brand_list&keyword=$keyword&page=$i&brand_search'><li>$i</li></a>";
                            }
                        }
                        if($present_page < $total_pages){
                            $next_page = $present_page + 1;
                            echo "<a href='index.php?brand_list&keyword=$keyword&page=$next_page&brand_search'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                        }else{
                            echo "<a href='index.php?brand_list&keyword=$keyword&page=1&brand_search'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
                        }
                    }
                    
                    ?>
                </ul>
            </div>
        </form>
    </div>

</div>
