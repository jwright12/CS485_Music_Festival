<?php
	if(count($_POST)>0) {
		include '../db-connect.php';

		$u = $_POST['username'];
		$p = $_POST['password'];

		$query = $pdo->prepare("SELECT user.user_id, user.username, user.user_password 
		FROM user 
        JOIN administrator on user.user_id = administrator.admin_id
		WHERE user.username='$u' AND user.user_password='$p'");
		$query->execute();
		$row_count = $query->rowCount();

		if($row_count >= 1){
			$array = $query->fetch();
			$id = $array[0];

			header("Location: http://cs485.localhost/admin/admin.php?id=$id");
			
		} else {
			$message = "Invalid username or password.";
		}
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
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">

                <?php if(isset($message)){echo $message;}?>
                <?php include 'admin_body.php';?>

                <?php

if(isset($_GET['id'])){

$id = $_GET['id'];
include '../db-connect.php';
$query = $pdo->prepare("SELECT festival.festival_name,festival.festival_id, festival.festival_date, location, ticket.quant as 'seat left'
                        FROM festival
                        join ticket
                        on festival.festival_id = ticket.festival_id");
$query->execute();


echo "<table width='98%' border='1'name='table';>
<tr>
<th>Event</th>
<th>Date and Time</th>
<th>Location</th>
<th>Seat Left</th>
</tr>";

while($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
    printf("
            <tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
            <td>
                <form action=\"festival/buyticket.php?f_id=$row[3]&id=$id\" method=\"post\">
                    <input type=\"hidden\" name=\"id\" value=$id> 
                    <input type=\"hidden\" name=\"f_id\" value=$row[1]> 
                    <button type=\"submit\" name=\"ticketbuying\" class=\"btn btn-primary\">Edit</button>
                </form>
            </td>
            </tr>
    ", $row[0], $row[2], $row[3], $row[4]);
}
}
?>

                <form action="../index.php" method="post">
                    <button type="submit" class="btn btn-primary">Home</button>
                </form>

        </div>
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
