<?php
require_once('partials/headSection-with-database.php');

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fetch_user_sql = sprintf(
        "SELECT * FROM tbllecturer
                    WHERE UserEmail = '%s'",
        $connection->real_escape_string($_POST["email"])
    );

    $result = $connection->query($fetch_user_sql);
    $user = $result->fetch_assoc();

    if ($user) {
        if (password_verify(trim($_POST["password"]), $user["PasswordHashed"])) {
            session_regenerate_id();
            $_SESSION["user-id"] = $user["LecturerID"];
            $_SESSION["user-role"] = $user["IsAdmin"];
            $_SESSION["signed-in"] = 1;
            header("Location: index.php");
            exit;
        }
    }
    $is_invalid = true;
}


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

            <form method="POST">
                <div class="formHolder">
                    <div class="formItem">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>

                    <div class="formItem show-box">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password">

                        <div class="show-password" onclick="togglePassword()">Show</div>

                        <?php if ($is_invalid) : ?>
                            <div class="alert-message">
                                <p><i class="fa-solid fa-circle-exclamation"></i> Invalid Input</p>
                            </div>
                        <?php endif; ?>

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