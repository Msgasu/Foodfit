<?php
include "../settings/connection.php"


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


if(isset($_GET['delete_user'])) {
    $userId = $_GET['delete_user'];
    $deleteQuery = "DELETE FROM users WHERE pid = $userId";
    if($mysqli->query($deleteQuery)) {
        echo "<script>alert('User deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting user');</script>";
    }
}


?>