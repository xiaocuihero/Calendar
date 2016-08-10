<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html"; charset="utf-8" /> 
<title>项目报告列表</title> 
</head> 
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="laydate.js"></script>
<script type="text/javascript"> 
function deletereport(id)
{
	if(confirmd()==true)
	{
		var url="deletereportbyid.php";
		var data ={id:id};
		$.ajax({
		   type: "GET",
		   url: url,
		   data: data,
		   success: function (msg) {	                   
			window.location.reload();   
		   }
		});
	}
}
function confirmd() {  
var msg = "您真的确定要删除报告吗？";  
if (confirm(msg)==true){ 
return true;  
}else{  
return false;  
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

*{margin:0;padding:0;list-style:none;}
html{background-color:#E3E3E3; font-size:14px; color:#000; font-family:'微软雅黑'}
h2{line-height:30px; font-size:20px;}
a,a:hover{ text-decoration:none;}
pre{font-family:'微软雅黑'}
.box{width:970px; padding:10px 20px; background-color:#fff; margin:10px auto;}
.box a{padding-right:20px;}
.demo1,.demo2,.demo3,.demo4,.demo5,.demo6{margin:25px 0;}
h3{margin:10px 0;}
.layinput{height: 22px;line-height: 22px;width: 150px;margin: 0;}

</style> 
<body> 
<table id="mytable" cellspacing="0"> 
<caption>项目报告</caption> 
<th scope="col">报告时间</th> 
<th scope="col">报告内容</th> 
<th scope="col">项目状态</th>
<th scope="col">项目进度</th> 
<th scope="col">剩余工作量</th> 
<th scope="col">下月计划</th> 
<th scope="col">回款情况</th>
<th scope="col">报告类型</th>
<th scope="col">操作</th>   
<?php
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
	die('Could not connect: ' . mysqli_error());
	}
$sql = "SELECT * FROM `projectreport`";
$result=mysqli_query($con,$sql);
while($row = mysqli_fetch_row($result)){
	$reportdate=$row[3];
	$reportcontent=$row[2];
	$projectstatus=$row[4];
	$projectprogress=$row[5];
	$remainwork=$row[6];
	$monthplan=$row[7];
	$returnmoney=$row[8];
	$reportclass=$row[9];
	$id=$row[0];
	//$href1="xgcalendar-master/example/php/index.php?id=".$id;
	$href2="projectreport.php?rid=".$id;
	$test="deletereport(".$id.")";
?>
<tr> 
<td class="row"><?php echo $reportdate ?></td> 
<td class="row"><?php echo $reportcontent ?></td> 
<td class="row"><?php echo $projectstatus ?></td> 
<td class="row"><?php echo $projectprogress ?></td>
<td class="row"><?php echo $remainwork ?></td> 
<td class="row"><?php echo $monthplan ?></td> 
<td class="row"><?php echo $returnmoney ?></td>
<td class="row"><?php echo $reportclass ?></td> 
<td class="row"><a href="javascript:void(0)"  onclick="<?php echo $test ?>" >删除</a>           	<a href=<?php echo $href2 ?> >编辑</a></td>  
</tr> 
<?php
	}
	mysqli_close($con);  
?>

</table> 
<div class="box">
报告内容：<textarea name="projectinfo" id="projectinfo" cols="70" rows="10"></textarea><br/> 
报告时间：<div class="demo1"><input class="laydate-icon" id="demo" value="2014-6-25更新"> </div>
项目状态：<select id="projectstatus"  name="projectstatus">
        <option value="0" >未开始</option>
		<option value="1" >进行中</option>
		<option value="2" >已结束</option>
		</select><br/>
项目进度：<input type="text" id="projectsite" name="projectsite" /><br/>
剩余工作量：<input type="text" id="projectsite" name="projectsite" /><br/>
本月计划：<input type="text" id="projectsite" name="projectsite" /><br/>
回款情况：<input type="text" id="projectsite" name="projectsite" /><br/>
报告类型：<select id="projectstatus"  name="projectstatus">
        <option value="0" >计划</option>
		<option value="1" >完成</option>
		</select><br/>
		
</div>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();
</script>
</body> 
</html>