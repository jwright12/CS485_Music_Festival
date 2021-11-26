<?php
    $id = $_GET['id'];
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

                <h1>Artist Overview</h1>
				
				<br>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <form action="band.php?id=<?php echo $id;?>" method="post">
                                    <input type="hidden" name="id" value=<?php echo $id;?>> 
                                    <button type="submit" class="btn btn-primary">Join, Create, Or Leave A Band</button>
                                </form>
                            </th>
                            <th scope="col">
                                <form action="add_music.php" method="post">
                                    <button type="submit" class="btn btn-primary">Upload Music</button>
                                </form>
                            </th>
                            <th scope="col">
                                <form action="band.php" method="post">
                                    <button type="submit" class="btn btn-primary">New Set List</button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                </table>

                <h2>Current Bands</h2>
                
            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>