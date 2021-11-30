
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
                
				<?php 
                if(isset($message)) { echo $message; } ?>
				<br>
				<form action="buyticket.php" method="post">

                <script>
                    if ( window.history.replaceState ) {
                        window.history.replaceState( null, null, window.location.href );
                    }
                </script>

                <?php
                include '../db-connect.php';
                    if(isset($_POST['f_id']) && isset($_POST['id'])) {
                        include '../db-connect.php';
                        $fid = $_POST['f_id'];
                        $id = $_POST['id'];

                        // Display ticket information of the festival 
                        $query = $pdo->prepare("SELECT festival.festival_name,
                                                festival.festival_id,
                                                festival.festival_date,
                                                location,
                                                ticket.ticket_id as 'Ticket id',
                                                ticket.price,
                                                ticket.quant
                                                FROM festival
                                                join ticket
                                                on festival.festival_id = ticket.festival_id
                                                WHERE festival.festival_id = $fid");

                        $query->execute();
                        $array = $query->fetch();
                        $row = $query->fetch();
                        $f_name = $array[0];
                        $tid = $array[1];
                        $date = $array[2];
                        $locate = $array[3];
                        $ticid = $array[4];
                        $price = $array[5];
                        $q = $array[6];

                       // echo "$f_name $price $q";
                       echo "<table width='98%' border='1'name='table';>
                       <tr>
                           <th>Festival</th>		
                           <th>Location</th>
                           <th>Date</th>
                           <th>Price</th>
                           <th>Seat left</th>
                       </tr>
                       <tr>
                       <td>$f_name</td>
                           <td>$locate</td>
                           <td>$date</td>     
                           <td>$price</td>
                           <td>$q</td>
                       </tr>";
                       $query2 = $pdo->prepare("update ticket set ticket.quant = ticket.quant-1 where ticket.ticket_id ='$ticid'");
                       $query2->execute();
    
             
                    }

?>
					    <button name="buyit" type="submit" class="btn btn-primary">Buy Tickets</button>
                        </form>


                <?php
 

                if(isset($_POST['buyit'])) 
                    {

                echo '<script>alert("Thank you for purchasing");
                window.location = "http://localhost/index.php";
                </script>';
        
                }
 
 
 ?>

            </div> <!-- hero-unit -->
        </div> <!-- container -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
