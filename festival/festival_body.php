<?php
	if(isset($_GET['id'])){

		$id = $_GET['id'];
		printf("
			<h2>Artists - Manage Your Bands, Music, and Set Lists Below. </h2>
			<form method=\"post\" action=\"../artist/artist.php?id=$id\">
				<input type=\"hidden\" name=\"id\" value=$id/> 
				<button type=\"submit\" class=\"btn btn-primary\">Artists</button>
			</form>

			<br>
		");

		include 'db-connect.php';
		$query = $pdo->prepare("SELECT user.f_name FROM user WHERE user.user_id=$id");
		$query->execute();

		$array = $query->fetch();
		$name = $array[0];

		printf("
			<h2>%s - Shop Upcoming Festivals </h2>
			
			<br>
		",$name);
		
	} else {
		printf("
			<h2>Register or Login</h2>
	
			<form method=\"get\">
				<button type=\"submit\" formaction=\"../login.php\" class=\"btn btn-primary\">Login</button>
				<button type=\"submit\" formaction=\"../register.php\" class=\"btn btn-primary\">Sign Up</button>
			</form>

			<br>

			<h1>Upcoming Festivals</h1>

			<br>
		");
	}
?>
<?php
	include 'db-connect.php';
	$query = $pdo->prepare('SELECT user.f_name FROM user');
	$query->execute();
	while($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
		if(isset($_GET['id'])){
			printf("
				<div>
					<a><h2>%s</h2></a>
					<form method=\"get\">
						<button type=\"submit\" formaction=\"./festival/customer.php\" class=\"btn btn-primary\">Buy Tickets</button>
					</form>
				</div>",$row[0]
			);
		} else {
			printf("<h2>%s</h2>",$row[0]);
		}
	}
?>
       