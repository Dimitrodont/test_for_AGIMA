console.log("include profile.js");

$(document).ready(function(){
	var form = $("#form");
	var file = $("#file");

	form.submit(function(){
		if(file.val() == ""){
			file.css('color', 'red');
			return false;	
		}
		return true;
	});

	file.change(function(){
		file.css('color', 'black');
	});

	$(".more_info").click(function(){
		var loader = $("#" + $(this).attr("id") + "_loader");
		if($(this).val() == "+"){
			$(this).val("-");
			loader.load("includes/one_order_inc.php", {id: $(this).attr("id")});
		}else{
			$(this).val("+");
			loader.empty();
		}
		
	});
});