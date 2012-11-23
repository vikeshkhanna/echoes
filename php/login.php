<?php
require dirname(__FILE__).'/../facebook/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '556761407680480',
  'secret' => 'a8de1f9094b8101ddb784efcd72b86ae',
));

$user = $facebook->getUser();
?>
