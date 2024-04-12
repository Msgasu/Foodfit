<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $goal_id = $custom_goal = $week = $status = null;

    if (isset($_POST['goalId']) && isset($_POST['editCustomGoal']) && isset($_POST['editWeek']) && isset($_POST['status'])) {
        
        $goal_id = filter_var($_POST['goalId'], FILTER_VALIDATE_INT);
        
        // Sanitize custom goal and week
        $custom_goal = filter_var($_POST['editCustomGoal'], FILTER_SANITIZE_STRING);
        $week = filter_var($_POST['editWeek'], FILTER_SANITIZE_STRING);
        
        // Sanitize and validate status
        $status = filter_var($_POST['status'], FILTER_VALIDATE_INT);
        
        
        if ($goal_id !== false && $goal_id !== null && $custom_goal !== false && $week !== false && $status !== false) {
            
            $query = "UPDATE goals SET goal_description = ?, targetperiod = ?, status_id = ? WHERE goalid = ?";

            // Prepare the statement
            $stmt = mysqli_prepare($mysqli, $query);

            if ($stmt) {
                
                mysqli_stmt_bind_param($stmt, "ssii", $custom_goal, $week, $status, $goal_id);

                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                   
                    echo "Goal updated successfully.";
                } else {
                    
                    echo "Error: " . mysqli_stmt_error($stmt);
                }

              
                mysqli_stmt_close($stmt);
            } else {
               
                echo "Error: " . mysqli_error($mysqli);
            }
        } else {
            
            echo "Invalid input data.";
        }
    } else {
        
        echo "Missing input data.";
    }

    mysqli_close($mysqli);
}
?>
