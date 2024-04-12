<?php
date_default_timezone_set('Africa/Accra');
include "../settings/connection.php";
include_once "../settings/core.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $update = $_POST['progressUpdate'];
    $entdate = date("Y-m-d"); 
    $pid = $_SESSION['user_id'];
    $goalid = $_POST['goal_type']; 

   
    $stmt = $mysqli->prepare("INSERT INTO progress_tracking (pid, goal_type_id, entry_date, progress_update) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $pid, $goalid, $entdate, $update); 

    // Execute the statement
    if ($stmt->execute()) {
        $lasttrackingID = $mysqli->insert_id;
        $_SESSION['lasttrackingID'] = $lasttrackingID; 
        echo json_encode(['success' => true]); 
    } else {
     
        if (strpos($mysqli->error, 'foreign key constraint') !== false) {
            echo json_encode(['success' => false, 'error' => 'foreign_key_constraint']);
        } else {
            echo json_encode(['success' => false, 'error' => $mysqli->error]);
        }
    }

  
    $stmt->close();
}


$mysqli->close();
?>
