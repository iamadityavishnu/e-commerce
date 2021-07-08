<footer>
    <div class="footer-content">
        <div class="footer-column">
            <h4>Your account</h4>
            <div class="footer-column-list">
                <ul>
                    <?php
                    if(!isset($_SESSION['email'])){
                        echo "
                            <a href='login.php'><li>Log in</li></a>
                            <a href='signup.php'><li>Sign up</li></a>
                            <a href='cart.php'><li>Cart</li></a>
                        ";
                    }else{
                        echo "
                            <a href='my_account.php'><li>My account</li></a>
                            <a href='my_account.php?my_orders'><li>Your orders</li></a>
                            <a href='cart.php'><li>Cart</li></a>
                        ";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="footer-column">
            <h4>Quick links</h4>
            <div class="footer-column-list">
                <ul>
                    <a href="categories.php"><li>Categories</li></a>
                    <a href="privacy_policy.php"><li>Privacy policy</li></a>
                    <a href="delivery_policy.php"><li>Delivery policy</li></a>
                    <a href="return_and_cancellation_policy.php"><li>Return policy</li></a>
                    <a href="return_and_cancellation_policy.php"><li>Cancellation policy</li></a>
                    <a href="contact_us.php"><li>Contact us</li></a>
                    <a href="about_us.php"><li>About us</li></a>
                </ul>
            </div>
        </div>
        <div class="footer-column">
            <h4>Contact</h4>
            <div class="footer-column-list">
                <ul>
                    <li>TIMES INTERNATIONAL PTY LTD</li>
                    <li>Queensland</li>
                    <li>Australia</li>
                </ul>
            </div>
        </div>
        <div class="footer-column">
            <h4>Trading hours</h4>
            <div class="footer-column-list">
                <ul>
                    <li>Monday to Saturday: 8.30am to 5.30pm</li>
                    <li>Closed Sundays and Public Holidays</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-credits">
        <div>
            <a href=""><img style="margin: 10px" src="images/instagram.png" alt=""></a>
            <a href=""><img style="margin: 10px" src="images/facebook.png" alt=""></a>
            <a href=""><img style="margin: 10px" src="images/twitter.png" alt=""></a>
        </div>
        <div>
            <p>Copyright &copy; 2021 Times International</p>
        </div>
        <div class="payment-stripe">
            <img src="images/paypal-logo.png" alt="" height="20px"/>
        </div>
    </div>
</footer>
