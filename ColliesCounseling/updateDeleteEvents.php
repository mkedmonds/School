<?php
    session_start();

    if ($_SESSION["signedIn"] == "valid") {
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
        header('Location: eventsLogin.php');
    }
    

?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Update/Delete Events</title>

<link rel="stylesheet" href="eventsStyles.css">
<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Anton|Roboto&display=swap" rel="stylesheet">
  
</head>
<body>

<header> 
    <h1><img src="img/CCSummit.png" alt="icon" width="150">Collie's Counseling Summit</h1>
</header>


<nav>
    
    <ul class="hamburgerNav">
        <li class="dropdown"><a href="javascript:void(0)" class="dropbtn"><img src="img/hamburger.png" alt="icon" class="hamburger"></a>
        
            <div class="dropdown-content">
            <a href="eventsHome.php">Home</a><br>
            <a href="eventAbout.php">About</a><br>
            <a href="eventsContact.php">Contact Us</a><br>
            <a href="eventRegister.php">Register Today</a><br>
            <a href="updateDeleteEvents.php">Update and/or Delete Events</a><br>
            <a href="eventsForm.php">Add Events</a><br>
            <a href="showRegistrants.php">Registrant List</a><br>
            <a href="eventsLogout.php"><span>Logout</span></a>
            </div>
        
        </li>
    </ul>
        
    <ul class="hideNav">
        <li><a href="eventsHome.php">Home</a></li>
        <li><a href="eventAbout.php">About</a></li>
        <li><a href="eventsContact.php">Contact Us</a></li>
        <li><a href="eventRegister.php">Register Today</a></li>
        <li><a href="updateDeleteEvents.php">Update and/or Delete Events</a></li>
        <li><a href="eventsForm.php">Add Events</a></li>
        <li><a href="showRegistrants.php">Registrant List</a></li>
        <li class="right"><a href="eventsLogout.php"><span>Logout</span></a></li>
    </ul>        
        
</nav>

<h4><?php echo $message; ?></h4>

<?php

    foreach ($events as $row) {
    

?>

        <div class="eventBox">
        
        
            <div class="flexContent"> 
            
                <div ><span class="eventTitle"> Event Name:</span><?php echo $row["event_name"]; ?></div>

                <div ><span class="eventTitle">Event Date:</span><?php echo $row["event_formatted_date"]; ?></div>

                <div ><span class="eventTitle">Event Time: </span><?php echo $row["event_formatted_time"]; ?></div>
            
            </div>

            <div class="eventDesc">
            <span class="eventTitle">Event Description: </span><?php echo $row["event_description"]; ?>
            </div>

            <div class="flexContent">
            
                <div><span class="eventTitle">Event Presenter: </span><?php echo $row["event_presenter"]; ?></div>

                <div><span class="eventTitle">Event Location: </span><?php echo $row["event_location"]; ?></div>

            </div>

            <div class="eventBottom">
            
                <?php
                    $eventsId = $row['event_id']; 
                ?>

                <a href="eventsUpdate.php?recId=<?php echo $eventsId; ?>"><button class="updateDetele">Update Events</button></a>


                <a href="eventsDelete.php?recId=<?php echo $eventsId; ?>"><input type="button" class="updateDetele" value="Delete"></a>
            </div>        
        
        </div>


<?php

        
    }

?>

<footer>
        <h4>Copyright &copy; 
          <script>
            var d = new Date();

            document.write(d.getFullYear())
          </script>
          , All Rights Reserved
        </h4>
</footer>

</body>
</html>