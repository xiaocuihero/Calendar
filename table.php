
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" /> 
    <script type="text/javascript" src="jquery.min.js">
    </script>
<title>项目列表</title> 
</head> 
<style type="text/css"> 
body { 
font: normal 11px auto "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #4f6b72; 
background: #E6EAE9; 
} 

a { 
color: #c75f3e; 
} 

#mytable { 
width: 100%; 
padding: 0; 
margin: 0; 
} 

caption { 
padding: 0 0 5px 0; 
width: 100%; 
font: italic 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
text-align: right; 
} 

th { 
font: bold 11px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #4f6b72; 
border-right: 1px solid #C1DAD7; 
border-bottom: 1px solid #C1DAD7; 
border-top: 1px solid #C1DAD7; 
letter-spacing: 2px; 
text-transform: uppercase; 
text-align: left; 
padding: 6px 6px 6px 12px; 
background: #CAE8EA  no-repeat; 
} 

th.nobg { 
border-top: 0; 
border-left: 0; 
border-right: 1px solid #C1DAD7; 
background: none; 
} 

td { 
border-right: 1px solid #C1DAD7; 
border-bottom: 1px solid #C1DAD7; 
background: #fff; 
font-size:11px; 
padding: 6px 6px 6px 12px; 
color: #4f6b72; 
} 


td.alt { 
background: #F5FAFA; 
color: #797268; 
} 

th.spec { 
border-left: 1px solid #C1DAD7; 
border-top: 0; 
background: #fff no-repeat; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
} 

th.specalt { 
border-left: 1px solid #C1DAD7; 
border-top: 0; 
background: #f5fafa no-repeat; 
font: bold 10px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
color: #797268; 
} 
/*---------for IE 5.x bug*/ 
html>body td{ font-size:11px;} 
body,td,th { 
font-family: 宋体, Arial; 
font-size: 12px; 
} 
</style>
<body> 
<table id="mytable" cellspacing="0"> 
<caption>项目列表</caption> 
<th scope="col">项目名称</th> 
<th scope="col">项目内容</th> 
<th scope="col">项目规模</th>
<th scope="col">预计开始时间</th> 
<th scope="col">预计结束时间</th> 
<th scope="col">实际开始时间</th> 
<th scope="col">实际结束时间</th>
<th scope="col">操作</th>  
<?php
session_start();
$id1="";
$id1=$_SESSION['id']; 
$b="<script>document.write(aa);</script>";
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
	die('Could not connect: ' . mysqli_error());
	}
$sql = "SELECT * FROM `project` WHERE projectmonitorid=$id1";
$result=mysqli_query($con,$sql);
$s="<script type=text/javascript>document.write(s)</script>"; 
while($row = mysqli_fetch_row($result)){
	$projectname=$row[1];
	$projectcontent=$row[2];
	$site=$row[9];
	$prestartdate=$row[4];
	$preenddate=$row[5];
	$startdate=$row[6];
	$enddate=$row[7];
	$id=$row[0];
	$href1="xgcalendar-master/example/php/index.php?pid=".$id;
	$href2="projectreport.php?pid=".$id;
?>
<tr> 
<td class="row"><?php echo $projectname ?></td> 
<td class="row"><?php echo $projectcontent ?></td> 
<td class="row"><?php echo $site ?></td> 
<td class="row"><?php echo $prestartdate ?></td>
<td class="row"><?php echo $preenddate ?></td> 
<td class="row"><?php echo $startdate ?></td> 
<td class="row"><?php echo $enddate ?></td> 
<td class="row" align="center"><a href=<?php echo $href1 ?> >日志</a>           	<a href=<?php echo $href2 ?> >项目报告</a></td>  
</tr> 
<?php
	}
	mysqli_close($con);
$id1="";
$id1=$_SESSION['id'];
	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
	die('Could not connect: ' . mysqli_error());
	}
	$para="";			  
$sql = "SELECT * FROM `project` where projectmonitorid='".$id1."'";
  $result1=mysqli_query($con,$sql);
  if($result1 !=null)
  {
  while ($row = mysqli_fetch_row($result1)) {   
  	$para.=$row[0].',';
			  }
  }
  $para=substr($para,0,-1);
  echo $s."<br/>";
  $s1="";
  $s1=$s;
  echo $s1."<br/>";
  if($s1==4){
	$sql = "SELECT * FROM `project` WHERE id not in (".$para.")";  
  }
  else
  {
	$sql = "SELECT * FROM `project` WHERE id not in (".$para.")";    
  }
echo $sql;
$result2=mysqli_query($con,$sql);
if($result2 !=null)
  {
while($row = mysqli_fetch_row($result2)){
	$projectname=$row[1];
	$projectcontent=$row[2];
	$site=$row[9];
	$prestartdate=$row[4];
	$preenddate=$row[5];
	$startdate=$row[6];
	$enddate=$row[7];
	$id=$row[0];
	$href1="xgcalendar-master/example/php/index.php?pid=".$id;
?>
<tr> 
<td class="row"><?php echo $projectname ?></td> 
<td class="row"><?php echo $projectcontent ?></td> 
<td class="row"><?php echo $site ?></td> 
<td class="row"><?php echo $prestartdate ?></td>
<td class="row"><?php echo $preenddate ?></td> 
<td class="row"><?php echo $startdate ?></td> 
<td class="row"><?php echo $enddate ?></td> 
<td class="row" align="center"><a href=<?php echo $href1 ?> >日志</a></td>  
</tr> 
<?php
  }
  }
	mysqli_close($con);
?>
</table> 
</body> 
</html>