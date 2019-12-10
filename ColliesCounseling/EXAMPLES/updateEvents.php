<?php

session_start();

if ($_SESSION["signedIn"] == "confirm") {
    $message="Update The Form";

}

  $eventName = "";
  $eventNameErr = ""; 
  $eventDescription = "";
  $eventDescriptionErr = "";
  $eventPresenter = "";
  $eventPresenterErr = "";
  $eventDate = "";
  $eventDateErr = "";
  $eventTime = "";
  $eventTimeErr = "";
  $eventLocation = "";
  $eventLocationErr = "";
  $eventHidden = "";
  $message = "";
  $validForm = false;  

  function validateEventName($inputValue){

    global $validForm, $eventNameErr;

    if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
        $eventNameErr =  "Please enter an event name";
        $validForm = false;
        
    } 
    else {
        $eventNameErr = "";
        
    }
    
  } //end validateEvent Name()

  function validateEventPresenter($inputValue){

      global $validForm, $eventPresenterErr;      

      if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
          $eventPresenterErr =  "Please enter presenter's name";
          $validForm = false;
          
      } 
      else {
          $eventPresenterErr = "";
          
      }
      
  } //end validateEvent Name()

  function validateEventDesc($inputValue){

      global $validForm, $eventDescriptionErr;      

      if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
          $eventDescriptionErr =  "Please enter a description  ";
          $validForm = false;
          
      } 
      else {
          $eventDescriptionErr = "";
          
      }
      
  } //end validateRequiredField()

  function validateEventDate($inputDate) { 

      global $validForm,$eventDateErr;

      if (false === strtotime($inputDate)) { 
          $eventDateErr = "Please enter a date in the following format mm/dd/yyyy";
          $validForm = false;
      } 
      else {
          list($year, $month, $day) = explode('-', $inputDate); 
          if (checkdate($month, $day, $year)) {
              $eventDateErr = "";
          } 
      }
      
  }

  function validateEventTime($inputTime)
  {

      global $validForm, $eventTimeErr;

      if(strtotime($inputTime)) {
          $eventTimeErr = "";
      } 
      else {
          $eventTimeErr = "Please enter a time";
          $validForm = false;
      }
  }

  function validateLocation($inputLocation)
  {
    global $validForm, $eventLocation, $eventLocationErr;

    if (trim($inputLocation) == "" || $inputLocation=="undefined" || !strcasecmp($inputLocation,"null")) {
      $eventLocationErr =  "Please enter an event location";
      $validForm = false;
      
    } 
    else {
        $eventLocationErr = "";
        
    }
    
  }


  if (isset($_POST["submit"])) {
      
      $eventName = $_POST["eventName"];
      $eventDescription = $_POST["eventDesc"];
      $eventPresenter = $_POST["eventPresenter"];
      $eventLocation = $_POST["eventLocation"];
      $eventDate = $_POST["eventDate"];
      $eventTime = $_POST["eventTime"];
      $eventHidden = $_POST["hidden"];
      $recId = $_GET["recId"];
      

      echo "<h1>EVENT ID: $recId </h1>";


      if ($eventHidden != "") {
          echo "<h1>SCAMMER!<h1>";
      }

      $validForm = true;
      
      validateEventName($eventName);
      validateEventDesc($eventDescription);
      validateEventPresenter($eventPresenter);
      validateLocation($eventLocation);
      validateEventDate($eventDate);
      validateEventTime($eventTime);

      if ($validForm) {

          $message = "Form Submitted";
          
          try {
              require_once("connection.php"); //Connect to database

              $date = date("Y-m-d", strtotime($eventDate)); //Format Date


              //SQL COMMAND

              $sql = "UPDATE collie_counseling_events SET event_name='$eventName', event_description='$eventDescription', event_presenter='$eventPresenter', event_location='$eventLocation', event_date='$eventDate', event_time='$eventTime' WHERE event_id='$recId'
              
              ";

              //PREPARE STMT OBJECT

              $stmt = $conn->prepare($sql);

              //Bind Parameters

              $stmt->bindParam(":eName", $eventName);
              $stmt->bindParam(":eDescription", $eventDescription);
              $stmt->bindParam(":eLocation", $eventLocation);
              $stmt->bindParam(":ePresenter", $eventPresenter);
              $stmt->bindParam(":eDate", $date);
              $stmt->bindParam(":eTime", $eventTime);
              $stmt->bindParam(":eventId", $recId);

              

              //Execute Statement

              $stmt->execute();

              $message = "The event has been added. Thank you.";

          } 
          
          catch (PDOException $e) {
              $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

              

              error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
              error_log(var_dump(debug_backtrace()));
            
              //Clean up any variables or connections that have been left hanging by this error.		
            
              header('Location: updateEvents.php');	//sends control to a User friendly page	
          }


      }

      else
      {
        $message = "Please make corrections and sumbit form.";
      }//ends check for valid form


  }
  else {
    # Form has not been seen by user display form

    $recId = $_GET["recId"];

    echo "<h1>EVENT ID: $recId </h1>";

    require 'connection.php';

		$sql = "SELECT event_name, event_description, event_presenter,event_location, event_date, event_time 
				FROM collie_counseling_events WHERE event_id = :eventID
			";

		$stmt = $conn->prepare($sql);

		$stmt->bindParam(":eventID", $recId); //Bind Parameter

		$stmt->execute();

		$row = $stmt->fetch();

		$eventName = $row["event_name"];
		$eventDescription = $row["event_description"];
		$eventPresenter = $row["event_presenter"];
		$eventLocation = $row["event_location"];
		$eventDate = $row["event_date"];
		$eventTime = $row["event_time"];

  }


?>

<!DOCTYPE html>
<html>
<head>

<title>Update Event</title>

  <style>

  .error{
      color: red;
      font-style: italic;
  }

  .hidden{
      display: none;
  }

  </style>

</head>
<body>

<h1>WDV341 Intro PHP </h1>
<h2>Update An Event</h2>

<h4>Please make your corrections and press Update when you are done.</h4>

<?php

    if($validForm)
    {

?>

        <h1><?php echo $message; ?></h1>
        <p><a href="updateDeleteExample.php">Return to Events</a></p>

<?php

    }
    else
    {    

?>

<form action="updateEvents.php?recId=<?php echo $recId; ?>" method="post">

  <p>
      <label for="name">Event Name:</label>
      <input type="text" name="eventName" id="eventName" value="<?php echo $eventName; ?>">
      <span class="error"><?php echo $eventNameErr; ?></span>
  </p>
  <p>
      <label for="desc">Event Description:</label>
      <input type="text" name="eventDesc" id="eventDesc" value="<?php echo $eventDescription; ?>">
      <span class="error"><?php echo $eventDescriptionErr; ?></span>
  </p>
  <p class="hidden">
      <label for="hiddenField">Do NOT fill this out</label>
      <input type="text" name="hidden" value="<?php echo $eventHidden; ?>">
  </p>
  <p>
      <label for="desc">Event Presenter:</label>
      <input type="text" name="eventPresenter" id="eventPresenter" value="<?php echo $eventPresenter; ?>">
      <span class="error"><?php echo $eventPresenterErr; ?></span>
  </p>
  <p>
      <label for="desc">Event Location:</label>
      <input type="text" name="eventLocation" id="eventLocation" value="<?php echo $eventLocation; ?>">
      <span class="error"><?php echo $eventLocationErr; ?></span>
  </p>
  <p>
      <label for="desc">Event Date:</label>
      <input type="date" name="eventDate" id="eventDate" value="<?php echo $eventDate; ?>">
      <span class="error"><?php echo $eventDateErr; ?></span>
  </p>
  <p>
      <label for="desc">Event Time: </label>
      <input type="time" name="eventTime" id="eventTime" value="<?php echo $eventTime; ?>">
      <span class="error"><?php echo $eventTimeErr; ?></span>
  </p>

  <p>
      <input type="submit" name="submit" value="Update">
      <input type="reset" name="reset" value="Reset">
  </p>

</form>

<?php

    }

?>

</body>
</html>

<!-- 

    TO-DO

        Display out events list
        add update and delete link to page
        add recId=? to links deleteEvents and updateEvents
        modify delete page to access GET parameter (id)
        use id as parameter to SQL database
    USE PHP ECHO htmlspecialchars(SERVER PHP_SELF?RECID=UPDATEID)
    
 -->