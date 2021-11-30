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
			<h2>Create An Account To View Festival Details</h2>
	
			<form method=\"get\">
				<button type=\"submit\" formaction=\"../login.php\" class=\"btn btn-primary\">Login</button>
				<button type=\"submit\" formaction=\"../register.php\" class=\"btn btn-primary\">Sign Up</button>
			</form>
		");
	}
?>
<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		include 'db-connect.php';
		$query = $pdo->prepare("SELECT festival_name, festival_date, location, festival_id FROM festival");
		$query->execute();

		echo "<table width='98%' border='1'name='table';>
		<tr>
		<th>Event</th>
		<th>Date and Time</th>
		<th>Location</th>
		</tr>";

		while($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
			printf("
					<tr>
					<td><a href=\"http://cs485.localhost/festival/festival_details.php?id=$id&f_id=$row[3]\">%s</a></td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<form action=\"festival/buyticket.php?f_id=$row[3]&id=$id\" method=\"post\">
							<input type=\"hidden\" name=\"id\" value=$id> 
							<input type=\"hidden\" name=\"f_id\" value=$row[3]> 
							<button type=\"submit\" class=\"btn btn-primary\">Buy Tickets</button>
						</form>
					</td>
					</tr>
			", $row[0], $row[1], $row[2]);
		} 
	}
?>
       