<?php
$userid="";
$userid=$_GET['userid'];		      
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
$para="";
if (!$con)
	{
	die('Could not connect: ' . mysqli_error());
	}			  
$sql = "SELECT * FROM `calendar` where userid='".$userid."'";
  $result=mysqli_query($con,$sql);
  if($result !=null)
  {
	  session_start(); //标志Session的开始 
  while ($row = mysqli_fetch_row($result)) {   
  	$para.=$row[1].',';
			  }
  }
  mysqli_close($con);  
  echo $para;		
?>