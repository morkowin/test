<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<meta charset="utf-8" />
	<link href="main.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		  $("#form_action").click(function() {
		   var name = $("#name").val();
		   var tel = $("#tel").val();
			if((name.length != 0) && (tel.length != 0)){
				 $.ajax({
					url: "server.php",
					type: "POST",
					dataType: "text",
					data: ("name="+name+"&tel="+tel),
					success: function(data){
						
					 if(data){
						 $("div.form_auth").remove();
						 $(".value").html("Данные успешно добавлены!");
					 }
					}
				});
			}
			else alert("Не заполненые данные!");
		  
		   });
		});
	</script>
</head>
<body>
		<div class="value"></div>
		<div class="form_auth">
			<div>
				<label for="name">Name: </label> <input type="text" id="name" placeholder="Name.." required/> 
			</div>
			<div>
				<label for="tel">Telephon: </label> <input type="tel" id="tel" placeholder="Telephon.." /> 
			</div>
			<div>
				<input type="submit" id="form_action" />
			</div>
		</div>	
</body>
</html>
