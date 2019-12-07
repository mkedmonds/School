<?php

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

                $sql = "
                    INSERT INTO eventsite_formal(event_name, event_description,event_location, event_presenter, event_date, event_time)

                    VALUES(:eName, :eDescription, :eLocation, :ePresenter, :eDate, :eTime);
                
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

                //Execute Statement

                $stmt->execute();

                $message = "The event has been added. Thank you.";

            } 
            
            catch (PDOException $e) {
                $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: eventsForm.php');	//sends control to a User friendly page	
            }


        }

        else
		{
			$message = "Please make corrections and sumbit form.";
		}//ends check for valid form


    }
   

?>



<!DOCTYPE html>
<html>
<head>
  <title>Events Form</title>

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

    <h1>WDV341: Intro PHP</h1>

    <h2>SQL Insert - Events Form</h2>

    <?php

        if($validForm)
        {

    ?>

            <h1><?php echo $message; ?></h1>
            <p><a href="eventsForm.php">Return to form</a></p>
            <p><a href="updateDeleteExample.php">View Events</a></p>

    <?php
    
        }
        else
        {    
    
    ?>

    <form action="eventsForm.php" method="post">

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
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </p>

    </form>

    <?php

        }

    ?>


</body>
</html>