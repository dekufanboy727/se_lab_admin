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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/transaction.css">
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <script src="https://kit.fontawesome.com/4fdfa3530e.js" crossorigin="anonymous"></script>
    <script src="js/transaction.js"></script>
</head>

<body>
    <?php 
        date_default_timezone_set("Asia/Kuching");

        //Session Control
        if (empty($_SESSION['logged_in']) == true)
        {
            echo "You are not Logged in";
            header("Location: adminlogout.php");
        }


        if ($_SERVER["REQUEST_METHOD"] == "GET"){
            if(isset($_GET["latest"])){
                $sql = mysqli_query($conn, "select * from transaction");
            }else if(isset($_GET["today"])){
                $date1 = date('d');
                $date2 = date('m');
                $date3 = date('Y');

                $sql = mysqli_query($conn, "select * from transaction inner join orders on transaction.order_id = orders.order_id 
                where DAY(order_date) = '$date1' AND MONTH(order_date) = '$date2' AND YEAR(order_Date) = '$date3'");

            }else if(isset($_GET["this-week"])){
                $date1 = date( 'W');
                $date2 = date( 'Y');
                $sql = mysqli_query($conn, "select * from transaction inner join orders on transaction.order_id = orders.order_id 
                where WEEK(order_date) = '$date1' AND YEAR(order_date) = '$date2'");

            }else if(isset($_GET["this-month"])){
                $date2 = date('m');
                $date3 = date('Y');

                $sql = mysqli_query($conn, "select * from transaction inner join orders on transaction.order_id = orders.order_id 
                where MONTH(order_date) = '$date2' AND YEAR(order_Date) = '$date3'");
            }
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
                    <a href="events.html">
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
                            <label>
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Search Here..">
                            </label>
                        </div>
                        <div class="grid-child filter">
                            <div class="filter-dropdown">
                                <button onclick="dropdownFunction()" class="dropbtn">Filter By <i class="fa-solid fa-filter"></i></button>
                                <div id="dropdownContent" class="dropdown-content">
                                    <a href="?latest=1">Latest</a>
                                    <a href="?today=1">Today</a>
                                    <a href="?this-week=1">This Week</a>
                                    <a href="?this-month=1">This Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="grid-child pdf">
                            <button class="pdf-button">PDF <i class="fa-regular fa-file-pdf"></i></button>
                        </div>
                    </div>
                    <div class="transaction-table-content">
                        <table class="transaction-table-data" id="transactionTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice No <i onclick="sortByInt(1)" class="fa-solid fa-sort"></i></th>
                                    <th>Item <i onclick="sortByAlphabet(2)" class="fa-solid fa-sort"></i></th>
                                    <th>Quantity <i onclick="sortByInt(3)" class="fa-solid fa-sort"></i></th>
                                    <th>Amount (RM) <i onclick="sortByFloat(4)" class="fa-solid fa-sort"></i></th>
                                </tr>
                            </thead>

                            <tbody>
                            <?php
                                $i = 1;
                                if(isset($sql))
                                {
                                    if (mysqli_num_rows($sql) > 0) {
                                        while ($row = mysqli_fetch_assoc($sql)) {
    
                                            $sql1 = mysqli_query($conn, "select * from orders where order_id = '".$row['order_id']."';");
                                            $row1 = mysqli_fetch_assoc($sql1);
                                            $sql2 = mysqli_query($conn, "select * from order_product where order_id = '".$row['order_id']."';");
                                        ?>
                                        <tr>
                                            <td><?php echo $row1['order_date'] ?></td>
                                            <td><?php echo $row['trans_id']?></td>
                                            <td>
                                                <?php
                                                while ($row2 = mysqli_fetch_assoc($sql2)) {
                                                    $sql3 = mysqli_query($conn, "select * from product where product_id ='" . $row2['product_id'] . "';");
                                                    $row3 = mysqli_fetch_assoc($sql3);
                                                    echo $row3['product_name'];
                                                    echo ";";
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                $sql2 = mysqli_query($conn, "select * from order_product where order_id = '".$row['order_id']."';");
                                                while ($row4 = mysqli_fetch_assoc($sql2)) {
                                                    echo $row4['quantity'];
                                                    echo ";";
                                                } ?> 
                                            </td>
                                            <td><?php echo $row1['order_amount'] ?></td>
                                        </tr>
                                <?php      }
                                    }else{
                                        echo "<tr><h3> No Results Found </h3></tr>";
                                    }
                                }  ?>
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
        //Add event listener to search box
        searchBar.addEventListener('keyup', performSearch);

        function dropdownFunction() {
            document.getElementById("dropdownContent").classList.toggle("show");
        }

        function mySearchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("transactionTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
        }
    </script>
</body>

</html>
