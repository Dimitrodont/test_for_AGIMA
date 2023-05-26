console.log("include basket.js");

$(document).ready(function(){
	var basket_view = $(".basket_view");
	var basketSize = $(".basket_size");

	$(".manager").click(function(){
		basket_view.load("../basket_table.php", {id: $(this).attr("id"), char: $(this).val()});
		basketSize.load("../includes/add_item_inc.php");
	});
});