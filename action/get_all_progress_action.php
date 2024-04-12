<?php
function fetch_progress(){
   include "../settings/connection.php";
   include_once "../settings/core.php";


   $pid = $_SESSION['user_id'];

   $query= "SELECT * FROM progress_tracking WHERE pid = '$pid';";
   $result = $mysqli->query($query); 

    return mysqli_fetch_all($result, MYSQLI_ASSOC);

    $mysqli->close(); 


}
// fetch_progress();

?>
