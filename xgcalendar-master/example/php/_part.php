<?php
require_once('includes/prefs.inc.php');
require_once('includes/db.php');
$date = new DateTime();
$timestamp = $date->getTimestamp();
$dataformat = GetCalendarViewFormat("month" ,$timestamp);
$clientzone =8;
$serverzone= 8;
$zonediff = $serverzone-$clientzone ; 
$qstart = $dataformat['start_date'] +$zonediff*3600;
$qend = $dataformat['end_date'] +$zonediff*3600;		
$qstart  = date("Y-m-d H:i:s",$qstart);
$qend = date("Y-m-d H:i:s",$qend);
@session_start();
$userid=$_SESSION['id'];
$pid=$_SESSION['pid'];
$role=$_SESSION['role'];
$nu=0;
if($role==0){
$nu=$_SESSION['nu'];
}
$db = db_connect();	
$db->query("set names utf-8"); 
if($role==0){
	if($nu==0)
	{
	$result = $db->query("SELECT c.`Id`, c.`Subject`, c.`Location`, c.`MasterId`, c.`Description`, c.`CalendarType`, c.`StartTime`, c.`EndTime`, c.`IsAllDayEvent`, c.`HasAttachment`, c.`Category`, c.`InstanceType`, c.`Attendees`, c.`AttendeeNames`, c.`OtherAttendee`, c.`UPAccount`, c.`UPName`, c.`UPTime`, c.`RecurringRule`,u.`realname` FROM `calendar` c left join `user` u on c.`UPAccount`=u.`id`  where c.StartTime<='{$qend}' and c.EndTime>='{$qstart}' and c.Location='{$pid}' order by c.StartTime,c.EndTime");	
	}
	else{
	$result = $db->query("SELECT c.`Id`, c.`Subject`, c.`Location`, c.`MasterId`, c.`Description`, c.`CalendarType`, c.`StartTime`, c.`EndTime`, c.`IsAllDayEvent`, c.`HasAttachment`, c.`Category`, c.`InstanceType`, c.`Attendees`, c.`AttendeeNames`, c.`OtherAttendee`, c.`UPAccount`, c.`UPName`, c.`UPTime`, c.`RecurringRule`,u.`realname` FROM `calendar` c left join `user` u on c.`UPAccount`=u.`id`  where c.StartTime<='{$qend}' and c.EndTime>='{$qstart}' and c.Location='{$pid}' and c.UPAccount='{$nu}' order by c.StartTime,c.EndTime");
	}
}
else{
	$result = $db->query("SELECT * FROM calendar where StartTime<='{$qend}' and EndTime>='{$qstart}' and UpAccount='{$userid}' and Location='{$pid}' order by StartTime,EndTime");
}
		
$ret =array();	
echo " __CURRENTDATA=[";
if($result)
{
	$i = 0;
	foreach ($result as $row) {  
		if($role==0){	
		$username=$row["realname"].":".$row["Subject"];
		}
		else{
			$username=$row["Subject"];
		}
		// if(strpos($username,chr(10))){
			// echo "1_____________________________________________1";
		// }
		$username = str_replace(chr(10), 'qYQVP9', $username);
		if($i>0) 
		{
			echo ",";
		}
		echo "['{$row["Id"]}','".$username."',".TimeToFullJsonTime($row["StartTime"]).",".TimeToFullJsonTime($row["EndTime"]).
		",".($row["IsAllDayEvent"]?1:0).",".((TimeToTimeStringFormat($row["StartTime"],"Ymd")== TimeToTimeStringFormat($row["EndTime"],"Ymd"))? 0:1).",1,".
		($row["Category"]=="1"?1:0).",1,'{$row["Attendees"]}','{$row["Location"]}']";
			
		$i++;
	}		
	
}
echo "];\r\n";
//echo " __CURRENTDATA=".preg_replace("/\/(Date\([0-9-]+\))\//", "new \\1", $r).";"; 
?>