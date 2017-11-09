<?php
$token = '0d157dcb700bf12b10440db8be7e661d';

$domainname = 'http://www.ec.sc.senac.br/';
$functionname = 'core_course_create_courses';

/* REST RETURNED VALUES FORMAT
$restformat = 'xml';                      
*/
$format = 'json';                       
 
$user = new stdClass();
$user->fullname = $_POST['nomeCompleto'];
$user->shortname = $_POST['nomeCurto'];
$user->categoryid = 1; //aqui vai o id da categoria do curso.
$user->idnumber = $_POST['cursoId'];

$courses = array($user);
$params = array('courses' => $courses);

$users = array($user);
$params = array('users' => $users);

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