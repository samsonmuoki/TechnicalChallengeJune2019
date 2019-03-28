<? php

require_once('AfricasTalkingGateway.php')

$username = "sandbox";
$apikey   = "a41af90b1785c3cde4cda3fbdda5574c5dbc71d689ef66dd030143e92b5c0c95";


//create table members  with columns phonenumber varchar(15), email varchar(50)

if(!empty($_POST)){
	
	require_once('AfricasTalkingGateway');
	
	
	//receiving post from AT
	$sessionId=$_POST['sessionId'];
	$serviceCOde=$_POST['serviceCode'];
	$phoneNumber=$_POST['phoneNumber'];
	
	$text=$_POST['text'];
	
//get value of latest interaction
$textArray = explode('*',$text);

$userResponse = trim(end($textArray));

//check level
$level = 0;
$sql = "select 'level' from 'session_levels' where 'session_id'='"  . $sessionId . "'";
$levelQuery = $db->query($sql);
if($result = $levelQuery->fetch_assoc()){
	$level = $result['level'];
}

//check if user is not in db 
$firstQuery="SELECT * FROM users WHERE 'phoNenumber' LIKE '%'"..$phoneNumber."%' LIMIT 1";
$firstResult=$db->query($firstQuery);
$userAvail=$firstResult->fetch_assoc();

//print user details
$response = "you have successfully registered";
$response = $phoneNumber;
$response = $email;

//if user available reply user already registered
if($userAvail && userAvail['email']!=NULL && $userAvail['phoneNumber']!=NULL ){
	$response = "User ALREADY REGISTERED!";
}


	
	
	
	
	
}


?>
