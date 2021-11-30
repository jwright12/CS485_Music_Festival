<?php
    $id = $_POST['id'];
    $type = $_POST['type'];
    $message = "Optionally make a new set list with song IDs. Then create a schedule by assigning bands to a set list to play at different times. ";

    if($type == "new_fest") {
        
        include '../db-connect.php';
        $f_name = $_POST['fest_name'];
        $f_date = $_POST['fest_date']." 00:00:00";
        $f_loc = $_POST['fest_loc'];
        $s_id = $_POST['sched_id'];
        $quant = $_POST['ticket_q'];
        $price = $_POST['ticket_p'];

        $query = $pdo->prepare("insert into festival values( null, '$f_name', '$f_date', '$f_loc', $s_id, $id, '$f_date' )");
        $query->execute();

        $query = $pdo->prepare("SELECT festival_id FROM festival WHERE festival_name='$f_name' AND festival_date='$f_date'");
        $query->execute();
        $array = $query->fetch();
        $f_id = $array[0];   

        $query = $pdo->prepare("insert into ticket values (null, $price, $quant, $f_id, $id, '2021-02-10 9:00:00')");
        $query->execute();

        $message = "Festival Created Successfully";

    } else if ($type == 1) {
        header("Location: http://cs485.localhost/admin/admin.php?id=$id");

    } else if ($type == "schedule") {

        include '../db-connect.php';
        $s_id = $_POST['sched'];
        $b_id = $_POST['band'];
        $set_list = $_POST['set'];
        $time = $_POST['time'].":00";
        $date = $_POST['fest_date'];
        $dt = $date." ".$time;
        $now = date("Y-m-d H:i:s");
        
        $query = $pdo->prepare("insert into performance values( null, $b_id, $set_list)");
        $query->execute();

        $query = $pdo->prepare("SELECT performance_id FROM performance WHERE band_id=$b_id AND set_list_id=$set_list");
        $query->execute();
        $array = $query->fetch();
        $p_id = $array[0];

        try {
            $query = $pdo->prepare("insert into schedule values($s_id, $id, '$now')");
            $query->execute();

        } catch (PDOException $ex) {
            $message = "Schedule ID $s_id already exists. Try $s_id + 1";
            
        }

        $query = $pdo->prepare("insert into scheduled_performance values($s_id, $p_id, '$dt')");
        $query->execute();

        $message =  "Performance with ID of $p_id was scheduled successfully for the $date at $time";

        
        
    } else if ($type == "set_list") {
        include '../db-connect.php';
        $set = $_POST['set_list'];
		$song = $_POST['song_id'];
		
		$query = $pdo->prepare("INSERT INTO set_list (set_list_id, song_id) values ('$set', '$song')");
        $query->execute();
        
        $message = "Added song ID $song to set List ID $set";
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

                <h1>Festival Management</h1>

                <br>

                <?php if(isset($message)){echo $message;}?>
                
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="type" value="set_list"> 
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

                <h2>Create Festival Schedule</h2>
		
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="type" value="schedule">  
					<div class="mb-3">
                            <label for="sched" class="form-label"><b>Schedule ID</b></label>
							<input type="number" class="form-control" name="sched">
							<label for="band" class="form-label"><b>Band ID</b></label>
							<input type="number" class="form-control" name="band">
                            <label for="set" class="form-label"><b>Set List ID</b></label>
							<input type="number" class="form-control" name="set">
                            <div class="mb-3">
							<label for="fest_date" class="form-label"><b>Festival Date</b></label>
							<input type="date" class="form-control" name="fest_date">
					</div>
                            <label for="time" class="form-label"><b>Start Time</b></label>
							<input type="time" class="form-control" name="time">
					</div>
					
					<button type="submit" class="btn btn-primary">Schedule Performance</button>
				</form>

				<br>

                <h2>Create Festival</h2>
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="type" value="new_fest">  
					<div class="mb-3">
							<label for="fest_name" class="form-label"><b>Festival Name</b></label>
							<input type="text" class="form-control" name="fest_name">
					</div>
					
                    <div class="mb-3">
							<label for="fest_date" class="form-label"><b>Festival Date</b></label>
							<input type="date" class="form-control" name="fest_date">
					</div>

                    <div class="mb-3">
							<label for="fest_loc" class="form-label"><b>Festival Location</b></label>
							<input type="text" class="form-control" name="fest_loc">
					</div>

                    <div class="mb-3">
							<label for="sched_id" class="form-label"><b>Schedule ID</b></label>
							<input type="number" class="form-control" name="sched_id">
					</div>

                    <div class="mb-3">
                        <label for="ticket_q" class="form-label"><b>Quantity</b></label>
                        <input type="number" class="form-control" name="ticket_q">
					</div>

                    <div class="mb-3">
                        <label for="ticket_p" class="form-label"><b>Price</b></label>
                        <input type="number" class="form-control" name="ticket_p">
					</div>

					<button type="submit" class="btn btn-primary">Create Festival</button>
				</form>

                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="hidden" name="type" value=1>
					<button type="submit" class="btn btn-primary">Admin Overview</button>
				</form>

            </div> 
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </body>

</html>