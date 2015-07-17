<?php
//text bt

//text is blank = Level 0
//second text is not empty but does have * = level 1
//third text has one star = level 2
include "patient.php";
$text= $_REQUEST['text'];

$result =  getLevel($text);

$level = $result['level'];
$message = $result['latest_message'];
switch (strtolower($level)) {
    case 0:
        $response = getHomeMenu();
        break;
    case 1:
        $response = gethealservicemenu($message);
        break;
    case 2:
        $response = getLevelOneMenu($message);
        break;
    default:
        $response = getHomeMenu();
        break;
}



sendOutput($response,1);
exit;

$exploded_text = explode('*',$text);

print_r($exploded_text);
exit;


//1*1*3*5
$input = getInput();

if ( $input['text'] == "" ) {
    // This is the first request.
    $response  = "Nairobi hospital+".PHP_EOL;
    $response .= "Health service";
    sendOutput($response,1);
}
// This is the second first request.
else if( $input['text'] ==$response )  {
    $response  = "1. CHEK-UP RESULT".PHP_EOL;
    $response  .= "2. Book for a Checkup";
    sendOutput($response,1);
}
else{

    switch (strtolower($input['text'])) {
        case 1:
            $response  = "1. Enter your ID".sendOutput($response,1).PHP_EOL;
            // verication if the patient exist
            if(!empty($patient[$id])){
                $message= "Mr/Ms".$patient[$id]['name'];

            }else{
                $message = "You are a not yet reigisted at Nairobi hospital please contact contact the registration office";
            }
            $response  .= "2. Exit".sendOutput($response,2);
            break;
        case 2:
            $response = "Enter your ID";
            $response  = "1. Enter your ID".sendOutput($response,1).PHP_EOL;
            // verication if the patient exist
            if(!empty($patient[$id])){
                $message= "Mr/Ms".$patient[$id]['name'];
                //if patient exist
                if($message==$patient[$id]['name']){
                   // proceed
                    $response = "those are you exams details".sendOutput($response,2);


                }
                else{
                    $response = gethealservicemenu($message);
                }

            }else{
                $message =  "You are a not yet reigisted at Nairobi hospital please contact contact the registration office";
            }
            sendOutput($response,1);
            break;
        default:
            $response = "Try again the procedure";
            break;
    }
    sendOutput($response,1);
}

function getLevelOneMenu($text){

    switch (strtolower($text)) {

        case 1:
            $response  = "1. Enter your ID".PHP_EOL;
            $response .= "2. Exit".sendOutput($response,2);
            break;
        case 2:
            $response = "Enter your ID";
            sendOutput($response,1);
            break;
        default:
            $response = "Try again the procedure";
            break;
    }

    return $response;

}
function getHomeMenu(){
    $response  = "Nairobi hospital+".PHP_EOL;
    $response .= "Health service";

    return $response;
}
function gethealservicemenu(){

    $response  = "1. CHEK-UP RESULT".PHP_EOL;
    $response .= "2. Book for a Checkup";
    return $response;
}

//verify if the id belongs to one of the staff members
/*function getInput(){
    $input = array();
    $input['sessionId']   = $_REQUEST["sessionId"];
    $input['serviceCode'] = $_REQUEST["serviceCode"];
    $input['phoneNumber'] = $_REQUEST["phoneNumber"];
    $input['text']        = $_REQUEST["text"];

    return $input;

}*/
function getLevel($text){
    if($text == ""){
        $response['level'] = 0;
    }else{
        $exploded_text = explode('*',$text);
        $response['level'] = count($exploded_text);
        $response['latest_message'] = end($exploded_text);

    }
    return $response;
}
/*function sendOutput($message,$type=2){
    //Type 1 is a continuation, type 2 output is an end

    if($type==1){
        echo "CON ".$message;
    }elseif($type==2){
        echo "END ".$message;
    }else{
        echo "END We faced an error";
    }
    exit;
}*/

?>
