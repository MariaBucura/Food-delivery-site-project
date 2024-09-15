<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\front\img\logo.png" type="image/x-icon">
    <title>Restaurants</title>
    <link rel="stylesheet" href="..\front\style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body bgcolor="#BCA0BC">
<?php
// Start session
session_start();

$_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
// If session is not set but cookie is, set the session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
// Check if user is logged in
if(isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    // User is logged in, display navbar
    ?>
    <!-- HTML for navbar -->
    <head>
        <nav class="navbar-main">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/delishdrop/back/"><img class="logo-image"
                            src="../front/img/logo.png" alt="donut"></a>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <div class="li-item">
                            <button class="nav-button" onclick="window.location.href = '/delishdrop/back/';">Home</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button class="nav-button" onclick="window.location.href = '/delishdrop/back/products.php';">Browse</button>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="search">
                        <div class="li-item">
                        <form method="POST" action="search.php">
                            <input class="search-bar" type="text" name="search-bar" id="search-bar" placeholder="Search restaurants">
                            <button onclick="" class="nav-button" href="#" style="width: 55px" type="submit" name="submit" id="submit"><span class="glyphicon glyphicon-search"></span>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="openSidebar()" class="nav-button" href="#"><span class="glyphicon glyphicon-user"></span>Account</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="openCartSidebar()" class="nav-button" href="#" style="width: 55px"><span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                                <div class="cart-number" id="cart-nr">
                                <p><?php 
                                    if (isset($_SESSION['cart_quantity']) && $_SESSION['cart_quantity'] != 0){
                                        ?>
                                        <script src="..\front\scripts\script.js"></script>
                                        <script>displayCartNumber();</script>
                                        <?php echo $_SESSION['cart_quantity'];
                                    }

                                 ?></p>
                            </div>
                        </div>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </head>
    <?php
} else {
    ?>
    <head>
        <nav class="navbar-main">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/delishdrop/back/"><img class="logo-image"
                            src="../front/img/logo.png" alt="donut"></a>
                </div>
                <ul class="nav navbar-nav">
                    <li>
                        <div class="li-item">
                            <button class="nav-button" onclick="window.location.href = '/delishdrop/back/';">Home</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button class="nav-button" onclick="window.location.href = '/delishdrop/back/products.php';">Browse</button>
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="search">
                        <div class="li-item">
                        <form method="POST" action="search.php">
                            <input class="search-bar" type="text" name="search-bar" id="search-bar" placeholder="Search restaurants">
                            <button onclick="" class="nav-button" href="#" style="width: 55px" type="submit" name="submit" id="submit"><span class="glyphicon glyphicon-search"></span>
                                </button>
                            </form>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="toggleSigninForm()" class="nav-button" href="#"><span class="glyphicon glyphicon-user"></span> Sign
                                Up</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="toggleLoginForm()" class="nav-button" href="#"><span class="glyphicon glyphicon-log-in"></span>
                                Login</button>
                        </div>
                    </li>
                    <li>
                        <div class="li-item">
                            <button onclick="openCartSidebar()" class="nav-button" href="#" style="width: 55px"><span class="glyphicon glyphicon-shopping-cart"></span>
                                </button>
                                <div class="cart-number" id="cart-nr">
                                <p><?php 
                                    if (isset($_SESSION['cart_quantity']) && $_SESSION['cart_quantity'] != 0){
                                        ?>
                                        <script src="..\front\scripts\script.js"></script>
                                        <script>displayCartNumber();</script>
                                        <?php echo $_SESSION['cart_quantity'];
                                    }

                                 ?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </head>
<?php
}
?>

    <section class="featured">
        <form method="GET" action="">
            <div class="search-city-input">
                <label for="search-city" style="color: #57bac7"><h3><b>Search by city</b></h3></label>
                <div class="input-res-city">
                <input class="form-input" type="text" placeholder="Search city" name="search-city" id="search-city" value="<?php echo isset($_GET['search-city']) ? $_GET['search-city'] : ''; ?>"><br>
                <button class="nav-button" type="submit" style="width: 55px"><span class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </form><br>
        <div class="row">
            <?php
            $conn = mysqli_connect("localhost", "root", "", "DelishDrop");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $search = isset($_GET['search-city']) ? $_GET['search-city'] : '';
            $sql = "SELECT * FROM restaurant";
            if (!empty($search)) {
                $sql .= " WHERE city LIKE '%$search%'";
            }

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="col-md-4 res-container.">
                    <a href="restaurantpage.php?id=<?php echo $row['id']; ?>" class="res-link" style="color: white; text-decoration: none">
                        <div class="restaurant">
                        <div class="restaurant-container">
                            <div class="restaurant-image" style="background-image: url('<?php echo $row['image']; ?>')">
                            </div>
                        </div>
                        <h3><?php echo $row['name']; ?></h3>
                        </div>
                </a>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No restaurants found</p>";
            }

            // Close connection
            mysqli_close($conn);
            ?>
        </div>
        
            
               
    </section>
    <footer>
        <div class="footer-content">
            DelishDrop@2024
        </div>
    </footer>

    <div id="loginFormPopup" class="login-form-popup">
        <form method="POST" action="..\back\login.php" class="login-form-container">
          <h2>Login</h2><br>
      
          <label for="username"><b>Username/Email</b></label><br>
          <div style = "color: pink">
          <?php 
          if(isset($_SESSION['login_status'])) {
            echo "<p>" . $_SESSION['login_status'] . "</p>";
            unset($_SESSION['login_status']); // Clear the message after displaying
        }
          ?>
        </div>
          <input class="form-input" type="text" placeholder="Enter Username" name="username" id="username" required><br>
      
          <label for="password"><b>Password</b></label><br>
          <input class="form-input" type="password" placeholder="Enter Password" name="password" id="password" required><br>
      
          <button type="submit" name="submit" id="submit" class="nav-button">Login</button><br>
          <?php $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];?>
          <button type="button" class="nav-button cancel" onclick="closeLoginForm()">&times;</button>
        </form>
    </div>

    <div id="signinFormPopup" class="signin-form-popup">
        <form method="POST" action="create.php" class="signin-form-container">
          <h2>Sign up</h2><br>
      
          <label for="username"><b>Username</b></label><br>
          <div style = "color: pink">
          <?php 
          if(isset($_SESSION['username_error'])) {
            echo "<p>" . $_SESSION['username_error'] . "</p>";
            unset($_SESSION['username_error']);
        }
          ?>
        </div>
          <input class="form-input" type="text" placeholder="Enter Username" name="username" id="username" required><br>

          <label for="email"><b>Email Adress</b></label><br>
          <div style = "color: pink">
          <?php 
          if(isset($_SESSION['email_error'])) {
            echo "<p>" . $_SESSION['email_error'] . "</p>";
            unset($_SESSION['email_error']);
        }
          ?>
        </div>
          <input class="form-input" type="text" placeholder="Enter Email" name="email" id="email" required><br>
      
          <label for="password"><b>Password</b></label><br>
          <input class="form-input" type="password" placeholder="Enter Password" name="password" id="password" required><br>
          <?php $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];?>
          <button type="submit" name="submit" id="submit" class="nav-button">Sign up</button><br>
          <button type="button" class="nav-button cancel" onclick="closeSigninForm()">&times;</button>
        </form>
      </div>

    <div class="sidebar" id="sidebar">
        <a href="#" class="closebtn" onclick="closeSidebar()">&times;</a>
        <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
        <a  href="myaccountpage.php">My account</a>
        <?php 
          if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'yes') {
        ?>
            <a id="createRestaurant" onclick="" href="createrestaurant.php">Add restaurant</a>
        <?php
        }
          ?>
          <?php $_SESSION['current_url'] = $_SERVER['REQUEST_URI'];?>
          <form method="POST" action="logout.php">
        <button type="submit" name="submit" id="submit" class="logout-button">Log out</button>
        </form>
      </div>

      <div class="sidebar" id=cart-sidebar>
      <a href="#" class="closebtn" onclick="closeCartSidebar()">&times;</a>
      <h1>Shopping Cart</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPrice = 0;
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $productId => $quantity) {
                        // Retrieve product details from the database based on $productId
                        // Replace this with your database query to fetch product details
                        // $product = getProductDetails($productId); // You need to define getProductDetails function
                        $conn = mysqli_connect("localhost", "root", "", "DelishDrop");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM product WHERE id='$productId'";
                        $result = mysqli_query($conn, $sql);
                        // Example product details
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product = array(
                                    'name' => $row['name'],
                                    'price' => $row['price'], // Example price
                                );
        
                                $subtotal = $product['price'] * $quantity;
                                $totalPrice += $subtotal;
                    
                            
                            }
                        } ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo number_format($product['price'], 2); ?>RON</td>
                            <td><?php echo $quantity; ?></td>
                            <td><?php echo number_format($subtotal, 2); ?>RON</td>
                            <td class="table-buttons">
                                <form action="update_cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <input class="quantity-input" type="number" name="quantity[<?php echo $productId; ?>]" value="<?php echo $quantity; ?>" min="1">
                                    <button type="submit" class="cart-button">Update</button>
                                </form>
                            </td>
                            <td>
                            <form action="remove_from_cart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                                    <button type="submit" class="cart-button">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">Your cart is empty</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

        <p>Total: <?php echo number_format($totalPrice, 2); ?>RON</p>

        <a href="products.php">Continue Shopping</a>
        <?php
        if (isset($_SESSION['cart_quantity']) && $_SESSION['cart_quantity'] != 0){?>
        <a href="checkoutpage.php">Checkout</a>
        <?php
        }
        ?>
      </div>

    <script src="..\front\scripts\script.js"></script>

    <?php
    if(isset($_SESSION['failed_login'])) {
    ?>
    <script src="..\front\scripts\script.js"></script>

    <script>toggleLoginForm();</script>
    <?php unset($_SESSION['failed_login']);
    
    }

    if(isset($_SESSION['failed_signin'])){
        ?>
        <script src="..\front\scripts\script.js"></script>

<script>toggleSigninForm();</script>
    <?php unset($_SESSION['failed_signin']);
    }
    ?>
</body>

</html>