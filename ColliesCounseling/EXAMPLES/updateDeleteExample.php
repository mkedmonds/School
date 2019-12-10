<?php
    session_start();

    if ($_SESSION["signedIn"] == "confirm") {
        $message="Please choose a function";

        require_once('connection.php');

        $sql = "SELECT event_id, event_name, event_presenter, DATE_FORMAT(event_date, '%c/%e/%Y') as event_formatted_date, TIME_FORMAT(event_time, '%h:%i:%p') as event_formatted_time, event_description, event_location FROM collie_counseling_events ORDER BY event_date DESC ";

        $stmt = $conn->prepare($sql);

        //bind the parameters if any



        ///execute the statement

        $stmt->execute();



        //Work with the result-set from the SELECT commmand

        $events = $stmt->fetchAll();    //turn results set into array

        //process each row of the array, displaying the event_name

    } 
    
    else {
        $_SESSION['signedIn']='notConfirm';
        header('Location: loginExample.php');
    }
    

?>


<!DOCTYPE html>
<html>
<head>

    <style>
        #container{
            width: 660px;
             border: 2px solid black; 
            /* padding: 10px; */
            margin: auto auto;
            margin-bottom: 30px;
        }
        
        .eventDesc{
            /* border: 2px solid black; */
            border-bottom: 2px solid black;
            
            padding: 5px;
        }

        .eventBottom{
            padding: 5px;
        }

        .eventBottom a{
            /* border-top: 2px solid black; */
            margin: 10px;
            
        }

        
        .flexContent{
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid black;
            padding: 5px;
        }
    </style>
  
</head>
<body>

<h1>Coming Up Events</h1>

<h4><?php echo $message; ?></h4>

<p><a href="eventsForm.php">Add an event</a></p>

<p><a href="logoutExample.php">Logout of site</a></p>

<?php

    foreach ($events as $row) {
    

?>

        <div id="container" >
        
        
            <div class="flexContent"> 
            
                <div >Event Name: <?php echo $row["event_name"]; ?></div>

                <div >Event Date: <?php echo $row["event_formatted_date"]; ?></div>

                <div >Event Time: <?php echo $row["event_formatted_time"]; ?></div>
            
            </div>

            <div class="eventDesc">
                Event Description: <?php echo $row["event_description"]; ?>
            </div>

            <div class="flexContent">
            
                <div>Event Presenter: <?php echo $row["event_presenter"]; ?></div>

                <div>Event Location: <?php echo $row["event_location"]; ?></div>

            </div>

            <div class="eventBottom">
            
                <?php
                    $eventsId = $row['event_id']; 
                ?>

                <a href="updateEvents.php?recId=<?php echo $eventsId; ?>"><button>Update Events</button></a>


                <a href="deleteEvents.php?recId=<?php echo $eventsId; ?>"><input type="button" value="Delete"></a>
            </div>        
        
        </div>


<?php

        
    }

?>

</body>
</html>