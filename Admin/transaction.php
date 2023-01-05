<?php
session_start();

global $conn;

include "dbConnection.php"

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <link rel="stylesheet" type="text/css" href="css/transaction.css">
    <script src="https://kit.fontawesome.com/4fdfa3530e.js" crossorigin="anonymous"></script>
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
                    <a href="events.php">
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

            <div class="table-box">
                <div class="transaction-table">
                    <div class="transaction-table-header">
                        <h2>Transaction History</h2>
                    </div>
                    <div class="filter-dropdown">
                        <button onclick="dropdownFunction()" class="dropbtn"><i class="fa-solid fa-filter"></i> Filter By</button>
                        <div id="dropdownContent" class="dropdown-content">
                            <a href="?latest=1">Latest</a>
                            <a href="?today=1">Today</a>
                            <a href="?this-week=1">This Week</a>
                            <a href="?this-month=1">This Month</a>
                        </div>
                    </div>
                    <div class="transaction-table-content">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Amount (RM)</th>
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
                            <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Invoice No</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Amount (RM)</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    
    <script>
        // MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function () {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }

        function dropdownFunction() {
            document.getElementById("dropdownContent").classList.toggle("show");
        }
    </script>
</body>

</html>
