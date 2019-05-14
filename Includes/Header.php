<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 25/01/2018
 * Time: 09:51
 */
?>

<div class="w3-display-container">
    <img src="/img/space-banner.jpg" class="w3-animate-opacity" alt="Lights" style="width: 100%;max-height: 200px">
        <div class="w3-top">
            <div class="w3-bar w3-indigo w3-card">
                <!-- left -->
                <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
                <a href="/home.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
                <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Presentation</a>
                <a href="/forum/forum.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Forum</a>
                <a href="/download.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Download</a>
                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-padding-large w3-button" title="More">More <i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-indigo w3-bar-block w3-card-4">
                        <a href="/blog.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Blog</a>
                        <a href="/about.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">About us</a>
                        <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Contact</a>
                        <a href="/bug.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Report Bug</a>
                    </div>
                </div>

                <!-- right -->
                <?php
                if(isset($_SESSION['isLogged']) && $_SESSION['isLogged']) {?>
                    <span class="w3-bar-item w3-button w3-padding-large w3-right" onclick="document.location='/Includes/PHP/logout.php'"><i class="fa fa-sign-out"></i>Log out</span>
                <?php } else { ?>
                    <span class="w3-bar-item w3-button w3-padding-large w3-right" onclick="document.getElementById('id01').style.display='block'">Log in</span>
                <?php }
                $searchlink = '/profile.php';
                $profilname = 'Profile';
                if(IsLogged()) {
                    $searchlink = $searchlink.'?q='. $_SESSION['id'];
                    $profilname = $_SESSION['pseudo'];
                } ?>
                <a href="<?php echo $searchlink; ?>" class="w3-bar-item w3-button w3-padding-large w3-right"><?php echo $profilname; ?></a>
            </div>
        </div>

        <!-- Navbar on small screens -->
        <div id="navDemo" class="w3-bar-block w3-indigo w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
            <a href="/presentation.php" class="w3-bar-item w3-button w3-padding-large">Presentation</a>
            <a href="/blog.php" class="w3-bar-item w3-button w3-padding-large">Blog</a>
            <a href="/forum/forum.php" class="w3-bar-item w3-button w3-padding-large">Forum</a>
            <a href="/download.php" class="w3-bar-item w3-button w3-padding-large">Download</a>
            <a href="/about.php" class="w3-bar-item w3-button w3-padding-large">About us</a>
            <a href="/contact.php" class="w3-bar-item w3-button w3-padding-large">Contact</a>
            <a href="/bug.php" class="w3-bar-item w3-button w3-padding-large">Report Bug</a>
        </div>
</div>



<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    }
    else {
    x.className = x.className.replace(" w3-show", "");
    }
}

function openTab(evt, actionType) {
    var i, x, tablinks;
    x = document.getElementsByClassName("actionType_tab");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink_tab");
    for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-grey", "");
    }
    document.getElementById(actionType).style.display = "block";
    evt.currentTarget.className += " w3-grey";
}
</script>

<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-bar w3-indigo w3-card">
            <a class="w3-bar-item w3-button w3-xlarge tablink_tab w3-grey" onclick="openTab(event,'signin_tab')">Log in</a>
            <a class="w3-bar-item w3-button w3-xlarge tablink_tab" onclick="openTab(event,'signup_tab')">Sign up</a>
        </div>
        <div class="w3-center"><br>
            <br>
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-red w3-hover-light-gray w3-display-topright" title="Close Modal">&times;</span>
            <img src="/img/defaut-profile.png" alt="Avatar" style="width:30%" class="w3-circle w3-margin-top">
        </div>

        <form method="post" class="w3-container actionType_tab" id="signin_tab" action="/login.php">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Enter Username" name="log_username"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers and some special chars!')">
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="log_pswd"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Login</button>
                <input class="w3-check w3-margin-top" type="checkbox" checked="checked"> Remember me
            </div>
        </form>

        <form method="post" class="w3-container actionType_tab" id="signup_tab" action="/login.php?tabchoice=1" style="display: none">
            <div class="w3-section">
                <label><b>Username</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Username" name="username"
                       required pattern="^[0-9a-zA-Z-_!\[\]|]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters and numbers and some special chars!')"> <br>
                <label><b>Firstname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Firstname" name="firstname"
                       required pattern="^[a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters !')"> <br>
                <label><b>Lastname</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter Lastname" name="lastname"
                       required pattern="^[a-zA-Z]{3,12}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 3 - 12 letters !')"> <br>
                <label><b>Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Enter Email" name="email"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')"> <br>
                <label><b>Confirm Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Confirm Email" name="email_conf"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')"> <br>
                <label><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Enter Password" name="pswd"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>
                <label><b>Confirm Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Confirm Password" name="pswd_conf"
                       required pattern="^[0-9a-zA-Z.-_!\[\]|@]{5,20}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter 5 - 20 letters, numbers or : . - _ ! [ ] | @    ! ')"> <br>

                <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit">Sign up</button>
            </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('id01').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
            <span class="w3-right w3-padding w3-hide-small">Forgot <a href="#">password?</a></span>
        </div>

    </div>
</div>