<?php
require_once('includes/prefs.inc.php');
require_once('includes/db.php');
require_once('resources/i18n.php');
$mode = getPref('mode');
switch($mode)
{
	case "get":
		GetCalendarsByRange();
		break;
	case "quickadd":
		QuickAdd();
		break;
	case "quickupdate":		
		QuickUpdate();
		break;
	case "quickdelete":
		QuickDelete();
		break;
	default :
		DefaultImpl();
	break;
}
function DefaultImpl()
{
	$ret = array();
	$ret["error"] = array("ErrorCode"=>"NotVolidMode","ErrorMsg"=>"") ;
	echo json_encode($ret);
}
function QuickAdd()
{
	$ret = array();
	@session_start();
	$userid=$_SESSION['id'];
	$department=$_SESSION['department'];
	$pid=getPref('pid');
 	$subject = getPref("CalendarTitle");
	$strStartTime = getPref("CalendarStartTime");
	$strEndTime =  getPref("CalendarEndTime");
	$isallday =  getPref("IsAllDayEvent");
	$clientzone = getPref('timezone');	
	$serverzone= TIMEZONE_INDEX;
	$zonediff = 0 ; 
	$category = getPref('Category');
	$start_date = DateTime::createFromFormat(msg("datestring")." H:i",$strStartTime);
	if ($start_date==null) {
		$ret["IsSuccess"] =false;
		$ret["Msg"] =msg("notvoliddatetimeformat").":".$strStartTime;
		echo json_encode($ret); 
		return;
	}
	$end_date = DateTime::createFromFormat(msg("datestring")." H:i",$strEndTime);
	if ($end_date==null) {
		$ret["IsSuccess"] =false;
		$ret["Msg"] =msg("notvoliddatetimeformat").":".$strEndTime;
		echo json_encode($ret);
		return;
	}

	
	try
	{
		$cal = array(
		"CalendarType" => 1,
		"InstanceType" => 0,
		"Subject" => $subject,
		"Location" => $pid,
		"Description" => "",
		"StartTime" => addtime($start_date,$zonediff,0,0),
		"EndTime" => addtime($end_date,$zonediff,0,0),
		"IsAllDayEvent" => $isallday == "1"?1:0,
		"UPAccount" => $userid,
		"UPName" => $department,
		"UPTime" => new DateTime(),
		"MasterId" => $clientzone,
		"Category" => $category
		);

		$newid = DbInsertCalendar($cal);
		if($newid>0)
		{
			$ret["IsSuccess"] =true;
			$ret["Msg"] =msg("successmsg");
			$ret["Data"] = $newid;
		}
		else 
		{
			$ret["IsSuccess"] =false;
			$ret["Msg"] =msg("dberror");
		}
	}
	catch(Exception $e)
	{
			$ret["IsSuccess"] =false;
			$ret["Msg"] = $e->getMessage();
	}
	echo json_encode($ret);
}
function QuickUpdate()
{
	$ret =array();
	try
	{		
		$id =getPref("id");
		$subject =getPref("strname");
		$category = getPref("category");
		$clientzone = 8;
		$serverzone= 8;
		$zonediff = 0 ; 		
		$rcount = DbUpdateCalendar($id,$subject,$category);
		if($rcount>0)
		{
			$ret["IsSuccess"] =true;
			$ret["Msg"] =msg("successmsg");
		}
		else
		{
			$ret["IsSuccess"] =false;
			$ret["Msg"] =msg("dberror");
		}
	}
	catch(Exception $e)
	{
			$ret["IsSuccess"] =false;
			$ret["Msg"] = $e->getMessage();
	}
	echo json_encode($ret);
}
function QuickDelete()
{

	$ret =array();
	try
	{
		$id =getPref("calendarId");
		$rcount =DbDeleteCalendar($id );
		if($rcount>0)
		{
			$ret["IsSuccess"] =true;
			$ret["Msg"] =msg("successmsg");
		}
		else
		{
			$ret["IsSuccess"] =false;
			$ret["Msg"] =msg("dberror");
		}
	}
	catch(Exception $e)
	{
			$ret["IsSuccess"] =false;
			$ret["Msg"] = $e->getMessage();
	}
	echo json_encode($ret);
}
function strtodate($strdata)
{	
	$date= date_create_from_format('Y-m-d',$strdata );
	return $date;
}
function GetCalendarsByRange()
{
	$ret = array();
	$view_Type = "month"; // week,month,day
	$str_show_day = getPref('showdate'); // 当前是那一天 
	$clientzone = 8;
	$serverzone= 8;
	$zonediff = 0; 
	$showday = strtodate($str_show_day);
	if (($timestamp =  date_timestamp_get($showday)) == false) {
		echo 1;
		$ret["error"] = array("ErrorCode"=>"NotVolidDateTimeFormat","ErrorMsg"=>msg("notvoliddatetimeformat")) ;//替换成
	}
	else
	{
		
		$dataformat = GetCalendarViewFormat($view_Type ,$timestamp);
		$qstart = $dataformat['start_date'] +$zonediff*3600;
		$qend = $dataformat['end_date'] +$zonediff*3600;		
		//查询数据库 GetClientIP();
		// {"start":start,"end":end,"error":error,"issort":issort,"events":jsonlist}
		$ret["start"] = TimestampToJsonTime($dataformat['start_date']);
		$ret["end"] = TimestampToJsonTime( $dataformat['end_date']);
		
		$ret["error"] =NUll;
		$ret["issort"] =TRUE;
		//print_r($ret);	
		$ret["events"] = DbQueryCalendars(date("Y-m-d H:i:s",$qstart),date("Y-m-d H:i:s",$qend),GetClientIP(),$zonediff);	
		
	}
	echo json_encode($ret);
}
function DbDeleteCalendar($id)
{
	$db = db_connect();
	$id = safeparam($id);
	$sql = "delete from  calendar where Id={$id}";

	$affected_rowscount =$db->exec($sql);
	
	if($affected_rowscount>0)
	{
		return $affected_rowscount;
	}		
	return -1;
}
function DbUpdateCalendar($id,$subject,$category)
{
	$db = db_connect();
	$sql = "UPDATE calendar set Subject='{$subject}', Category='{$category}'  where Id={$id}";
	$affected_rowscount =$db->exec($sql);	
	
	if($affected_rowscount>0)
	{
		return $affected_rowscount;
	}	
	return -1;
}
function DbInsertCalendar($cal)
{
	$db = db_connect();
	
	$sql = "INSERT INTO calendar (Subject,Location,MasterId,Description,
				CalendarType,StartTime,EndTime,IsAllDayEvent,HasAttachment,
				Category,InstanceType,Attendees,AttendeeNames,OtherAttendee,
				UPAccount,UPName,UPTIME) 
				VALUES  ('".IsNullThenEmpty($cal,"Subject")."',
				'".IsNullThenEmpty($cal,"Location")."',{$cal["MasterId"]},
				'".IsNullThenEmpty($cal,"Description")."',{$cal["CalendarType"]}
				,'".$cal["StartTime"]->format('Y-m-d')."','".$cal["EndTime"]->format('Y-m-d')."',".IsNullThenFalse($cal,"IsAllDayEvent")."
				,".IsNullThenFalse($cal,"HasAttachment").",'".IsNullThenEmpty($cal,"Category")."'
				,0,'".IsNullThenEmpty($cal,"Attendees")."','".IsNullThenEmpty($cal,"AttendeeNames")."'
				,'".IsNullThenEmpty($cal,"OtherAttendee")."','".IsNullThenEmpty($cal,"UPAccount")."',
				'".IsNullThenEmpty($cal,"UPName")."',now())";
	$ret =-1;
	
	$affected_rowscount =$db->exec($sql);
	
	if($affected_rowscount>0)
	{
		$ret =$db->lastInsertId();
	}		

	return $ret;
}
function IsNullThenEmpty($arr,$key)
{
	if(isset($arr[$key]))
	{
		return safeparam($arr[$key]);		
	}	
	else 
	{
		return "";
	}
}
function IsNullThenFalse($arr,$key)
{
	if(isset($arr[$key]))
	{
		return $arr[$key];
	}	
	else 
	{
		return 0;	
	}
}
function DbQueryCalendars($qstart,$qend,$userId,$zonediff)
{
	@session_start();
	$userid=$_SESSION['id'];
	$role=$_SESSION['role'];
	$pid=$_SESSION['pid'];
	$nu=$_SESSION['nu'];
	$db = db_connect();		
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
	
	if($result)
	{
		//echo date("ymd",$row["StartTime"]);
		//echo date("ymd",$row["EndTime"]);		
		foreach ($result as $row) {
			if($role==0){	
			$username=$row["realname"].":".$row["Subject"];
			}
			else{
				$username=$row["Subject"];
			}
			$ret[] = array(
				$row["Id"],$username,
				TimeToJsonTime($row["StartTime"]),
				TimeToJsonTime($row["EndTime"]),
				$row["IsAllDayEvent"],
				TimeToTimeStringFormat($row["StartTime"],"Ymd")==TimeToTimeStringFormat($row["EndTime"],"Ymd")? 0:1,
				1,
				$row["Category"]=="1"?1:0,1,$row["Attendees"],$row["Location"]
			);		
		}		
		
	}
	return $ret;
}

?>
