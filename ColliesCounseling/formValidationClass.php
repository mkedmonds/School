<?php

    class FormValidation{
        
        /* 
            This class will hold a variety of general purpose methods that are used to validate form fields

            The methods with accept inputs as needed and will return true if the value(s) pass the validation and fale otherwise
        */

        //Properties

        //Constructor

        public function __construct(){
            //empty constructor with no defined process

        }

        //Methods

        public function validateRequiredField($inputValue){

            global $validForm, $eventNameErr;

            

            if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
                $eventNameErr =  "Please enter a value  ";
                $validForm = false;
                
            } 
            else {
                $eventNameErr = "";
                
            }
            
        } //end validateRequiredField()

        public function requiredNumericField($inputValue){
            // This will require a numeric value in the input field
            if (is_numeric($inputValue)) {
                echo "";
            } 
            else {
                echo "Please enter a number - ";
                $validForm = false;
            }
            
 

        } //end requiredNumericField()


        public function validateEmailField($inputValue){
            //This will validate and sanitize the email

            global $validForm;

            if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL) == false) {
                echo "";
                $validForm = true;
                
            } else {
                echo "Invalid Email please enter you email in the follwing format: example@example.com  ";
                $validForm = false;
            }

        } //end validateEmailField()

        public function validateRequiredNameField($inputValue){

            global $validForm, $nameError;

            $nameError = " ";

            if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
                $validForm = false;
                $nameError =  "Please enter your name in the following format: John Doe";
                
                
            } 
            else {
                $nameError = "";
                
            }
            
        } //end validateRequiredField()

        public function validateCustomerEmailField($inputValue){
            //This will validate and sanitize the email

            global $validForm, $emailError;

            $emailError = "";

            if (!filter_var($inputValue, FILTER_VALIDATE_EMAIL) == false) {
                $emailError = "";
                
                
            } else {
                $validForm = false;
                $emailError = "Invalid Email please enter you email in the follwing format: example@example.com  ";
                
            }

        } //end validateCustomerEmailField()

        public function validateRegistration($inputValue){
            //This will validate the registration value

            global $validForm, $registrationError;

            $registrationError = "";

            if ($inputValue == "") {
                
                $validForm = false;
                $registrationError =  "Please select a choice";
                
            } 
            else {
                $registrationError = "";
                
            }
            
            

        }//end ValidateRegistration()

        public function validateBadgeType($inputValue)
        {
            //Accepts and validates badge value

            global $validForm, $badgeError;

            $badgeError = "";

            if ($inputValue == "") {

                $validForm = false;
                $badgeError = "Please choose a value";
            }
            else {
                $badgeError = "";
                
            }



        }//end validateBadgeType()

        public function validateTextarea($inputValue)
        {
            //If something is entered into the textarea, then special characters will be removed

            global $validForm, $specialError;

            if (preg_match("/([-+><>])+/", $inputValue, $matches)) {

                $validForm = false;

                $specialError = "Invalid Characters '- + < >'. Please enter in the following format: My name is John Doe. I like ice cream! ";
            } else {
                $specialError = "";
               
            }
            

            
        }// end validateTextarea

        public function validatePhoneNumber($inputValue)
        {
            //Validate inputted phone number

            global $validForm, $inPhone ,$phoneError;

            $phone = preg_replace('/[^0-9]/', '', $inputValue);
            if(strlen($phone) === 10) {
                //Phone is 10 characters in length (###) ###-####

                $inPhone = $phone;
                $phoneError = "";
                

            }
            else {

                $validForm = false;

                $phoneError = "Invalid Format. Phone Number must be 10 charater in legnth. Please enter your phone number";
            }

        }//end validatePhoneNumber

        public function validateRequiredFieldShirts($inputValue){

            global $validForm, $shirtError;

            

            if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {
                $shirtError =  "Please enter a value  ";
                $validForm = false;
                
            } 
            else {
                $shirtError = "";
                
            }
            
        } //end validateRequiredField()

        public function validateTextareaEvents($inputValue)
        {
            //If something is entered into the textarea, then special characters will be removed

            global $validForm, $allergy2Error;

            if (preg_match("/([-+><>])+/", $inputValue, $matches)) {

                $validForm = false;

                $allergy2Error = "Invalid Characters '- + < >'. Please enter in the following format: My name is John Doe. I like ice cream! ";
            } else {
                if (trim($inputValue) == "" || $inputValue=="undefined" || !strcasecmp($inputValue,"null")) {

                    $validForm = false;

                    $allergy2Error = "please enter your allergies, if any. If you have selected NO, please enter N/A";
                } else {
                    $allergy2Error = "";
                }
                
                
               
            }
            

            
        }// end validateTextareaEvents

    }//END CLASS FORMVALIDATION()
    

?>

<!-- 
    Structure of a class
        - Properties
        - Constructor
        - Methods
            Setters
            Getters
        -Processed
            Alphabetical    
-->