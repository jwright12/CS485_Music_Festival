<?php
    $id = $_GET['id'];
    $f_id = $_GET['f_id'];

    if(isset($_POST['type'])) {
        header("Location: http://cs485.localhost/index.php?id=$id");
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

                <h1>Festival Details</h1>
				<?php if(isset($message)) { echo $message; } ?>
				<br>

                <?php
                    include '../db-connect.php';
                    $fid = $_GET['f_id'];

                    $query = $pdo->prepare("SELECT band.band_name, scheduled_performance.start_time
                                            FROM festival
                                            join schedule
                                            on festival.schedule_id = schedule.schedule_id
                                            join scheduled_performance
                                            on scheduled_performance.schedule_id = schedule.schedule_id
                                            join performance 
                                            on scheduled_performance.performance_id = performance.performance_id
                                            join band
                                            on band.band_id = performance.band_id
                                            WHERE festival_id = $fid");
                    $query->execute();
                    while($row = $query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        printf("<h2>%s %s</h2>", $row[0], $row[1]);
                    } 
                ?>
				
				<form action="" method="post">
                    <input type="hidden" name="type" value=1>
					<button type="submit" class="btn btn-primary">Admin Overview</button>
				</form>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>