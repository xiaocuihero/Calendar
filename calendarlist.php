<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="xgcalendar-master/example/php/static/theme/Default/calendar.css" rel="stylesheet" type="text/css" /> 
	<title>日志列表</title> 
</head>
<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="laydate.js"></script>
<script type="text/javascript">
	function change() {	
		var url = "selectcalendar.php";
		var dt=document.getElementById("cdate").value;
		var categoryValue = parseInt($("input[name=planOrFinish]:checked").val());
		$("#mytable  tr:not(:first)").html("");
		var data =
		{
			cdate: dt,
      category: categoryValue
    };
    $.ajax({
     type: "GET",
     url: url,
     data: data,
     success: function (msg) {
      console.log(msg);
      var arr=msg.split('||');
      for(var i=0;i<arr.length-1;i++)
      {
       createTable(arr[i]);
     }
   }
 });	 
  }
  function createTable(s){
    var arr=s.split(/8FyRQoC7xr/);
    var table = document.getElementById("mytable");//创建table 
    var row = table.insertRow();//创建一行 
    var cell = row.insertCell();//创建一个单元 
    cell.width = "150";//更改cell的各种属性     
    cell.innerHTML=arr[0]; 
    cell = row.insertCell();//创建一个单元   	   
    cell.innerHTML=arr[1];

  }
  function click1(){
    document.getElementById("btn").click();
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
  font: bold 20px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
} 

th.specalt { 
  border-left: 1px solid #C1DAD7; 
  border-top: 0; 
  background: #f5fafa no-repeat; 
  font: bold 20px "Trebuchet MS", Verdana, Arial, Helvetica, sans-serif; 
  color: #797268; 
} 
/*---------for IE 5.x bug*/ 
html>body td{ font-size:15px;} 
body,td,th { 
  font-family: 宋体, Arial; 
  font-size: 20px; 
} 
</style> 
<body onload="change()">
 <div class="box">
  <input class="laydate-icon" id="cdate"  value="<?php echo date('Y-m-d',time()); ?>"/> 
  <input  id="btn"  onclick="change()" type="button" value="更新" /> 
  <br/>
  <br/>
  <form id="categoryForm"> 
    <input type="radio" name="planOrFinish" id="radioPlan" value = "0">计划    
    <input type="radio" name="planOrFinish" id="radioFinish" value = "1">完成  
  </form>
</div>
<table id="mytable" cellspacing="0"> 
  <caption>日志列表</caption> 
  <th scope="col">姓名</th> 
  <th scope="col">工作内容</th> 

</table> 

<script type="text/javascript">
  !function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#cdate'});//绑定元素
}();
</script>
<script type="text/javascript">
  var dateTime = new Date();
  if (dateTime.getHours() >= 17 && dateTime.getMinutes() >= 30){
    $("input[name=planOrFinish]:eq(1)").attr("checked","checked");
  }else{    
    $("input[name=planOrFinish]:eq(0)").attr("checked","checked");
  }
  $("#radioPlan").change(function () {    
    change();
  })
  $("#radioFinish").change(function () {    
    change();
  })
</script>
</body> 
</html>