<?php

if(isset($_POST['buyTicket'])) 
{
  $checkbox = isset($_POST['checkBuy']) ? $_POST['checkBuy'] : array();
  $id = 0;
  for($i=0;$i<count($checkbox);$i++)
  {
    $id = $checkbox[$i];
    $deleteQuery = "update ticket set quant = quant-1 where ticket_id ='$id'";
    $DeleteQueryExec = mysqli_query($conn, $deleteQuery);
  }

  echo '<script>alert("Thank you for purchasing");
  window.location = "http://localhost/index.php";
  </script>';



}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Ultimate Music Festival Manager - Pro Version</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #333;}</style>
        <link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">

                <h1>Ticket Purchasing</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

                <script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                </script>

                <?php
                    if(isset($_POST['f_id']) && isset($_POST['id'])) {
                        include '../db-connect.php';
                        $fid = $_POST['f_id'];
                        $id = $_POST['id'];

                        // Display ticket information of the festival 
                        $query = $pdo->prepare("SELECT festival.festival_name,
                                                festival.festival_id,
                                                festival.festival_date,
                                                location,
                                                ticket.ticket_id,
                                                ticket.price,
                                                ticket.quant
                                                FROM festival
                                                join ticket
                                                on festival.festival_id = ticket.festival_id
                                                WHERE festival.festival_id = $fid");
                        $query->execute();
                        $array = $query->fetch();
                        $f_name = $array[0];
                        $price = $array[5];
                        $q = $array[6];
                        echo "$f_name $price $q";
                    }
                ?>

                Need a form to calculate the order details, insert to customer purchases, update ticket quant
            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>