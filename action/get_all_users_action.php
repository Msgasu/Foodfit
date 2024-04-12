<?php

function getusers(){
    include "../settings/connection.php";
$query = "SELECT * FROM users";
$result = $mysqli->query($query);

return mysqli_fetch_all($result, MYSQLI_ASSOC);

$mysqli->close(); 
}
?>