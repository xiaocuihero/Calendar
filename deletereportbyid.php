<?php
$id="";
$id=$_GET['id'];
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}

$sql = "DELETE FROM `projectreport` WHERE id=$id";
$affected_rowscount=mysqli_query($con,$sql);
	if($affected_rowscount>0)   
	{
	echo $affected_rowscount;	
	}
	else
	{
		echo -1;
	}					
  mysqli_close($con);  
?>