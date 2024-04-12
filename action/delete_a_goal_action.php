<?php
include "../settings/connection.php"; 


if(isset($_POST['goalId'])) {
    // Sanitize input to prevent SQL injection
    $gid = $_POST['goalId'];
    
    // Prepare the delete statement
    $query = "DELETE FROM goals WHERE goalid = ?";
    
    // Bind parameters and execute the statement
    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $gid); 
        if ($stmt->execute()) {
            // header('Location: ../vieww/plan_meal.php');
            echo "Goal deleted successfully.";
        } else {
        
            echo "Error deleting goal: " . $stmt->error;
        }
     
        $stmt->close();
    } else {
     
        echo "Error: Unable to prepare statement.";
    }
} else {
 
    // header('Location: ../vieww/plan_meal.php');
    echo "Error: Goal ID not provided.";
}
?>
