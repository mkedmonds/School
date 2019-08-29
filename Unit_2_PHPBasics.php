<!DOCTYPE html>
<html>
<head>

    <title>Unit-2: Homework Assignment</title>

</head>
<body>

    <h1>Unit-2: PHP Basics - Homework Assignment</h1>
 
    <?php 

        $yourName = "Maddie"; #Exercise 1

        echo "<h1>Exercise 2 - $yourName</h1>"; //Exercise 2
        
    ?>

    <h2>Exercise 3: My Name <?php echo "$yourName"?> displays here</h2> <!--Exercise 3 -->

    <script> //Exercises 4 & 5
    
        let number1 = 12; //Defines variable number1

        document.write("<p> Number1: " + number1 + "</p>"); //Displays variable number1

        let number2 = 8; //Defines variable number2

        document.write("<p>Number2: " + number2 + "</p>"); //Displays variable number2

        let number3 = 9652; //Defines variable number3

        document.write("<p>Number3: " + number3 + "</p>"); //Displays variable number3

        let total = number1 + number2 + number3; //Defines variable total and adds num1, num2, num3 to each other

        document.write("<p>Total: " + total + "</p>"); //Displays the toal of all added variables
    
    </script>

    <!--EXERCISE 6 -->

    <?php 
    
        $codingLanguages = array("PHP", "HTML", "JAVASCRIPT"); //Defining a PHP array called coding Languages

        echo "<h4>USING PHP: " .$codingLanguages[0]. ", " .$codingLanguages[1]. ", " .$codingLanguages[2]. "</h4>"; //Displays array as a PHP array    
    ?>

    <script>
    
       let codingLanguages = <?php echo json_encode($codingLanguages) ?>; //Converts PHP array into a Javascript array 

       document.write("<h3>Using Javascript: " + codingLanguages[0] + ", " + codingLanguages[1] + ", " + codingLanguages[2] + "</h3>"); // Displays array as a Javascript array
    
    </script>

</body>
</html>