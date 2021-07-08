<?php
include('includes/dbconnection.php');
session_start();
?>

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
        <script src="https://smtpjs.com/v3/smtp.js"></script>

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
        <title>Times International | Home</title>
    </head>
    <body>
        <?php
        include("includes/header.php");
        ?>

        <main style="padding: 5% 10%" class="contact-form">
            <h2>Contact us</h2>
                <table>
                    <tr>
                        <td>Name: </td>
                        <td><input type="text" id="name" name="name" placeholder="Your name" required></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td><input type="email" id="email" name="user_email" placeholder="Your email" required></td>
                    </tr>
                    <tr>
                        <td>Phone: </td>
                        <td><input type="text" id="phone" name="phone" placeholder="Your phone number" required></td>
                    </tr>
                    <tr>
                        <td>Message: </td>
                        <td>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Your message" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="send_message" id="" value="Send Message" onclick="sendEmail()"></td>
                    </tr>
                    
                </table>
        </main>

        <script>
            function sendEmail(){
                var name = document.getElementById("name").value;
                var email = document.getElementById("email").value;
                var phone = document.getElementById("phone").value;
                var message = document.getElementById("message").value;
                Email.send({
                    Host : "smtp.gmail.com",
                    Username : "times.mailing.service@gmail.com",
                    Password : "mmszmnxcpejqhzjd",
                    To : "times.mailing.service@gmail.com",
                    From : email,
                    Subject : "A new message through contact form",
                    Body : 'Sender: ' + name + '<br> Phone: ' + phone + '<br> Message: ' + message + '<br> Email: ' + email
                }).then(
                message => alert("Message sent!")
                );
            }
        </script>

        <?php
        include("includes/footer.php");
        ?>

        
    </body>
</html>
