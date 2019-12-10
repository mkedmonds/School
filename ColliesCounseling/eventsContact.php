<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Us</title>

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

      <main id="container">

        <h3>Contact Us!</h3>

        <p><i>Please fill out the form below</i></p>

        <form action="" method="post">
        
            <p>
                <label for="name">Name</label>
                <input type="text" name="eventName">
            </p>

            <p>
                <label for="email">Email</label>
                <input type="text" name="eventPassword">
            </p>

            
            <p>Questions/Comments</p>
            <textarea name="eventComment" cols="30" rows="10"></textarea>

            <p>
              <input type="submit" class="submitResetBtn button" value="Submit">
              <input type="reset" class="button" value="Reset">
            </p>
            
        
        </form>

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