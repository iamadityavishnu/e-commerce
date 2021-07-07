<div class="includes">
<center>
    <div class="list" style="margin: 20px; width: 50%;">
        <h1 class="heading">Admins</h1>
        <a href="index.php?add_admin">Add a new admin</a>
        
        <table style="margin-top: 20px">
            
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </tr>
            <?php

            $sql = "SELECT admin_id, admin_email, admin_name, admin_img FROM admins";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            while($data = $result->fetch_assoc()){
                $admin_id = $data['admin_id'];
                $admin_name = $data['admin_name'];
                $admin_email = $data['admin_email'];
                $admin_img = $data['admin_img'];

                echo "
                <tr>
                    <td>
                        $admin_id
                    </td>
                    <td>
                        <img src='images/admin-images/$admin_img' height='50px'><br>
                        $admin_name
                    </td>
                    <td>$admin_email</td>";
                    if($_SESSION['aid'] == $admin_id){
                        echo "<td><a href='index.php?change_password'>Change password</a></td>";
                    }
                    echo"
                </tr>
                ";
            }

            ?>
        </table>
        <div class="pagination" style="height: 50px;"></div>
    </div>
</center>
</div>
