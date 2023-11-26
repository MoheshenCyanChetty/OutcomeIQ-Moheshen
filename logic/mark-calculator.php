<!DOCTYPE html>
<html>

<head>
    <title>Mark Calculator - Results</title>
    <style>
        /* Styling for the result container */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .result-container {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .result-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .result-container p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .result-container .mark-info {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Mark Calculator - Results</h1>
    <div class="result-container">
        <h2>Results</h2>
        <?php

        // Calc Required Final mark with Assignment
        function calc_ReqFinalMark_Assignment($caTest1, $caTest2, $assignment)
        {
            $weightageTest1 = 15;
            $weightageTest2 = 15;
            $weightageAssignment = 10;
            $weightageFinalExam = 60;
            $minimumPassMark = 50;

            $totalAssessmentMarks = ($caTest1 * $weightageTest1 / 100) + ($caTest2 * $weightageTest2 / 100) + ($assignment * $weightageAssignment / 100);
            $requiredFinalExamMark = max(0, ($minimumPassMark - $totalAssessmentMarks) / ($weightageFinalExam / 100));

            return $requiredFinalExamMark;
        }

        // calc probability with assignment
        function calc_probability_assignment($caTest1, $caTest2, $assignment, $requiredFinalMark)
        {
            $weightageTest1 = 15;
            $weightageTest2 = 15;
            $weightageAssignment = 10;
            $weightageFinalExam = 60;

            $totalAssessmentMarks = ($caTest1 * $weightageTest1 / 100) + ($caTest2 * $weightageTest2 / 100) + ($assignment * $weightageAssignment / 100);
            $maxFinalExamMarks = ($requiredFinalMark - $totalAssessmentMarks) / ($weightageFinalExam / 100);

            if ($maxFinalExamMarks > 100) {
                return 0;

            } else {
                $probability = max(0, 100 - $maxFinalExamMarks); // Probability calculation (probability cannot exceed 100%)
                return $probability;
            }
        }

        // calc Req. Final mark no assignment
        function calc_ReqFinalMark($caTest1, $caTest2)
        {
            $weightageTest1 = 15;
            $weightageTest2 = 15;
            $weightageFinalExam = 70;
            $minimumPassMark = 50;

            $totalAssessmentMarks = ($caTest1 * $weightageTest1 / 100) + ($caTest2 * $weightageTest2 / 100);
            $requiredFinalExamMark = max(0, ($minimumPassMark - $totalAssessmentMarks) / ($weightageFinalExam / 100));

            return $requiredFinalExamMark;
        }

        // calc probability no assignment
        function calc_probability($caTest1, $caTest2, $requiredFinalMark)
        {
            $weightageTest1 = 15;
            $weightageTest2 = 15;
            $weightageFinalExam = 70;

            $totalAssessmentMarks = ($caTest1 * $weightageTest1 / 100) + ($caTest2 * $weightageTest2 / 100);
            $maxFinalExamMarks = ($requiredFinalMark - $totalAssessmentMarks) / ($weightageFinalExam / 100);

            if ($maxFinalExamMarks > 100) {
                return 0; // If the required final mark is unachievable, return 0 probability
            } else {
                $probability = max(0, 100 - $maxFinalExamMarks); // Probability calculation (probability cannot exceed 100%)
                return $probability;
            }
        }


        // calc risk level
        function calc_RiskLevel($probability){
            if ($probability <= ((1 / 3) * 100)){
                return "High";

            } elseif ($probability <= ((2 / 3) * 100)){
                return "Medium";

            } else {
                return "Low";

            }
        }

        // form submission action -- change later, grab data from database instead of form
        if ($_SERVER["REQUEST_METHOD"] == "POST") { // convert to function format for iteration in table
            $caTest1Score = $_POST['caTest1'] ?? 0;
            $caTest2Score = $_POST['caTest2'] ?? 0;
            $assignmentScore = $_POST['assignment'] ?? 0;
        
            $requiredFinalMark = 50;
        
            $shouldUseAssignmentScore = $assignmentScore != 0;
        
            // assignment mark checker - runs the respective functions if assignment mark exists
            $requiredFinalExamMark = $shouldUseAssignmentScore
                ? calc_ReqFinalMark_Assignment($caTest1Score, $caTest2Score, $assignmentScore) 
                : calc_ReqFinalMark($caTest1Score, $caTest2Score);
        
            $probability = $shouldUseAssignmentScore
                ? calc_probability_assignment($caTest1Score, $caTest2Score, $assignmentScore, $requiredFinalMark)
                : calc_probability($caTest1Score, $caTest2Score, $requiredFinalMark);
        
            $riskLevel = calc_RiskLevel($probability);
        
            $requiredFinalExamMark = number_format(round($requiredFinalExamMark, 2), 2);
            $probability = number_format(round($probability, 2), 2);
        
            $accuracy = $shouldUseAssignmentScore; // boolean for accuracy, if true High Accuracy if false, low accuracy

            // testing, delete the below later
            $accuracyString = $shouldUseAssignmentScore ? "High Accuracy Prediction": "Low Accuracy Prediciton";

            echo "<p>You would need to score at least <b>{$requiredFinalExamMark}%</b> in the final exam to achieve a minimum pass mark of <b>{$requiredFinalMark}%.</b></p>";
            echo "<p>{$accuracyString}: <b>{$probability}%</b></p>";
            echo "<p>Risk Level: <b>{$riskLevel}</b></p>";
        }

        ?>
    </div>
</body>

</html>