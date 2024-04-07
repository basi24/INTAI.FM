<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    require 'vendor/autoload.php';

    use FacebookAds\Api;
    use FacebookAds\Logger\CurlLogger;
    use FacebookAds\Object\ServerSide\Event;
    use FacebookAds\Object\ServerSide\EventRequest;
    use FacebookAds\Object\ServerSide\UserData;
    use FacebookAds\Object\ServerSide\CustomData;

    $access_token = '__';
    $pixel_id = '__';


    // $get_cluster = $_GET['nome_cluster'];
    // $get_external_id = $_GET['id_user'];
    // $get_fbc = $_GET['fbc'];
    // $get_fbp = $_GET['fbp'];
    // $get_client_ip_address = $_GET['client_ip_address'];
    // $get_client_user_agent = $_GET['client_user_agent'];


    $rawData = file_get_contents('php://input');
    $data = json_decode($rawData);


    $get_cluster = $data->nome_cluster;
    $get_external_id = $data->id_user;
    $get_fbc = $data->fbc;
    $get_fbp = $data->fbp;
    $get_client_ip_address = $data->client_ip_address;
    $get_client_user_agent = $data->client_user_agent;



    $api = Api::init(null, null, $access_token);
    $api->setLogger(new CurlLogger());

    $user_data = (new UserData())
        // It is recommended to send Client IP and User Agent for ServerSide API Events.
        ->setClientIpAddress("$get_client_ip_address")
        ->setClientUserAgent("$get_client_user_agent")
        ->setFbp("$get_fbp") 
        //->setEmail('joe@eg.com')
        ->setExternalId("$get_external_id");

    if($get_fbc != "")
    {
        //IF PRESENT --> FBC è presente solo se è stata cliccata un ad prima di giungere sulla pagina
        $user_data->setFbc("$get_fbc");
    }
        

    $event = (new Event())
        ->setEventName("$get_cluster")
        ->setEventTime(time())
        ->setEventSourceUrl('https://www.jamcommunication.it/web-division')
        ->setUserData($user_data);

    $events = array();
    array_push($events, $event);

    $request = (new EventRequest($pixel_id))
        ->setEvents($events);
    $response = $request->execute();

    //$ris = print_r($response);
    $ris = $response->getEventsReceived();
    

    echo json_encode(array('response' => "$ris"));


    

?>



