<div class="includes">

<div class="add-section-options">
    <a href="index.php?insert_product" class="each-option" style="background: linear-gradient(90deg, #6D7DD2 0%, #6DACF7 100%);">
        Add product
    </a>
    <a href="index.php?insert_category" class="each-option" style="background: linear-gradient(90deg, #7BD26D 0%, #80F76D 100%);">
        Add category
    </a>
    <a href="index.php?insert_brand" class="each-option" style="background: linear-gradient(90deg, #D2986D 0%, #F77E6D 100%);">
        Add brand
    </a>
</div>

<div class="insert-container">
    <form action="index.php?insert_product" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <h1 style="margin: 20px; color: #37474f;">Add product</h1> 
            </tr>
            <tr>
                <td>
                    <label for="">Title:</label>
                </td>
                <td>
                    <input type="text" name="p_title" placeholder="Product title" required/>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Description:</label>
                </td>
                <td>
                    <textarea name="p_desc" rows="6" placeholder="Product description" required></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Category: </label>
                </td>
                <td>
                    <select name="cat_id" id="" value="Select">
                        <?php
                        $sql = "SELECT * FROM categories";
                        $stmt = $conn->prepare($sql); 
                        $stmt->execute(); 
                        $result = $stmt->get_result();
                        while($categories = $result->fetch_assoc()){ 
                            $cat_id = $categories['cat_id'];
                            $cat_title = $categories['cat_title'];
                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Brand: </label>
                </td>
                <td>
                    <select name="b_id" id="" value="">
                        <?php
                        $sql = "SELECT * FROM brand";
                        $stmt = $conn->prepare($sql); 
                        $stmt->execute(); 
                        $result = $stmt->get_result();
                        while($brands = $result->fetch_assoc()){ 
                            $b_id = $brands['b_id'];
                            $b_name = $brands['b_name'];
                            echo "<option value='$b_id'>$b_name</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Weights<br>(in milli):</label>
                </td>
                <td class="multi-inputs">
                    <input type="number" name="p_weight_1" min="1" placeholder="Product weight 1 (in grams/milliliters)" required />
                    <input type="number" name="p_weight_2" min="1" placeholder="Product weight 2 (in grams/milliliters)" />
                    <input type="number" name="p_weight_3" min="1" placeholder="Product weight 3 (in grams/milliliters)" />
                    <input type="checkbox" name="in_liters[]" />
                    <label for="">Is liquid</label>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Prices:</label>
                </td>
                <td class="multi-inputs">
                    <input type="number" step="any" name="p_price_1" min="0" placeholder="Price for weight 1" required />
                    <input type="number" step="any" name="p_price_2" min="0" placeholder="Price for weight 2" />
                    <input type="number" step="any" name="p_price_3" min="0" placeholder="Price for weight 3" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Images:</label>
                </td>
                <td class="multi-inputs">
                    <input type="file" name="p_img_1" required /><br />
                    <input type="file" name="p_img_2" /><br />
                    <input type="file" name="p_img_3" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Keywords:</label>
                </td>
                <td>
                    <input type="text" name="p_keywords" placeholder="Search keywords" />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Stock:</label>
                </td>
                <td>
                    <input type="number" name="p_stock" min="0" placeholder="Number of items in stock" required />
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Add product" />
                </td>
            </tr>
        </table>
    </form>
</div>

</div>

<?php
if(isset($_POST['submit'])){
    $sql = "INSERT INTO products (cat_id, b_id, date, p_title, p_img_1, p_img_2, p_img_3, p_wt_1, p_wt_2, p_wt_3,
                                p_price_1, p_price_2, p_price_3, in_liters, p_keywords, p_desc, stock_left) VALUES
                                (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $cat_id = $_POST['cat_id'];
    $b_id = $_POST['b_id'];
    $p_title = $_POST['p_title'];
    
    $p_wt_1 = $_POST['p_weight_1'];
    $p_wt_2 = $_POST['p_weight_2'];
    $p_wt_3 = $_POST['p_weight_3'];
    $p_price_1 = $_POST['p_price_1'];
    $p_price_2 = $_POST['p_price_2'];
    $p_price_3 = $_POST['p_price_3'];

    if(isset($_POST['in_liters'])){
        $in_liters = $_POST['in_liters'];
    }else{
        $in_liters = 0;
    }
    
    $p_keywords = $_POST['p_keywords'];
    $p_desc = $_POST['p_desc'];
    $stock_left = $_POST['p_stock'];

    $p_img_1 = $_FILES['p_img_1']['name'];
    $p_img_2 = $_FILES['p_img_2']['name'];
    $p_img_3 = $_FILES['p_img_3']['name'];

    $temp_name1 = $_FILES['p_img_1']['tmp_name'];
    $temp_name2 = $_FILES['p_img_2']['tmp_name'];
    $temp_name3 = $_FILES['p_img_3']['tmp_name'];

    $date = date("Y-m-d H:i:s");

    move_uploaded_file($temp_name1,"images/product-images/$p_img_1");
    move_uploaded_file($temp_name2,"images/product-images/$p_img_2");
    move_uploaded_file($temp_name3,"images/product-images/$p_img_3");

    $stmt->bind_param("iisssssiiidddissi", $cat_id, $b_id, $date, $p_title, $p_img_1, $p_img_2, $p_img_3, $p_wt_1, $p_wt_2, $p_wt_3, $p_price_1, $p_price_2, $p_price_3, $in_liters, $p_keywords, $p_desc, $stock_left);
    if($stmt->execute()){
        echo "<script>alert('Product has been added succesfully')</script>";
        echo "<script>window.open('index.php?insert_product','_self')</script>";
    }
}
?>