<?php

include "../settings/connection.php";
include "../settings/core.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $customGoal = trim($_POST['customGoal']);
    $duration = intval($_POST['duration']);
    $selectedGoal = trim($_POST['selectedGoal']);
    $pid = $_SESSION['user_id'];

    // Set default status_id so all goals are in progress
    $defaultStatus = 2; 

    // Validate inputs
    if (empty($customGoal) || empty($duration) || empty($selectedGoal)) {
        echo "Error: All fields are required.";
    } else {
  
        $sql = "INSERT INTO goals (pid, goal_description, goal_type, targetperiod, status_id) VALUES (?, ?, ?, ?, ?)";
        
        if ($stmt = $mysqli->prepare($sql)) {
       
            $stmt->bind_param("isssi", $pid, $customGoal, $selectedGoal, $duration, $defaultStatus); 

            
            if ($stmt->execute()) {
                
                $lastCategoryID = $mysqli->insert_id;
                $_SESSION['lastCategoryID'] = $lastCategoryID;
                echo "Goal inserted successfully.";
            } else {
                echo "Error: Unable to execute statement.";
            }

            $stmt->close();
        } else {
            echo "Error: Unable to prepare statement.";
        }
    }
}


$mysqli->close();
?>
