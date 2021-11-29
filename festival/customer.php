
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
<div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

        <div class="container">
            <div class="hero-unit">

                <h1>Upcoming Event</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

<?php

$con=mysqli_connect("localhost","root","","music_festival");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT festival_name as 'Festival Name',
    date as 'Date',
    location as 'Location'
    FROM festival;");

echo "<table width='98%' border='1'name='table';>
<tr>
<th>Event</th>
<th>Date and Time</th>
<th>Location</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['Festival Name'] . "</td>";
echo "<td>" . $row['Date'] . "</td>";
echo "<td>" . $row['Location'] . "</td>";

echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>

</div>
				
					<button name="gotobuyticket" type="submit" class="btn btn-primary">Buy Tickets</button>


                </form>
<?php
if(isset($_POST['gotobuyticket'])) 
{

  echo '<script>
  window.location = "http://localhost/buyticket.php";
  </script>';



}
?>
            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>