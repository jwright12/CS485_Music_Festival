
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Ultimate Music Festival Manager - Pro Version</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #333;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    </head>

    <body>
<div>



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
$servername = "localhost";
$username = "root";
$password = "88888888";
$dbname = "music_festival";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$con=mysqli_connect("localhost","root","88888888","music_festival");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT festival.festival_name as 'Festival Name',
festival.festival_id,
festival.festival_date as 'Date',
location as 'Location',
ticket.ticket_id as ticket,
ticket.price as Price,
ticket.quant as 'Seat Available'
FROM festival
join ticket
on festival.festival_id = ticket.festival_id;");

echo "<table width='98%' border='1'name='table';>
<tr>
<th> </th>
<th>Event</th>
<th>Date and Time</th>
<th>Location</th>
<th>Price</th>
<th>Seat Available</th>
</tr>";
$b2 = 0;
while($row = mysqli_fetch_array($result))
{
   // echo "tID: ". $row["ticket"]." <br>";
    $a1 =$row["Price"];
    $b2 + $a1;
$html ='<tr>
<td style="text-align:center;"> 
<input name="checkBuy[]" type="checkbox" value="'. $row['ticket']. '" >
<center>
</td>
<td>' . $row['Festival Name'] . '</td>
<td>' . $row['Date'] . '</td>
<td>' . $row['Location'] . '</td>
<td>' . $row['Price'] . '</td>
<td>' . $row['Seat Available'].' </td>

</tr>';
echo $html;

//echo $a1;
//echo $b2;
}
echo "</table>";
mysqli_close($con);

?>
</div>
				
					<button type="submit" name="buyTicket" class=" btn btn-primary">Buy Tickets</button>
				</form>

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


            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>