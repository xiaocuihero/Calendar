<?php
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
$para="";
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}

$sql = "SELECT * FROM `user` ";
$result=mysqli_query($con,$sql);
  if($result !=null)
  {
  while ($row = mysqli_fetch_row($result)) {
	$para.=$row[0].','.$row[3].';';
	}
  }
mysqli_close($con);  
echo $para;
?>