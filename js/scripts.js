
function onChange() {
	var chbox;
	chbox=document.getElementById('cond');
	if (chbox.checked) {
		chbox=document.getElementById('regsub').disabled =false;		
	}
	else {
		chbox=document.getElementById('regsub').disabled =true;	
	}
}

$(document).ready(function(){
	$('#checkemail').on('click', function(e) {
		var email = $("#email").val();
		$.ajax({
			url: "checkemail.php",
			type: "POST",
			dataType: "text",
			data: ("email="+email),
			success: function(data){
				if(data){
					$("#resemail").css("color","#0f0");
					  $("#resemail").html("&nbsp;&nbsp;email is free");
				}else{
					$("#resemail").css("color","#f00");
					$("#resemail").html("&nbsp;&nbsp;email is not free");
					
				}
			}
		});
	});
	$('#checklogin').on('click', function(e) {
		var login = $("#login").val();
		$.ajax({
			url: "checklogin.php",
			type: "POST",
			dataType: "text",
			data: ("login="+login),
			success: function(data){
				if(data){
					$("#reslogin").css("color","#0f0");
					  $("#reslogin").html("&nbsp;&nbsp;login is free");
				}else{
					$("#reslogin").css("color","#f00");
					$("#reslogin").html("&nbsp;&nbsp;login is not free");
					
				}
			}
		});
	});
});