<?php
include('include.php');

$db_host = "localhost:3306";
$db_name = "intaifmDB";
$db_user = "intaifmDB";
$db_pass = "DedicataDB";

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die ("Impossibile trovare host di destinazione. Contattare l'assistenza tecnica.");

$rawData = file_get_contents('php://input');
$data = json_decode($rawData);


$type = $data->type;

$userId = $data->userId;
$sessionId = $data->sessionId;

$deviceType = $data->deviceType; 
$startTime = $data->startTime; 

$endTime = $data->endTime; 
$timeSpent = $data->timeSpent; 

$fbc = $data->fbc;
$fbp = $data->fbp;
$client_ip_address = $data->client_ip_address;
$client_user_agent = $data->client_user_agent;

$startTime_sec = $startTime / 1000;
$startTime_date = date("Y-m-d H:i:s", $startTime_sec);


$endTime_sec = $endTime / 1000;
$endTime_date = date("Y-m-d H:i:s", $endTime_sec);


switch($type)
{
  case "startSession":

    do_query("INSERT INTO intai_session_data (id_user, id_session, device_type, start_time, stato)
                VALUES ('$userId', '$sessionId', '$deviceType', '$startTime_date', '1')
    ");


  break;

  case "updateSession":

    do_query("UPDATE intai_session_data SET
                fbc = '$fbc',
                fbp = '$fbp',
                client_ip_address = '$client_ip_address',
                client_user_agent = '$client_user_agent'
            WHERE id_user = '$userId' AND id_session = '$sessionId'
      ");


  break;

  case "endSession";

    do_query("UPDATE intai_session_data SET
                end_time = '$endTime_date',
                stato = '4'
              WHERE id_user = '$userId' AND id_session = '$sessionId' 

            ");
      
  break;

}

mysqli_close($conn);

echo json_encode(array('type' => "$type"));

?>
