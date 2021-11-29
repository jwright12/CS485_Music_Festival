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
    
            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>