<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FoodFit Registration</title>
 
  <link rel="stylesheet" href="../css/register.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
<div class="container2 flex">
  <div class="register-page flex">
    <div class="text">
      <h1>FoodFit Registration</h1>
      <p>Please fill out the form to create an account</p>
    </div>
    <form id="registrationForm" action="../action/register_user_action.php" method="post">
      <input type="text" name="firstName" placeholder="First Name" required>
      <input type="text" name="lastName" placeholder="Last Name" required>
      <input type="email" name="username" id="username" placeholder="Email" required>
      <input type="tel" placeholder="Enter your number" name="TEL" id="phoneNumber" pattern="[0-9]{10}" title="Phone number should be 10 digits" required>
      <input type="date" name="dob" placeholder="Date of Birth" max="2010-12-31" required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
      <div class="button">
        <button type="submit" name="submit" class="register">Register</button>
      </div>
    </form>
    <br>
    <p>Already have an account? <a href="../login/login.php">Sign in</a></p>
  </div>
</div>

<script>

  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  document.getElementById("registrationForm").addEventListener("submit", function(event) {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirmPassword").value;

   
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;

    if (!isValidEmail(username)) {
      event.preventDefault(); 
     
      Swal.fire({
        icon: 'error',
        title: 'Try again',
        text: 'Please enter a valid email address!',
      });
    } else if (password !== confirmPassword || !password.match(passwordRegex)) {
      event.preventDefault(); 
      Swal.fire({
        icon: 'error',
        title: 'Try again',
        text: 'Passwords do not match or do not meet the required format!',
      });
    }
  });
</script>
</body>
</html>
