<?php
    include 'db-connect.php';
    /*
        1). Start a timer
        2). Query the warehouse table using W_ID from user to get the W_TAX
        3). Query district table using W_ID and D_ID from user to get D_TAX and D_NEXT_O_ID. Increment D_NEXT_O_ID by one
        4). Query customer table using W_ID, D_ID, and C_ID from user and get records
        5). Insert into NEW ORDER and ORDER table

        For each item in the order line:
        1). Get some data from the item table
        2). Use W_ID, D_ID to get data from stock table
        3). Might need to updae the stock quantity
        4). Calculate some information and insert to ORDER LINE table

        Need to output data based on if the transaction commited or roll back

    */
    $q = $pdo->query('SELECT * FROM warehouse');
    echo "OK";

    
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>TPCC Benchmark on AWS Elastic Beanstalk and RDS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #333;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">
                <table class="table table-bordered table-dark" name="order_header">
                    <thead>
                        <tr>
                        <th scope="col">Order Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>W_ID</th>
                        <td colspan="2">D_ID</td>
                        <td colspan="2">Date</td>
                        </tr>
                        <tr>
                        <td>C_ID</th>
                        <td colspan="2">C_Last_Name</td>
                        <td>C_Credit</td>
                        <td>C_Discount</td>
                        </tr>
                        <tr>
                        <td>O_ID</th>
                        <td colspan="2">O_Count</td>
                        <td>W_Tax</td>
                        <td>D_Tax</td>
                        </tr>
                    </tbody>
                </table>

                <br>

                <table class="table table-bordered table-dark" name="line_summary">
                    <thead>
                        <tr>
                        <th scope="col">Supp_W_ID</th>
                        <th scope="col">I_ID</th>
                        <th scope="col">I_Name</th>
                        <th scope="col">I_Quant</th>
                        <th scope="col">I_Stock</th>
                        <th scope="col">I_Brand</th>
                        <th scope="col">I_Price</th>
                        <th scope="col">I_Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>W_ID</td>
                        <td>I_ID</td>
                        <td>I_Name</td>
                        <td>Qt</td>
                        <td>Stock</td>
                        <td>B/G</td>
                        <td>Price</td>
                        <td>Amount</td>
                        </tr>
                        <tr>
                        <td colspan="3" name="Status">Order status: Success</th>
                        <td colspan="3"></th>
                        <td colspan="2">Order Total: $2,000.00</th>
                        </tr>
                        <tr>
                        <td colspan="4"></th>
                        <td colspan="4" name="Processing_Time">100</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>