<?php

    $inName = "";
    $inPhone = "";
    $inEmail = "";
    $inRegistration = "";
    $inBadge = "";
    $inMeals = "";
    $inSpecial = "";
    $postInBadge01 = "";
    $postInBadge02 = "";
    $postInBadge03 = "";
    $selected = "";


    if(isset($_POST["submit"])){

      echo "<h1>Form Submitted</h1>";

      $inName = $_POST["textfield"];
      $inPhone = $_POST["textfield2"];
      $inEmail = $_POST["textfield3"];
      $inRegistration = $_POST["select"];
      $inBadge = $_POST["radio"];
      $inMeals = $_POST["checkbox"];
      $inSpecial = $_POST["textarea"];

      if ("radio" == $inBadge) {
        $postInBadge01 = "checked='checked'";
      }

      else {

        if ("radio2" == $inBadge) {
          $postInBadge02 = "checked='checked'";
        }

        else {

          if ("radio3" == $inBadge) {
            $postInBadge03 = "checked='checked'";
          }

        }
        
      }

      
      

       
      

    }

?>


<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Self Posting Form</title>
<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#orderArea h3	{
	text-align:center;	
}
.error	{
	color:red;
	font-style:italic;	
}

</style>
</head>

<body>
<h1>WDV341 Intro PHP</h1>
<h2>Unit-5 and Unit-6 Self Posting - Form Validation Assignment


</h2>
<p>&nbsp;</p>


<div id="orderArea">
<form name="form3" method="post" action="customerRegistrationForm.php">
  <h3>Customer Registration Form</h3>

      <p>
        <label for="textfield">Name:</label>
        <input type="text" name="textfield" id="textfield" value="<?php echo $inName ?>" >
      </p>
      <p>
        <label for="textfield2">Phone Number:</label>
        <input type="text" name="textfield2" id="textfield2" value="<?php echo $inPhone ?>" >
      </p>
      <p>
        <label for="textfield3">Email Address: </label>
        <input type="text" name="textfield3" id="textfield3" value="<?php echo $inEmail ?>" >
      </p>
      <p>
        <label for="select">Registration: </label>
        <select name="select" id="select" > 
          <option <?php if($inRegistration == ""){ ?> selected="true" <?php }; ?> value="">Choose Type</option>
          <option <?php if($inRegistration == "evt01"){ ?> selected="true" <?php }; ?> value="evt01">Attendee</option>
          <option <?php if($inRegistration == "evt02"){ ?> selected="true" <?php }; ?> value="evt02">Presenter</option>
          <option <?php if($inRegistration == "evt03"){ ?> selected="true" <?php }; ?> value="evt03">Volunteer</option>
          <option <?php if($inRegistration == "evt04"){ ?> selected="true" <?php }; ?> value="evt04">Guest</option>

          

        </select>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="radio" id="radio" value="radio" <?php echo $postInBadge01; ?> >
        <label for="radio">Clip</label> <br>
        <input type="radio" name="radio" id="radio2" value="radio2" <?php echo $postInBadge02; ?>  >
        <label for="radio2">Lanyard</label> <br>
        <input type="radio" name="radio" id="radio3" value="radio3" <?php echo $postInBadge03; ?> >
        <label for="radio3">Magnet</label>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="checkbox" id="checkbox"  value="checkbox" <?php if(isset($_POST["checkbox"])) echo "checked='checked'" ?> >
        <label for="checkbox">Friday Dinner</label><br>
        <input type="checkbox" name="checkbox2" id="checkbox2"  value="checkbox2" <?php if(isset($_POST["checkbox2"])) echo "checked='checked'" ?> >
        <label for="checkbox2">Saturday Lunch</label><br>
        <input type="checkbox" name="checkbox3" id="checkbox3"  value="checkbox3" <?php if(isset($_POST["checkbox3"])) echo "checked='checked'" ?> >
        <label for="checkbox3">Sunday Award Brunch</label>
      </p>
      <p>
        <label for="textarea">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="textarea" cols="40" rows="5" id="textarea" maxlength="200" > <?php echo $inSpecial ?> </textarea>
      </p>
   
  <p>
    <input type="submit" name="submit" id="button3" value="Submit">
    <input type="reset" name="reset" id="button4" value="Reset">
  </p>
</form>
</div>

</body>
</html>