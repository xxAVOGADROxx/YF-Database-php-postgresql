$(document).ready(function(){


//code  (down) to use in the DGAC requirements
$("#add_product").on("submit",function(event){
	event.preventDefault();
	$(".overlay").show();
	$.ajax({
		url	:	"add_product.php", // se modifica el archivo add_product -> add_order
		method:	"POST",
		data	:$("#add_product").serialize(),
		success	:function(data){
			$(".overlay").hide();
			if(data == "add_success"){
				window.location.href = "sellprofile.php";
			}else{
				$("#msg_addproduct").html(data);

			}
		}
	})
})

//Get User Information in the homepage
$("#signup_form_home").on("submit",function(event){
	event.preventDefault();
	$(".overlay").show();
	$.ajax({
		url : "register.php",
		method : "POST",
		data : $("#signup_form_home").serialize(),
		success : function(data){
			$(".overlay").hide();
			if (data == "register_success") {
				window.location.href = "profile.php";
			}else{
				$("#signup_msg").html(data);
			}

		}
	})
})

})
//----------------------------------------
