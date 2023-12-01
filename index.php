<?php
require_once('partials/headSection-with-database.php'); //Includes top part of hmtl tags, database connection(which includes constants.php) ,common styles.css, main.js, font-awesome CDN connection(let's u use icons straight from the web without having to download them), .
// if (!isset($_SESSION['user-id'])) {
//     header('Location: signin.php'); //rediects user is not signed in
//     exit;
// }
?>

<link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>"> <!--page custom css file-->

</head>

<body> <!--start of body-->

    <?php
    require_once('partials/navBarWithSearch.php'); //Includes navigation bar with searchbox to search students
    ?>
    <!------------------END OF NAVIGATION BAR----------------------->

    <div class="mainSectionContainer">

        <!--SIDE BAR-->
        <div class="sideBarContainer">
            <div class="nav-top-section">
                <h2>Modules</h2>
                <div id="openNavButton" class="inactive"> <i class="fa fa-bars"></i> </div>
                <div id="closeNavButton"> <i class="fa-solid fa-multiply"></i> </div>
            </div>

            <!--Modules Side Bar-->
            <?php
                $fetch_modules_sql = "
                SELECT ModuleName FROM tblmodule WHERE LecturerID = 6";
                $result = $connection->query($fetch_modules_sql);
            ?>

            <div class="nav-middle-section">
                <!-- <h3>Programming 742</h3>
                <h3 class="active">Mobile Application Development 700</h3>
                <h3>Webtech 512</h3> -->

                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<h3 class= "h3ss">' . $row['ModuleName'] . '</h3>';
                    }
                ?>

            </div>

            <div class="nav-bottom-section">
                <form action="./admin/adminPanel.php">
                    <button class="admin-special-button">Admin Panel</button>
                </form>
                <button class="log-out">Log Out</button>
                <p class="smallGreyText">Copyright 2023 OutcomeIQ</p>
            </div>

        </div> <!--end o side bar-->

        <!--BUTTON SECTION-->
        <div class="buttonSectionContainer">
            <div class="left-buttons">

                <div class="upload-container">
                    <button class="" onclick="toggleUploadBox()">Import <i class="fa fa-add"></i></button>

                    <div class="uploadBox card-styling" id="fileInput">
                        <form action="index.php" method="post" enctype="multipart/form-data">

                            <div class="radio-buttons">
                                <label><input type="radio" name="testType" checked="true" value="CA_Test_1"> CA Test 1</label>
                                <label><input type="radio" name="testType" value="CA_Test_2"> CA Test 2</label>
                                <label><input type="radio" name="testType" value="Assignment"> Assignment</label>
                            </div>

                            <input class="file-upload-button" type="file" name="file" accept=".csv">
                            <button class="file-submit-button" type="submit">Upload<i class="fa fa-upload"></i></button>
                        </form>
                    </div>
                </div>



                <form class="charts-button" action="charts.php" method="post">
                    <button type="submit">Charts <i class="fa fa-chart-simple"></i></button>
                </form>

            </div>


            <!-- Rigth Buttons -->
            <div class="right-buttons">
                <button onclick="showSortingOptions()">Sorting <i class="fa fa-chevron-down"></i></button>

                <button onclick="showFilteringOptions()">Filter <i class="fa fa-filter"></i></button>
            </div>
        </div> <!--END OF BUTTON SECTION-->


        <!--STUDENTS TABLE-->
        <?php

        $SQLquery = "
        SELECT DISTINCT
            s.StudentNumber,
            CONCAT(s.FirstName, ' ', s.LastName) AS 'Student Name',
            ts1.Score AS 'CA Test 1',
            ts2.Score AS 'CA Test 2',
            ts3.Score AS 'Assignment',
            s.markToPassExam AS 'Exam',
            s.RiskLevel AS 'Risk',
            s.LecturersComment AS 'Comment'
        FROM tblStudent s
        INNER JOIN tblTestScore ts1 ON s.StudentID = ts1.StudentID AND ts1.TestTypeID = 1
        INNER JOIN tblTestScore ts2 ON s.StudentID = ts2.StudentID AND ts2.TestTypeID = 2
        INNER JOIN tblTestScore ts3 ON s.StudentID = ts3.StudentID AND ts3.TestTypeID = 3
        INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = 6 AND m.ModuleID = 1  
        WHERE m.CourseID IN (SELECT CourseID FROM tblCourse)";

        // Fetch data from the database using the provided SQL query
        $result = $connection->query($SQLquery);
        ?>

        <div class="table-section-container">

            <div class="stats-section">

            </div>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Student Number</th>
                        <th>Student Name</th>
                        <th>CA Test 1</th>
                        <th>CA Test 2</th>
                        <th id="assign-header">Assignment</th>
                        <th>Exam</th>
                        <th>Risk</th>
                        <th>Comment</th>
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
                        echo '<td>' . $row['Assignment'] . '</td>';
                        echo '<td>' . $row['Exam'] . '</td>';
                        echo '<td>' . $row['Risk'] . '</td>';
                        echo '<td>' . $row['Comment'] . '</td>';
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
        <!-- remove later -->
        <div class="hidden-element floatingButtons">Button float</div>


    </div> <!--main section container-->



</body>

</html>