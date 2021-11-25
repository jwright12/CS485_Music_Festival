<?php
	if(count($_POST)>0) {
		include 'db-connect.php';
		$pdo->beginTransaction();

		$f = $_POST['first_name'];
		$l = $_POST['last_name'];
		$u = $_POST['username'];
		$p = $_POST['password'];
		$em = $_POST['email'];
		$ph = $_POST['number'];

		$query = $pdo->prepare("INSERT INTO user (user_id, f_name, l_name, username, user_password) values (null, '$f', '$l', '$u', '$p')");
		$query->execute();
		// Could be a problem. Make just use username as unique identifier
		// Should probably also insert U ID into customer table
		$query = $pdo->prepare("SELECT user.user_id FROM user WHERE user.f_name='$f' AND user.l_name='$l'");
		$query->execute();
		$array = $query->fetch();
		$id = $array[0];
		
		$query = $pdo->prepare("INSERT INTO user_email (user_id, email) values ('$id', '$em')");
		$query->execute();

		$query = $pdo->prepare("INSERT INTO user_phone (user_id, phone) values ('$id', '$ph')");
		$query->execute();

		$pdo->commit();

		header("Location: http://cs485.localhost/index.php?id='$id'");
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

                <h1>Register to Buy Tickets</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

					<div class="mb-3">
							<label for="first_name" class="form-label"><b>First Name</b></label>
							<input type="text" class="form-control" name="first_name">
					</div>
					<div class="mb-3">
							<label for="last_name" class="form-label"><b>Last Name</b></label>
							<input type="text" class="form-control" name="last_name">
					</div>
					<div class="mb-3">
							<label for="email" class="form-label"><b>Email</b></label>
							<input type="email" class="form-control" name="email">
					</div>
					<div class="mb-3">
							<label for="username" class="form-label"><b>Username</b></label>
							<input type="text" class="form-control" name="username">
					</div>
					<div class="mb-3">
							<label for="password" class="form-label"><b>Password</b></label>
							<input type="password" class="form-control" name="password">
					</div>
					<div class="mb-3">
							<label for="number" class="form-label"><b>Phone Number</b></label>
							<input type="text" class="form-control" name="number">
					</div>

					<button type="submit" class="btn btn-primary">Register</button>
				</form>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>