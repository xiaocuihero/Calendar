<?php
    $mode="";
	$mode=$_GET['mode'];
    $calendarid="";
	$calendarid=$_GET['calendarid'];		
	$subject="";
	$subject=$_GET['subject'];
	$location="";
	$location=$_GET['location'];
	$masterid="";
	$masterid=$_GET['masterid'];
	$calendartype="";
	$calendartype=$_GET['calendartype'];
	$starttime="0000-00-00 00:00:00";
	$starttime=$_GET['starttime'];
	$endtime="0000-00-00 00:00:00";
	$endtime=$_GET['endtime'];
	$isalldayevent="";
	$isalldayevent=$_GET['isalldayevent'];
	$hasattachment="";
	$hasattachment=$_GET['hasattachment'];
	$instancetype="";
	$instancetype=$_GET['instancetype'];
	$upaccount="";
	$upaccount=$_GET['upaccount'];
	$upname="";
	$upname=$_GET['upname'];
	$Description="";
	$Category="";	
	$Attendees="";
	$AttendeeNames="";
	$OtherAttendee="";
	$starttime = date('Y-m-d H:i:s',strtotime($starttime));
	$endtime = date('Y-m-d H:i:s',strtotime($endtime));
	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	mysqli_query($con,"set names utf8");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	if($mode=="insert")			
	$sql = "INSERT INTO calendar (Subject,Location,MasterId,Description,CalendarType,StartTime,EndTime,IsAllDayEvent,HasAttachment,Category,InstanceType,Attendees,AttendeeNames,OtherAttendee,UPAccount,UPName,UPTIME) VALUES ('$subject','$location','$masterid','$Description','$calendartype','$starttime','$endtime','$isalldayevent','hasattachment','$Category','$instancetype','$Attendees','$AttendeeNames','$OtherAttendee','$upaccount','$upname','$starttime')";
	elseif($mode=="update")
	$sql = "UPDATE calendar set Subject='{$subject}',HasAttachment= 0 where Id={$calendarid}";
	else
	$sql = "delete from  calendar where Id={$calendarid}";
	
	  if (!mysqli_query($con,$sql))
	  {
       echo 0;
	  die('Error: ' . mysqli_error());
	  }
	  else
      {
		echo 1;	 
	  }
	mysqli_close($con);	
?>