<div class="includes">

<div style="text-align: center">
    <h1>UI Elements</h1>
</div>

<div class="insert-container">

    
    <form action="index.php?ui_elements" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <h1 style="margin: 20px; color: #37474f;">Update Slider</h1>
                <p style="margin: 20px; color: #37474f;">Image size: 1200px X 400px</p>
            </tr>
            
            <tr>
                <td>
                    <label for="">Slide 1:</label>
                </td>
                <td class="multi-inputs">
                    <input type="text" name="slider_name_1" placeholder="Slide name">
                    <input type="text" name="slider_link_1" placeholder="Silde link">
                    <input type="file" name="slider_img_1" /><br />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Slide 2:</label>
                </td>
                <td class="multi-inputs">
                    <input type="text" name="slider_name_2" placeholder="Slide name">
                    <input type="text" name="slider_link_2" placeholder="Silde link">
                    <input type="file" name="slider_img_2" /><br />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Slide 3:</label>
                </td>
                <td class="multi-inputs">
                    <input type="text" name="slider_name_3" placeholder="Slide name">
                    <input type="text" name="slider_link_3" placeholder="Silde link">
                    <input type="file" name="slider_img_3" /><br />
                </td>
            </tr>
            <tr>
                <td>
                    <label for="">Slide 4:</label>
                </td>
                <td class="multi-inputs">
                    <input type="text" name="slider_name_4" placeholder="Slide name">
                    <input type="text" name="slider_link_4" placeholder="Silde link">
                    <input type="file" name="slider_img_4" /><br />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="update_slider" value="Update Slider" />
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="insert-container">
    <form action="index.php?ui_elements" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <h1 style="margin: 20px; color: #37474f;">Ad Banner Update</h1>
                <p style="margin: 20px; color: #37474f;">Image size: 1200px X 150px</p>
            </tr>
            
            <tr>
                <td>
                    <label for="">Ad Banner:</label>
                </td>
                <td class="multi-inputs">
                    <input type="text" name="banner_name_1" placeholder="Campaign name">
                    <input type="text" name="banner_link_1" placeholder="Campaign link">
                    <input type="file" name="banner_img_1" /><br />
                </td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <input type="submit" name="update_banner" value="Update Banner" />
                </td>
            </tr>
        </table>
    </form>
</div>

</div>

<?php
if(isset($_POST['update_slider'])){
    if(!empty($_FILES['slider_img_1'])){
        $sql = "SELECT * FROM slider_images WHERE slider_id=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $categories = $result->fetch_assoc();
        $image = $categories['slider_img'];
        unlink("images/slideshow/$image");

        $sql = "UPDATE slider_images SET slider_name=?, slider_img=?, slider_link=? WHERE slider_id=1";
        $stmt = $conn->prepare($sql);

        $slider_name = $_POST['slider_name_1'];
        $slider_link = $_POST['slider_link_1'];
        $slider_img = $_FILES['slider_img_1']['name'];
        $temp_name1 = $_FILES['slider_img_1']['tmp_name'];

        move_uploaded_file($temp_name1,"images/slideshow/$slider_img");

        $stmt->bind_param("sss", $slider_name, $slider_img, $slider_link);
        $stmt->execute();
        
    }
    if(!empty($_FILES['slider_img_2'])){
        $sql = "SELECT * FROM slider_images WHERE slider_id=2";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $categories = $result->fetch_assoc();
        $image = $categories['slider_img'];
        unlink("images/slideshow/$image");

        $sql = "UPDATE slider_images SET slider_name=?, slider_img=?, slider_link=? WHERE slider_id=2";
        $stmt = $conn->prepare($sql);

        $slider_name = $_POST['slider_name_2'];
        $slider_link = $_POST['slider_link_2'];
        $slider_img = $_FILES['slider_img_2']['name'];
        $temp_name1 = $_FILES['slider_img_2']['tmp_name'];

        move_uploaded_file($temp_name1,"images/slideshow/$slider_img");

        $stmt->bind_param("sss", $slider_name, $slider_img, $slider_link);
        $stmt->execute();

    }
    if(!empty($_FILES['slider_img_3'])){
        $sql = "SELECT * FROM slider_images WHERE slider_id=3";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $categories = $result->fetch_assoc();
        $image = $categories['slider_img'];
        unlink("images/slideshow/$image");

        $sql = "UPDATE slider_images SET slider_name=?, slider_img=?, slider_link=? WHERE slider_id=3";
        $stmt = $conn->prepare($sql);

        $slider_name = $_POST['slider_name_3'];
        $slider_link = $_POST['slider_link_3'];
        $slider_img = $_FILES['slider_img_3']['name'];
        $temp_name1 = $_FILES['slider_img_3']['tmp_name'];

        move_uploaded_file($temp_name1,"images/slideshow/$slider_img");

        $stmt->bind_param("sss", $slider_name, $slider_img, $slider_link);
        $stmt->execute();

    }
    if(!empty($_FILES['slider_img_4'])){
        $sql = "SELECT * FROM slider_images WHERE slider_id=4";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $categories = $result->fetch_assoc();
        $image = $categories['slider_img'];
        unlink("images/slideshow/$image");

        $sql = "UPDATE slider_images SET slider_name=?, slider_img=?, slider_link=? WHERE slider_id=4";
        $stmt = $conn->prepare($sql);

        $slider_name = $_POST['slider_name_4'];
        $slider_link = $_POST['slider_link_4'];
        $slider_img = $_FILES['slider_img_4']['name'];
        $temp_name1 = $_FILES['slider_img_4']['tmp_name'];

        move_uploaded_file($temp_name1,"images/slideshow/$slider_img");

        $stmt->bind_param("sss", $slider_name, $slider_img, $slider_link);
        $stmt->execute();

    }
    echo "<script>alert('Sliders updated succesfully')</script>";
    echo "<script>window.open('index.php?ui_elements','_self')</script>";
}

elseif(isset($_POST['update_banner'])){
    if(!empty($_FILES['banner_img_1'])){
        $sql = "SELECT * FROM ad_banner WHERE banner_id=1";
        $stmt = $conn->prepare($sql);
        $stmt->execute(); 
        $result = $stmt->get_result();
        $categories = $result->fetch_assoc();
        $image = $categories['banner_img'];
        unlink("images/ad-banner/$image");

        $sql = "UPDATE ad_banner SET banner_name=?, banner_img=?, banner_link=? WHERE banner_id=1";
        $stmt = $conn->prepare($sql);

        $banner_name = $_POST['banner_name_1'];
        $banner_link = $_POST['banner_link_1'];
        $banner_img = $_FILES['banner_img_1']['name'];
        $temp_name1 = $_FILES['banner_img_1']['tmp_name'];

        move_uploaded_file($temp_name1,"images/ad-banner/$banner_img");

        $stmt->bind_param("sss", $banner_name, $banner_img, $banner_link);
        $stmt->execute();
        
    }
    
    echo "<script>alert('Ad banner updated succesfully')</script>";
    echo "<script>window.open('index.php?ui_elements','_self')</script>";
}
?>