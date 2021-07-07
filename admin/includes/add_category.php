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
        <form action="index.php?insert_category" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <h1 style="margin: 20px; color: #37474f;">Add Category</h1> 
                </tr>
                <tr>
                    <td>
                        <label for="">Category name:</label>
                    </td>
                    <td>
                        <input type="text" name="c_name" placeholder="Category name" required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Description:</label>
                    </td>
                    <td>
                        <textarea name="c_desc" rows="6" placeholder="Category description" required></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="">Image:</label>
                    </td>
                    <td class="multi-inputs">
                        <input type="file" name="c_img" required/>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Add Category" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $sql = "INSERT INTO categories (cat_title, cat_desc, cat_image) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);

    $c_name = $_POST['c_name'];
    $c_desc = $_POST['c_desc'];
    $c_img = $_FILES['c_img']['name'];

    $c_img_temp_name = $_FILES['c_img']['tmp_name'];
    move_uploaded_file($c_img_temp_name, "images/categories/$c_img");

    $stmt->bind_param("sss", $c_name, $c_desc, $c_img);
    if($stmt->execute()){
        echo "<script>alert('Category added succesfully!')</script>";
        echo "<script>window.open('index.php?insert_category','_self')</script>";
    }
}
?>