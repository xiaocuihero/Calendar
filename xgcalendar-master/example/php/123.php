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

						  echo"<script> var id1=\"$id\";var strname=\"$namestr\";</script>";
		
		?>
		<script type="text/javascript">
		function changeTextArea(){
		document.getElementById("myTextArea").value=strname;
		}
		function save()
		{
			var newname=document.getElementById("myTextArea").value;
			var url="calendar.php";
			 var data =
					   {
						   mode: "quickupdate",
						   id:id1,
						   strname:newname,
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
				 <textarea name="myTextArea" id="myTextArea" cols="80" rows="10"></textarea><br/><br/><br/>				 
         <button id="updatebtn" type="button" onclick="save()">保存</button> 
		 <button id="cancelbtn" type="button" onclick="cancel()">取消</button>
        </div>	
<!--<script type="text/javascript" src="calendar.php?mode=quickupdate&id="+id1+"&strname="+strname ></script>-->

</body>
</html>