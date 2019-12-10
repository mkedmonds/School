<?php

  $message="";
  $inUser = "";
  $inPass = "";

  session_start();

  if ($_SESSION["signedIn"] == "valid") {
    $message = "Welsome back $inUser";
  } 
  else {
      if (isset($_POST["inLogin"])) {

          $inUser = $_POST["inUsername"];

          $inPass = $_POST["inPassword"];

          require_once('connection.php');

          $sql = "SELECT event_user_name, event_user_password FROM event_user WHERE event_user_name = :eventUser AND event_user_password = :eventPass";

          $stmt = $conn->prepare($sql);

          $stmt->bindParam(":eventUser", $inUser);

          $stmt->bindParam(":eventPass", $inPass);

          $stmt->execute();

          $stmt->fetch();

          if ($stmt->rowCount() == 1) {

              $_SESSION["signedIn"] = "valid";

              $message = "YAY! You signed in!";

          }
          else {
          $_SESSION["signedIn"] = "notConfirm";

          $message = "Invalid username or password. Please Try again.";
          }
      } 
      else {
          
      }
      
  }
    

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
      <h1><img src="img/CCSummit.png" alt="icon" width="150">Collie's Counseling Summit</h1>
  </header>   

  <?php

      if ($_SESSION["signedIn"] == "valid") {

  ?>      

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

      
      <h4>Welcome back! Please choose one of the above functions </h4>


  <?php
          
      }

      else {
    

  ?>

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
      <p>Please fill in the fields below</p>

      <form action="eventsLogin.php" method="post">

          <p>
              <label for="name">Username: </label>
              <input type="text" name="inUsername">
          </p>

          <p>
              <label for="pass">Password: </label>
              <input type="password" name="inPassword">
          </p>

          <p>
            <input type="submit" class="submitResetBtn button" value="Login" name="inLogin">
            <input type="reset" class="button" value="Reset" name="reset">
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