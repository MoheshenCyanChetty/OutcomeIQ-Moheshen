<?php
require_once('config/database.php');
?>

<?php
$fetch_LecturerName_sql = "
    SELECT
    LFirstName,
    LLastName,
    CONCAT(LFirstName, ' ', LLastName) AS LName
    FROM
    tbllecturer 
    WHERE
    LecturerID = {$_SESSION['user-id']};
";

$l_result = $connection->query($fetch_LecturerName_sql);

$row = mysqli_fetch_assoc($l_result);
$lecturer_name = $row['LName'];

$LInitials = $row['LFirstName'][0] . $row['LLastName'][0];
?>

<nav>
    <div class="navContainer">
        <div><a href="#"><img src="images/LogoWhiteTextOutcomeIQ.svg" alt=""></a></div>
        <div class="searchBox">
            <i class="fa fa-magnifying-glass magGlass"></i>
            <input type="search" id="search-input" placeholder="Search">
        </div>
        <div class="lNameInitials"> <!--needs to be loaded dynamically from database-->
            <h2 class="lecturerName"><?php echo $lecturer_name;?></h2>
            <div class="initialBox">
            <?php echo $LInitials;?>
            </div>
        </div>
    </div> <!--END OF NAV CONTAINER-->
</nav>