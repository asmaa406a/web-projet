<!DOCTYPE>
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







                   
            <!-- Navegation Bar ends here-->
            
            <!-- Content starts here-->
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
                        Welcome Guest! <b style="color:yellow">Shopping Cart-</b>Total Items: <?php total_items(); ?>  Total Price: <?php total_price(); ?><a href="cart.php" style="color:yellow"> Go to Cart</a>
                    </span>
                </div>
                <div id="content_area">
                    <form action="customer_register.php" method="post" enctype="multipart/form-data">
					    <table align="center" width="100%" height="400px" style="color:white">
                            <tr align="center">
                                <td colspan="6"><h2>Create an Account</h2></td>
                            </tr>
                            <tr>
                                <td align="center">Customer Name:</td>
                                <td><input type="text" name="c_name" required/></td>
                            </tr>

                            <tr>
                                <td align="center">Customer Email:</td>
                                <td><input type="text" name="c_email" required/></td>
                            </tr>

                            <tr>
                                <td align="center">Customer Password:</td>
                                <td><input type="password" name="c_pass" required/></td>
                            </tr>

                            <tr>
                                <td align="center">Customer Image:</td>
                                <td><input type="file" name="c_image" required/></td>
                            </tr>
                            <tr>
                                <td align="center">Customer Country:</td>
                                <td>
                                <select name="c_country">
                                    <option>Select a Country</option>
                                    <option>Morroco</option>
                                    <option>Tunesie</option>
                                    <option>Algerie</option>
                                    <option>Egype</option>
                                    <option>USA</option>
                                    <option>India</option>
                                    <option>United Arab Emirates</option>
                                    <option>China</option>
                                </select>
                                </td>
                            </tr>

                            <tr>
                                <td align="center">Customer City:</td>
                                <td><input type="text" name="c_city" required/></td>
                            </tr>

                            <tr>
                                <td align="center">Customer Contact:</td>
                                <td><input type="text" name="c_contact" required/></td>
                            </tr>

                            <tr>
                                <td align="center">Customer Address</td>
                                <td><input type="text" name="c_address" required/></td>
                            </tr>
                            <tr align="right">
                                <td align="center" colspan="2"><input type="submit" name="register" value="Create Account" /></td>
                            </tr>
					</table>
				</form>
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
<?php
    if(isset($_POST['register'])){
		$ip = getIp();
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_country = $_POST['c_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
        
		move_uploaded_file($c_image_tmp,"customers/customer_images/$c_image");
		
        $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
        
        $run_c = mysqli_query($con, $insert_c); 
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con, $sel_cart); 
		$check_cart = mysqli_num_rows($run_cart); 
        if($check_cart==0){
            $_SESSION['customer_email']=$c_email; 
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('customers/my_account.php','_self')</script>";
        }else {
            $_SESSION['customer_email']=$c_email; 
            echo "<script>alert('Account has been created successfully, Thanks!')</script>";
            echo "<script>window.open('checkout.php','_self')</script>";
		}
    }
?>