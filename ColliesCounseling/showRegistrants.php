<?php
    session_start();

    if ($_SESSION["signedIn"] == "valid") {
        $message="Please choose a function";

        require_once('connection.php');

        $sql = "SELECT participate_id, participate_name, participate_phone, participate_email, participate_allergy1, participate_allergy2, participate_photo, participate_shirt_size, DATE_FORMAT(register_date, '%c/%e/%Y') as register_formatted_date FROM collie_counseling_register ORDER BY participate_name ";

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

<title>Registrant List</title>

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


<?php

    foreach ($events as $row) {
    

?>
        <div style="overflow-x:auto;" id="container">    

            <table>

                <th>Registrant ID: </th>
                <th>Registrant Name:</th>
                <th>Registrant Email:</th>
                <th>Registrant Phone Number:</th>
                <th>Registrant Shirt Size:</th>
                <th>Registrant Allergy:</th>
                <th>Registrant Allergy Description:</th>
                <th>Registrant Photo Waiver:</th>
                <th>Registrant Date:</th>
        
                <tr>

                    <td><?php echo $row["participate_id"]; ?></td>
                    <td><?php echo $row["participate_name"]; ?></td>
                    <td><?php echo $row["participate_email"]; ?></td>
                    <td><?php echo $row["participate_phone"]; ?></td>
                    <td><?php echo $row["participate_shirt_size"]; ?></td>
                    <td><?php echo $row["participate_allergy1"]; ?></td>
                    <td><?php echo $row["participate_allergy2"]; ?></td>
                    <td><?php echo $row["participate_photo"]; ?></td>
                    <td><?php echo $row["register_formatted_date"]; ?></td>

                </tr>

            </table>
            
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