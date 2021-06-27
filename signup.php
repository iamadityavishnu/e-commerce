<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- SEO TAGS -->
        <meta name="title" content="Times International " />
        <meta
            name="description"
            content="Times International PTY LTD. Buy online a range of authentic food products from Times International. Delivery across mainland."
        />
        <meta
            name="keywords"
            content="times international, daily delight, buy online"
        />
        <meta name="robots" content="index, follow" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="English" />
        <meta name="revisit-after" content="1 days" />
        <meta name="author" content="Times International " />
        <!-- END OF SEO TAGS -->

        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="style/style.css" />
        <link rel="stylesheet" href="style/home.css" />
        <link
            rel="icon"
            href="images/TIMES LOGO.jpg"
            type="image/jpg"
            sizes="16x16"
        />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <title>Signup | Times International</title>

        <style>
            main{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .signup-container{
                background: #fff;
                margin: 8% 0;
                padding: 40px;
                min-width: 30vw;
                border-radius: 20px;
                box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034),
            0 6.7px 5.3px rgba(0, 0, 0, 0.098);
            }
            form input{
                width: 100%;
                margin: 10px 0px;
                padding: 5px 15px;
                height: 40px;
                border-radius: 10px;
                border: none;
                background: #ebebeb;
            }
            input[type="submit"]{
                background: #379af9;
                color: #fff;
                font-weight: bold;
                cursor: pointer;
            }
            p{
                font-size: 0.8em;
                text-align: center;
                margin: 10px;
            }
            p a{
                color: #D1A300;
            }
        </style>
    </head>
    
    <body>
    <?php
    include("includes/header.php");
    ?>

    <main>
        <div class="signup-container">
            <div>
                <h2>Signup</h2>
            </div>
            <div class="form-container">
                <form action="my_account.php" method="POST">
                    <input name="user-name" type="text" placeholder="Name"><br>
                    <input name="user-email" type="email" placeholder="Email"><br>
                    <input name="password" type="password" placeholder="Password"><br>
                    <input name="signup" type="submit" value="Signup">
                </form>
                <div>
                    <p>Already have an account? Login <a href="login.php">here</a></p>
                </div>
            </div>
        </div>
    </main>

    <?php
    include("includes/footer.php");
    ?>
    </body>
</html>
