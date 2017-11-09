<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_user_get_users_by_field';

$field = $_POST['field'];
$values = array($_POST['fieldvalue']);
$params = array('field' => $field, 'values' => $values);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);
?>