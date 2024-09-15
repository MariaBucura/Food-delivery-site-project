<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\front\img\logo.png" type="image/x-icon">
    <title>Check out</title>
    <link rel="stylesheet" href="..\front\style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body bgcolor="#BCA0BC">
<?php

include "login.php";

$_SESSION['current_url'] = $_SERVER['REQUEST_URI'];
// If session is not set but cookie is, set the session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

          
?>

<?php
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
                            <button onclick="openCartSidebar()" class="nav-button cart-nav-button" href="#" style="width: 55px"><span class="glyphicon glyphicon-shopping-cart"></span>
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



   <div class="add-restaurant-form" style="height: 100%">
    <h1>Checkout</h1>   
    <form method="POST" action="submitorder.php" class="add-restaurant-container" style="width: 100%; padding: 50px">
    <label for="order-name"><b>First name</b></label><br>
          <input class="form-input" type="text" placeholder="Enter first name" name="order-name" id="order-name" required><br>
          <label for="order-surname"><b>Last name</b></label><br>
          <input class="form-input" type="text" placeholder="Enter last name" name="order-surname" id="order-surname" required><br>
         
          <h3>Enter adress</h3><br>
            <label for="order-county"><b>County</b></label><br>
          <div class="dropdown">
            <input id="order-county" name="order-county" type="text" placeholder="Search counties..." class="dropdown-input" onkeyup="filterCounties(this.value)">
                <div class="dropdown-list" id="county-list">
                </div>
          </div><br>
          <label for="order-city"><b>City</b></label><br>
          <input class="form-input" type="text" placeholder="Enter city" name="order-city" id="order-city" required><br>
          <label for="order-street"><b>Street</b></label><br>
          <input class="form-input" type="text" placeholder="Enter street" name="order-street" id="order-street" required><br>
          <h1>Shopping Cart</h1>
        <table class="table" style="width: 100% ">
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
                            <td class="table-buttons"><?php echo $quantity; ?>
                            </td>
                            <td>
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

        <p class="total-price">Order Total: <?php echo number_format($totalPrice, 2); ?>RON</p> 
        <?php 
        if(isset($_SESSION['username'])){
            $conn = mysqli_connect("localhost", "root", "", "DelishDrop");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $userId = $row['id'];
            }
        }
        }
        ?>  
        <?php
        if(isset($_SESSION['username'])){
            ?><input type="hidden" name="user-id" value="<?php echo $userId?>">
            <?php
        }
        ?>
        <input type="hidden" name="order-total" value="<?php echo $totalPrice?>">
          <button type="submit" name="submit" id="submit" class="nav-button">Submit order</button><br>
          
        </form>
   </div>
 
    
      <div class="sidebar" id="sidebar">
        <a href="#" class="closebtn" onclick="closeSidebar()">&times;</a>
        <h2>Hello, <?php echo $_SESSION['username']; ?>!</h2>
        <a  href="myaccountpage.php">My account</a>
        <?php 
          if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 'yes') {
        ?>
            <a id="createRestaurant" onclick="" href="#">Add restaurant</a>
        <?php
        }
          ?>
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
      

    <footer>
        <div class="footer-content">
            DelishDrop@2024
        </div>
    </footer>

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