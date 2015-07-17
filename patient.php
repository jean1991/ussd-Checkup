<?php

$input = getInput();

$patient1 = array('name'=>'JAMES', 'staff_id' => 1234);

$patient2 = array('name'=>'LEWIS', 'staff_id' => 12345);

$patient5 = array('name'=>'CHARLES', 'staff_id' => 231);

$patient = array('1234'=>$patient1,'12345'=>$patient2,'231'=>$patient3);
/*    if(!empty($patient[$id])){
        $message= "ID is valid and it belongs to ".$patient[$id]['name'];

    }else{
        $message =  "No Staff with that id";
    }


    sendOutput($message,2);

*/
//verify if the id belongs to one of the staff members
function getInput(){
    $input = array();
    $input['sessionId']   = $_REQUEST["sessionId"];
    $input['serviceCode'] = $_REQUEST["serviceCode"];
    $input['phoneNumber'] = $_REQUEST["phoneNumber"];
    $input['text']        = $_REQUEST["text"];
    return $input;
}

function sendOutput($message,$type=2){
    //Type 1 is a continuation, type 2 output is an end

    if($type==1){
        echo "CON ".$message;
    }elseif($type==2){
        echo "END ".$message;
    }else{
        echo "END We faced an error";
    }
    exit;
}

?>
