<?php

// if(!isset($_SESSION['userStatus'])){
//     header('Location: signin.php');      //redirects user if he tries to acces index.php without sigining in
//     exit();
// }

require_once('partials/headSection.php'); //Includes top part of hmtl tags, database connection(which includes constants.php) ,common styles.css, main.js, font-awesome CDN connection(let's u use icons straight from the web without having to download them), .

?>

<link rel="stylesheet" href="css/index.css"> <!--page custom css file-->

</head> <!--Head closing tag is left here so that you can add additional links to the head section such as custom CSS files as seen above-->


<!------------------------------------------------------------------------------------------->



<body> <!--start of body-->

<?php
require_once('partials/navBarWithSearch.php'); //Includes navigation bar with searchbox to search students
?>
<!------------------END OF NAVIGATION BAR----------------------->

<div class="mainSectionContainer">

    <!--SIDE BAR-->
    <div class="sideBarContainer">

    </div>

    <!--BUTTON SECTION-->
    <div class="buttonSectionContainer">

    </div>


    <!--STUDENTS TABLE-->
    <?php

    $SQLquery = "
        SELECT DISTINCT
            s.StudentNumber,
            CONCAT(s.FirstName, ' ', s.LastName) AS 'Student Name',
            ts1.Score AS 'CA Test 1',
            ts2.Score AS 'CA Test 2',
            s.markToPassCa2 AS 'Ca Test 2',
            s.markToPassAssignment AS 'Assignment',
            s.markToPassExam AS 'Exam',
            s.RiskLevel AS 'Risk'
        FROM tblStudent s
        INNER JOIN tblTestScore ts1 ON s.StudentID = ts1.StudentID AND ts1.TestTypeID = 1
        INNER JOIN tblTestScore ts2 ON s.StudentID = ts2.StudentID AND ts2.TestTypeID = 2
        INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = 5 AND m.ModuleID = 15  
        WHERE m.CourseID IN (SELECT CourseID FROM tblCourse)";

    // Fetch data from the database using the provided SQL query
    $result = $connection->query($SQLquery);
    ?>

    <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Student Number</th>
                    <th>Student Name</th>
                    <th>CA Test 1</th>
                    <th>CA Test 2</th>
                    <th>Ca Test 2</th>
                    <th>Assignment</th>
                    <th>Exam</th>
                    <th>Risk</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td><input type="checkbox" class="recordCheckbox" name="selectedRecord" value="' . $row['StudentNumber'] . '" onchange="handleCheckboxChange(this)"></td>';
                    echo '<td>' . $row['StudentNumber'] . '</td>';
                    echo '<td>' . $row['Student Name'] . '</td>';
                    echo '<td>' . $row['CA Test 1'] . '</td>';
                    echo '<td>' . $row['CA Test 2'] . '</td>';
                    echo '<td>' . $row['Ca Test 2'] . '</td>';
                    echo '<td>' . $row['Assignment'] . '</td>';
                    echo '<td>' . $row['Exam'] . '</td>';
                    echo '<td>' . $row['Risk'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <?php
        
        $connection->close();
        ?>
    </div>

    <!--------------------------END OF TABLE------------------------->


</div> <!--main section container-->   



</body>
</html>