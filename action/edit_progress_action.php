<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $progress_id = $_POST['progressId'];
    $progress_update = $_POST['progressUpdate'];

   
    $query = "UPDATE progress_tracking SET progress_update = ? WHERE tracking_id = ?";
    
    // Prepare the statement
    if ($stmt = mysqli_prepare($mysqli, $query)) {
        
        mysqli_stmt_bind_param($stmt, "si", $progress_update, $progress_id);
        
     
        if (mysqli_stmt_execute($stmt)) {
            
            echo "Progress update edited successfully!";
        } else {

            echo "Error: " . mysqli_stmt_error($stmt);
        }
        
        
        mysqli_stmt_close($stmt);
    } else {
       
        echo "Error: " . mysqli_error($mysqli);
    }


    mysqli_close($mysqli);
}
?>

