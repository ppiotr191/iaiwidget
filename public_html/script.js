$(function(){
	$("#iai-widget-form").submit(function(e){
		e.preventDefault();
		$('.iai-widget-result').html(`<div class="spinner"></div>`);
		$("#iai-widget-form button").prop('disabled', true);
		$.getJSON("form.php", $(this).serialize()).then(function(result){
			$("#iai-widget-form button").prop('disabled', false);
			if (result.found){
				$(".iai-widget-result").html(`
				<div class="alert alert-success" role="alert">
					Status: <strong>${result.status}</strong>
				</div>`);
				return false;
			}
			$(".iai-widget-result").html(`
			<div class="alert alert-info" role="alert">
				${result.msg}
			</div>`);
		});
	});
});