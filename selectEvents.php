<?php

    require_once('connection.php');

    //dreat SQL command

    $sql = "SELECT event_name, event_presenter, DATE_FORMAT(event_date, '%c/%e/%Y') as event_formatted_date, TIME_FORMAT(event_time, '%h:%i:%p') as event_formatted_time, event_description FROM wdv341_event ORDER BY event_name    
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

<!-- 

    div
        div = flex
            div
            div
            div
        div

        div
        div

        div
        div

    div    

 -->

<!DOCTYPE html>
<html>
<head>

    <title>Select Events</title>

    <link href="https://fonts.googleapis.com/css?family=Alatsi|Calistoga|Fjalla+One&display=swap" rel="stylesheet">

    <style>

        #container {
            /* border: 5px solid black; */
            width: 500px;
            margin-bottom: 10px;
        }

        h1{
            font-family: 'Calistoga', cursive;
            
        }

        h2{
            font-family: 'Alatsi', sans-serif;
        }
    
        .flexContainer{
            display: flex;
            font-family: 'Fjalla One', sans-serif;
            /* border: 2px solid black;  */
        }

        .styleName{
            font-size: 25px;
            padding: 5px;
            border: 2px solid black;
        }
        .styleDate {
            font-size: 20px;
            padding: 7px;
            border: 2px solid black;
        }

        .styleValues{
            font-family: 'Fjalla One', sans-serif;
            font-size: 20px;
            padding: 5px;
            border: 2px solid black;
        }
    
    </style>

</head>
<body>

    <h1>Events Catalog</h1>

    <h2>Listing of Current Events</h2>

    <?php

        foreach ($events as $row) {

    ?>

    <div id="container">
        <div class="flexContainer">
            <div class="styleName"><strong>Event Name:</strong> <?php echo $row['event_name']; ?></div>

            <div class="styleDate"><strong>Date:</strong>  <?php echo $row['event_formatted_date']; ?></div>

            <div class="styleDate"><strong>Time:</strong>  <?php echo $row['event_formatted_time']; ?></div>
        </div>

        <div class="styleValues">
            <strong>Event Description:</strong> <?php echo $row['event_description']; ?>
        </div>

        <div class="styleValues">
            <strong>Event Presenter:</strong>  <?php echo $row['event_presenter']; ?>
        </div>
    </div>

    <?php

        }

    ?>

</body>
</html>