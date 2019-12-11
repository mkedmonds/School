<?php

	$color = "";
	$fontStyle = "";
	//Get the Event data from the server.

	//DATE: MM-DD-YY
	//DESC ORDER BY DATE

	require_once('connection.php');

	//direct SQL command

    $sql = "SELECT event_name, event_description, event_presenter, DATE_FORMAT(event_date, '%c/%e/%Y') as event_formatted_date, MONTH(event_date) as event_format_month, TIME_FORMAT(event_time, '%h:%i:%p') as event_formatted_time FROM wdv341_events ORDER BY event_date DESC    
    ";

    //prepare the sql command

    $stmt = $conn->prepare($sql);

    //bind the parameters if any



    ///execute the statement

	$stmt->execute();
	
	//Work with the result-set from the SELECT commmand

	$events = $stmt->fetchAll();    //turn results set into array

	//process each row of the array, displaying the event_name

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>WDV341 Intro PHP  - Display Events Example</title>
    <style>
		.eventBlock{
			width:500px;
			margin-left:auto;
			margin-right:auto;
			background-color:#CCC;	
		}
		
		.displayEvent{
			text_align:left;
			font-size:18px;
			margin-right: 20px;	
		}
		
		.displayDescription {
			margin-left:100px;
		}

		

		

	</style>
</head>

<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Example Code - Display Events as formatted output blocks</h2>   
    <h3><?php echo count($events) ?> Events are available today.</h3>

<?php
	//Display each row as formatted output in the div below

	foreach ($events as $row) {

		if (strtotime($row['event_formatted_date']) >= strtotime(date("m/d/Y"))) {
			// echo "PASS";
			$color = "color: red";
			$fontStyle = "font-style: normal";
		} 
		else {
			// echo "FAIL";
			$color = "color: black";
			
		}
		if ($row['event_format_month'] == date("m")) {
			// echo "EQULAS MONTH";
			$fontStyle = "font-style:italic";
			
		}
		else{
			// echo "DOESNT EQUAL MONTH";
			$fontStyle = "font-style:normal";
		}
		
		
	
?>
	<p>
        <div class="eventBlock">	
            <div>
            	<span class="displayEvent" style="<?php echo $fontStyle; ?>">Event:<?php echo $row['event_name']; ?></span>
                <span>Presenter:<?php echo $row['event_presenter']; ?></span>
            </div>
            <div>
            	<span class="displayDescription">Description: <?php echo $row['event_description']; ?></span>
            </div>
            <div>
            	<span class="displayTime">Time: <?php echo $row['event_formatted_time']; ?></span>
            </div>
            <div>
            	<span style="<?php echo $color; ?>">Date:  <?php echo $row['event_formatted_date']; ?></span>
            </div>
        </div>
    </p>

<?php
	//Close the database connection	
	}
?>
</div>	
</body>
</html>