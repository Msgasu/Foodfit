<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Main</title>
  <?php include "../function/get_username_fxn.php" ?>

  <link rel="stylesheet" href="../css/dashboard.css">
  <link rel="stylesheet" href="../css/landinpage.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Aptos&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

<div class="top-left-buttons">
  <button onclick="window.location.href='../login/login.php'">Login</button>
  <button onclick="window.location.href='../login/register.php'">Sign Up</button>
</div>

<header>
<div class="logo">
  
  </div>
  <nav>
    <ul>
      <li><a href="#about">About</a></li>
      <li><a href="#services">Services</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>
</header>

<section class="hero">
  <div class="hero-content">
    <h1>Welcome to Foodfit</h1>
    <h2> Taste the Goodness, Feel the Wellness!</h2>
  </div>
</section>

<section id="about">
  <h2>About Us</h2>
  <section>
  <p>Welcome to FoodFit, your go-to platform for seamless meal planning and nutrition tracking.</p>
<br>
  <p>At FoodFit, we understand the importance of personalized nutrition in achieving your health goals.</p>
  <br>
  <p> Whether you're looking to lose weight, build muscle, or simply eat healthier,</p>
   <p> our app provides the tools and resources you need to create and track your meal plans with ease.</p>
  <br>
  <p>With a user-friendly interface and intuitive features, FoodFit empowers you to:</p>
  <br>
  <p>Join the FoodFit community today and take control of your health journey.</p>
  <br>
  <p> Let's make meal planning simpler, smarter, and more satisfying than ever before!</p>
</section>


<section id="services">
  <h2>Web App Features</h2>
  
  <ul>
    <li><strong>Plan Meals:</strong> 
     Create customized meal plans tailored to your dietary preferences, allergies, and nutritional requirements.</li>
    <br>
    <li><strong>Search Recipes:</strong> Find inspiration for every occasion and discover new flavors to spice up your kitchen routine.</li>
    <br>
    <li><strong>Set Goals:</strong> Define your health and fitness goals, whether it's weight loss, muscle gain, or overall well-being. Set realistic targets and track your progress over time.</li>
     <br>   
   
  </ul>

</section>

<section id="contact">
  <h2>Contact Us</h2>
  <p>Feel free to reach out to us with any questions or inquiries.</p>
  <p><i class="material-icons">phone</i> +233-20-911-6445</p>

</section>

<footer>
  <ul>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Terms of Service</a></li>
    <li><a href="#">Contact Us</a></li>
  </ul>
  <div class="social-media">
    <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
  </div>
</footer>

</body>
</html>
