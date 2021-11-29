<?php
    include '../db-connect.php';
    $id = $_POST['id'];
    $message;

    if(isset($_POST['band_name'])){
        $bn = $_POST['band_name'];

        $query = $pdo->prepare("SELECT * FROM artist WHERE artist.artist_id = $id");
        $query->execute();
        $row_count = $query->rowCount();

        // If new artist, insert to artist
        if($row_count==0){
            $query = $pdo->prepare("INSERT INTO artist (artist_id) values ($id)");
            $query->execute();
        }

        $query = $pdo->prepare("INSERT INTO band (band_id, band_name) values (null, '$bn')");
        $query->execute();

        $query = $pdo->prepare("SELECT band_id from band WHERE band_name='$bn'");
        $query->execute();
        $array = $query->fetch();
        $b_id = $array[0];

        $query = $pdo->prepare("INSERT INTO form_band (band_id, artist_id) values ('$b_id', '$id')");
        $query->execute();

        $message = "$bn created successfully";
    }

    if(isset($_POST['band_id_leave'])) {
        $b_id = $_POST['band_id_leave'];

        $query = $pdo->prepare("DELETE FROM form_band WHERE artist_id = $id AND band_id = $b_id");
        $query -> execute();

        $query = $pdo->prepare("SELECT band_name from band WHERE band_id='$b_id'");
        $query->execute();
        $array = $query->fetch();
        $bn = $array[0];

        $message = "Successfully left $bn";
    }

    if(isset($_POST['band_join'])) {
        $b_id = $_POST['band_join'];

        $query = $pdo->prepare("SELECT * FROM artist WHERE artist.artist_id = $id");
        $query->execute();
        $row_count = $query->rowCount();

        // If new artist, insert to artist
        if($row_count==0){
            $query = $pdo->prepare("INSERT INTO artist (artist_id) values ($id)");
            $query->execute();
        }
        
        $query = $pdo->prepare("INSERT INTO form_band (band_id, artist_id) values ('$b_id', '$id')");
        $query->execute();

        $query = $pdo->prepare("SELECT band_name from band WHERE band_id='$b_id'");
        $query->execute();
        $array = $query->fetch();
        $bn = $array[0];

        $message = "Successfully joined $bn";
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

                <h1>Band Management</h1>

                <br>

                <?php if(isset($message)){echo $message;}?>

                <form action="" method="post">
					<div class="mb-3">
							<label for="band_name" class="form-label"><b>Band Name</b></label>
							<input type="text" class="form-control" name="band_name">
                            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
					</div>
					
					<button type="submit" class="btn btn-primary">Register Band</button>
				</form>

                <form action="" method="post">
					<div class="mb-3">
							<label for="band_id_leave" class="form-label"><b>Band ID</b></label>
							<input type="number" class="form-control" name="band_id_leave">
                            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
					</div>
					
					<button type="submit" class="btn btn-primary">Leave Band</button>
				</form>

                <form action="" method="post">
					<div class="mb-3">
							<label for="band_join" class="form-label"><b>Band ID</b></label>
							<input type="number" class="form-control" name="band_join">
                            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
					</div>
					
					<button type="submit" class="btn btn-primary">Join Band</button>
				</form>

                <form action="artist.php?id=<?php echo $id;?>" method="post">
                    <input type="hidden" name="id" value=<?php echo $id;?>>
					<button type="submit" class="btn btn-primary">Back to Overview</button>
				</form>
		
				<br>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>