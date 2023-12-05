<?php
require_once('partials/headSection-with-database.php'); //Includes top part of hmtl tags, database connection(which includes constants.php) ,common styles.css, main.js, font-awesome CDN connection(let's u use icons straight from the web without having to download them), .
// USE THESE VARIABLES FOR CRUD OPERATIONS
$_SESSION['user-id'] = 2;
$_SESSION['module-id'] = 5;


if (!isset($_SESSION['user-id']) || !isset($_SESSION["signed-in"])) {
    header('Location: signin.php'); //rediects user is not signed in
    exit;
}
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
                SELECT ModuleName FROM tblmodule WHERE LecturerID = 2";
            $result = $connection->query($fetch_modules_sql);
            ?>

            <div class="nav-middle-section">
                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<h3 class="h3ss" data-index="' . $i . '">' . $row['ModuleName'] . '</h3>';
                    $i++;
                }
                ?>

                <!-- ELECTIVES -->
                <?php
                $fetch_electiveModules_sql = "
                SELECT ElectiveModuleName FROM tblelective WHERE LecturerID = 2";
                $result = $connection->query($fetch_electiveModules_sql);
                ?>

                <?php
                $i = 1;
                while ($row = $result->fetch_assoc()) {
                    echo '<h3 class="h3ss" data-index="' . $i . '">' . $row['ElectiveModuleName'] . '</h3>';
                    $i++;
                }
                ?> <!--End of Elective Modules List-->

            </div> <!--End of Module List-->




            <div class="nav-bottom-section">
                <form action="./admin/adminPanel.php">
                    <button class="admin-special-button">Admin Panel</button>
                </form>
                <a href="logout.php"><button class="log-out">Log Out</button></a>
                <p class="smallGreyText">Copyright 2023 OutcomeIQ</p>
            </div>

        </div> <!--end o side bar-->

        <!--BUTTON SECTION-->
        <div class="buttonSectionContainer">
            <div class="left-buttons">

                <div class="upload-container">
                    <button class="" onclick="toggleUploadBox()">Import <i class="fa fa-add"></i></button>

                    <div class="uploadBox" id="fileInput">
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

        $fetch_modules_sql = "
        SELECT DISTINCT
            s.StudentNumber,
            CONCAT(s.FirstName, ' ', s.LastName) AS 'Student Name',
            ts1.Score AS 'CA Test 1',
            ts2.Score AS 'CA Test 2',
            ts3.Score AS 'Assignment',
            mtp.MarkToPass AS 'Exam',
            rl.RiskLevel AS 'Risk',
            lc.LecturersComment AS 'Comment'
            FROM tblStudent s
            INNER JOIN tblTestScore ts1 ON s.StudentID = ts1.StudentID AND ts1.TestTypeID = 1
            INNER JOIN tblTestScore ts2 ON s.StudentID = ts2.StudentID AND ts2.TestTypeID = 2
            INNER JOIN tblTestScore ts3 ON s.StudentID = ts3.StudentID AND ts3.TestTypeID = 3
            INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = {$_SESSION['user-id']} AND m.ModuleID = {$_SESSION['module-id']}
            LEFT JOIN tblmarktopassexam mtp ON s.StudentID = mtp.StudentID AND m.ModuleID = mtp.ModuleID
            LEFT JOIN tblrisklevel rl ON s.StudentID = rl.StudentID AND m.ModuleID = rl.ModuleID
            LEFT JOIN tblcomment lc ON s.StudentID = lc.StudentID AND m.ModuleID = lc.ModuleID
            WHERE m.CourseID IN (SELECT CourseID FROM tblCourse);";

        // Fetch data from the database for calculation
        $module_sql_result = $connection->query($fetch_modules_sql);


        // -------------------------- ALGORITHM IMPLEMENTATION -------------------------- //
        require_once('logic/stats-calculator.php');


        $statsCalc = new StatsCalculator();
        $statsArray = [];

        while ($row = $module_sql_result->fetch_assoc()) {

            $statsArray = $statsCalc->calc_stats($row['CA Test 1'], $row['CA Test 2'], $row['Assignment']);

            $markToPassExam = $statsArray['requiredFinalExamMark'];
            $riskLevel = $statsArray['riskLevel'];
            $predictionAccuracy = $statsArray['isHighAccuracy'];


            // SQL update database - markToPass, *probability, risk level, prediction accuracy ---- *optional, but add column to db later
            $updateQuery = "
                UPDATE tblrisklevel
                SET RiskLevel = '{$riskLevel}', PredictionAccuracy = '{$predictionAccuracy}'
                WHERE StudentID IN (
                    SELECT s.StudentID
                    FROM tblStudent s
                    INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = {$_SESSION['user-id']} AND m.ModuleID = {$_SESSION['module-id']}
                    WHERE m.CourseID IN (SELECT CourseID FROM tblCourse)
                );
                
                UPDATE tblmarktopassexam
                SET MarkToPass = '{$markToPassExam}'
                WHERE StudentID IN (
                    SELECT s.StudentID
                    FROM tblStudent s
                    INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = {$_SESSION['user-id']} AND m.ModuleID = {$_SESSION['module-id']}
                    WHERE m.CourseID IN (SELECT CourseID FROM tblCourse)
                )";

            if (mysqli_multi_query($connection, $updateQuery)) {
                do {
                    // Store and free the result set
                    if ($result = mysqli_store_result($connection)) {
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($connection));
            } else {
                echo "Query Error: " . mysqli_error($connection);
            }
        }
        // -------------------------- ALGORITHM IMPLEMENTATION END -------------------------- //

        // Fetch data from the database again for displaying
        $module_sql_result = $connection->query($fetch_modules_sql);

        ?>

        <div class="table-section-container">

            <div class="stats-section">
                <div class="left-color-box">
                    <div class="key-box">
                        <p>Key</p>
                        <div class="obtained">
                            <div class="tiny-square tiny-square1"></div>
                            <div>Student Obtained Mark</div>
                        </div>
                        <div class="required-mark">
                            <div class="tiny-square tiny-square2"></div>
                            <div>Mark required to pass semester</div>
                        </div>
                    </div>
                    <h2>Operations Systems 700</h2>
                </div>




                <!-- Fetch Counters -->
                <?php
                $fetch_counters_sql = "
                SELECT
    COUNT(*) AS TotalRecords,
    COUNT(CASE WHEN rl.RiskLevel = 1 THEN 1 END) AS RiskLevel1Count,
    COUNT(CASE WHEN rl.RiskLevel = 2 THEN 1 END) AS RiskLevel2Count
FROM
    tblstudent s
    INNER JOIN tblModule m ON s.CourseID = m.CourseID AND m.LecturerID = {$_SESSION['user-id']} AND m.ModuleID = {$_SESSION['module-id']}
    LEFT JOIN tblrisklevel rl ON s.StudentID = rl.StudentID AND m.ModuleID = rl.ModuleID
WHERE
    m.CourseID IN (SELECT CourseID FROM tblCourse);
";

                $counters_result = $connection->query($fetch_counters_sql);

                $row = mysqli_fetch_assoc($counters_result);
                $totalRecords = $row['TotalRecords'];
                $riskLevel1Count = $row['RiskLevel1Count'];
                $riskLevel2Count = $row['RiskLevel2Count'];
                ?>

                <div class="stat-box1 color-box">
                    <div class="color-box-title cbt1">
                        Total No. Students
                    </div>

                    <div class="color-box-counter">
                        <div class="color-counter"><?= $totalRecords ?></div>
                        <div class="color-icon">
                            <i class="fa fa-user-group"></i>
                        </div>
                    </div>

                </div>

                <div class="stat-box2 color-box">
                    <div class="color-box-title cbt2">
                        Moderate Risk
                    </div>

                    <div class="color-box-counter">
                        <div class="color-counter"><?= $riskLevel1Count ?></div>
                        <div class="color-icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>

                </div>

                <div class="stat-box3 color-box">
                    <div class="color-box-title cbt3">
                        High Risk
                    </div>

                    <div class="color-box-counter">
                        <div class="color-counter"><?= $riskLevel2Count ?></div>
                        <div class="color-icon">
                            <i class="fa-solid fa-rectangle-xmark"></i>
                        </div>
                    </div>

                </div>
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
                    while ($row = $module_sql_result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td><input type="checkbox" class="recordCheckbox" name="selectedRecord" value="' . $row['StudentNumber'] . '" onchange="handleCheckboxChange(this)"></td>';
                        echo '<td>' . $row['StudentNumber'] . '</td>';
                        echo '<td>' . $row['Student Name'] . '</td>';
                        echo '<td>' . $row['CA Test 1'] . '</td>';
                        echo '<td>' . $row['CA Test 2'] . '</td>';
                        echo '<td>' . $row['Assignment'] . '</td>';

                        $markToPassExam = $row['Exam'];
                        echo '<td>';
                        if ($markToPassExam == 0) {
                            echo '-';
                        } else {
                            echo $markToPassExam;
                        }
                        echo '</td>';


                        // Assigning the appropriate class based on RiskLevel
                        $riskLevel = $row['Risk'];
                        $riskClass = '';
                        if ($riskLevel == 0) {
                            $riskClass = 'zero-risk';
                        } elseif ($riskLevel == 1) {
                            $riskClass = 'one-risk';
                        } elseif ($riskLevel == 2) {
                            $riskClass = 'two-risk';
                        }

                        echo '<td class="' . $riskClass . '">';
                        if ($riskLevel == 0) {
                            echo 'Low';
                        } elseif ($riskLevel == 1) {
                            echo 'Moderate';
                        } elseif ($riskLevel == 2) {
                            echo 'High';
                        }
                        echo '</td>';


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
        <div class="hidden-element floatingButtons">


        </div>


    </div> <!--main section container-->



</body>

</html>