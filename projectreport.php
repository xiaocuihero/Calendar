<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>项目报告</title>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="laydate.js"></script>
<script type="text/javascript"> 
var rid=0;
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
function updatereport(id)
{
	var url="selectreportbyid.php";
	var data ={id:id};
	var arraydata=new Array();;
	$.ajax({
		   type: "GET",
		   url: url,
		   data: data,
		   success: function (msg) {	                   
			if(msg!="")
			{
			arraydata=msg.split(",");
			document.getElementById("reportinfo").value=arraydata[0];
			document.getElementById("reportdate").value=arraydata[1];
			document.getElementById("projectstatus").selectvalue=arraydata[2];
			document.getElementById("projectprogress").value=arraydata[3];
			document.getElementById("remainwork").value=arraydata[4];
			document.getElementById("monthplan").value=arraydata[5];
			document.getElementById("returnmoney").value=arraydata[6];
			document.getElementById("reportclass").value=arraydata[7];
			document.getElementById("idd").value=arraydata[8];
			document.getElementById("btnadd").value="更新报告";
			}				
		   }
		});
}
function confirmd() {  
var msg = "您真的确定要删除报告吗？";  
if (confirm(msg)==true){ 
return true;  
}else{  
return false;  
}  
}
function save() {//大专业改变时查询具体专业，并填充具体专业下拉框
	var url1=this.location.href;
	var projectid=url1.substr(url1.indexOf('=')+1);
     var url = "addprojectreport.php";
	 var url2 = "updateprojectreport.php";
	 var reportinfo = document.getElementById("reportinfo").value;
     var reportdate = document.getElementById("reportdate").value;
	 var reportclass = document.getElementById("reportclass").value;	 
     var returnmoney = document.getElementById("returnmoney").value;
	 var projectprogress = document.getElementById("projectprogress").value;
	 var remainwork = document.getElementById("remainwork").value; 	
     var monthplan = document.getElementById("monthplan").value;
	 var projectstatus = document.getElementById("projectstatus").value;
	 var btntext=document.getElementById("btnadd").value;
	 var id=document.getElementById("idd").value;
	 if(reportinfo=="")
	 {
	 alert("请填写项目名称！");
	 return;
	 }
	 if(btntext=="添加新的报告")
	 {
      var data ={
	               reportinfo: reportinfo,
                   reportdate:reportdate,
                   projectstatus:projectstatus,
                   reportclass:reportclass,
                   returnmoney:returnmoney,
				   projectprogress:projectprogress,
                   remainwork:remainwork,
                   monthplan:monthplan,
                   projectid:projectid
	           };
	           $.ajax({
	               type: "GET",
	               url: url,
	               data: data,
	               success: function (msg) {
	                   alert("添加成功！");
					   window.location.reload();
	               }
				   
	           });
			   }
			   else{
				   var data ={
					id:id,
	               reportinfo: reportinfo,
                   reportdate:reportdate,
                   projectstatus:projectstatus,
                   reportclass:reportclass,
                   returnmoney:returnmoney,
				   projectprogress:projectprogress,
                   remainwork:remainwork,
                   monthplan:monthplan,
                   projectid:projectid
	           };
	           $.ajax({
	               type: "GET",
	               url: url2,
	               data: data,
	               success: function (msg) {
	                   alert("更新成功！");
					   window.location.reload();
	               }
				   
	           });
			   }
 }  
</script> 
<style type="text/css">
*{margin:0;padding:0;list-style:none;}
html{background-color:#E3E3E3; font-size:14px; color:#000; font-family:'微软雅黑'}
h2{line-height:30px; font-size:20px;}
a,a:hover{ text-decoration:none;}
pre{font-family:'微软雅黑'}
.box{width:100%; padding:10px 20px; background-color:#fff;margin:10px auto; }
.box a{padding-right:20px;}
.demo1,.demo2,.demo3,.demo4,.demo5,.demo6{margin:25px 0;}
h3{margin:10px 0;}
.layinput{height: 22px;line-height: 22px;width: 150px;margin: 0;}
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

</head>
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
$pid="";
$pid=$_GET['pid'];
$con = mysqli_connect('localhost', 'sa', '123456', 'calendardb');
mysqli_query($con,"set names 'utf8'");
if (!$con)
	{
	die('Could not connect: ' . mysqli_error());
	}
$sql = "SELECT * FROM `projectreport` WHERE projectid=".$pid;
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
	//$href2="projectreport.php?rid=".$id;
	$test="deletereport(".$id.")";
	$update="updatereport(".$id.")";
?>
<tr> 
<td class="row"><?php echo date("Y-m-d",strtotime($reportdate)) ?></td> 
<td class="row" width="400"><?php echo $reportcontent ?></td> 
<td class="row"><?php echo $projectstatus ?></td> 
<td class="row"><?php echo $projectprogress ?></td>
<td class="row"><?php echo $remainwork ?></td> 
<td class="row"><?php echo $monthplan ?></td> 
<td class="row"><?php echo $returnmoney ?></td>
<td class="row"><?php echo $reportclass ?></td> 
<td class="row"><a href="javascript:void(0)"  onclick="<?php echo $test ?>" >删除</a>           	<a href="javascript:void(0)" onclick="<?php echo $update ?>" >编辑</a></td>  
</tr> 
<?php
	}
	mysqli_close($con);  
?>

</table> 
<div class="box">
报告内容：<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="reportinfo" id="reportinfo" cols="150" rows="5"></textarea><br/><br/>
报告时间：<input class="laydate-icon" id="reportdate" value=<?php echo date('Y-m-d',time()) ?>> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input class="text" id="idd"  style="width:0;height:0;visibility:hidden;"  value="">
项目状态：<select id="projectstatus"  name="projectstatus">
        <option value="1" >进行中</option>				
		<option value="2" >已完结</option>
		<option value="3" >暂停</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
报告类型：<select id="reportclass"  name="reportclass">
        <option value="0" >计划</option>
		<option value="1" selected="selected" >完成</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
回款情况：<input type="text" id="returnmoney" name="returnmoney" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
项目进度：<input type="text" id="projectprogress" name="projectprogress" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
剩余工作量：<input type="text" id="remainwork" name="remainwork" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
本月计划：<input type="text" id="monthplan" name="monthplan" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="btnadd" type="button" value="添加新的报告" onclick="save()" />&nbsp;&nbsp;&nbsp;&nbsp;
</div>

<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#reportdate'});//绑定元素
}();


</script>
</body>
</html>