<?php
/**
 * Created by PhpStorm.
 * User: domin
 * Date: 25/01/2018
 * Time: 10:23
 */
?>
<footer class="w3-container w3-indigo w3-center" xmlns="http://www.w3.org/1999/html">
    <div class="w3-hide-medium w3-mobile">
        <div class="w3-quarter">
            <p class="w3-center">
                ©GotoBreak 2018 - 2020
                <br>
                <a href="https://www.gnu.org/licenses/gpl-3.0.fr.html" target="_blank">GENERAL PUBLIC LICENSE 3.0</a>
            </p>
            <h3>Social Media :</h3>
            <div class="w3-xxlarge">
                <a href="https://www.facebook.com/Hello-world-Officiel-1702536623146748/" target="_blank"><i class="fa fa-facebook-square"></i></a>
                <a href="https://twitter.com/Hello_world_dev/" target="_blank"><i class="fa fa-twitter-square"></i></a>
            </div>
        </div>
        <div class="w3-quarter">
            <h2>Sign up for our newsletter :</h2>
            <form class="w3-container" action="../Includes/PHP/email_sub.php" onsubmit="trySub(document.getElementById('input-large').value);return false;" method="post">
                <input class="w3-input w3-border" type="email" placeholder="username.firstname@email.com" name="email" id="input-large" onkeyup="document.getElementById('responsemodal').style.display='block';"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                <button class="w3-btn w3-blue w3-left" type="submit">Register</button>
            </form>
        </div>
        <div class="w3-half w3-hide-small" id="footer_quote">
            <p class="w3-xxlarge w3-serif">
                <span style="font-size:70px">&#10077;</span>
                <i>"Make it as simple as possible, but not simpler."</i></p>
            <p>Albert Einstein</p>
        </div>
    </div>

    <div class="w3-hide-large w3-hide-small">
        <div class="w3-half">
            <p class="w3-center">
                ©GotoBreak 2018 - 2020
                <br>
                <a href="https://www.gnu.org/licenses/gpl-3.0.fr.html" target="_blank">GENERAL PUBLIC LICENSE 3.0</a>
            </p>
            <h3>Social Media :</h3>
            <div class="w3-xxlarge">
                <a href="https://www.facebook.com/Hello-world-Officiel-1702536623146748/" target="_blank"><i class="fa fa-facebook-square"></i></a>
                <a href="https://twitter.com/Hello_world_dev/" target="_blank"><i class="fa fa-twitter-square"></i></a>
            </div>
            <h2>Sign up for our newsletter :</h2>
            <form class="w3-container" action="../Includes/PHP/email_sub.php" onsubmit="trySub(document.getElementById('input-small').value);return false;" method="post">
                <input class="w3-input w3-border" type="email" placeholder="username.firstname@email.com" name="email" id="input-large"
                       required pattern="^[\w\-\+]+(\.[\w\-]+)*@[\w\-]+(\.[\w\-]+)*\.[\w\-]{2,4}$" oninput="setCustomValidity('')" oninvalid="setCustomValidity('Please enter a valid email adress!')">
                <button class="w3-btn w3-blue w3-left" type="submit" onsubmit="trySub(document.getElementById('input-small').value)">Register</button>
            </form>
            <br>
        </div>
        <div class="w3-half">
            <p class="w3-xxlarge w3-serif">
                <span style="font-size:70px">&#10077;</span>
                <i>"Make it as simple as possible, but not simpler."</i></p>
            <p>Albert Einstein</p>
        </div>
    </div>



    <script>
        function trySub(str) {
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    var temp = this.response;
                    if(temp === "0"){
                        document.getElementById('confirmmodal').style.display='block';
                    }
                    else if(temp === "1") {
                        document.getElementById('singedmodal').style.display='block';
                    }
                    else if (temp === "2"){
                        document.getElementById('errormodal').style.display='block';
                    }
                }
            }
            xmlhttp.open("POST","/Includes/PHP/email_sub.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("email="+str);
        }
    </script>

    <div id="confirmmodal" class="w3-modal">
        <div class="w3-modal-content w3-card-4">
            <div class="w3-container w3-green">
                <span onclick="document.getElementById('confirmmodal').style.display='none'" class="w3-red w3-button w3-display-topright">&times;</span>
                <h2>You successfully signed up ! </h2>
            </div>
            <div class="w3-container w3-text-black">
                <h3>Your email address has been successfully added to our database.<br/>
                    If you consider unsubscribing please use the given link in the sent email(s) or contact us with the contact form !
                </h3>
            </div>
        </div>
    </div>
    <div id="singedmodal" class="w3-modal">
        <div class="w3-modal-content w3-card-4">
            <div class="w3-container w3-orange">
                <span onclick="document.getElementById('singedmodal').style.display='none'" class="w3-red w3-button w3-display-topright">&times;</span>
                <h2>The given email address is already in our database ! </h2>
            </div>
            <div class="w3-container w3-text-black">
                <h3>The address you have given is already in our database. This means that whenever an announcement is being made, you will receive an email ! <br/>
                    If you consider unsubscribing please use the given link in the sent email(s) or contact us with the contact form !
                </h3>
            </div>
        </div>
    </div>
    <div id="errormodal" class="w3-modal">
        <div class="w3-modal-content w3-card-4">
            <div class="w3-container w3-rest w3-red">
                <span onclick="document.getElementById('errormodal').style.display='none'" class="w3-red w3-button w3-display-topright">&times;</span>
                <h2>An error occurred ! </h2>
            </div>
            <div class="w3-container w3-text-black">
                <h3>An error occurred, please try again later or if the problem persists contact us with the contact form !
                </h3>
            </div>
        </div>
    </div>

</footer>
