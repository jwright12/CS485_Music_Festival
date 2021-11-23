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
                <form action="transaction.php" method="post">
                    <div class="mb-3">
                        <label for="warehouseID" class="form-label"><b>Warehouse ID</b></label>
                        <input type="number" class="form-control" name="warehouseID">
                    </div>
                    <div class="mb-3">
                        <label for="districtID" class="form-label"><b>District ID</b></label>
                        <input type="number" class="form-control" name="districtID">
                    </div>
                    <div class="mb-3">
                        <label for="customerID" class="form-label"><b>Customer ID</b></label>
                        <input type="number" class="form-control" name="customerID">
                    </div>
                    <div class="mb-3">
                        <label for="order_Count" class="form-label"><b># of Items</b></label>
                        <input type="number" class="form-control" name="order_Count">
                    </div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">OL_I_ID</th>
                            <th scope="col">OL_SUPPLY_W_ID</th>
                            <th scope="col">OL_QUANTITY</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_1"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_1"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_1"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_2"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_2"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_2"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_3"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_3"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_3"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_4"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_4"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_4"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_5"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_5"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_5"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_6"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_6"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_6"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_7"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_7"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_7"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_8"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_8"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_8"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_9"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_9"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_9"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_10"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_10"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_10"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_11"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_11"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_11"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_12"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_12"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_12"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_13"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_13"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_13"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_14"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_14"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_14"></td>
                            </tr>
                            <tr>
                            <td><input type="number" class="form-control" name="OL_I_ID_15"></th>
                            <td><input type="number" class="form-control" name="OL_SUPPLY_W_ID_15"></td>
                            <td><input type="number" class="form-control" name="OL_QUANTITY_15"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" name="submit_button">Start Transaction</button>
                </form>
                
            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
