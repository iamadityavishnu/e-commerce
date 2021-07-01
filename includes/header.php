<header>
    <a href="http://localhost/times-international/index.php" style="text-decoration: none; color: #fff;">
        <div class="brand-container">
            <div class="brand-logo">
                <img src="images/TIMES LOGO.png" alt="times international logo" />
            </div>
            <div class="brand-name">
                <h1>
                    Times <br />
                    International
                </h1>
            </div>
        </div>
    </a>

    <div class="search-bar">
        <form class="search-bar" action="search_result.php">
        <div><input class="search-field" name="search_keyword" type="text" placeholder="Search"></div>
        <div><input class="search-field" type="submit" value="&#x1f36d;"></div>
        </form>
    </div>

    <div class="account-options">
        <div>
            <?php
                session_start();
                if(isset($_SESSION['email'])){
                    echo "<a href='my_account.php'>My account</a>";
                }else{
                    echo "<a href='login.php'>Log in/Sign up</a>";
                }
            ?>
        </div>
        <div><a href="cart.php">Cart 🛒</a></div>
        <div class="dropdown">
            <a class="drop-btn" href="">More</a>
            <dropdown class="dropdown-content">
                <a href="">About us</a>
                <a href="">Legal</a>
                <a href="">Contact us</a>
            </dropdown>
        </div>
        <div id="hamburger" onclick="toggleHam()">
            <p>☰</p>
            <dropdown class="ham-dropdown-content" id="dropdown">
                <a href="">About us</a>
                <a href="">Legal</a>
                <a href="">Contact us</a>
            </dropdown>
        </div>
    </div>

    <script>
        function toggleHam() {
            var dropd = document.getElementById("dropdown");
            console.log("Click click!");
            if (dropd.style.display == "flex") {
                console.log("None aa!");
                dropd.style.display = "none";
            } else {
                dropd.style.display = "flex";
                console.log("block aa");
            }
        }
    </script>
</header>
