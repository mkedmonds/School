<?php

        $testBoolean = true;

        include "formValidationClass.php"; //get the class
    
        $validateTool = new FormValidation(); //instantiates a new object

    ?>

<!DOCTYPE html>
<html>
<head>



</head>
<body>

        
        <h3>Testing validateRequiredField()</h3>

    <?php    
        echo "Empty quotes: ".$validateTool->validateRequiredField(""). "<br>";

        //echo "true: ".$testBoolean;

        echo "Empty space within quotes: ".$validateTool->validateRequiredField(" "). "<br>";

        echo "Two Empty spaces within quotes: ".$validateTool->validateRequiredField("  "). "<br>";

        echo "a: ".$validateTool->validateRequiredField("a"). "<br>";

        echo "4: ".$validateTool->validateRequiredField(4). "<br>";

        echo "null: ".$validateTool->validateRequiredField(null). "<br>";

        echo "NULL: ".$validateTool->validateRequiredField(NULL). "<br>";

        echo "null string: ".$validateTool->validateRequiredField("null"). "<br>";

        echo "NULL string: ".$validateTool->validateRequiredField("NULL"). "<br>";

        echo "undefined: ".$validateTool->validateRequiredField("undefined"). "<br>";

        if ($validateTool->validateRequiredField("a")) {
            echo "a is valid <br>";
        }
        else {
            echo "a is invalid <br>";
        }

        if ($validateTool->validateRequiredField("")) {
            echo "empty is valid <br>";
        }
        else {
            echo "empty is invalid <br>";
        }

    
    ?>

    <h3>Testing requiredNumericField()</h3>

    <?php

        echo "7: ".$validateTool->requiredNumericField(7)."<br>";

        echo "0: ".$validateTool->requiredNumericField(0)."<br>";

        echo "i: ".$validateTool->requiredNumericField("i")."<br>";

        echo "empty: ".$validateTool->requiredNumericField("")."<br>";
        echo "null: ".$validateTool->requiredNumericField(null)."<br>";
        echo "four: ".$validateTool->requiredNumericField("four")."<br>";
        echo ".7: ".$validateTool->requiredNumericField(.7)."<br>";
        echo "2.7: ".$validateTool->requiredNumericField(2.7)."<br>";
        echo "-3: ".$validateTool->requiredNumericField(-3)."<br>";
        echo "-3.3: ".$validateTool->requiredNumericField(-3.3)."<br>";
        echo "+4: ".$validateTool->requiredNumericField(+4)."<br>";
        echo ".: ".$validateTool->requiredNumericField(".")."<br>";
        echo "$: ".$validateTool->requiredNumericField("$")."<br>";
        echo "-: ".$validateTool->requiredNumericField("-")."<br>";
        echo ",: ".$validateTool->requiredNumericField(",")."<br>";
        echo "2,300: ".$validateTool->requiredNumericField(2,300)."<br>";
        echo "1 3: ".$validateTool->requiredNumericField("1 3")."<br>";
        echo "7%: ".$validateTool->requiredNumericField("7%")."<br>";

    ?>

    <h3>Testing validateEmailField</h3>

    <?php

        echo "olive: ".$validateTool->validateEmailField("olive")."<br>";
        echo "oliveOlivson.com: ".$validateTool->validateEmailField("oliveOliveson.com")."<br>";
        echo "olive@olivecom: ".$validateTool->validateEmailField("olive@olivecom")."<br>";
        echo "olive@olive.com: ".$validateTool->validateEmailField("olive@olive.com")."<br>";
        echo "empty: ".$validateTool->validateEmailField("")."<br>";
        echo "null: ".$validateTool->validateEmailField(null)."<br>";
        echo "4: ".$validateTool->validateEmailField(4)."<br>";
        echo "olive@@@olive.com: ".$validateTool->validateEmailField("olive@@@olive.com")."<br>";

    ?>

    <h3>Testing Dropdown validation</h3>

    <?php

        $testValue = "";
        $testErrMsg = " ";
        

        if(isset($_POST["submit"])) {
            # code...
            $testValue = $_POST["selectTest"];       
  

            
        }

    ?>

    <select name="selectTest">
        <option value="">Please Choose</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
    </select>

    <p>
        <input type="submit" name="submit" value="Submit">
        <p>Result: <span><?php echo "tEST - " . $validateTool->validateRegistration($testValue) ; ?></span></p>
    </p>
    
    

    

</body>
</html>