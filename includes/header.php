<header>
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

    <div class="search-bar">
        <div><input class="search-field type="text" placeholder="Search"></div>
        <div><button class="search-field">&#x1F50D;</button></div>
    </div>

    <div class="account-options">
        <div><a href="">Log in/Sign up</a></div>
        <div><a href="">Cart 🛒</a></div>
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
