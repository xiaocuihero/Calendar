<?php
$dt="";
$dt=$_GET['cdate'];
$categoryValue = 0;
$categoryValue = $_GET['category'];
$dt1=date('Y-m-d H:i:s',strtotime($dt));
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
$para="";
mysqli_query($con,"set names 'utf8'");
if (!$con)
{
	die('Could not connect: ' . mysqli_error());
}

$sql = "SELECT u.realname,group_concat(concat(p.projectname,'：',c.`Subject`)separator '<br/><br/>'), c.Category FROM `calendar` c left join `user` u on c.UPAccount=u.id left join `project` p on p.id=c.Location where c.StartTime='".$dt1."' and c.Category='".$categoryValue."' group by c.`UPAccount`";

$result=mysqli_query($con,$sql);
if($result !=null)
{
	while ($row = mysqli_fetch_row($result)) {
		$para.=$row[0].'8FyRQoC7xr'.$row[1].'8FyRQoC7xr'.$row[2].'||';
	}
}
mysqli_close($con);
echo $para;

?>