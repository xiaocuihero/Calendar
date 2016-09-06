<?php
require_once('includes/prefs.inc.php');
require_once('includes/db.php');
require_once('resources/i18n.php');


// $date = new DateTime();
// $timestamp = $date->getTimestamp();
// $dataformat = GetCalendarViewFormat("day" ,$timestamp);
// $clientzone =8;
// $serverzone= 8;
// $zonediff = $serverzone-$clientzone ; 
// $qstart = $dataformat['start_date'] +$zonediff*3600;
// $qend = $dataformat['end_date'] +$zonediff*3600;		
// $qstart  = date("Y-m-d H:i:s",$qstart);
// $qend = date("Y-m-d H:i:s",$qend);
@session_start();
$userid=$_SESSION['id'];
$pid=$_SESSION['pid'];
$db = db_connect();	

$checkStart = $_POST["checkStart"];
$chechTimestamp = $checkStart / 1000 ;
$checkFormate = GetCalendarViewFormat("day", $chechTimestamp);
$checkFormatestart = $checkFormate['start_date'] + 86400;
$checkStartDate = date("Y-m-d H:i:s",$checkFormatestart);
// $checkDate =  $checkStart -> getTimestamp();

$stringQuery = "SELECT 1 FROM `calendar` c WHERE c.StartTime='{$checkStartDate}' AND c.EndTime='{$checkStartDate}' AND UpAccount='{$userid}' AND c.`Category`=0";
$resultPlan = $db->query("SELECT 1 FROM `calendar` c WHERE c.StartTime='{$checkStartDate}' AND c.EndTime='{$checkStartDate}' AND UpAccount='{$userid}' AND c.`Category`=0" AND c.'Location'='{$pid}');

$counterPlan = 0;
foreach ($resultPlan as $row) {
	$counterPlan++;
}

$resultFinish = $db->query("SELECT 1 FROM `calendar` c WHERE c.StartTime='{$checkStartDate}' AND c.EndTime='{$checkStartDate}' AND UpAccount='{$userid}' AND c.`Category`=1 AND c.'Location'='{$pid}'");

$counterFinish = 0;
foreach ($resultFinish as $row) {
	$counterFinish++;
}

$result = array('plan' => $counterPlan, 'finish' => $counterFinish);

echo json_encode($result);

// echo var_dump($pid);
// echo "_____________";
// echo var_dump($checkFormatestart);
// echo json_encode($checkStart);
?>