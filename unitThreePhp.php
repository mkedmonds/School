<?php

            function formatString($inString){
                
                echo "Character Total: " . strlen($inString) . "<br>";

                echo "String after trim(): " . trim($inString) . "<br>";

                echo "String Lowercase: " . strtolower($inString) . "<br>";

                if(stripos($inString, "DMACC") === false){
                    echo "DMACC is Not in the string <br>";
                }
                else {
                    echo "DMACC is in the string <br>";
                }

            }

            function formatNumber($inNum){

                echo "Formatted Number: " . number_format($inNum) . "<br>";

            }

            function formatCurrency($inNumTwo){

                setlocale(LC_MONETARY,"en_US");

                echo "Total Price $" . number_format($inNumTwo, 2);

            }

                         
            


        ?>


<!DOCTYPE html>
<html>
<head>
  

</head>
<body>

    <h1>WDV 341: Intro PHP</h1>

    <h2>Unit Three: PHP Functions</h2>

    <h3>Results from Submission</h3>

    <?php 
    
    $inDate = date('m / d / Y', strtotime($_POST['inputDateOne']));

    $inDateTwo = date('d / m / Y', strtotime($_POST['inputDateOne']));

    echo "Date One - (mm/dd/yyyy): " . $inDate . "<br>";

    echo "Date Two - (dd/mm/yyyy): " . $inDateTwo . "<br>";

    formatString($_POST['inputString']);

    formatNumber($_POST['inputNum']);

    formatCurrency($_POST['inputNumTwo']);
    
    ?>

    <p><a href="unitThreeFunctions.php">Go Back To Form</a></p>
</body>
</html>
