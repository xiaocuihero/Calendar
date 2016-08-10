<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" /> 
<title>项目列表</title> 
</head>
    <script type="text/javascript" src="jquery.min.js">
    </script>
<script type="text/javascript"> 
	function GetQueryString(name)
	{
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
	}
	function setuserlist() {
		var url = "getuserbydepartment.php?d="+GetQueryString("d");
		$.ajax({
			type: "GET",
			url: url,
			success: function (msg) {
				var arr=msg.split(";");
				for(var i=0;i<arr.length;i++){
				arr1=arr[i].split(',');
				var newItem=new Option(arr1[1],arr1[0]);
				document.getElementById("person").options.add(newItem);
				}
				document.getElementById("person").value=GetQueryString("u");
			}

		});			
		document.getElementById("projectstatus").value=GetQueryString("s");
		document.getElementById("department").value=GetQueryString("d");		
	}
	
    function onchangestatus(m) {
			if(m==1)
			{
				var d=document.getElementById("department").value;
				var s=1;
				var u=0;
				window.location.href="projectinfolist.php?s="+s+"&u="+u+"&d="+d;
			}
			else 
			{
				var s=document.getElementById("projectstatus").value;
				var u=document.getElementById("person").value;
				var d=document.getElementById("department").value;
				window.location.href="projectinfolist.php?s="+s+"&u="+u+"&d="+d;
			}
	 
        }
</script>		
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
<body onload="setuserlist()">
<span>部门：</span><select id="department" name="department" onchange="onchangestatus(1)">
            <option value="0">公司</option>
            <option value="1">市场部</option>
            <option value="2">BIM部</option>
            <option value="3">互动媒体部</option>
            <option value="4">GIS部</option>
            <option value="5">研发部</option>
            <option value="6">综合部</option>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>项目状态：</span><select id="projectstatus" name="projectstatus" onchange="onchangestatus(2)">
			<option value="1">正在进行</option>
			<option value="4">全部</option>
            <option value="2">已完结</option>
            <option value="3">暂停</option>           
        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>参与人员：</span><select id="person" name="person" onchange="onchangestatus(3)">
            <option value="0"></option>                     
        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="calendarlist.php" >日志列表</a><br /> 
<table id="mytable" cellspacing="0"> 
<caption>项目列表</caption> 
<th scope="col">项目名称</th> 
<th scope="col">项目内容</th> 
<th scope="col">项目规模</th>
<th scope="col">合同费用</th> 
<th scope="col">项目负责人</th>
<th scope="col">项目参与人</th>  
<th scope="col">起止时间</th> 
<th scope="col">当前进度</th>
<th scope="col">已收费</th>
<th scope="col">操作</th>
<?php
$s=1; 
$s=$_GET['s'];
$u=0; 
$u=$_GET['u'];
$d=0; 
$d=$_GET['d'];

$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
{
die('Could not connect: ' . mysqli_error());
}
if($u!=0)
{
	if($s==4){
		
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.projectmonitorid=$u";	
		
	}
	else
	{
		
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.status=$s and p.projectmonitorid=$u";
		
	}
}
else
{
	
		$para6="-1,";
		$para4="-1,";
		if($d!=0)
		{
		$sql6 = "SELECT * FROM `user` where department='".$d."'";
		}
		else
		{
			$sql6 = "SELECT * FROM `user`";
		}
		$result1=mysqli_query($con,$sql6);
		if($result1 !=null)
		{
		while ($row = mysqli_fetch_row($result1)) {   
		$para6.=$row[0].',';
				  }
		}
		$para6=substr($para6,0,-1);
		$sql5 = "SELECT * FROM `project`  where projectmonitorid in(".$para6.")";
		$result1=mysqli_query($con,$sql5);
		if($result1 !=null)
		{
		while ($row = mysqli_fetch_row($result1)) {   
		$para4.=$row[0].',';
				  }
		}
		$para4=substr($para4,0,-1);
		if($s==4){
			
				$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id in(".$para4.")";			
			
		}
		else
		{
			
				$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.status=$s and p.id in(".$para4.")";
			
			
		}
	
}
$result=mysqli_query($con,$sql);
if($result!=null){
while($row = mysqli_fetch_row($result)){
	$projectname=$row[1];
	$projectcontent=$row[2];
	$site=$row[7];
	$pdate=$row[5];
	$cname=$row[13];
	$charge=$row[4];
	$pprogress=$row[10];
	$realname=$row[9];
	$returnmoney=$row[12];
	$id=$row[0];
	$href1="xgcalendar-master/example/php/index.php?pid=".$id."&nu=".$u;
	$href2="projectreport.php?pid=".$id;
?>
<tr> 
<td class="row"><?php echo $projectname ?></td> 
<td class="row"><?php echo $projectcontent ?></td> 
<td class="row"><?php echo $site ?></td> 
<td class="row"><?php echo $charge ?></td>
<td class="row"><?php echo $realname ?></td> 
<td class="row"><select id="cperson<?php echo $id ?>" name="cperson">                     
        </select>
 <script type="text/javascript"> 
 var cname="<?php echo  $cname; ?>";
 arr2=cname.split(',');
 for(var i=0;i<arr2.length;i++){
	var newItem=new Option(arr2[i],arr2[i]);
	document.getElementById("cperson<?php echo $id ?>").options.add(newItem);
}
 </script>

</td> 
<td class="row"><?php echo $pdate ?></td>
<td class="row"><?php echo $pprogress ?></td>
<td class="row"><?php echo $returnmoney ?></td>  
<td class="row" align="center"><a href=<?php echo $href1 ?> >日志</a>           	<a href=<?php echo $href2 ?> >项目报告</a></td>  
</tr> 
<?php
	}
	}
	mysqli_close($con);

$u="";
$u=$_GET['u'];
$s=1; 
$s=$_GET['s'];
$u=0; 
$u=$_GET['u'];
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
{
die('Could not connect: ' . mysqli_error());
}
$para="-1,";
$para1="-1,";
$para2="-1,";
$para3="-1,";
$sql1 = "SELECT * FROM `calendar` where UPAccount='".$u."'";
$result1=mysqli_query($con,$sql1);
if($result1 !=null)
{
while ($row = mysqli_fetch_row($result1)) {   
$para.=$row[2].',';
		  }
}
$para=substr($para,0,-1);
$sql2 = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location where p.projectmonitorid='".$u."'";
$result1=mysqli_query($con,$sql2);
if($result1 !=null)
{
while ($row = mysqli_fetch_row($result1)) {   
$para1.=$row[0].',';
		  }
}
$para1=substr($para1,0,-1);
$sql3 = "SELECT * FROM `user` where department='".$d."'";
$result1=mysqli_query($con,$sql3);
if($result1 !=null)
{
while ($row = mysqli_fetch_row($result1)) {   
$para2.=$row[0].',';
		  }
}
$para2=substr($para2,0,-1);
$sql4 = "SELECT * FROM `calendar` where UPAccount in(".$para2.")";
$result1=mysqli_query($con,$sql4);
if($result1 !=null)
{
while ($row = mysqli_fetch_row($result1)) {   
$para3.=$row[2].',';
		  }
}
$para3=substr($para3,0,-1);
$para4="";

$sql5 = "SELECT * FROM `project` where projectmonitorid in(".$para2.")";
$result1=mysqli_query($con,$sql4);
if($result1 !=null)
{
while ($row = mysqli_fetch_row($result1)) {   
$para4.=$row[1].',';
		  }
}
$para4=substr($para4,0,-1);
if($u==0)
{
	
  if($s==4){	
	$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location  where p.id not in(".$para4.")";  	
  }
  else
  {

	$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE  p.status=$s and p.id not in(".$para4.")";  
	
  }
}
else
{
	if($s==4){

		$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id in (".$para.")and p.id not in(".$para1.")";			
	  
	}
	else
	{
	$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id in (".$para.")and p.id not in(".$para1.") and p.status=$s";	
		
	}
}	

$result2=mysqli_query($con,$sql);
if($result2 !=null)
  {
while($row = mysqli_fetch_row($result2)){
	$projectname=$row[1];
	$projectcontent=$row[2];
	$site=$row[7];
	$pdate=$row[5];
	$cname=$row[13];
	$charge=$row[4];
	$pprogress=$row[10];
	$realname=$row[9];
	$returnmoney=$row[12];
	$id=$row[0];
	$href1="xgcalendar-master/example/php/index.php?pid=".$id."&nu=".$u;
	$href2="projectreport.php?pid=".$id;
?>
<tr> 
<td class="row"><?php echo $projectname ?></td> 
<td class="row"><?php echo $projectcontent ?></td> 
<td class="row"><?php echo $site ?></td> 
<td class="row"><?php echo $charge ?></td>
<td class="row"><?php echo $realname ?></td> 
<td class="row"><select id="cperson<?php echo $id ?>" name="cperson">                     
        </select>
 <script type="text/javascript"> 
 var cname="<?php echo  $cname; ?>";
 arr2=cname.split(',');
 for(var i=0;i<arr2.length;i++){
	var newItem=new Option(arr2[i],arr2[i]);
	document.getElementById("cperson<?php echo $id ?>").options.add(newItem);
}
 </script></td> 
<td class="row"><?php echo $pdate ?></td>
<td class="row"><?php echo $pprogress ?></td>
<td class="row"><?php echo $returnmoney ?></td>  
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