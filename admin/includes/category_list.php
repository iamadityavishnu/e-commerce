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
            <h1 class="heading">All categories</h1>
            <div class="list-search">
                <label for="">Search: </label>
                <input type="text" name="keyword">
                <input type="submit" name="cat_search" id="" value="SEARCH">
            </div>
            <table>
                
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Total products</th>
                </tr>
                <?php

                if(isset($_GET['cat_search'])){

                    $sql = "SELECT * FROM categories WHERE (cat_id LIKE ? OR cat_title LIKE ? OR cat_desc LIKE ?)";
                    $stmt = $conn->prepare($sql);
                    $keyword = $_GET['keyword'];
                    $keyword = "%$keyword%";
                    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = mysqli_num_rows($result);

                    $sql = "SELECT * FROM categories WHERE (cat_id LIKE ? OR cat_title LIKE ? OR cat_desc LIKE ?) LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $keyword = $_GET['keyword'];
                    $keyword = "%$keyword%";
                    $stmt->bind_param("sssii", $keyword, $keyword, $keyword, $start_from, $per_page);

                }else{

                    $sql = "SELECT * FROM categories";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $total = mysqli_num_rows($result);

                    $sql = "SELECT * FROM categories LIMIT ?,?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ii", $start_from, $per_page);

                }

                $stmt->execute();
                $result = $stmt->get_result();
                while($data = $result->fetch_assoc()){
                    $cat_id = $data['cat_id'];
                    $cat_title = $data['cat_title'];
                    $cat_desc = $data['cat_desc'];
                    $cat_image = $data['cat_image'];

                    $sql_c = "SELECT COUNT(cat_id) FROM products WHERE cat_id=?";
                    $stmt_c = $conn->prepare($sql_c);
                    $stmt_c->bind_param("i", $cat_id);
                    $stmt_c->execute();
                    $result_c = $stmt_c->get_result();
                    $data_c = $result_c->fetch_assoc();
                    $cat_count = $data_c["COUNT(cat_id)"];

                    echo "
                    <tr>
                        <td>
                            $cat_id
                        </td>
                        <td>
                            <img src='images/categories/$cat_image' height='50px'><br><br>
                            $cat_title
                        </td>
                        <td>$cat_desc</td>
                        <td>$cat_count</td>
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
                                echo "<a href='index.php?category_list&keyword=$keyword&page=$i&cat_search'><li class='active'>$i</li></a>";
                            }else{
                                echo "<a href='index.php?category_list&keyword=$keyword&page=$i&cat_search'><li>$i</li></a>";
                            }
                        }
                        if($present_page < $total_pages){
                            $next_page = $present_page + 1;
                            echo "<a href='index.php?category_list&keyword=$keyword&page=$next_page&cat_search'><li style='width: 70px; padding: 10px; border-radius: 20px'>Next</li></a>";
                        }else{
                            echo "<a href='index.php?category_list&keyword=$keyword&page=1&cat_search'><li style='width: auto; padding: 10px; border-radius: 20px'>First page</li></a>";
                        }
                    }
                    
                    ?>
                </ul>
            </div>
        </form>
    </div>

</div>
