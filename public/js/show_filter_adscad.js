$(document).ready(function(){
	$("#exibe_fcateg > div").hide();
		$("#sel_categ").change(function(){
				$("#exibe_fcateg > div").hide();
				$( '#'+$( this ).val() ).show('fast');
		});
		$("input[name='rd-categ']").click(function(){
				$("#exibe_fcateg > div").hide();
				$( '#'+$( this ).val() ).show('fast');
		});
});