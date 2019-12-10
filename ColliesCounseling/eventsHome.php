<?php

  require_once('connection.php');

  $sql = "SELECT event_id, event_name, event_presenter, DATE_FORMAT(event_date, '%c/%e/%Y') as event_formatted_date, TIME_FORMAT(event_time, '%h:%i:%p') as event_formatted_time, event_description, event_location FROM collie_counseling_events ORDER BY event_date ASC ";

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Collie's Counseling</title>
  
  <link rel="stylesheet" href="eventsStyles.css">
  <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Anton|Roboto&display=swap" rel="stylesheet">

</head>
<body>


      
      <header>
        
          <h1><img src="img/CCSummit.png" alt="icon" width="150"> Collie's Counseling Summit</h1>
      </header>

      <nav>
        
        <ul class="hamburgerNav">
          <li class="dropdown"><a href="javascript:void(0)" class="dropbtn"><img src="img/hamburger.png" alt="icon" class="hamburger"></a>
        
            <div class="dropdown-content">
              <a href="eventsHome.php">Home</a><br>
              <a href="eventAbout.php">About</a><br>
              <a href="eventsContact.php">Contact Us</a><br>
              <a href="eventRegister.php">Register Today</a><br>
              <a href="eventsLogin.php"><span>Sign In</span></a>
            </div>
        
          </li>
        </ul>
        
        <ul class="hideNav">
            <li><a href="eventsHome.php">Home</a></li>
            <li><a href="eventAbout.php">About</a></li>
            <li><a href="eventsContact.php">Contact Us</a></li>
            <li><a href="eventRegister.php">Register Today</a></li>
            <li class="right"><a href="eventsLogin.php"><span>Sign In</span></a></li>
        </ul>        
          
      </nav>

      <main id="container">

        <h3>Prepare for the best month of your Life!</h3>

        <p><i>Starting June 1st through June 30th, we will laugh and cry through this amazing journey of becoming a certified counselor! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. In fermentum et sollicitudin ac orci phasellus egestas tellus rutrum. Aliquam nulla facilisi cras fermentum odio.</i></p>


        <h4>View our schedule of events</h4>

        <div class="events">

          <?php

            foreach ($events as $row) {


          ?>
              <div class="eventBox">              
                  
                <div class="flexContent"> 
                
                    <div >
                      <span class="eventTitle"> Event Name:</span> 
                      <?php echo $row["event_name"]; ?>
                    </div>

                    <div >
                      <span class="eventTitle">Event Date:</span> <?php echo $row["event_formatted_date"]; ?>
                    </div>

                    <div >
                      <span class="eventTitle">Event Time: </span>
                      <?php echo $row["event_formatted_time"]; ?>
                    </div>
                
                </div>

                <div class="eventDesc">
                  <span class="eventTitle">Event Description: </span>
                  <?php echo $row["event_description"]; ?>
                </div>

                <div class="flexContent">
                
                    <div>
                      <span class="eventTitle">Event Presenter: </span>
                      <?php echo $row["event_presenter"]; ?>
                    </div>

                    <div>
                      <span class="eventTitle">Event Location: </span>
                      <?php echo $row["event_location"]; ?>
                    </div>

                </div>                 
              </div>    
          <?php
              
            }

          ?>
        </div>

      </main>


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