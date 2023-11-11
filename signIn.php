<?php 
require_once('config/database.php');
// $_SESSION['userStatus'] = 1; //keeps the stataus of user (admin or NOT)
// $_SESSION['lecturerID'] = 1 //keeps the lecturerID which is used to see which Modules/Electives he teaches
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--CSS-->
    <link rel="stylesheet" href="css/styles.css">
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