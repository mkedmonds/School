<?php

require_once('connection.php');

include "formValidationClass.php"; //get the class
    
$validateTool = new FormValidation(); //instantiates a new object

$registerName = "";
$nameError = "";
$registerEmail = "";
$emailError = "";
$registerPhone = "";
$phoneError = "";
$registerAllergies1="";
$postAllergy1 = "";
$postAllergy2 = "";
$allergy1Error = "";
$registerAllergies2="";
$allergy2Error = "";
$registerPhoto = "";
$postPhoto1 = "";
$postPhoto2 = "";
$photoError = "";
$registerShirt = "";
$shirtError = "";
$validForm = false;

if (isset($_POST["submit"])) {

    $registerName = $_POST["inName"];
    $registerEmail = $_POST["inEmail"];
    $registerPhone = $_POST["inPhone"];
    $registerAllergies1 = $_POST["allergy1"];
    $registerAllergies2 = $_POST["allergy2"];
    $registerPhoto = $_POST["inPhoto"];
    $registerShirt = $_POST["inShirt"];

    $validForm = true;

    if ($registerAllergies1 == "YES") {
        $allergy1Error = "";
        $postAllergy1 = "checked = 'checked'";
    } 
    else {
        if ($registerAllergies1 == "NO") {
            $allergy1Error = "";
            $postAllergy2 = "checked = 'checked'";
        } else {
            $allergy1Error = "Please select YES or NO";
            $validForm = false;
        }
        
    }

    if ($registerPhoto == "YES") {
        $photoError = "";
        $postPhoto1 = "checked = 'checked'";
    } 
    else {
        if ($registerPhoto == "NO") {
            $photoError = "";
            $postPhoto2 = "checked = 'checked'";
        } else {
            $validForm = false;
            $photoError = "Please select YES or NO";
        }
        
    }
    

    $validateTool->validateRequiredNameField($registerName);
    $validateTool->validateCustomerEmailField($registerEmail);
    $validateTool->validatePhoneNumber($registerPhone);
    $validateTool->validateRequiredFieldShirts($registerShirt);
    $validateTool->validateTextareaEvents($registerAllergies2);

    if ($validForm) {

        $message = "Form Submitted";
        
        try {
            require_once("connection.php"); //Connect to database

            $date = date("Y-m-d"); //Format Date


            //SQL COMMAND

            $sql = "
                INSERT INTO collie_counseling_register(participate_name, participate_phone,participate_email, participate_allergy1, participate_allergy2, participate_photo, participate_shirt_size, register_date)

                VALUES(:pName, :pPhone, :pEmail, :pAllergy1, :pAllergy2, :pPhoto, :pShirt, :rDate);
            
            ";

            //PREPARE STMT OBJECT

            $stmt = $conn->prepare($sql);

            //Bind Parameters

            $stmt->bindParam(":pName", $registerName);
            $stmt->bindParam(":pPhone", $registerPhone);
            $stmt->bindParam(":pEmail", $registerEmail);
            $stmt->bindParam(":pAllergy1", $registerAllergies1);
            $stmt->bindParam(":pAllergy2", $registerAllergies2);
            $stmt->bindParam(":pPhoto", $registerPhoto);
            $stmt->bindParam(":pShirt", $registerShirt);
            $stmt->bindParam(":rDate", $date);

            //Execute Statement

            $stmt->execute();

            $message = "You have been registered. Thank you.";

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

else {
    //Form is being shown for the first time
}



?>

<!DOCTYPE html>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Us!</title>

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

<?php
    if($validForm){
?>
        <h1>FORM SUBMITTED</h1>

        <h4><?php echo $message; ?></h4>

        <p class="center"><a href="eventRegister.php">Register another person</a>, or choosed the above links.</p>

<?php
    }
    else {
       
?>

    <main class="form">

        <p><i>Please fill out the form below</i></p>
    
        <form action="eventRegister.php" method="post">
        
            <p>
                <label for="name">First and Last Name:</label>
                <input type="text" name="inName" value="<?php echo $registerName; ?>">
                <span class="error"><?php echo $nameError; ?></span>
            </p>

            <p>
                <label for="name">Email:</label>
                <input type="text" name="inEmail" value="<?php echo $registerEmail; ?>">
                <span class="error"><?php echo $emailError ?></span>
            </p>

            <p class="no"> 
                <label for="hidden">DO NOT FILL THE OUT</label>
                <input type="text" name="hidden">            
            </p>

            <p>
                <label for="name">Phone Number:</label>
                <input type="text" name="inPhone" value="<?php echo $registerPhone; ?>">
                <span class="error"><?php echo $phoneError; ?></span>
            </p>

            <p>
                <label for="name">Do you have any allergies?</label><span class="error"><?php echo $allergy1Error; ?></span><br>
                <input type="radio" name="allergy1" value="YES" <?php echo $postAllergy1; ?>>YES
                <input type="radio" name="allergy1" value="NO" <?php echo $postAllergy2; ?>>NO
            </p>

            <p>If YES, please specify <i>(if you selected NO above, please write N/A)</i>: </p> <span class="error"><?php echo $allergy2Error ?></span><br>
            <textarea name="allergy2" cols="30" rows="5" ><?php echo $registerAllergies2; ?></textarea>

            <p class="photo">
                I hereby grant permission to Collie's Counseling &copy; to use photographs and/or video of me taken on June 1 - 30, 2020 at Coomunity Events Building in publications, news releases, online, and in other communications related to the mission of Collie's Counseling &copy;.
            </p> <span class="error"><?php echo $photoError; ?></span><br>
            <input type="radio" name="inPhoto" value="YES" <?php echo $postPhoto1; ?>>YES
            <input type="radio" name="inPhoto" value="NO" <?php echo $postPhoto2; ?>>NO

            <p>
                <label for="name">Shirt Size:</label>
                <input type="text" name="inShirt" value="<?php echo $registerShirt; ?>">
                <span class="error"><?php echo $shirtError; ?></span>
            </p>

            <p>
                <input type="submit" class="submitResetBtn button" value="Submit" name="submit">
                <input type="reset" class="button" value="Reset" name="Reset">
            </p>

        </form>
    
    </main>
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