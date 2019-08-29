<!DOCTYPE html>
<html>
<head>

    <title>Unit-2: Homework Assignment</title>

</head>
<body>

    <h1>Unit-2: PHP Basics - Homework Assignment</h1>
 
    <?php 

        $yourName = "Maddie"; #Exercise 1

        echo "<h1>Exercise 2 - $yourName</h1>";
        
    ?>

    <h2>Exercise 3: My Name <?php echo "$yourName"?> displays here</h2>

    <script>
    
        let number1 = 12;

        document.write("<p> Number1: " + number1 + "</p>");

        let number2 = 8;

        document.write("<p>Number2: " + number2 + "</p>");

        let number3 = 9652;

        document.write("<p>Number3: " + number3 + "</p>");

        let total = number1 + number2 + number3;

        document.write("<p>Total: " + total + "</p>");
    
    </script>

    <?php 
    
        $codingLanguages = array("PHP", "HTML", "JAVASCRIPT");

        echo "<h4>USING PHP: " .$codingLanguages[0]. ", " .$codingLanguages[1]. ", " .$codingLanguages[2]. "</h4>";    
    ?>

    <script>
    
       let codingLanguages = <?php echo json_encode($codingLanguages) ?>;

       document.write("<h3>Using Javascript: " + codingLanguages[0] + ", " + codingLanguages[1] + ", " + codingLanguages[2] + "</h3>")
    
    </script>

</body>
</html>