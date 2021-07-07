<?php


if(isset($_POST['change_pass'])){
    $sql = "SELECT admin_pass from admins WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);
    $a_id = $_SESSION['aid'];
    $stmt->bind_param("i", $a_id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if($data['admin_pass'] == md5($_POST['current_pass'])){
        $sql = "UPDATE admins SET admin_pass=? WHERE admin_id = ?";
        $new_pass = md5($_POST['new_pass']);
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_pass, $a_id);
        if($stmt->execute()){
            echo "<script>alert('Password updated succesfully')</script>";
            echo "<script>window.open('index.php?settings', '_self')</script>";
        }else{
            echo "<script>alert('Some error occured')</script>";
        }
    }else{
        echo "<script>alert('Current password is wrong')</script>";
    }
}

?>

<div class="includes change-password">
    <center>
    <form class="list" style="width: 50%;" action="index.php?change_password" method="POST" onsubmit="return checkPasswordInput(this)">
        <h3 style="padding: 20px">Change Password</h3>
        <table>
            <tr>
                <td>
                    <label style="z-index: 1;">Current password:</label><br />
                    <input
                        type="password"
                        name="current_pass"
                        placeholder="Enter current password"
                        autocomplete="off"
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <label style="z-index: 1">New password:</label><br />
                    <input
                        type="password"
                        name="new_pass"
                        placeholder="Enter new password"
                        
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
                        
                    />
                </td>
            </tr>
            <tr>
                <td>
                    <br />
                    <input type="submit" name="change_pass" value="Change password" />
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