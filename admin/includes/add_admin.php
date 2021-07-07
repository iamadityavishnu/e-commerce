<?php


if(isset($_POST['add_admin'])){
    $sql = "INSERT INTO admins (admin_email, admin_name, admin_pass, admin_img) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $admin_email = $_POST['email'];
    $admin_name = $_POST['admin_name'];
    $admin_pass = md5($_POST['pass']);
    $admin_img = "ca7b6044398c39b298b9ce6e2f5003ca.png";

    $stmt->bind_param("ssss", $admin_email, $admin_name, $admin_pass, $admin_img);
    if($stmt->execute()){
        echo "<script>alert('Admin added succesfully')</script>";
        echo "<script>window.open('index.php?settings', '_self')</script>";
    }else{
        echo "<script>alert('Some error occured $stmt->error')</script>";
    }
}else{
    echo "Else happened";
}

?>

<div class="includes change-password">
    <center>
    <form class="list" style="width: 50%;" action="index.php?add_admin" method="POST" onsubmit="return checkPasswordInput(this)">
        <h3 style="padding: 20px">Add admin</h3>
        <table>
            <tr>
                <td>
                    <label style="z-index: 1;">Name:</label><br />
                    <input
                        type="text"
                        name="admin_name"
                        placeholder="Enter admin name"
                        autocomplete="off"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label style="z-index: 1;">Email:</label><br />
                    <input
                        type="email"
                        name="email"
                        placeholder="Enter email"
                        autocomplete="off"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label style="z-index: 1">Password:</label><br />
                    <input
                        type="password"
                        name="pass"
                        placeholder="Enter new password"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label style="z-index: 1">Confirm password:</label><br />
                    <input
                        type="password"
                        name="confirm_pass"
                        placeholder="Confirm new password"
                        required
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    <input type="submit" name="add_admin" value="Add admin" />
                </td>
            </tr>
            <tr>
                <p style="color: red;" id="warning"></p>
            </tr>
        </table>
        <div class="pagination" style="height: 20px"></div>
    </form>
    </center>
</div>

<script>
    function checkPasswordInput(form){
        var current_pass = form.current_pass.value;
        var new_pass = form.new_pass.value;
        var confirm_pass = form.confirm_pass.value;
        if(current_pass == ""){
            document.getElementById("warning").innerHTML = "Please enter the current password";
            return false;
        }else if(new_pass == ""){
            document.getElementById("warning").innerHTML = "Please enter a new password";
            return false;
        }else if(new_pass != confirm_pass){
            document.getElementById("warning").innerHTML = "Passwords do not match";
            return false;
        }else{
            return true;
        }
    }
</script>