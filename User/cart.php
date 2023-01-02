<?php
    session_start();
    include 'dbConnection.php';

    //Declarations
    $paymenttype = $name = $cardnumber= $expiration = $cvc = "";
    $paymenttypeErr = $nameErr = $cardnumberErr = $expirationErr = $cvcErr = "";
    $error = "";

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["checkoutForm"]))
	{

        if (empty($_POST["paymenttype"])) {
            $paymenttypeErr = "*Please select a payment method!";
        } else {
            $paymenttype = $_POST["paymenttype"];
        }

        if (empty($_POST["name"])) {
            $nameErr = "*Name is required!";
        } else {
            $name = $_POST["name"];
        }

        if (empty($_POST["cardnumber"])) {
            $cardnumberErr = "*Card Number is required!";
        } else {
            $cardnumber = $_POST["cardnumber"];
        }

        if (empty($_POST["expiration"])) {
            $expirationErr = "*Expiration Date is required!";
        } else {
            $expiration = $_POST["expiration"];
        }

        if (empty($_POST["cvc"])) {
            $cvcErr = "*CVC is required!";
        } else {
            $cvc = $_POST["cvc"];
        }
		

        /*
		$sql = "SELECT * FROM cart_temp";
		$result = $conn->query($sql);
        $customer_name = $_SESSION['customer_name'];
		$customer_email = $_SESSION['customer_email'];

		while($data = mysqli_fetch_array($result))
		{
			$product_name =  $data['product_name'];
			$price =  $data['price'];
			$quantity = $data['quantity'];
			$total_price = $data['total_price'];
			$sql = "INSERT INTO cart(customer_name,customer_email,product_name,price,quantity,total_price,order_time) VALUES('$customer_name','$customer_email','$product_name','$price',$quantity,'$total_price',CURRENT_TIMESTAMP)";

            if ($conn->query($sql) === FALSE){
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
             }else{
                 header('location:cart.php');
             }
             }
             */
    }

    function test_input ($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Helf Coffee Official Website</title>
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.php"></a>
        </div>

        <?php if(!isset($_SESSION['logged_in'])) : ?>
        <a href="user_login.php" class="login">Login</a>
        <?php endif ?>

        <?php if(isset($_SESSION['logged_in'])) : ?>
        <a href="index.php?status=loggedout " class="login">Logout</a>
        <a href="profile.php" class="login">Profile</a> 
        <?php endif ?>
        
        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="menu_best_seller.php">Menu</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>        
    </div>
    <div class="menu_bar">
        <img src="../product_images/cart_bg.jpg" alt="Best Seller Bg">
        <ul>
            <li><a class="active2" href="cart.php">My Cart</a></li>
        </ul>
    </div>

    <div class="content_container">
        <div class="cart_container">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <?php

                

                $sql= "SELECT * FROM cart_temp";
                $result = $conn->query($sql);
                $sub_order = 0;
                $fee = 8;
                $total_order = 0;

                while($data = mysqli_fetch_array($result)) 
                {
                    $product_id = $data['product_id'];
                    $sql2= "SELECT product_img FROM product WHERE product_id = '$product_id'";
                    $result2 = $conn->query($sql2);

                    $sub_order = $sub_order + $data['total_price'];

                    ?>
                    <tr>
                    <?php while($data2 = mysqli_fetch_array($result2))
                        {
                        ?>	
                            <td><?php echo '<img src="'.$data2['product_img'].'"/>';?></td>
                        <?php	
                        } 
                        ?>                
                    <td><?php echo $data['product_name']; ?></td>
                    <td>RM<?php echo number_format($data['price'], 2);?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td>RM<?php echo number_format($data['total_price'], 2);?></td>
                    <td><a class="remove" href = "delete.php?id=<?php echo $data['cart_id']; ?>" onclick="return  confirm('Do you want to remove this product?')"    >X</a>
                    </tr>

                    <?php
                    $total_order = $sub_order + $fee;
                if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["deliveryForm"])){    

                    $dmethod = $_POST['d_method'];

                    if($dmethod == "Self-Pickup"){                       
                        $total_order = $sub_order;
                        $fee = 0;
                    }else{
                        $total_order = $sub_order + $fee;
                    }    
                    
                    $datetime = $_POST['datetime'];
                    $_SESSION['datetime'] = $datetime;
                        
                    }
                }
            
                ?>				
                <tr>
                    <td colspan="4" style="text-align: right;">Sub Total</td>
                    <td>
                        RM<?php echo number_format($sub_order, 2);?>
                    </td>
                </tr> 
                <tr>
                    <td colspan="4" style="text-align: right;">Delivery Fee</td>
                    <td id= "delivery_fee">
                    RM<?php echo number_format($fee, 2);?>
                    </td>
                </tr> 
                    <tr>
                    <td colspan="4" style="text-align: right;">Total</td>
                    <td>
                        RM<?php echo number_format($total_order, 2);?>
                    </td>
                </tr> 
            </table>
        </div>

    </script>

        <div class="order_container">
            <div class="order_details">
                <div class="header">
                    <h2>Order Details</h2>
                </div>

                <form name= "deliveryForm" id="deliveryForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="user_input">
                        <label class="input_field2">&nbsp; Delivery Method &nbsp;</label>
                        <br><br>
                        <div class="container">
                            <div class="c_type">
                                <input type="radio" name="d_method" class="hidden" id="1d" value="Delivery" checked="checked">
                                <label for="1d" class="lb1-radio">Delivery</label>
                            </div>
                            <div class="c_type">
                                <input type="radio" name="d_method" class="hidden" id="2d" value="Self-Pickup">
                                <label for="2d" class="lb1-radio">Self-Pickup</label>
                            </div>
                        </div>
                        
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Receival Date &nbsp;</label>
                        <input type="datetime-local" id="date" name="datetime" value="<?php echo $_SESSION['datetime'];?>" >
                        <br>
                        <small>Error Message</small>
                    </div>

                    <button class="checkout" type="submit" type="deliveryForm" name="deliveryForm">Confirm</button>
                </form>
            </div>

            <div class="payment_details">
                <div class="header">
                    <h2>Payment Details</h2>
                </div>

                <form name= "checkoutForm" id="checkoutForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="user_input">
                        <label class="input_field2">&nbsp; Payment Method &nbsp;</label>
                        <br><br>
                        <div class="container" >
                            <div class="c_type">
                                <input type="radio" name="p_method" id="1p" class="hidden" value="Visa" checked="checked">
                                <label for="1p" class="lb2-radio"><img src="images/visa.png" alt="visa" width="60" height="40"></label>
                            </div>
                            <div class="c_type">
                                <input type="radio" name="p_method" id="2p" class="hidden" value="MasterCard">
                                <label for="2p" class="lb2-radio"><img src="images/mastercard.png" alt="mastercard" width="60" height="40"></label>
                            </div>
                        </div>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Card Holder Name &nbsp;</label>
                        <input type="text" name="name" id="name" placeholder="John Doe">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $nameErr; ?></span>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Card Number &nbsp;</label>
                        <input type="text" name="cardnumber" id="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $cardnumberErr; ?></span>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Expiration Date &nbsp;</label>
                        <input type="text" name="expiration" id="expiration" placeholder="MM-YY">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $expirationErr; ?></span>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; CVC &nbsp;</label>
                        <input type="text" name="cvc" id="cvc" placeholder="XXX">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                        <br>
                        <small>Error Message</small>
                        <span style="color:#e74c3c;font-size: smaller;"><?php echo $cvcErr; ?></span>
                    </div>

                    <button class="checkout" type="checkoutForm" name="checkoutForm">Checkout</button>
			    </form>
            </div>
            <br><br>
        </div>
        </div>
        <script type="text/javascript" src="js/checkout.js"></script>
    </body>
</html>
