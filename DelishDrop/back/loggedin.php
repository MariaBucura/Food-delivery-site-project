<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    header("Location: login.php");
    exit();
}

// If session is not set but cookie is, set the session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

// Display dashboard content

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\front\img\logo.png" type="image/x-icon">
    <title>A Page yay</title>
    <link rel="stylesheet" href="..\front\style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body bgcolor="#BCA0BC">

    <head>
        <nav class="navbar-main">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><img class="logo-image"
                            src="../front/img/logo.png" alt="donut"></a>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <div class="li-item">
                            <button class="nav-button" onclick="window.location.href = '#';">Home</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button class="nav-button" href="#">Page 1</button>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="search">
                        <div class="li-item">
                            <input class="search-bar" type="text" placeholder="Search restaurants">
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="openSidebar()" class="nav-button" href="#"><span class="glyphicon glyphicon-user"></span>Account</button>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </head>
    <section class="general">
        <div class="about">
            <h1><b>Welcome to DelishDrop!</b></h1>
            <h4>Welcome to DelishDrop - where culinary delights meet convenience! Indulge in a world of flavors
                delivered straight to your doorstep. Whether you're craving comforting classics, exotic cuisines, or
                healthy options, we've got you covered. Simply browse our curated menus, place your order with ease, and
                await the arrival of delectable dishes crafted with care by our partner restaurants and chefs. Elevate
                your dining experience today with DelishDrop.</h4>
            <button class="nav-button" style="width: 250px;">Browse restaurants</button>
        </div>
    </section>

    <section class="featured">
        <div class="featured-label">
            <h1>Featured</h1><br><br>
        </div>
        <div class="res-row">
            <div class="row">
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
            </div><br>
        </div>
        <div class="res-row">
            <div class="row">
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image">
                            </div>
                        </div>
                        <h3>Restaurant Name</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testulet">

    </section>

    <div id="loginFormPopup" class="login-form-popup">
        <form method="POST" action="..\back\login.php" class="login-form-container">
          <h2>Login</h2><br>
      
          <label for="username"><b>Username/Email</b></label><br>
          <input class="form-input" type="text" placeholder="Enter Username" name="username" id="username" required><br>
      
          <label for="password"><b>Password</b></label><br>
          <input class="form-input" type="password" placeholder="Enter Password" name="password" id="password" required><br>
      
          <button type="submit" name="submit" id="submit" class="nav-button">Login</button><br>
          <button type="button" class="nav-button cancel" onclick="closeLoginForm()">X</button>
        </form>
    </div>

    <div id="signinFormPopup" class="signin-form-popup">
        <form class="signin-form-container">
          <h2>Sign up</h2><br>
      
          <label for="username"><b>Username</b></label><br>
          <input class="form-input" type="text" placeholder="Enter Username" name="username" required><br>

          <label for="username"><b>Email Adress</b></label><br>
          <input class="form-input" type="text" placeholder="Enter Email" name="username" required><br>
      
          <label for="password"><b>Password</b></label><br>
          <input class="form-input" type="password" placeholder="Enter Password" name="password" required><br>
      
          <button type="submit" class="nav-button">Sign up</button><br>
          <button type="button" class="nav-button cancel" onclick="closeSigninForm()">X</button>
        </form>
      </div>

      <div class="sidebar" id="sidebar">
        <a href="#" class="closebtn" onclick="closeSidebar()">&times;</a>
        <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
        <a  href="#">My account</a>
        <a id="logout" onclick="logout()" href="#">Log out</a>
      </div>

    <footer>
        <div class="footer-content">
            DelishDrop@2024
        </div>
    </footer>

    <script src="..\front\scripts\script.js"></script>

</body>



</html>