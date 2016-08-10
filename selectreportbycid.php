<?php
$id="";
$id=$_SESSION['id'];
	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	$para="";
	mysqli_query($con,"set names 'utf8'");
	if (!$con)
		{
			die('Could not connect: ' . mysqli_error());
		}

	$sql = "SELECT * FROM `projectreport` WHERE projectid=$id";
	$result=mysqli_query($con,$sql);
	  if($result !=null)
	  {
	  while ($row = mysqli_fetch_row($result)) {
		$para.=$row[2].','.$row[3].','.$row[4].','.$row[5].','.$row[6].','.$row[7].','.$row[8].','.$row[9].','.$row[0].",";
		}
	  }
	  mysqli_close($con);  
	  echo $para;
?>