<?php
require_once('partials/headSection-with-database.php');


unset($_SESSION['signin-data']);

?>

<link rel="stylesheet" href="css/sign-in.css"> <!--page custom css file-->

<title>Sign in to OutcomeIQ</title>
</head>

<body class="signInPageBody">

    <div class="logInformContainer">

        <div class="leftSide">
            <div class="logInformHeader">
                <img class="signInLogo" src="images/LogoBlackTextOutcomeIQ.svg" alt="OutcomeIQ Logo">
                <h4 class="smallGreyText">Sign in to continue</h4>
            </div>

            <form action="signin-logic.php" method="POST">
                <div class="formHolder">
                    <div class="formItem">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="userEmail" value="<?= $userEmail?>">
                    </div>

                    <div class="formItem show-box">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="userPassword" value="<?= $userPassword?>">

                        <div class="show-password" onclick="togglePassword()">Show</div>

                        <div class="alert-message">
                            <p><i class="fa-solid fa-circle-exclamation"></i> Wrong Email or password</p>
                        </div>
                    </div>

                    <div class="ForgotPassword">
                        <div class="forgotPassword">
                            <a href="forgotPassword.php" class="smallGreyText">Forgot Password?</a>
                        </div>
                    </div>

                    <div class="btnContainer">
                        <button type="submit" name="submit-button">Sign In</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="rightSide">
            <img class="dope-gent-looking-at-pie-chart" src="images/SignInPageVisual.svg" alt="">
        </div>
    </div>

    <?php
        
    ?>


</body>

</html>