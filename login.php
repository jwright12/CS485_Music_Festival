<?php
	if(count($_POST)>0) {
		include 'db-connect.php';

		$u = $_POST['username'];
		$p = $_POST['password'];

		$query = $pdo->prepare("SELECT user.user_id, user.username, user.user_password 
		FROM user 
		join customer
		on user.user_id = customer.customer_id
		WHERE user.username='$u' AND user.user_password='$p'");
		$query->execute();
		$row_count = $query->rowCount();

		$query2 = $pdo->prepare("SELECT user.user_id, user.username, user.user_password 
		FROM user 
		join artist
		on user.user_id = artist.artist_id
		WHERE user.username='$u' AND user.user_password='$p'");
		$query2->execute();
		$row_count2 = $query2->rowCount();

		$query3 = $pdo->prepare("SELECT user.user_id, user.username, user.user_password 
		FROM user 
		join administrator
		on user.user_id = administrator.admin_id
		WHERE user.username='$u' AND user.user_password='$p'");
		$query3->execute();
		$row_count3 = $query3->rowCount();

		if($row_count == 1){
			$array = $query->fetch();
			$id = $array[0];

			header("Location: http://cs485.localhost/festival/customer.php?id=$id");
			
		}elseif ($row_count2 == 1){
			$array = $query->fetch();
			$id = $array[0];

			header("Location: http://cs485.localhost/artist/artist.php?id=$id");
		}elseif ($row_count3 == 1){
			$array = $query->fetch();
			$id = $array[0];

			header("Location: http://cs485.localhost/admin/admin.php?id=$id");
		}else {
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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <style>body {margin-top: 40px; background-color: #333;}</style>
        <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">

                <h1>Login to Your Account</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

					<div class="mb-3">
							<label for="username" class="form-label"><b>Username</b></label>
							<input type="text" class="form-control" name="username">
					</div>
					<div class="mb-3">
							<label for="password" class="form-label"><b>Password</b></label>
							<input type="password" class="form-control" name="password">
					</div>
				
					<button type="submit" class="btn btn-primary">Login</button>
				</form>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>
