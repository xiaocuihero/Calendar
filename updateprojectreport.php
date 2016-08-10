<?php
	$id="";
	$id=$_GET['id'];
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
	  $sql="UPDATE `projectreport` SET `reportcontent`='$reportinfo',`reportdate`='$reportdate',`status`='$projectstatus',`progress`='$projectprogress',`remainwork`='$remainwork',`monthplan`='$monthplan',`returnmoney`='$returnmoney',`flag`='$reportclass' WHERE `id`='$id'";
	   if(mysqli_query($con,$sql))
		  {
			  echo ($sql);
			}
		else
		{
		echo($sql);
		}	
	mysqli_close($con);	
	
?>