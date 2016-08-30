<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title></title>
	<script src="jquery.min.js" type="text/javascript"></script>
	<?php
	
	$id="";
	$id=$_GET['id'];
	$namestr="";
	$namestr=$_GET['name'];
	$category=$_GET['category'];
	echo"<script> var id1=\"$id\";var strname=\"$namestr\";var category1=\"$category\";</script>";
	
	?>
	<script type="text/javascript">	
		function changeTextArea(){
			var czcontent = strname.replace(/qYQVP9/g, String.fromCharCode(10));
			document.getElementById("myTextArea").value=czcontent;			
		}

		function save()
		{
			var newname=document.getElementById("myTextArea").value;
			// newname = newname.replace(/[\r\n]/g, ";");
			var url="calendar.php";
			var category1 = parseInt($("input[name=planOrFinishEdit]:checked").val());
			var data =
			{
				mode: "quickupdate",
				id:id1,
				strname:newname,
				category: category1
			};
			$.ajax({
				type: "GET",
				url: url,
				data: data,
				success: function (msg) {	                   
					window.close();
					window.parent.location.reload();   
				}
			});
		}
		function cancel()
		{
			window.close();
			window.parent.location.reload();	
		}
	</script>		
</head>
<body style ="height:100%;" onload="changeTextArea()" >
	<div id="modal-qrcode" style=" z-index: 1000;">		
		<p>日志内容：</p>
		<textarea name="myTextArea" id="myTextArea" cols="80" rows="10"></textarea><br/><br/>
		<form id="categoryFormEdit"> 
			计划 <input type="radio" name="planOrFinishEdit" value = "0">
			完成  <input type="radio" name="planOrFinishEdit" value = "1"> 
		</form>				 
		<br/>
		<button id="updatebtn" type="button" onclick="save()">保存</button> 
		<button id="cancelbtn" type="button" onclick="cancel()">取消</button>
	</div>	
	<script type="text/javascript">
		$("input[name=planOrFinishEdit][value=" + category1 + "]").attr("checked","checked");		
	</script>
</body>
</html>