<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_user_create_users';
 
$user = new stdClass();
$user->username  = $_POST['login'];
$user->password  = $_POST['senha'];
$user->firstname = $_POST['nome'];
$user->lastname  = $_POST['sobrenome'];
$user->email     = $_POST['email'];

$users = array($user);
$params = array('users' => $users);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);

?>