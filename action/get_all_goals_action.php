<?php
function fetch_goals(){
   include "../settings/connection.php";
   include_once "../settings/core.php";

   $pid = $_SESSION['user_id'];

   $query= "SELECT * FROM goals WHERE pid = ?";
   $stmt = $mysqli->prepare($query);
   $stmt->bind_param("i", $pid);
   $stmt->execute();
   
  
   $result = $stmt->get_result();

   $goals = mysqli_fetch_all($result, MYSQLI_ASSOC);


   $stmt->close();
   $mysqli->close(); 

   return $goals;
}
?>
