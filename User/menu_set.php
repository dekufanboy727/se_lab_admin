<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/menu_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <script src="js/menu.js"></script>
    <title>Helf Coffee Official Website</title>
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.html"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.html"></a>
        </div>

        <a href="user_login.php" class="login">Login</a>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a class="active" href="menu_best_seller.html">Menu</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>        
    </div>
    <div class="menu_bar" id="scroll">
        <img src="images/set_bg.jpg" alt="Best Seller Bg">

        <ul>
            <li><a class="unactive" href="menu_best_seller.html">Best Seller</a></li>
            <li><a class="unactive" href="menu_pastries.html">Pastries</a></li>
            <li><a class="unactive" href="menu_beverages.html">Beverages</a></li>
            <li><a class="unactive" href="menu_desserts.html">Desserts</a></li>
            <li><a class="active2" href="menu_set.html">Set</a></li>
        </ul>
    </div>

    <div class="item_container">

        <div class="item">
            <div class="item_pic">
                <img src="images/mix_match_set.png" style="bottom: 80px;">
            </div>
            <div class="description">
                <div class="item_name"><center>Mix & Match Set</center></div>
                <div class="price">
                    <center>RM34.00</center>
                    <div class="sub_price"><center>3 of Any Kind</center></div>
                </div>
                <div class="price">
                    <center>RM42.00</center>
                    <div class="sub_price"><center>4 of Any Kind</center></div>
                </div>
                <div class="order_btn" onclick="togglePopup_1()"><center>Order Now</center></div>
            </div>
        </div>

        <div class="item">
            <div class="item_pic">
                <img src="images/tea_time_set.png" style="bottom: 95px;">
            </div>
            <div class="description">
                <div class="item_name"><center>Tea Time Set</center></div>
                <div class="price">
                    <center>RM38.80</center>
                    <div class="sub_price"><center>for 2 pax</center></div>
                </div>
                <div class="price">
                    <center>RM58.80</center>
                    <div class="sub_price"><center>for 3 pax</center></div>
                </div>
                <div class="order_btn" onclick="togglePopup_2()"><center>Order Now</center></div>
            </div>
        </div>
        
    </div>
    
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <img src="images/mix_match_set.png">
            <div class="description_container">
                <div class="description2">
                    <div class="item_name2">Mix & Match Set</div>
                    <P>“Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller.
                    </P>
                    <div class="deco">
                        <div class="deco_dot"></div>
                        <div class="deco_dot"></div>
                        <div class="deco_bar"></div>
                    </div>
                    <div class="price_quantity_container">
                        <div class="price2">
                            <center>RM34.00</center>
                            <div class="sub_price2"><center>3 of Any Kind</center></div>
                        </div>
                        <div class="price2">
                            <center>RM42.00</center>
                            <div class="sub_price2"><center>4 of Any Kind</center></div>
                        </div>
                        <div class="quantity">
                            <span class="minus" id="minus">-</span>
                            <span class="num" id="num">01</span>
                            <span class="plus" id="plus">+</span>
                        </div>
                    </div>
                    <div class="add_to_cart_btn">Add To Cart</div>
                </div>
            </div>
            <div class="close_btn" onclick="togglePopup_1()">Close</div>
        </div>
    </div>

    <div class="popup" id="popup-2">
        <div class="overlay"></div>
        <div class="content">
            <img src="images/tea_time_set.png">
            <div class="description_container">
                <div class="description2">
                    <div class="item_name2">Tea Time Set</div>
                    <P>“Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller.
                    </P>
                    <div class="deco">
                        <div class="deco_dot"></div>
                        <div class="deco_dot"></div>
                        <div class="deco_bar"></div>
                    </div>
                    <div class="price_quantity_container">
                        <div class="price2">
                            <div class="price2">
                                <center>RM38.80</center>
                                <div class="sub_price2"><center>for 2 pax</center></div>
                            </div>
                            <div class="price2">
                                <center>RM58.80</center>
                                <div class="sub_price2"><center>for 3 pax</center></div>
                            </div>
                        </div>
                        <div class="quantity">
                            <span class="minus"id="minus-2">-</span>
                            <span class="num"id="num-2">01</span>
                            <span class="plus" id="plus-2">+</span>
                        </div>
                    </div>
                    <div class="add_to_cart_btn">Add To Cart</div>
                </div>
            </div>
            <div class="close_btn" onclick="togglePopup_2()">Close</div>
        </div>
    </div>

</body>
</html>
