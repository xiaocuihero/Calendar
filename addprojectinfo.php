<?php		
	//取楼层ID	
	$projectname="";
	$projectname=$_GET['projectname'];
	$projectcontent="";
	$projectcontent=$_GET['projectinfo'];
	$projectsite="";
	$projectsite=$_GET['projectsite'];
	$projectmonitor="";
	$projectmonitor=$_GET['projectmonitor'];
	$charge="";
	$charge=$_GET['charge'];
	$start1="";
	$start1=$_GET['start1'];	
	$end1="";
	$end1=$_GET['end1'];
	$contract="";
	$contract=$_GET['contract'];
	$projectstatus="";
	$projectstatus=$_GET['projectstatus'];
	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	mysqli_query($con,"set names 'utf8'");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  $sql="INSERT INTO `project`(`projectname`, `projectcontent`, `projectmonitorid`, `charge`, `startdate`, `enddate`, `status`, `site`, `contract`) VALUES ('$projectname','$projectcontent','$projectmonitor','$charge','$start1','$end1','$projectstatus','$projectsite','$contract')";
	  if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error());
	  }
	mysqli_close($con);	
	
?>