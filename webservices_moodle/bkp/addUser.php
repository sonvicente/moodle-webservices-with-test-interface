<?php
$token = '0d157dcb700bf12b10440db8be7e661d';

$domainname = 'http://www.ec.sc.senac.br/';
$functionname = 'core_user_create_users';

/* REST RETURNED VALUES FORMAT
$restformat = 'xml';                      
*/
$format = 'json';                      

/* 
 * Aqui virão os parâmetros para o moodle$user1->nome, onde nome precisa ser dentro dos padroes do moodle  
 */
 
$user = new stdClass();
$user->username  = $_POST['login'];
$user->password  = $_POST['senha'];
$user->firstname = $_POST['nome'];
$user->lastname  = $_POST['sobrenome'];
$user->email     = $_POST['email'];

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