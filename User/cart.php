<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
    <script src="js/menu.js"></script>
    <title>Helf Coffee Official Website</title>
</head>
<body>
    <div class="nav_bar">
        <div class="logo">
            <a href="index.html"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 130px" href="index.html"></a>
        </div>

        <a href="#" class="login">Login</a>

        <nav class="pages">
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a class="active" href="menu_best_seller.html">Menu</a></li>
                <li><a href="#">Events</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>        
    </div>
    <div class="menu_bar">
        <img src="images/cart_bg.jpg" alt="Best Seller Bg">
        <ul>
            <li><a class="active2" href="cart.html">My Cart</a></li>
        </ul>
    </div>

    <div class="container">
        <table>
            <tr>
                <td><img src="images/Gu_Mor_Kak.jpg"></td>
                <td>Gu Mor Kak</td>
                <td>RM10</td>
                <td><div class="quantity">
                    <span class="minus"id="minus<?php echo $data['product_id']?>">-</span>
                    <input type="text" name='num' class="num" id="num<?php echo $data['product_id']?>" value ="01"></input>
                    <span class="plus" id="plus<?php echo $data['product_id']?>">+</span>
                </div></td>
                <td><button class="remove">X</button></td>
            </tr>
            
            <tr>
                <td><img src="images/Gu_Mor_Kak.jpg"></td>
                <td>Gu Mor Kak</td>
                <td>RM10</td>
                <td><div class="quantity">
                    <span class="minus"id="minus<?php echo $data['product_id']?>">-</span>
                    <input type="text" name='num' class="num" id="num<?php echo $data['product_id']?>" value ="01"></input>
                    <span class="plus" id="plus<?php echo $data['product_id']?>">+</span>
                </div></td>
                <td><button class="remove">X</button></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">Sub Total</td>
                <td>RM100</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">Delivery Fee</td>
                <td>RM8</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;">Total</td>
                <td>RM108</td>
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