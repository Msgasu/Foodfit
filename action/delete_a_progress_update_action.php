<?php
include "../settings/connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $progressId = $_POST['progressId']; 

    $progressId = mysqli_real_escape_string($mysqli, $progressId);

    
    $query = "DELETE FROM progress_tracking WHERE tracking_id = '$progressId'";
    
    if (mysqli_query($mysqli, $query)) {
       
        echo "Progress tracking entry deleted successfully!";
    } else {
     
        echo "Error: " . mysqli_error($mysqli);
    }
}
?>
