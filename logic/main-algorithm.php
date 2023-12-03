<?php
    require_once('mark-calculator.php');
    
    class StatsCalculator{

        // Calculate Stats Columns
        public function calc_stats($caTest1Score, $caTest2Score, $assignmentScore){

            $requiredFinalMark = 50;
    
            $shouldUseAssignmentScore = $assignmentScore != 0;
    
            // assignment mark checker - runs the respective functions if assignment mark exists
            // assignment does not exists
            $requiredFinalExamMark = $shouldUseAssignmentScore
                ? MarkCalculator::calc_ReqFinalMark_Assignment($caTest1Score, $caTest2Score, $assignmentScore) 
                : MarkCalculator::calc_ReqFinalMark($caTest1Score, $caTest2Score);
    
            // assignment exists
            $probability = $shouldUseAssignmentScore
                ? MarkCalculator::calc_probability_assignment($caTest1Score, $caTest2Score, $assignmentScore, $requiredFinalMark)
                : MarkCalculator::calc_probability($caTest1Score, $caTest2Score, $requiredFinalMark);
    
            
            // formatting to 2 decimal places
            $requiredFinalExamMark = number_format(round($requiredFinalExamMark, 2), 2);
            $probability = number_format(round($probability, 2), 2);
            
            $riskLevel = MarkCalculator::calc_RiskLevel($probability);
            $accuracy = $shouldUseAssignmentScore; // boolean for accuracy, if true High Accuracy if false, low accuracy

            $accuracyString = $shouldUseAssignmentScore ? "High Accuracy Prediction": "Low Accuracy Prediciton"; // mostly used for displaying
           
            // returns associative array of necessary values
            return [
                "requiredFinalMark" => $requiredFinalExamMark,
                "probability" => $probability,
                "riskLevel" => $riskLevel,
                "accuracy" => $accuracy,
                "accuracyString" => $accuracyString
            ];

        }

    }




?>