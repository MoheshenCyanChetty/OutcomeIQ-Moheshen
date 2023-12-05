<?php
if (!isset($_SESSION['user-id']) || !isset($_SESSION["signed-in"])) {
    header('Location: signin.php'); //rediects user is not signed in
    exit;
}

