<?php		
	//取楼层ID
	$department="";
	$department=$_GET['department'];
	$position="";
	$position=$_GET['position'];
	$realname="";
	$realname=$_GET['realname'];
	$loginname="";
	$loginname=$_GET['loginname'];
	$password="";
	$password=$_GET['password'];

	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	mysqli_query($con,"set names 'utf8'");
	if (!$con)
	  {
	  die('Could not connect: ' . mysql_error());
	  }
	  $sql="INSERT INTO `user`(`name`, `password`, `realname`, `department`, `role`) VALUES ('$loginname','$password','$realname','$department','$position')";
	  if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error());
	  }
	mysqli_close($con);	
	
?>