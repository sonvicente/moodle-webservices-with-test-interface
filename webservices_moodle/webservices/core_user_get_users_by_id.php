<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_user_get_users_by_id';

$userids = array($_POST['userid']);
$params  = array('userids' => $userids);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

echo($resp);
?>