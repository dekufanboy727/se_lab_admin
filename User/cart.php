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
        <img src="images/cart_bg.jpg" alt="Best Seller Bg">
        <ul>
            <li><a class="active2" href="cart.php">My Cart</a></li>
        </ul>
    </div>

    <div class="container">
        <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th></th>
            </tr>
		</thead>
            <?php

            $sql= "SELECT * FROM cart_temp";
            $result = $conn->query($sql);
            $total_order = 0;

            while($data = mysqli_fetch_array($result)) 
            {
                $product_id = $data['product_id'];
                $sql2= "SELECT product_img FROM product WHERE product_id = '$product_id'";
                $result2 = $conn->query($sql2);

                $total_order = $total_order + $data['total_price'];

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
                <td><button class="remove">X</button></td>
                </tr>
            <?php
            }
            ?>				
            <tr>
                <td colspan="7" style="text-align: right;">Sub Total</td>
                <td>
                RM<?php
                echo number_format($total_order, 2);
                ?>
                </td>
		    </tr> 
        </table>
        <button class="checkout">Checkout</button>
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

</body>
</html>
