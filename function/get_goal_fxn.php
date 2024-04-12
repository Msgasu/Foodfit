<?php

// Function to fetch goal type based on goal_id
function fetch_goal_type($goal_id) {
    include "../settings/connection.php";

    // Prepare and execute SQL query to fetch goal type based on goal_id
    $sql = "SELECT goal_type_name FROM goal_types WHERE goal_type_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $goal_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if any rows are returned
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        return $row; 
    } else {
       
        return array();
    }

    // Close connection
    $stmt->close();
    $mysqli->close();
}
?>
