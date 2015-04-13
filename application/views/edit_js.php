<script>

	var index = 0;
	var items = [];

	$("#gender_man").on( "click", function() {
		$(".hide").removeClass("hide");
		$(".woman").addClass("hide");
	});
	$("#gender_woman").on( "click", function() {
		$(".hide").removeClass("hide");
		$(".man").addClass("hide");
	});
	$(".add_item").on("click", function() {
		var class_id = $(this).attr('id');

		var type_id = $("input[name=type" + class_id + "]:checked").val();
		$("input[name=type" + class_id + "]:checked").prop( "checked", false );
		var color_id = $("input[name=color" + class_id + "]:checked").val();
		$("input[name=color" + class_id + "]:checked").prop( "checked", false );
		var pattern_id = $("input[name=pattern" + class_id + "]:checked").val();
		$("input[name=pattern" + class_id + "]:checked").prop( "checked", false );

		var class_label;
		var type_label;
		var color_label;
		var pattern_label;

		$.ajax({
			url:'/ajax/getItemAttributes',
			dataType:'json',
			success:function(data){
				for (var index in data['class'])
					if (data['class'][index].id == class_id)
						class_label = data['class'][index].label;
				for (var index in data['type'])
					if (data['type'][index].id == type_id)
						type_label = data['type'][index].label;
				for (var index in data['color'])
					if (data['color'][index].id == color_id)
						color_label = data['color'][index].label;
				for (var index in data['pattern'])
					if (data['pattern'][index].id == pattern_id)
						pattern_label = data['pattern'][index].label;

				$('#fashion').append(
				'<div class="col s3">' +
				'<div class="card blue-grey darken-1">' +
				'<div class="card-content white-text">' + 
				'<span class="card-title">' + class_label + '</span>' + 
				'<p>' + pattern_label + ' ' + color_label + ' ' + type_label + '</p>' + 
				'</div>' + 
				'<div class="card-action">' + 
				'<a href="#">This is a link</a>' + // TODO: Delete item
				'</div>' + 
				'</div>' + 
				'</div>'
				);

				var item = {
					'type_id':type_id,
					'color_id':color_id,
					'pattern_id':pattern_id
				};

				items.push(item);

				console.log('item', item);
				console.log('items', items);
			}
		});

		index++;		
	});

	$('#form').submit(function(event) {
		var form_data = $( this ).serializeArray();
		form_data.push({
			name:'items',
			value: items
		});
		
		$.ajax({
			url:'/ajax/addFashion',
			type:'post',
			data:'query=' + JSON.stringify(form_data),
			success:function(data) {
				window.location.replace("/graphic/feed");
			}
		});

		event.preventDefault();
	});

	$('#item_img').error(function() {
		$('#item_img').attr('src', '/resource/images/subimage.jpg');
	});
	
	$('#imgsrc').keyup(function() {
		$('#item_img').attr('src', $('#imgsrc').val());
		Materialize.fadeInImage('#item_img');	
	});

	$('.dropdown-button').dropdown({
		inDuration: 300,
		outDuration: 225,
		constrain_width: false, // Does not change width of dropdown to that of the activator
		hover: false, // Activate on hover
		gutter: 0, // Spacing from edge
		belowOrigin: true // Displays dropdown below the button
	});

	$(document).ready(function(){
		// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		$('.modal-trigger').leanModal();
	});

	$(document).ready(function() {
		$('select').material_select();
	});
</script>