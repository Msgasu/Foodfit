<?php
include "../settings/connection.php";

if (isset($_POST['submit'])) { 

    // Sanitize inputs
    $first_name = mysqli_real_escape_string($mysqli, $_POST["firstName"]);
    $last_name = mysqli_real_escape_string($mysqli, $_POST["lastName"]);
    $dob = $_POST["dob"];
    $email = mysqli_real_escape_string($mysqli, $_POST["username"]);
    $phone = mysqli_real_escape_string($mysqli, $_POST["TEL"]);
    $pass_1 = $_POST["password"];
    $pass_2 = $_POST["confirmPassword"];    
    $hash = password_hash($pass_2, PASSWORD_DEFAULT); 

    // Prepare and bind parameters
    $stmt = $mysqli->prepare("INSERT INTO users (`f_name`, `l_name`, `email`, `dob`, `tel`, `passwd`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $first_name, $last_name, $email, $dob, $phone, $hash);

   
    if ($stmt->execute()) {
        header("Location:../login/login.php");
        exit(); 
    } else {
        die("Error: ". $mysqli->error);
    }

    $stmt->close();
    $mysqli->close();
}
?>
