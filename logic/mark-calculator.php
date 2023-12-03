<!DOCTYPE html>
<html>

<head>
    <title>Mark Calculator - Results</title>
</head>
<?php
class StatsAlgorithm{
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
}
?>

</html>