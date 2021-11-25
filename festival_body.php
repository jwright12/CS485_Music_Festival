<?php
	if(isset($_GET['id'])){
		printf("
			<h2>Register & Manage Your Band</h2>
			<form method=\"get\">
				<button type=\"submit\" formaction=\"artist.php\" class=\"btn btn-primary\">Go To Band Page</button>
			</form>

			<br>

			<h1>See Festival Details</h1>
	
			<br>
		");
	} else {
		printf("
			<h2>Register or Login</h2>
	
			<form method=\"get\">
				<button type=\"submit\" formaction=\"login.php\" class=\"btn btn-primary\">Login</button>
				<button type=\"submit\" formaction=\"register.php\" class=\"btn btn-primary\">Sign Up</button>
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
						<button type=\"submit\" formaction=\"login.php\" class=\"btn btn-primary\">Buy Tickets</button>
					</form>
				</div>",$row[0]
			);
		} else {
			printf("<h2>%s</h2>",$row[0]);
		}
	}
?>
       