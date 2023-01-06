<?php
session_start();

global $conn;

include "dbConnection.php"

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="icon" type="image/jpg" href="images/profile.jpg">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <?php //Session Control
    if (empty($_SESSION['logged_in']) == true) {
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
                <li class="hovered active">
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
                <li>
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

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="images/profile.jpg">
                </div>
            </div>

            <!-- cards -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php

                            $sql = "SELECT COUNT(order_id) as total FROM orders";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo $row['total'];
                                }
                            } else {
                                echo "0";
                            }

                            ?>
                        </div>
                        <div class="cardName">Orders</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php

                            $sql = "SELECT COUNT(product_id) as total FROM product";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo $row['total'];
                                }
                            } else {
                                echo "0";
                            }

                            ?>
                        </div>
                        <div class="cardName">Products</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="fast-food-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php

                            $sql = "SELECT COUNT(id) as total from customer";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo $row["total"];
                                }
                            } else {
                                echo "0";
                            }

                            ?>
                        </div>
                        <div class="cardName">Customers</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">
                            <?php

                            $sql = "SELECT SUM(order_amount) as amount FROM orders";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "RM" . $row['amount'];
                                }
                            } else {
                                echo "0";
                            }

                            ?>
                        </div>
                        <div class="cardName">Earning</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="logo-usd"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- Add Charts -->
            <div class="graphBox">
                <div class="box">
                    <canvas id="myChart" width="auto" height="auto"></canvas>
                </div>
                <div class="box">
                    <canvas id="orders" width="auto" height="auto"></canvas>
                </div>
            </div>

            <div class="details">
                <!-- order details list -->
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Recent Orders</h2>
                        <a href="orders.php" class="btn">View All</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Order products</td>
                                <td>Quantity</td>
                                <td>Order ID</td>
                                <td>Date</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql3 = "SELECT orders.order_id, orders.Status, orders.order_date, order_product.quantity, product.product_name FROM orders JOIN order_product ON orders.order_id = order_product.order_id JOIN product ON order_product.product_id = product.product_id ORDER BY orders.order_date DESC LIMIT 5";
                            $result3 = $conn->query($sql3);

                            if ($result3->num_rows > 0) {
                                while ($row3 = $result3->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row3['product_name'] . "</td>";
                                    echo "<td>" . $row3['quantity'] . "</td>";
                                    echo "<td>" . $row3['order_id'] . "</td>";
                                    echo "<td>" . $row3['order_date'] . "</td>";
                                    if ($row3['Status'] == "preparing") {
                                        echo "<td><span class='status preparing'>Preparing</span></td>";
                                    } else if ($row3['Status'] == "done") {
                                        echo "<td><span class='status done'>Done</span></td>";
                                    } else if ($row3['Status'] == "cancel") {
                                        echo "<td><span class='status cancel'>Cancel</span></td>";
                                    }

                                    echo "<tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- New Customer -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>
                    <table>
                        <?php

                        $sql4 = "SELECT * FROM `customer` ORDER BY id DESC LIMIT 4";
                        $result4 = $conn->query($sql4);

                        if ($result4->num_rows > 0) {
                            while ($row4 = $result4->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td width='60px'>";
                                echo "<div class='imgBx'><img src='images/user.png'></div>";
                                echo "</td>";
                                echo "<td>";
                                echo "<h4>" . $row4['name'] . "<br><span>" . $row4['credit_score'] . "</span></h4>";

                                echo "<tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // MenuToggle
        let toggle = document.querySelector('.toggle');
        let navigation = document.querySelector('.navigation');
        let main = document.querySelector('.main');

        toggle.onclick = function() {
            navigation.classList.toggle('active');
            main.classList.toggle('active');
        }
    </script>

    <?php

    $sql = "SELECT category.name, COUNT(order_product.order_id) as num FROM `category` JOIN `category_product` ON category.category_id=category_product.category_id JOIN `order_product` on category_product.product_id=order_product.product_id GROUP BY name ORDER BY category.category_id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $category[] = $row["name"];
            $amount[] = $row["num"];
        }
    } else {
        echo "0";
    }

    $sql2 = "SELECT COUNT(`order_id`) AS num, MONTHNAME(`order_date`) AS mon FROM `orders` GROUP BY DATE_FORMAT(`order_date`, '%m-%Y') ORDER BY YEAR(`order_date`) ASC";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row2 = $result2->fetch_assoc()) {
            $num[] = $row2["num"];
            $month[] = $row2["mon"];
        }
    } else {
        echo "0";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const orders = document.getElementById('orders');

        new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: <?php echo json_encode($category) ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode($amount) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                    ]
                }]
            },
            options: {
                responsive: true,
            }
        });

        new Chart(orders, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($month) ?>,
                datasets: [{
                    label: 'Orders',
                    data: <?php echo json_encode($num) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                }]
            },
            options: {
                responsive: true,
            }
        });
    </script>
</body>

</html>