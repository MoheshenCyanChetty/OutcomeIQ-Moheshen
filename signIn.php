<?php

// if(!isset($_SESSION['userStatus'])){
//     header('Location: signin.php');      //redirects user if he tries to acces index.php without sigining in
//     exit();
// }

// require_once('partials/headSection.php'); 
//Includes top part of hmtl tags, database connection(which includes constants.php) ,common styles.css, main.js, font-awesome CDN connection(let's u use icons straight from the web without having to download them), .

?>

<link rel="stylesheet" href="css/sign-in.css"> <!--page custom css file-->

<title>Sign in to OutcomeIQ</title>
<style>
    .signInPageBody{
    background-image: url('css/homeBackground.jpeg');
    background-size:cover;
    background-repeat:no-repeat;
    display: grid;
    place-items: center;
  }
</style>
</head>
<body class="signInPageBody">

    <div class="logInformContainer">

        <div class="leftSide">
            <div class="logInformHeader">
                <img class="signInLogo" src="images/LogoBlackTextOutcomeIQ.svg" alt="OutcomeIQ Logo">
                <h4 class="smallGreyText">Sign in to continue</h4>
            </div>
            
            <form action="index.php" method="POST">
                <div class="formHolder">
                    <div class="formItem">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>

                    <div class="formItem">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">  
                        <div class="show-password" onclick="togglePassword()">Show</div> 
                    </div>

                    <div class="ForgotPassword">
                        <div class="forgotPassword">
                            <a href="forgotPassword.php" class="smallGreyText">Forgot Password?</a>
                        </div>
                    </div>

                    <div class="btnContainer">
                        <button type="submit">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
 

        <div class="rightSide">
            <img src="images/SignInPageVisual.svg" alt="">
        </div>
    </div>
</body>
<script>
function togglePassword() {// code for the show button in password input
    var passwordInput = document.getElementById("password");
    var showPasswordButton = document.querySelector(".show-password");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        showPasswordButton.textContent = "Hide";
    } else {
        passwordInput.type = "password";
        showPasswordButton.textContent = "Show";
    }
}
</script>
</html>