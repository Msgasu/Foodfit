<?php 
session_start();
include "../settings/connection.php";

$errors = array();

if(isset($_POST['submit'])){
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
  
    $query = "SELECT * FROM users WHERE email = ?";

    if ($stmt = $mysqli->prepare($query)) {
        
        $stmt->bind_param("s", $username);
        
     
        $stmt->execute();
        
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            
            $q_result = $result->fetch_assoc();
          
            if (password_verify($password, $q_result["passwd"])) {
             
                $_SESSION["user_id"] = $q_result["pid"];
                $_SESSION["user_role"] = $q_result["role_id"];
                
             
                header("Location: ../vieww/dashboard.php");
                exit();
            } else {
              
                $_SESSION["error_message"] = "Incorrect password. Please try again.";
            }
        } else {
          
            $_SESSION["error_message"] = "User not found. Please register.";
        }
        
        $stmt->close();
    } else {
    
        $_SESSION["error_message"] = "Error: " . $mysqli->error;
    }
}


header("Location: ../login/login.php");
exit();
?>
