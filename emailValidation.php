<?php 

    class Emailer{

        //The class will store information aquired to send PHP email.
        //It will build and email and use the PHP mail().


        //Properties of the class

        private $emailMessage; //Body of the email

        private $emailSubject; 

        private $recipientAddress;

        private $senderAddress;

        
        //Constructor Function

        function __construct() {

            //constructor function


        }


        //Setter Funtions aka Mutators

        function setEmailMessage($inMessage){

            $this->emailMessage = $inMessage; 

        }

        function setEmailSubject($inEmailSubject){
            
            $this->emailSubject = $inEmailSubject;

        }

        function setRecipientAddress($inRecipientAddress){

            $this->recipientAddress = $inRecipientAddress;

        }

        function setSenderAddress($inSenderAddress){

            $this->senderAddress = $inSenderAddress;

        }

        
        //Getter Funtions aka accessors

        function getEmailMessage(){

            return $this->emailMessage;

        }

        function getEmailSubject(){

            return $this->emailSubject;

        }

        function getRecipientAddress(){

            return $this->recipientAddress;

        }

        function getSenderAddress(){

            return $this->senderAddress;

        }

        //Processing functions

        function sendEmail(){
            
            $fromAddress = "From: " . $this->getSenderAddress();


            mail($this->getRecipientAddress(), $this->getEmailSubject(), $this->getEmailMessage(), $fromAddress);

        }

    }
    

?>