<script>
	$("#gender_man").on( "click", function() {
			$(".hide").removeClass("hide");
			$(".woman").addClass("hide");
	});
	$("#gender_woman").on( "click", function() {
			$(".hide").removeClass("hide");
			$(".man").addClass("hide");
	});

	$('#item_img').error(function() {
		$('#item_img').attr('src', '/resource/images/subimage.jpg');
	});
	
	$('#imgsrc').keyup(function() {
		$('#item_img').attr('src', $('#imgsrc').val());
		Materialize.fadeInImage('#item_img');	
	});
</script>