<?php
    $message = "";

    session_start();

    if ($_SESSION['signedIn'] == "confirm") {
        $message = "YAY! You signed in!";
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

               $_SESSION["signedIn"] = "confirm";

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
  <title>Login/Logout Example</title>
</head>
<body>

<h1>WDV341: Intro PHP</h1>
<h2>Login and Logout Example</h2>

<h2><?php echo $message; ?></h2>

<?php

    if ($_SESSION["signedIn"] == "confirm") {

?>

        <p><a href="updateDeleteExample.php">Update/Delete Events</a></p>

        <p><a href="logoutExample.php">LogOut</a></p>

<?php
        
    }

    else {
   

?>

    

    <p><i>Please fill out the form below</i></p>
    <form action="loginExample.php" method="post">
        <p>
            <label for="name">Username: </label>
            <input type="text" name="inUsername">
        </p>
        <p>
            <label for="pass">Password: </label>
            <input type="password" name="inPassword">
        </p>
        <p>
            <input type="submit" value="Login" name="inLogin">
            <input type="reset" value="Reset" name="reset">
        </p>
    
    </form>

<?php

    }

?>

</body>
</html>