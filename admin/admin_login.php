<?php
session_start();

if(isset($_SESSION['admin_email'])){
	session_unset();
	session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
        }
        input[type="submit"]{
            background: green;
            color: #fff;
            width: 100%;
            height: 40px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin login</h2>
        <form action="authorize.php" method="POST">
            <table>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="login" value="Login">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>