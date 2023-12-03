<?php
    require_once('mark-calculator.php');
    
    class MainAlgorithm{

        private $stats; // instance of StatsAlgorithm class
        
        // constructor
        public function MainAlgorithm(){
            $this->stats = new StatsAlgorithm();
        }


        public function calc_main_alg($caTest1Score, $caTest2Score, $assignmentScore){

            $requiredFinalMark = 50;
    
            $shouldUseAssignmentScore = $assignmentScore != 0;
    
            // assignment mark checker - runs the respective functions if assignment mark exists
            // assignment does not exists
            $requiredFinalExamMark = $shouldUseAssignmentScore
                ? $this->stats -> calc_ReqFinalMark_Assignment($caTest1Score, $caTest2Score, $assignmentScore) 
                : $this->stats -> calc_ReqFinalMark($caTest1Score, $caTest2Score);
    
            // assignment exists
            $probability = $shouldUseAssignmentScore
                ? $this->stats->calc_probability_assignment($caTest1Score, $caTest2Score, $assignmentScore, $requiredFinalMark)
                : $this->stats->calc_probability($caTest1Score, $caTest2Score, $requiredFinalMark);
    
            
            $requiredFinalExamMark = number_format(round($requiredFinalExamMark, 2), 2);
            $probability = number_format(round($probability, 2), 2);
            
            $riskLevel = $this->stats->calc_RiskLevel($probability);
            $accuracy = $shouldUseAssignmentScore; // boolean for accuracy, if true High Accuracy if false, low accuracy

            $accuracyString = $shouldUseAssignmentScore ? "High Accuracy Prediction": "Low Accuracy Prediciton";
        }

    }


?>