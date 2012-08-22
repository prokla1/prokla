$(document).ready(function(){
	
	
	$('.li_category').live('click',function(){
		var id = $(this).attr('rel');
		console.log('id:'+id);

		$.getJSON("/filter-category/", { id: $(this).attr('rel') }, function(data){
			console.log(data);

			var subs = data.subs;
			if(subs.length > 0){
				var html = '<hr><ul rel="nivel_1">';
				$.each(subs, function(key, value) {
					html = html + '<li class="li_category" rel="' + value.id  + '"> ' + value.name  + '</li> '
				});
				html = html + '</ul>'
				$('#filter-category').append(html);
			}
				
				
				$.each(data.attribute, function(key, value) {
					console.log('data.attribute : ');
					console.log(value);
					var att = value.name + ':'
					if (value.type == 'text'){
						att = att + ' <input type="text" name="'+value.id+'" >';
						
					}else if (value.type == 'single') {
						//att = att + ''+ value.name+'';
						$.each(value.options, function(keyOpt, valueOpt){
							att = att + '<label><input type="radio" name="'+ value.id+'" value="'+ valueOpt.name+'">'+ valueOpt.name+'</label>';
						})

					}else { // value.type == 'multi'
						//att = att + ''+ value.name+'';
						$.each(value.options, function(keyOpt, valueOpt){
							att = att + '<label><INPUT TYPE="checkbox" NAME="'+ value.id+'" VALUE="'+ valueOpt.id+'">'+ valueOpt.name+'</label>';
						})						
					}
						
				
					$('#filter-category').append(att);
			});
				
		});	
	});
		
	
});