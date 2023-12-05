<?php
    require_once('mark-calculator.php');
    
    class StatsCalculator{

        // Calculate Stats Columns
        public function calc_stats($caTest1Score, $caTest2Score, $assignmentScore){

            $requiredFinalMark = 50;
    
            $shouldUseAssignmentScore = $assignmentScore != 0;
    
            // assignment mark checker - runs the respective functions if assignment mark exists
            // required final exam mark
            $requiredFinalExamMark = $shouldUseAssignmentScore
                ? MarkCalculator::calc_ReqFinalMark_Assignment($caTest1Score, $caTest2Score, $assignmentScore) // assignment
                : MarkCalculator::calc_ReqFinalMark($caTest1Score, $caTest2Score); // no assigmnent

            // probability
            $probability = $shouldUseAssignmentScore
                ? MarkCalculator::calc_probability_assignment($caTest1Score, $caTest2Score, $assignmentScore, $requiredFinalMark) // assignment
                : MarkCalculator::calc_probability($caTest1Score, $caTest2Score, $requiredFinalMark); // no assignment
    
            
            // formatting to 2 decimal places
            $requiredFinalExamMark = number_format(round($requiredFinalExamMark, 2), 2);
            $probability = number_format(round($probability, 2), 2);
            
            $riskLevel = MarkCalculator::calc_RiskLevel($probability);
            $isHighAccuracy = $shouldUseAssignmentScore; // boolean for accuracy, if true High Accuracy if false, low accuracy
           
            // returns associative array of necessary values
            return [
                "requiredFinalExamMark" => $requiredFinalExamMark,
                "probability" => $probability,
                "riskLevel" => $riskLevel,
                "isHighAccuracy" => $isHighAccuracy,
            ];

        }

    }




?>