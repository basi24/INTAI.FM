<?php

//   ini_set('display_errors', 1);
//   ini_set('display_startup_errors', 1);
//   error_reporting(E_ALL);

  // Configuration.
  // Should fill in value before running this script
  $access_token = '__';
  $pixel_id = '__';

  include 'vendor/autoload.php';

  $get_fbc = $_POST['fbc'];
  $get_fbp = $_POST['fbp'];
  
  $clientIpAddress = $_SERVER['REMOTE_ADDR'];
  $clientUserAgent = $_SERVER['HTTP_USER_AGENT'];

  use FacebookAds\Api;
  use FacebookAds\Logger\CurlLogger;
  use FacebookAds\Object\ServerSide\Content;
  use FacebookAds\Object\ServerSide\CustomData;
  use FacebookAds\Object\ServerSide\DeliveryCategory;
  use FacebookAds\Object\ServerSide\Event;
  use FacebookAds\Object\ServerSide\EventRequest;
  use FacebookAds\Object\ServerSide\Gender;
  use FacebookAds\Object\ServerSide\UserData;
  
  if (is_null($access_token) || is_null($pixel_id)) {
    throw new Exception(
      'You must set your access token and pixel id before executing'
    );
  }
  
  // Initialize
  Api::init(null, null, $access_token);
  $api = Api::instance();
  $api->setLogger(new CurlLogger());
  
  $events = array();
  
  $user_data_0 = (new UserData())
    ->setClientIpAddress("$get_client_ip_address")
    ->setClientUserAgent("$get_client_user_agent")
    ->setFbp("$get_fbp")
    ->setFbc("$get_fbc");
  
  $event_0 = (new Event())
    ->setEventName("conversione_chat_intaim")
    ->setEventTime(time())
    ->setUserData($user_data_0)
    ->setCustomData($custom_data_0);
  array_push($events, $event_0);
  
  $request = (new EventRequest($pixel_id))
    ->setEvents($events);
  
  $request->execute();

  echo "ok";

?>