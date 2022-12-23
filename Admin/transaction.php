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
    <title>Transaction</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="transaction.css">
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
                    <a href="orders.php">
                        <span class="icon">
                            <ion-icon name="cart-outline"></ion-icon>
                        </span>
                        <span class="title">Orders</span>
                    </a>
                </li>
                <li>
                    <a href="products.php">
                        <span class="icon">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li class="hovered active">
                    <a href="transaction.php">
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
                    <a href="settings.php">
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
                <div class="transaction-table">
                    <div class="transaction-table-header">
                        <h2>Transaction History</h2>
                    </div>
                    <div class="grid-container">
                        <div class="search-container">
                            <form>
                                <input type="text" placeholder="Invoice No.." name="search-invoice-no">
                                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></i></button>
                            </form>
                        </div>
                        <div class="grid-child filter">
                            <div class="filter-dropdown">
                                <button onclick="dropdownFunction()" class="dropbtn">Filter By <i class="fa-solid fa-filter"></i></button>
                                <div id="dropdownContent" class="dropdown-content">
                                    <a href="#latest">Latest</a>
                                    <a href="#today">Today</a>
                                    <a href="#this-week">This Week</a>
                                    <a href="#last-week">Last Week</a>
                                    <a href="#last-week">Last Two Weeks</a>
                                    <a href="#this-month">This Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="grid-child pdf">
                            <button class="pdf-button">PDF <i class="fa-regular fa-file-pdf"></i></button>
                        </div>
                    </div>
                    <div class="transaction-table-content">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>3</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>1</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
                                </tr>
                                <tr>
                                    <td>20/11/2023</td>
                                    <td>2</td>
                                    <td>Gu Mor Kak</td>
                                    <td>2</td>
                                    <td>RM17.80</td>
                                    <td><button class="delete-button"><ion-icon name="trash-outline"></ion-icon></button></td>
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

    <script>
        function dropdownFunction() {
            document.getElementById("dropdownContent").classList.toggle("show");
        }
    </script>
</body>

</html>