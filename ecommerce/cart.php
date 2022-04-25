<!DOCTYPE html>
<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
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
                
            </div>






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
                <?php cart(); ?>
                <div id="shopping_cart">
                    <span style="float:right; font-size:18px; padding:5px; line-height:40px;">
                        <?php 
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Welcome:</b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'>Your</b>" ;
                            }else {
                                echo "<b>Welcome Guest:</b>";
                            }
                        ?>
                        
                        
                        <b style="color:yellow">Shopping Cart-</b>Total Items: <?php total_items(); ?>  Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow"> Go to Cart</a>
                        
                        <?php 
                            if(!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php' style='color:orange;'>Login</a>";
                            }
                            else {
                                echo "<a href='logout.php' style='color:orange;'>Logout</a>";
                            }
                        ?>
                    </span>
                </div>
                <div id="content_area">
                    
                    <div id="products_box">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table  align="left" width="100%" bgcolor="skyblue">
                                <tr align="center">
                                    <th>Remove</th>
                                    <th>Product(S)</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                                <?php 
                                $total = 0;
                                global $con; 
                                $ip = getIp(); 
                                $sel_price = "select * from cart where ip_add='$ip'";
                                $run_price = mysqli_query($con, $sel_price); 
                                while($p_price=mysqli_fetch_array($run_price)){
                                    $pro_id = $p_price['p_id']; 
                                    $pro_price = "select * from products where product_id='$pro_id'";
                                    $run_pro_price = mysqli_query($con,$pro_price); 
                                    while ($pp_price = mysqli_fetch_array($run_pro_price)){
                                    $product_price = array($pp_price['product_price']);
                                    $product_title = $pp_price['product_title'];
                                    $product_image = $pp_price['product_image']; 
                                    $single_price = $pp_price['product_price'];
                                    $values = array_sum($product_price); 
                                    $total += $values; 

                                ?>
                                <tr align="center">
                                <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"/></td>
                                <td><?php echo $product_title; ?><br>
                                <img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60"/>
                                </td>
                                <td><input type="text" size="4" name="qty" value="<?php
                                
                                if(isset($_SESSION['qty']))
                                echo $_SESSION['qty'];?>"/></td>
                                <?php 
                                if(isset($_POST['update_cart'])){
                                    $qty = $_POST['qty'];
                                    $update_qty = "update cart set qty='$qty'";
                                    $run_qty = mysqli_query($con, $update_qty); 
                                    $_SESSION['qty']=$qty;
                                    
                                    $total =(int)$total * (int)$qty;
                                }
                                ?>
                                <td><?php echo "$" . $single_price; ?></td>
                            </tr>
                            <?php } } ?>
                            <tr>
                                    <td colspan="4" align="right"><b>Sub Total:</b></td>
                                    <td><?php echo "$" . $total;?></td>
                                </tr>
                                <tr align="center">
                                    <td colspan="2"><input type="submit" name="update_cart" value="Update Cart"/></td>
                                    <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                                    <td><button><a href="checkout.php" style="text-decoration:none; color:black;">Checkout</a></button></td>
                                </tr>

                            </table>
                        </form>
                        <?php
                        function updatecart(){
                            global $con;
                            $ip = getIp();
                            if(isset($_POST['update_cart'])){
                                foreach($_POST['remove'] as $remove_id){
                                    $delete_product = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
                                    $run_delete = mysqli_query($con, $delete_product);
                                    if($run_delete){
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    }
                                }
                            }
                            if(isset($_POST['continue'])){
                                echo "<script>window.open('index.php','_self')</script>";
                            }
                        }
                        echo @$up_cart = updatecart();
                       ?>	

                    </div>

                </div>
            </div>
            <!-- Content ends here-->
            
            <div id="footer">
               <!-- Footer -->
<footer class="page-footer font-small blue">

<!-- Copyright -->
<div class="footer-copyright text-center py-3">© 2022  Copyright:
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