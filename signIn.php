<?php

// if(!isset($_SESSION['userStatus'])){
//     header('Location: signin.php');      //redirects user if he tries to acces index.php without sigining in
//     exit();
// }

require_once('partials/headSection.php'); //Includes top part of hmtl tags, database connection(which includes constants.php) ,common styles.css, main.js, font-awesome CDN connection(let's u use icons straight from the web without having to download them), .

?>

<link rel="stylesheet" href="css/sign-in.css"> <!--page custom css file-->

    <title>Sign in to OutcomeIQ</title>
</head>
<body class="signInPageBody">
    <div class="logInformContainer">
        <div class="leftSide">
            <div class="logInformHeader">
                <img class="signInLogo" src="images/LogoBlackTextOutcomeIQ.svg" alt="">
                <h4 class="smallGreyText">Sign in to continue</h4>
            </div>
            <form action="index.php" method="POST">
                <div class="formHolder">
                    <div class="formItem">
                        <label for="email">Enter Email</label>
                        <input type="email" id="email">
                    </div>

                    <div class="formItem">
                        <label for="password">Enter Password</label>
                        <input type="password" id="password">    
                    </div>

                    <div class="ForgotPassword">
                        <div class="forgotPassword">
                            <a href="forgotPassword.php" class="smallGreyText">Forgot Password?</a>
                        </div>
                    </div>

                    <button type="submit">Sign In</button>
                </div>
            </form>
        </div>
 

        <div class="rightSide">
            <img src="images/SignInPageVisual.svg" alt="">
        </div>
    </div>
</body>
</html>