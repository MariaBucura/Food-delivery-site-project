<!DOCTYPE html>
<html lang="en">

<?php
        // Connect to database
        $conn = mysqli_connect("localhost", "root", "", "DelishDrop");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Retrieve product details based on the ID passed in the URL
        $restaurantId = $_GET['id'];
        $sql = "SELECT * FROM restaurant WHERE id = $restaurantId";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $restaurant = mysqli_fetch_assoc($result);
        }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="..\front\img\logo.png" type="image/x-icon">
    <title>Add product</title>
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


   <div class="add-restaurant-form">
    <h1>Add Product</h1>
    <form method="POST" action="createpr.php" enctype="multipart/form-data" class="add-restaurant-container">
          <input type="hidden" name="restaurant_id" value="<?php echo $restaurantId ?>">
          <label for="product-name"><b>Product name</b></label><br>
          <input class="form-input" type="text" placeholder="Enter name" name="product-name" id="product-name" required><br>
          <label for="product-description"><b>Description</b></label><br>
          <textarea class="description-box" id="product-description" name="product-description" placeholder="Enter your description here..."></textarea><br>
          <label for="product-price"><b>Price</b></label><br>
          <input class="form-input" type="text" placeholder="Enter price" name="product-price" id="product-price" required><br>
          <label for="product-image"><b>Image</b></label><br>
          <input name="product-image" id="product-image" class="restaurant-img" type="file" name="image" accept="image/*"><br>
          <button type="submit" name="submit" id="submit" class="nav-button">Add</button><br>
          
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