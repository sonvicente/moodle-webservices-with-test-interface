<?php
require_once('./config.php');
require_once('./curl.php');

$functionname = 'core_course_update_courses';

$courses[0]['id']      = $_POST['courseid'];
$courses[0]['visible'] = $_POST['visible'];

$params = array('courses' => $courses);

$serverurl = $domainname . '/webservice/rest/server.php'. '?wstoken=' . $token . '&wsfunction='.$functionname;

$curl = new curl;
$restformat = ($format == 'json')?'&moodlewsrestformat=' . $format:'';
$resp = $curl->post($serverurl . $restformat, $params);

print_r($resp);

/*
courses[0][id]= int
courses[0][fullname]= string
courses[0][shortname]= string
courses[0][categoryid]= int
courses[0][idnumber]= string
courses[0][summary]= string
courses[0][summaryformat]= int
courses[0][format]= string
courses[0][showgrades]= int
courses[0][newsitems]= int
courses[0][startdate]= int
courses[0][numsections]= int
courses[0][maxbytes]= int
courses[0][showreports]= int
courses[0][visible]= int
courses[0][hiddensections]= int
courses[0][groupmode]= int
courses[0][groupmodeforce]= int
courses[0][defaultgroupingid]= int
courses[0][enablecompletion]= int
courses[0][completionnotify]= int
courses[0][lang]= string
courses[0][forcetheme]= string
courses[0][courseformatoptions][0][name]= string
courses[0][courseformatoptions][0][value]= string
*/
?>