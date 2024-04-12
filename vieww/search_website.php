<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe hub</title>

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet">

  <link rel="stylesheet" href="../css/websiteee.css">
  <link rel="stylesheet" href="../css/dashboard.css">

  <?php include "../function/get_username_fxn.php"; ?>
  
</head>
<body>
  
<div class="container">
<div class="sidebar">
  <ul>
    <li><a href="dashboard.php"><i class="material-icons dashboard-icon">dashboard</i> Dashboard</a></li>
    <li><a href="plan_meal.php"><i class="material-icons meal-icon">fastfood</i> Plan a meal</a></li>
    <li><a href="goals.php"><i class="material-icons goals-icon">flag</i> Goals</a></li>
    <li><a href="search_website.php"><i class="material-icons website-icon">web</i> Look for a meal</a></li>
    <li class="logout"><a href="../login/logout_view.php"><i class="material-icons">exit_to_app</i> Logout</a></li>
  </ul>
</div>

    <!-- Content -->
    <div class="content">
      <header class="topbar">
        <div class="page-title">
          <h4>Meal recipe hub</h4>
       
        </div>
       
        <div class="user-info">
        <?php
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $userName = getUserName($userId, $mysqli);
            // $role = getRole($userId, $mysqli);
            echo '<div class="user-icon"><i class="material-icons">account_circle</i></div>';
            echo '<div class="user-name">' . $userName . '</div>';
        } else {
            echo "Error: User ID not set in session";
        }
        ?>
    </div>
    </header>

    <div class="meal-wrapper">
        <div class="meal-search">
            <div class="meal-search-header">
                <img src="../images/chef.jpg" alt="Chef" class="chef-image">
                <h2 class="title">Out of meal ideas? </h2>

            </div>


        <div class="meal-search-box">
        <input type="text" class="search-control" placeholder="Enter the main ingredient" id="search-input">
        <button type="submit" class="search-btn btn" id="search-btn">
            <i class="material-icons">search</i>
        </button>
    </div>



        <div class="meal-result">
            <h2 class="title">Search Results:</h2>
            <div id="meal">
            </div>
        </div>
        <div class="meal-details">
          
            <button type="button" class="btn recipe-close-btn" id="recipe-close-btn">
                <i class="material-icons">close</i>
            </button>

            
            <!-- meal content -->
            <div class="meal-details-content">
            </div>
        </div>
    </div>
</div>


  <script src="../js/website.js"></script>
</body>
</html>
