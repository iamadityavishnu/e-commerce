<?php
include("..\includes\dbconnection.php");
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <title>Add category</title>

        <style>
            body {
                font-family: "Poppins", sans-serif;
            }
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 5%;
                padding: 30px;
            }

            table {
                border-collapse: collapse;
            }

            table tr td {
                padding: 15px;
            }

            table tr td input[type="text"],
            table tr td input[type="number"],
            table tr td input[type="submit"],
            table tr td select {
                width: 100%;
                height: 30px;
                padding-left: 5px;
            }
            table tr td input[type="submit"] {
                background: green;
                border: none;
                color: white;
                cursor: pointer;
                height: 40px;
                font-weight: bold;
            }
            table tr td textarea {
                width: 100%;
                padding: 5px;
            }
            .multi-inputs input {
                margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form action="add_category.php" method="POST" enctype="multipart/form-data">
                <table>
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
    </body>
</html>

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
        echo "<script>window.open('add_category.php','_self')</script>";
    }
}
?>