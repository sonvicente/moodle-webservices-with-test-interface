<?php
$token = '0d157dcb700bf12b10440db8be7e661d';
$domainname = 'http://www.ec.sc.senac.br/';

$functionname = 'enrol_manual_enrol_users';

/* REST RETURNED VALUES FORMAT
$restformat = 'xml';                      
*/
$format = 'json'; 

/* usuario e curso */
$userid   = $_POST['user'];
$courseid = $_POST['course'];

$enrolment = new stdClass();
$enrolment->roleid = 5; //estudante(student) -> 5; moderador(teacher) -> 4; professor(editingteacher) -> 3;
$enrolment->userid =(int)$userid;
$enrolment->courseid = (int)$courseid; 
$enrolments = array( $enrolment);
$params = array('enrolments' => $enrolments);

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