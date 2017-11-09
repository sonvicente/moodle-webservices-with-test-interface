<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_course_get_courses';

$options['ids'][0]= $_POST['courseid'];
$params = array('options' => $options);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);
?>