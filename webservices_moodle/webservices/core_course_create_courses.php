<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_course_create_courses';
 
$user = new stdClass();
$user->fullname   = $_POST['nomeCompleto'];
$user->shortname  = $_POST['nomeCurto'];
$user->categoryid = 1; /* id da categoria do curso */
$user->idnumber   = $_POST['cursoId'];

$courses = array($user);
$params = array('courses' => $courses);

$users = array($user);
$params = array('users' => $users);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);
?>