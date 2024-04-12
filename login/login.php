<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodFit Login</title>

  <link rel="stylesheet" href="../css/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <div class="container2">
    <div class="picture-container">
   
    </div>
    <div class="form-container">
      <div class="login-page">
        <div class="text">
          <h1 class="title">FoodFit</h1>
          <p class="subtitle">Track your food intake</p>
          <p>for a healthier lifestyle</p>
        </div>

        <form id="loginForm" action="../action/login_user_action.php" method="post">
          <input type="email" name="username" id="username" placeholder="Email" required>
          <input type="password" name="password" id="password" placeholder="Password" required>
          <div class="link">
            <button type="submit" name="submit" class="login">Login</button>
          </div>
          <hr>
          <div class="button">
            <h4>Don't have an account?</h4>
            <br>
            <a href="../login/register.php">Register</a>
          </div>
        </form>
        
     
        <div id="errorMessage" style="color: red;">
          <?php
        
          if(isset($_SESSION['error_message'])){
            echo $_SESSION['error_message'];
            unset($_SESSION['error_message']); 
          }
          ?>
        </div>
      </div>
    </div>
  </div>

  <script>
   
    $(document).ready(function() {
 
    });
  </script>
</body>
</html>
