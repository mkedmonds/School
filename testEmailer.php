<?php

    include 'emailValidation.php'; //get the class file

    $customerMail = new Emailer(); //instantiate a new object from Emailer class

    $customerMail->setRecipientAddress("mkedmonds@dmacc.edu");

    $customerMail->getRecipientAddress();

    $customerMail->setEmailSubject("This Is A Email Subject");

    $customerMail->getEmailSubject();

    $customerMail->setEmailMessage("This is an Email Message!");

    $customerMail->getEmailMessage();

    $customerMail->setSenderAddress("mkedmonds@dmacc.edu");

    $customerMail->getSenderAddress();

    $customerMail->sendEmail(); //Send the mail


?>

<!DOCTYPE html>
<html>
<head>

    <title>WDV341:PHP EMAIL TEST</title>


</head>
<body>

    <h1>WDV 341: Intro PHP</h1>

    <h2>Test Emailer Class</h2>

    <p>RecipientAddress: <?php echo $customerMail->getRecipientAddress() ?></p>

    <p>EmailSubject: <?php echo $customerMail->getEmailSubject(); ?></p>

    <p>EmailMessage: <?php echo $customerMail->getEmailMessage(); ?></p>

    <p>SenderAdress: <?php echo $customerMail->getSenderAddress(); ?></p>

</body>
</html>