

#MUOKI SAMSON NGULI

<?php
// Reads the variables sent via POST from our gateway
$sessionId   = $_POST["sessionId"];
$serviceCode = $_POST["serviceCode"];
$phoneNumber = $_POST["phoneNumber"];
$text        = $_POST["text"];
if ( $text == "" ) {
   // This is the first request. Note how we start the response with CON
   $response  = " CON Welcome to the youth forum  \n";
   $response .= "Please enter your details to register";
   
}

//explode session levels 
$level = explode('*',$text);


//if user enters username
if(isset($level[0]) && $level[0]!=”” && !isset($level[1])){

$response="CON ".$level[0].", enter your user name";
 
 }
 else if(isset($level[1]) && $level[1]!=”” && !isset($level[2])){
 $response="CON Please enter your email\n";

}

else if(isset($level[1]) && $level[1]!="" && !isset($level[2])){
            //Save data to  the database
            $data=array(
                'phonenumber'=>$phonenumber,
                'username' =>$level[0],
                'email' => $level[1],
                
                );

 
// Print the response onto the page so that AT gateway can read it
header('Content-type: text/plain');
echo $response;


// Specify the numbers that you want to send to in a comma-separated list
// Please ensure you include the country code (+254 for Kenya in this case)
$recipients = $phonenumber;


// Send message to customer
$message    = "You have successfully registered 'username=" . $username. ";" "email=" .$email. "";
// Create a new instance of gateway class
$gateway    = new AfricasTalkingGateway($username, $apikey);
// Any gateway error will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Message is send to customer 
  $results = $gateway->sendMessage($recipients, $message);
			
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}


?> 
