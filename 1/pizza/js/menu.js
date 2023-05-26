console.log("include menu.js");

$(document).ready(function(){

	var basketSize = $(".basket_size");

	$(".add_button").click(function(){
		basketSize.load("../includes/add_item_inc.php", {id: $(this).attr("id")});
	});
	
});