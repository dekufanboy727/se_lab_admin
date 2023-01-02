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
        <link rel="stylesheet" href="css/receipt_style.css">
        <link href="https://fonts.googleapis.com/css2?family=Marhey:wght@300;400&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Helf Coffee Official Website</title>
    </head>
    <body>
        <div class="logo">
            <a href="index.php"><img src="images/helf_coffee_logo.png" alt="Helf Coffee Logo" style="width: 250px" href="index.php"></a>
        </div>
        <div class="container">
            <h2>Customer Receipt</h2>
        </div>
            <div class="details">
                <div class="delivery">
            <span>Delivery Date Time:</span>
                </div>  
                <div class ="order_num">
                <?php   
                    $sql = "SELECT * FROM orders";
                    $result = $conn->query($sql);
                    while($data = mysqli_fetch_array($result)) 
                    {
                        $receipt = $data['order_id'];
                    }    

                ?>
            <span>Order Number: #00<?php echo $receipt?></span>
                           
                </div>
            </div>
        <table>
            <thead>
                <tr>
                    <th colspan="2">Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
			</thead>
			<tbody>
            <?php

                $sql= "SELECT * FROM cart_temp";
                $result = $conn->query($sql);
                $sub_order = 0;
                $fee = 8;
                $total_order = 0;

                while($data = mysqli_fetch_array($result)) 
                {
                    $product_id = $data['product_id'];

                    $sub_order = $sub_order + $data['total_price'];

                    ?>
                    <tr>            
                    <td><?php echo $data['product_name']; ?></td>
                    <td>RM<?php echo number_format($data['price'], 2);?></td>
                    <td><?php echo $data['quantity']; ?></td>
                    <td>RM<?php echo number_format($data['total_price'], 2);?></td>
                    </tr>

                    <?php
                    
                    $total_order = $sub_order + $fee;
                }

                ?>			
				<tr>
                    <td colspan="4" style="text-align: right;">Subtotal</td>
                    <td>
                        RM<?php echo number_format($sub_order, 2);?>
                    </td>
                </tr> 
                <tr>
                    <td colspan="4" style="text-align: right;">Delivery Fee</td>
                    <td>
                        RM<?php echo number_format($fee, 2);?>
                    </td>
                </tr> 
                <tr>
                    <td colspan="4" style="text-align: right;">Total</td>
                    <td>
                        RM<?php echo number_format($total_order, 2);?>
                    </td>
                </tr> 
                
			</tbody>
		</table>
        
        <div class="container">
            <button class="confirm" type="submit">Confirm</button>
        </div>
    </body>
</html>
