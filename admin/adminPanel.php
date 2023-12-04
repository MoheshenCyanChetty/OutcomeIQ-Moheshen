<?php 
if ($_SESSION['isAdmin']) {
    // Display admin-specific content
    require_once('config/database.php');
} else {
    header('Location: index.php');
    // Display regular user content
}
?>

<?php
require_once('partials/headSection.php'); 
?>

<link rel="stylesheet" href="css/sign-in.css"> <!--page custom css file-->

<title>Admin Panel</title>
</head>
<body>
    
</body>
</html>