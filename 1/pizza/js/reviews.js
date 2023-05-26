console.log("include reviews.js");

$(document).ready(function(){
	var limit = 4;
	var loader = $(".reviews_loader");
	var comment = $("#comment");

	$("#submit").click(function(){
		if(comment.val()){
			loader.load("../includes/reviews_inc.php", {comment: comment.val()});
			comment.val("")
		}
	});

	$("#more").click(function(){
		loader.load("../includes/reviews_inc.php", {limit: (limit += 4)});
	});

	$(".rem_comm").click(function(){
		if(window.confirm("Удалить отзыв?")){
    		loader.load("../includes/reviews_inc.php", {rem: $(this).attr("id")});
		}
	});
});