<?php
function fetch_meals(){
   include "../settings/connection.php";
   include_once "../settings/core.php";


   $pid = $_SESSION['user_id'];

   $query= "SELECT*FROM meal_plans WHERE pid= '$pid';";
   $result = $mysqli->query($query); 

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
 
    $mysqli->close(); 


}
// fetch_meals();

?>
