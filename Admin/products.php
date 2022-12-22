<?php
session_start();

global $conn;

include "dbConnection.php"

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="products.css">
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <script src="https://kit.fontawesome.com/4fdfa3530e.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }
    ?>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="cafe-outline"></ion-icon>
                        </span>
                        <span class="title">HelffCoffee</span>
                    </a>
                </li>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="orders.html">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Orders</span>
                    </a>
                </li>
                <li class="hovered active">
                    <a href="products.html">
                        <span class="icon">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li>
                    <a href="transaction.html">
                        <span class="icon">
                            <ion-icon name="cash-outline"></ion-icon>
                        </span>
                        <span class="title">Transaction</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="sparkles-outline"></ion-icon>
                        </span>
                        <span class="title">Events</span>
                    </a>
                </li>
                <li>
                    <a href="settings.html">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="adminlogout.php">
                        <span class="icon">
                            <ion-icon name="exit-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="user">
                    <img src="images/profile.jpg">
                </div>
            </div>

            <div class="table">
                <div class="products-table">
                    <div class="products-table-header">
                        <h2>Products</h2>
                    </div>
                    <div class="controller-container">
                        <a href="products_add.html" class="button">Add</a>
                        <a href="products_edit.html" class="button">Edit</a>
                        <a href="products_delete.html" class="button">Delete</a>
                        <a href="products_best_seller.html" class="button">Best Seller</a>
                        <div class="search-container">
                            <form>
                                <input type="text" placeholder="Search Here.." name="products-search-bar">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="products-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Calorie (kcal)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pastries</td>
                                    <td>Gu Mor Kak</td>
                                    <td>
                                        “Gu Mor Kak” or Demon Cow’s Horn Biscuit is a chinese homemade traditional biscuit that is packed with savory rosated chicken fillings, with a thin layered crust wrapped around it. It’s crunchy textute and salty with a hint a sweetness flavour is exactly why Gu Mor Kak is one of our cafe’s signature pastries and best seller.
                                    </td>
                                    <td>8.90</td>
                                    <td>2</td>
                                    <td>35</td>
                                </tr>
                                <tr>
                                    <td>Pastries</td>
                                    <td>Portuguese Tart</td>
                                    <td>
                                        Homemade Portuguese style egg tart baked with an outer layer of crust, fragant egg fillings and a layer of burnt cheese on top. It’s aromatic, sweet and satly fillings combined with the crusty outer layer is definately a must try.
                                    </td>
                                    <td>9.90</td>
                                    <td>3</td>
                                    <td>125</td>
                                </tr>
                                <tr>
                                    <td>Desserts</td>
                                    <td>Oreo Cheesecake</td>
                                    <td>
                                        Served fresh of the fridge with butter and oreo crumps as the base, special homemade cream cheese and milk recipe as the middle layer and top it off with oreo poweder sprinkles and a piece of oreo biscuit. Oreo lovers what are you waiting for? Try it now.
                                    </td>
                                    <td>13.00</td>
                                    <td>1</td>
                                    <td>562</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <script>
        // MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function () {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
    </script>
</body>

</html>
