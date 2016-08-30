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
<script type="text/javascript">


	function GetQueryString(name)
	{
		var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
		var r = window.location.search.substr(1).match(reg);
		if(r!=null)return  unescape(r[2]); return null;
	}
	function setuserlist() {
		document.getElementById("person").value=GetQueryString("u");	
		document.getElementById("projectstatus").value=GetQueryString("s");			
	}
	function onchangestatus() {
		var s=document.getElementById("projectstatus").value;
		var u=document.getElementById("person").value;
		window.location.href="projectinfolistm.php?s="+s+"&u="+u;
	}
</script>
<body onload="setuserlist()">
	<span>项目状态：</span><select id="projectstatus" name="projectstatus" onchange="onchangestatus()">
	<option value="1">正在进行</option>
	<option value="4">全部</option>
	<option value="2">已完结</option>
	<option value="3">暂停</option>           
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span>参与状态：</span><select id="person" onchange="onchangestatus()" name="person">
<option value="0">参与</option>
<option value="2">全部</option>			
<option value="1">未参与</option>			
</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="calendarlist.php" >日志列表</a><br /> 
<table id="mytable" cellspacing="0"> 
	<caption>项目列表</caption> 
	<th scope="col">项目名称</th> 
	<th scope="col" style="width:30%">项目内容</th> 
	<th scope="col">项目规模</th>
	<th scope="col">合同费用 [已付款]</th> 
	<th scope="col">项目负责人</th>
	<th scope="col">项目参与人</th>  
	<th scope="col">起止时间</th> 
	<th scope="col">当前进度</th>
	<th scope="col">操作</th>
	<?php
	session_start();
	$id1="";
	$id1=$_SESSION['id'];
	$s=1; 
	$s=$_GET['s'];
	$u=2; 
	$u=$_GET['u'];
	if($u!=1)
	{
		$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
		mysqli_query($con,"set names 'utf8'");
		if (!$con)
		{
			die('Could not connect: ' . mysqli_error());
		}
		if($s==4){
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.projectmonitorid=$id1";
		}
		else
		{
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.projectmonitorid=$id1 and p.status=$s";
		}
		$result=mysqli_query($con,$sql);
		if($result!=null)
		{
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
				$href1="xgcalendar-master/example/php/index.php?pid=".$id;
				$href2="projectreport.php?pid=".$id;
				?>
				<tr> 
                        <td class="row"><?php echo $projectname ?></td> 
                        <td class="row"><?php echo $projectcontent ?></td> 
                        <td class="row"><?php echo $site ?></td> 
                        <td class="row">
                            <?php
                            $returnmoneyTemp = "未付款";
                            if ($returnmoney != "" && $returnmoney != null){
                                $returnmoneyTemp = $returnmoney;
                            }
                            echo $charge."  [".$returnmoneyTemp."]";
                            ?>
                        </td>
                        <td class="row"><?php echo $realname ?></td> 
                        <td class="row"><?php echo $cname ?></td> 
                        <td class="row"><?php echo $pdate ?></td>
                        <td class="row"><?php echo $pprogress ?></td>
                        <td class="row" align="center"><a href=<?php echo $href1 ?> >日志</a>           	<a href=<?php echo $href2 ?> >项目报告</a></td>  
				</tr> 
				<?php
			}
		}
		mysqli_close($con);

	}
	$id1="";
	$id1=$_SESSION['id'];
	$s=1; 
	$s=$_GET['s'];
	$u=2; 
	$u=$_GET['u'];
	$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
	mysqli_query($con,"set names 'utf8'");
	if (!$con)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$para="-1,";
	$para1="-1,";
	$sql1 = "SELECT * FROM `calendar` where UPAccount='".$id1."'";
	$result1=mysqli_query($con,$sql1);
	if($result1 !=null)
	{
		while ($row = mysqli_fetch_row($result1)) {   
			$para.=$row[2].',';
		}
	}
	$para=substr($para,0,-1);
	$sql2 = "SELECT * FROM `project` where projectmonitorid='".$id1."'";
	$result1=mysqli_query($con,$sql2);
	if($result1 !=null)
	{
		while ($row = mysqli_fetch_row($result1)) {   
			$para1.=$row[0].',';
		}
	}
	$para1=substr($para1,0,-1);
	if($u==0)
	{
		
		if($s==4){
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id in (".$para.") and p.id not in(".$para1.")";  
		}
		else
		{
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id in (".$para.") and p.status=$s and p.id not in(".$para1.")";    
		}
	}
	else if($u==2)
	{
		
		if($s==4){
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id not in (".$para1.")";  
		}
		else
		{
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id not in (".$para1.") and p.status=$s";    
		}
	}
	else
	{
		if($s==4){
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id not in (".$para.") and p.id not in(".$para1.")";  
		}
		else
		{
			$sql = "SELECT p.`id`, p.`projectname`, p.`projectcontent`, p.`projectmonitorid`, p.`charge`, concat(p.`startdate`,'~', p.`enddate`), p.`status`, p.`site`,p.`contract`,u.`realname`,m.`progress`,m.`remainwork`,m.`returnmoney`,un.`cname` FROM `project` p left join `user` u on p.`projectmonitorid`=u.`id` left join (SELECT `projectid`,max(`progress`) progress, `remainwork`, `monthplan`, `returnmoney` FROM `projectreport` WHERE `flag`=1 group by `projectid`) m on p.id=m.projectid left join (SELECT `Location`,group_concat(distinct u.realname) cname FROM `calendar` c left join `user` u on c.UPAccount=u.id group by c.`Location`) un on p.id=un.Location WHERE p.id not in (".$para.") and p.status=$s and p.id not in(".$para1.")";    
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
			$href1="xgcalendar-master/example/php/index.php?pid=".$id;
			?>
			<tr> 
				<td class="row"><?php echo $projectname ?></td> 
				<td class="row"><?php echo $projectcontent ?></td> 
				<td class="row"><?php echo $site ?></td> 
				<td class="row">
					<?php
					$returnmoneyTemp = "未付款";
					if ($returnmoney != "" && $returnmoney != null){
						$returnmoneyTemp = $returnmoney;
					}
					echo $charge."  [".$returnmoneyTemp."]";
					?>
				</td>
				<td class="row"><?php echo $realname ?></td> 
				<td class="row"><?php echo $cname ?></td> 
				<td class="row"><?php echo $pdate ?></td>
				<td class="row"><?php echo $pprogress ?></td>
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