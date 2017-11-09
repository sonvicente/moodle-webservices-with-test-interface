<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'enrol_manual_enrol_users';

$userid   = $_POST['userid'];
$courseid = $_POST['courseid'];

$enrolment = new stdClass();
$enrolment->roleid = 5; //estudante(student) -> 5; moderador(teacher) -> 4; professor(editingteacher) -> 3;
$enrolment->userid =(int)$userid;
$enrolment->courseid = (int)$courseid; 
$enrolments = array( $enrolment);
$params = array('enrolments' => $enrolments);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);
?>