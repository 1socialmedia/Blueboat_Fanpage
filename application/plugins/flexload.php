<script>

$(document).ready(function() {
		$(".home_bar").hide();
		$(".home_bar2").hide();
		$(".content").hide();
		$(".content-merken").hide();
		$(".slider_wrap").hide();
		$(".slider").hide();
		$(".slider_sidebar").hide();
		
		$(".slider_wrap").delay(300).fadeIn(900);
		$(".slider").delay(400).fadeIn(900);
		$(".slider_sidebar").delay(400).fadeIn(900);
		
		$(".home_bar").delay(600).slideDown(900);
		$(".home_bar2").delay(800).slideDown(900);
		$(".content").delay(900).slideDown(900);

	$(".home_button").click(function() {
		$(".home_bar").slideUp(900);
		$(".home_bar2").delay(400).slideUp(900);
		$(".content").delay(400).slideUp(900);
		$('.content-merken').delay(300).load('http://1socialmedia.nl/facebook-cms/sites/stefstore/application/views/merken-page.php');
		$(".content-merken").delay(910).fadeIn(900);
	});
	
	$(".terug").click(function() {
	    $(".content-merken").delay(110).slideUp(900);
		$(".home_bar").slideDown(900);
		$(".home_bar2").delay(400).slideDown(900);
		$(".content").delay(400).slideDown(900);
		
	});
	
	
	
});
</script>