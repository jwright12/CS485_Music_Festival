<?php
    $id = $_POST['id'];

	if(count($_POST)>1) {
		include '../db-connect.php';
        
        $message;
        
		$song = $_POST['song_name'];
		$alb = $_POST['album_name'];
		$bid = $_POST['band_id'];
		
		$query = $pdo->prepare("INSERT INTO songs (song_id, song_name, album_name, band_id) values (null, '$song', '$alb', '$bid')");
		$query->execute();
		
		$message = "$song uploaded successfully for bandID: $bid";
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

                <h1>Upload Your Bands Music</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>
				<form action="" method="post">

					<div class="mb-3">
							<label for="song_name" class="form-label"><b>Song Name</b></label>
							<input type="text" class="form-control" name="song_name">
					</div>
					<div class="mb-3">
							<label for="album_name" class="form-label"><b>Album Name</b></label>
							<input type="text" class="form-control" name="album_name">
					</div>
					<div class="mb-3">
							<label for="band_id" class="form-label"><b>Band ID</b></label>
							<input type="number" class="form-control" name="band_id">
					</div>
				
					<button type="submit" class="btn btn-primary">Upload</button>
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