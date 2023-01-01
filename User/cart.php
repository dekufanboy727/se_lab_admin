<?php
    session_start();
    include 'dbConnection.php';
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
    <script src="js/menu.js"></script>
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

    <form method="post" onsubmit="calculate()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <input onclick = "addFee()" type="radio" name="method" value="Delivery">Delivery
        <input onclick = "removeFee()" type="radio" name="method" value="Self Pickup">Self Pickup
        <input type="submit" class="checkout" value='Calculate' name='submit'>
    </form>
   
    <script>
        function addFee(){
            
            document.getElementById('delivery_fee').innerText = 'RM8.00';
        }

        function removeFee(){
            
            document.getElementById('delivery_fee').innerText = 'RM0.00';
        }

    </script>

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
                        RM0.00
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

    <script>
        let plus = document.getElementById("plus<?php echo $data['product_id']?>");
        let num = document.getElementById("num<?php echo $data['product_id']?>");
        let minus = document.getElementById("minus<?php echo $data['product_id']?>");

        let a = 1;

        plus.addEventListener("click", ()=>{
            a++;
            a = (a<10)?"0"+a:a;
            num.value = a;
        });

        minus.addEventListener("click", ()=>{
            if(a>1){
                a--;
                a = (a<10)?"0"+a:a;
                num.value = a;
            }
        });

    </script>

        <div class="payment_container">
            <div class="payment_info">
                <div class="header">
                    <h2>Payment Info</h2>
                </div>

                <form>
                    <div class="user_input">
                        <label class="input_field">&nbsp; Payment Method &nbsp;</label>
                        <br><br>
                        <div>
                            <div class="c_type">
                                <input type="radio" name="price" id="1" class="hidden" value="Visa">
                                <label for="1" class="lb1-radio"><img src="images/visa.png" alt="visa" width="60" height="40"></label>
                            </div>
                            <div class="c_type">
                                <input type="radio" name="price" id="2" class="hidden" value="MasterCard">
                                <label for="2" class="lb1-radio"><img src="images/mastercard.png" alt="mastercard" width="60" height="40"></label>
                            </div>
                        </div>
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Card Holder Name &nbsp;</label>
                        <input type="text" name="name" placeholder="John Doe">
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Card Number &nbsp;</label>
                        <input type="text" name="cardnumber" placeholder="XXXX-XXXX-XXXX-XXXX">
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; Expiration Date &nbsp;</label>
                        <input type="text" name="expiration" placeholder="MM-YY">
                    </div>

                    <div class="user_input">
                        <label class="input_field">&nbsp; CVC &nbsp;</label>
                        <input type="text" name="cvc" placeholder="XXX">
                    </div>

                    <button class="checkout" type="submit">Checkout</button>
			    </form>
            </div>
            <br><br>
        </div>
        </div>
    </body>
</html>
