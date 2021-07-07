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
        <form action="index.php?insert_brand" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <h1 style="margin: 20px; color: #37474f;">Add brand</h1> 
                </tr>
                <tr>
                    <td>
                        <label for="">Brand name:</label>
                    </td>
                    <td>
                        <input type="text" name="b_name" placeholder="Brand name" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Description:</label>
                    </td>
                    <td>
                        <textarea name="b_desc" rows="6" placeholder="Brand description" required></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label for="">Brand logo:</label>
                    </td>
                    <td class="multi-inputs">
                        <input type="file" name="b_img" required/>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Add Brand" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $sql = "INSERT INTO brand (b_name, b_desc, b_logo) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);

    $b_name = $_POST['b_name'];
    $b_desc = $_POST['b_desc'];
    $b_img = $_FILES['b_img']['name'];

    $b_img_temp_name = $_FILES['b_img']['tmp_name'];
    move_uploaded_file($b_img_temp_name, "images/brand-logos/$b_img");

    $stmt->bind_param("sss", $b_name, $b_desc, $b_img);
    if($stmt->execute()){
        echo "<script>alert('Brand added succesfully!')</script>";
        echo "<script>window.open('index.php?insert_brand','_self')</script>";
    }
}
?>