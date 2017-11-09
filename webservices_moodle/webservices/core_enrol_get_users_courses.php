<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_enrol_get_users_courses';

$userid = $_POST['userid'];
$params = array('userid' => $userid);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);
?>