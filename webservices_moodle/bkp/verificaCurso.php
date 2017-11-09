<?php

$token = '0d157dcb700bf12b10440db8be7e661d';
$domainname = 'http://www.ec.sc.senac.br/';

$functionname = 'core_course_get_courses';

$format = 'json';                      

$options['ids'][0]= $_POST['id'];
$params = array('options' => $options);


/* REST CALL */
/* header('Content-Type: text/plain'); */

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;
require_once('./curl.php');
$curl = new curl;

$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);

?>