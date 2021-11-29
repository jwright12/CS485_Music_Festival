<?php
    $id = $_POST['id'];

	if(count($_POST)>1) {
		include '../db-connect.php';
        
        $message;
        
		$set = $_POST['set_list'];
		$song = $_POST['song_id'];
		
		$query = $pdo->prepare("INSERT INTO set_list (set_list_id, song_id) values ('$set', '$song')");
		$query->execute();
		
		$message = "Successfully added song ID $song to set list ID $set";
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
    </head>

    <body>
        <div class="container">
            <div class="hero-unit">

                <h1>Assign Songs To A Set List</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

					<div class="mb-3">
							<label for="set_list" class="form-label"><b>Set List ID</b></label>
							<input type="text" class="form-control" name="set_list">
					</div>
					<div class="mb-3">
							<label for="song_id" class="form-label"><b>Song ID</b></label>
							<input type="text" class="form-control" name="song_id">
					</div>
				
					<button type="submit" class="btn btn-primary">Add To Set List</button>
				</form>

                <form action="artist.php?id=<?php echo $_GET['id'];?>" method="post">
                    <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
					<button type="submit" class="btn btn-primary">Back to Overview</button>
				</form>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>