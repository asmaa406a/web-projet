<!DOCTYPE>
<?php
include("functions/functions.php");
?>
<html>
    <head>
        <title>My Online Shop</title>
        <link rel="stylesheet" href="styles/style.css" media="all" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
    </head>
    
    <body>
        <!-- Main Container starts here-->
        <div class="main_wrapper">
            <!-- Header starts here-->
            <div class="header_wrapper">

            
                 <a href="index.php"><img id="logo" src="images/shoop.png"/></a>
                <!-- <img id="banner" src="images/ad-banner.gif"/> --> -->
            </div>
            <!-- Header ends here-->
            
            <!-- Navegation Bar starts here-->


            





                    <nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <a class="navbar-brand" href="index.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent" >
    <ul class="navbar-nav mr-auto" >
      <li class="nav-item active">
        <a class="nav-link" href="customers/my_account.php">My Account<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all_products.php">All Products</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="customer_register.php">Sign Up</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Shopping Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact_us.php">Contact Us</a>
      </li>
    </ul>
    <form method="get" action="results.php" enctype="multipart/form-data" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="user_query" placeholder="Search a Product" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" name="search" type="submit">Search</button>
    </form>
  </div>
</nav>







                    
            <div class="content_wrapper">
                <div id="sidebar">
                    <div id="sidebar_title">Categories</div>
                    <ul id="cats">
                        <?php getCats(); ?>
                    </ul>
                    <div id="sidebar_title">Brands</div>
                    <ul id="cats">
                        <?php getBrands(); ?>
                    </ul>
                </div>
                <div id="shopping_cart">
                    <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                        Welcome Guest! <b style="color:yellow">Shopping Cart-</b>Total Items: Total Price: <a href="cart.php" style="color:yellow"> Go to Cart</a>
                    </span>
                </div>
                <div id="content_area">
                    
                        <?php
                        if(isset($_GET['pro_id'])){
                            $product_id = $_GET['pro_id'];
                            $get_pro = "select * from products where product_id='$product_id'";
                            $run_pro = mysqli_query($con, $get_pro); 
                            while($row_pro=mysqli_fetch_array($run_pro)){
                                $pro_id = $row_pro['product_id'];
                                $pro_title = $row_pro['product_title'];
                                $pro_price = $row_pro['product_price'];
                                $pro_image = $row_pro['product_image'];
                                $pro_desc = $row_pro['product_desc'];
                                echo"
                                    <div id='single_product'>
                                        <h3>$pro_title</h3>
                                        <img src='admin_area/product_images/$pro_image' width='400' height='300'/>
                                        <p><b>$ $pro_price </b></p>
                                        <p> $pro_desc </p>
                                        <a href='index.php' style='float:left'>Go Back</a>
                                        <a href='index.php?pro_id=$pro_id'><button style='float:right'>Add to Cart</button></a>
                                    </div>

                                ";

                            }
                        }
                        ?>
                   
                </div>
            </div>
            <!-- Content ends here-->
            
            <div id="footer">
               <!-- Footer -->
<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3" style="color:white ; font-size:30px">© 2022  Copyright:
  <a href="/"> ecommerce.com</a>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->
            </div>
            <!-- Footer ends here-->
        </div>
        <!-- Main Container ends here-->
    </body>

</html>