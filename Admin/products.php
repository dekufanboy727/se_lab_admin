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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/products.css">
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

        $notice = "";
        //Product Deletion
        if($_SERVER["REQUEST_METHOD"] == "GET")
        {
            if(isset($_GET['product']) == true){
                $deleteid = $_GET['product'];
                $sql3 = "DELETE FROM product WHERE product_id = '$deleteid'";
                $result = mysqli_query($conn,$sql3);
                if($result === true)
                    $notice = "A product is deleted!";
                    header("Location: products.php");
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
                <li class="hovered active">
                    <a href="products.php">
                        <span class="icon">
                            <ion-icon name="fast-food-outline"></ion-icon>
                        </span>
                        <span class="title">Products</span>
                    </a>
                </li>
                <li>
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
                <div class="products-table">
                    <div class="products-table-header">
                        <h2>Products</h2>
                    </div>
                    <table>
                        <tr>
                            <th class="search-container">
                                <label>
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <input type="text" id="myInput" onkeyup="mySearchFunction()" placeholder="Search Here.." name="products-search-bar" title="Type in a product">
                                </label>
                            </th>
                            <th class="manage-product-button">
                                <a href="add_product.php" class="button">Add <i class="fa-solid fa-plus"></i></a>
                            </th>
                        </tr>
                    </table>

                    <div class="products-table-content">
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price (RM)</th>
                                    <th>Quantity</th>
                                    <th>Calorie (kcal)</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <?php
                                //Output delete successfully
                                echo '<p align=center style="font-size:20px;font-family: Monaco;">';
                                echo $notice;
                                echo '</p>';

                                //Tabulating Products
                                $sql = mysqli_query($conn, "select * from product");
                            ?>
                            <tbody>
                            <?php
                                if (mysqli_num_rows($sql) > 0) {
                                    while ($row = mysqli_fetch_assoc($sql)) {
                                        $sql1 = mysqli_query($conn, "select * from product_type where id ='".$row['product_type']."';");
                                        $row1 = mysqli_fetch_assoc($sql1)
                            ?>
                                        <tr>
                                            <td><?php echo '<img src="'.$row["product_img"].'" height ="100" width = "100">' ?></td>
                                            <td><?php echo $row1['type_name']?></td>
                                            <td id = "product_name"><?php echo $row['product_name'] ?></td>
                                            <td><?php echo $row['product_desc'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['product_quan'] ?></td>
                                            <td><?php echo $row['product_cal'] ?></td>
                                            <?php 
                                                echo '<td><a href="edit_product.php?product='.$row['product_id'].'"><ion-icon name="create"></a></td>';
                                                echo '<td><a href="javascript: myDeleteConfirmationFunction('.$row['product_id'].')"  alt = "delete" class="delete-button"><ion-icon name="trash-outline"></ion-icon></a></td>';
                                            ?>
                                        </tr>
                                <?php      }
                                } ?>
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

        function mySearchFunction() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
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

        function myDeleteConfirmationFunction(uid) {
            if (confirm('Are You Sure to Delete this Record?'))
            {
                window.location.href = 'products.php?product=' + uid;
            }
        }
    </script>
</body>

</html>
