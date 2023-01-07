<?php
    session_start();
    include 'dbConnection.php';

    if(!empty($_GET['status'])){
        session_destroy();
        unset($_SESSION['email']);
        unset($_SESSION['id']);
        header('Location: index.php');
    }

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $temp = $_POST['price'];
        $quantity = $_POST['num'];
        $sql2 = $conn->query("SELECT * FROM product");

        if($sql2->num_rows > 0)
        {
            while($data=$sql2->fetch_assoc())
            {
                $productid = $data['product_id'];

                if(isset($_POST[$productid]))
                {
                    $sql3 = $conn->query("SELECT * FROM product WHERE product_id = $productid");
                    $result = $sql3->fetch_assoc();

                    
                    $product_name = $result['product_name'];
                    $price = $result['price'];
                    if($temp == 'Cold'){
                        $price+=0.40;
                    }
                    $total_price = $quantity * $price;

                    $sql = "INSERT INTO cart_temp(product_id,product_name,price, quantity, total_price) VALUES('$productid','$product_name', '$price', '$quantity','$total_price')";
                    if ($conn->query($sql) === FALSE){
							echo ("ERROR IN PURCHASING MERCHANDISE!");
					}else{
                        sleep(2);
                        
                    }
					
    
                }
                                
            }


        }


	}	
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Helf Coffee Official Website</title>
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.html"></a>
        </div>

        <?php if(!isset($_SESSION['logged_in'])) : ?>
        <a href="user_login.php" class="login">Login</a>
        <?php endif ?>

        <?php if(isset($_SESSION['logged_in'])) : ?>
        <div class="profile_btn">
            <?php
            $email = $_SESSION['email'];
           
            ?>
            <a><?php echo $email ?></a>
            <i class="fa fa-user-circle" aria-hidden="true"></i>
            <div class="dropdown-content">
                <a href="profile.php">User Profile</i><i class="fa fa-id-card" aria-hidden="true"></i></a>
                <a href="profile.php#my_orders">My Orders<i class="fa fa-cutlery" aria-hidden="true"></i></a>
                <a href="index.php?status=loggedout">Logout<i class="fa fa-sign-out" aria-hidden="true"></i></a>
            </div>
            
        </div>
        <?php endif ?>

        <nav class="pages">
            <ul>
                <li><a href="index.php#about_us">About Us</a></li>
                <li><a class="active" href="menu_best_seller.php">Menu</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="contact_us.php">Contact</a></li>
            </ul>
        </nav>        
    </div>
    <div class="menu_bar" id="scroll">
        <img src="images/best_seller_bg.jpg" alt="Best Seller Bg" style="bottom: 200px;">
        <div class="blur"></div>
        <ul>
            <li><a class="active2" href="menu_best_seller.php">Best Seller</a></li>
            <li><a class="unactive" href="menu_pastries.php">Pastries</a></li>
            <li><a class="unactive" href="menu_beverages.php">Beverages</a></li>
            <li><a class="unactive" href="menu_desserts.php">Desserts</a></li>
            <li><a class="unactive" href="menu_set.php">Set</a></li>
        </ul>
    </div>

    <div class="content_container">        
        <div class="item_container">

            <?php
                    $sql = $conn->query("SELECT * FROM product WHERE best_seller = 1 AND product_type != 3 ORDER BY product_id");
                    $sql2 = $conn->query("SELECT * FROM product WHERE best_seller = 1 AND product_type = 3 ORDER BY product_id");
                    ?>
                    
                    <?php
                    if($sql->num_rows > 0)
                    {
                        while($data=$sql->fetch_assoc())
                        {

                        
                    ?>
                
                <div class="item">
                    
                <div class="item_pic">
                <?php
                    echo  '<img style="bottom: '.$data['pixel'].'px;" src="'.$data['product_img'].'"/>';
                ?>
                </div>
                <div class="description">
                    <div class="item_name"><center><?php echo $data['product_name']?></center></div>
                    <div class="price">
                        <center>RM<?php echo number_format($data['price'], 2);?></center>
                        <div class="sub_price"><center>per piece</center></div>
                    </div>
                    <div class="order_btn" onclick="togglePopup_<?php echo $data['product_id']?>()"><center>Order Now</center></div>
                </div>
            </div>

            <?php
            }
            
            while($data=$sql2->fetch_assoc())
                        {

                        $cold = 0.40;        

                    ?>
                
                <div class="item">
                    
                <div class="item_pic">
                <?php
                    echo  '<img style="bottom: '.$data['pixel'].'px;" src="'.$data['product_img'].'"/>';
                ?>
                </div>
                <div class="description">
                    <div class="item_name"><center><?php echo $data['product_name']?></center></div>
                    <div class="price">
                        <div class="price">
                            <center>RM<?php echo number_format($data['price'], 2);?></center>
                            <div class="sub_price"><center>Hot</center></div>
                        </div>
                        <div class="price">
                            <center>RM<?php echo number_format($data['price'] +$cold , 2);?></center>
                            <div class="sub_price"><center>Cold</center></div>
                        </div>
                    </div>
                    <div class="order_btn" onclick="togglePopup_<?php echo $data['product_id']?>()"><center>Order Now</center></div>
                </div>
            </div>

            <?php
            }
            }    
            ?>

        </div>
        <?php 
            $sql = $conn->query("SELECT * FROM product WHERE best_seller = 1 AND product_type != 3 ORDER BY product_id");
            $sql2 = $conn->query("SELECT * FROM product WHERE best_seller = 1 AND product_type = 3 ORDER BY product_id");
            ?>

        <?php
            if($sql->num_rows > 0 ){

                while($data=$sql->fetch_assoc()){
        ?>


        <div class="popup" id="popup-<?php echo $data['product_id']?>">
            <?php
                $product_id = $data['product_id'];
            ?>
            <div class="overlay"></div>
            <div class="content">
                <?php
                    echo  '<img src="'.$data['product_img'].'"/>';
                ?>
                <div class="description_container">
                    <div class="description2">
                        <div class="item_name2"><?php echo $data['product_name']?></div>
                        <P><?php echo $data['product_desc']?>
                        </P>
                        <div class="deco">
                            <div class="deco_dot"></div>
                            <div class="deco_dot"></div>
                            <div class="deco_bar"></div>
                        </div>
                        
                        <form name=<?php echo $product_id;?> method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="toggleAddCart()">
                            <div class="price_quantity_container">
                                
                                <div class="price2">
                                    <input type="radio" name="price" id="1<?php echo $data['product_id']?>" class="hidden" value="Hot" checked="checked">
                                    <label for="1<?php echo $data['product_id']?>" class="lb1-radio">
                                    <center>RM<?php echo number_format($data['price'], 2);?></center>
                                    <div class="sub_price2"><center>per piece</center></div>
                                    </label>
                                </div>
                                <div class="quantity">
                                    <span class="minus"id="minus<?php echo $data['product_id']?>">-</span>
                                    <input type="text" name='num' class="num" id="num<?php echo $data['product_id']?>" value ="01"></input>
                                    <span class="plus" id="plus<?php echo $data['product_id']?>">+</span>
                                </div>
                            </div>
                            <button class="add_to_cart_btn" type="submit" id="submit" name="<?php echo $product_id;?>" >Add To Cart</button>
                        </form>
                    </div>
                </div>
                <div class="close_btn" onclick="togglePopup_<?php echo $data['product_id']?>()">Close</div>
            </div>
        </div>


        <script>
            function togglePopup_<?php echo $data['product_id']?>(){
            document.getElementById("scroll").scrollIntoView();
            document.getElementById("popup-<?php echo $data['product_id']?>").classList.toggle("active");

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
    }
        
        </script>

        <?php 
            }    
                }
                if($sql2->num_rows > 0 ){
                while($data=$sql2->fetch_assoc()){
        ?>

        <div class="popup" id="popup-<?php echo $data['product_id']?>">
            <?php
                $product_id = $data['product_id'];
            ?>
            <div class="overlay"></div>
            <div class="content">
                <?php
                    echo  '<img src="'.$data['product_img'].'"/>';
                ?>
                <div class="description_container">
                    <div class="description2">
                        <div class="item_name2"><?php echo $data['product_name']?></div>
                        <P><?php echo $data['product_desc']?>
                        </P>
                        <div class="deco">
                            <div class="deco_dot"></div>
                            <div class="deco_dot"></div>
                            <div class="deco_bar"></div>
                        </div>
                        <form name=<?php echo $product_id;?> method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="toggleAddCart()">
                            <div class="price_quantity_container">
                                
                            <div class="price">
                                    <div class="price2">
                                        <input type="radio" name="price" id="1<?php echo $data['product_id']?>" class="hidden" value="Hot" checked="checked">
                                        <label for="1<?php echo $data['product_id']?>" class="lb1-radio">
                                        <center>RM<?php echo number_format($data['price'], 2);?></center>
                                        <div class="sub_price2"><center>Hot</center></div>
                                        </label>
                                    </div>

                                    <div class="price2">
                                        <input type="radio" name="price" id="2<?php echo $data['product_id']?>" class="hidden" value="Cold">
                                        <label for="2<?php echo $data['product_id']?>" class="lb1-radio">
                                        <center>RM<?php echo number_format($data['price'] +$cold , 2);?></center>
                                        <div class="sub_price2"><center>Cold</center></div>
                                    </label>
                                </div>
                                </div>
                                <div class="quantity">
                                    <span class="minus"id="minus<?php echo $data['product_id']?>">-</span>
                                    <input type="text" name='num' class="num" id="num<?php echo $data['product_id']?>" value ="01"></input>
                                    <span class="plus" id="plus<?php echo $data['product_id']?>">+</span>
                                </div>
                            </div>
                            <button class="add_to_cart_btn" type="submit" name="<?php echo $product_id;?>">Add To Cart</button> 
                        </form>
                    </div>
                </div>
                <div class="close_btn" onclick="togglePopup_<?php echo $data['product_id']?>()">Close</div>
            </div>
        </div>

            


        <script>
            function togglePopup_<?php echo $data['product_id']?>(){
            document.getElementById("scroll").scrollIntoView();
            document.getElementById("popup-<?php echo $data['product_id']?>").classList.toggle("active");

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
    }
        
        </script>

        <?php 
            }
        }
        ?>

        <div class="cart_btn" id="cart">
            <div class="cart_container" >
            <?php if(!isset($_SESSION['logged_in'])){ ?>
            <a href ="user_login.php"class="fa fa-shopping-cart fa-3x" aria-hidden="true" onclick="alert('Please log in before proceeding to your cart');"></a>    
            <?php    
            }else{ ?>
            <a href ="cart.php"class="fa fa-shopping-cart fa-3x" aria-hidden="true"></a>   
            <?php     
            } ?>

            <?php
                $result = $conn->query("SELECT COUNT(*) FROM `cart_temp`");
                $row = $result->fetch_row();
            ?>
            <span class ="cart_quantity"><?php echo $row[0];?></span>
                    
            <span class="message" id="cart-success" style = "font-size: 25px">Product successfully added to cart</span>
            </div>
        </div>

    <script>
        function toggleAddCart(){
                 
            document.getElementById("cart").classList.toggle('active');
            
        }
    
    </script>
</body>
</html>
