<?php		
	$projectid="";
	$projectid=$_GET['projectid'];
	$reportinfo="";
	$reportinfo=$_GET['reportinfo'];
	$reportdate="";
	$reportdate=$_GET['reportdate'];
	$projectstatus="";
	$projectstatus=$_GET['projectstatus'];
	$reportclass="";
	$reportclass=$_GET['reportclass'];
	$returnmoney="";
	$returnmoney=$_GET['returnmoney'];
	$projectprogress="";
	$projectprogress=$_GET['projectprogress'];
	$remainwork="";
	$remainwork=$_GET['remainwork'];
	$monthplan="";
	$monthplan=$_GET['monthplan'];

	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	mysqli_query($con,"set names 'utf8'");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  $sql="INSERT INTO `projectreport`(`projectid`, `reportcontent`, `reportdate`, `status`, `progress`, `remainwork`, `monthplan`, `returnmoney`, `flag`) VALUES ('$projectid','$reportinfo','$reportdate','$projectstatus','$projectprogress','$remainwork','$monthplan','$returnmoney','$reportclass')";
	  if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error());
	  }
	mysqli_close($con);	
	
?>