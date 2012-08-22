$(document).ready(function(){
	
	
	function populate(selector, values) {
		selector.empty();
		
		$.each(values, function(key, value) {
		     if(value.acronym){
			     $(selector)
		         .append($("<option></option>")
		         .attr("value",value.id)
		         .text('(DDD ' + value.acronym + ') ' + value.name + ' e região')); 
		     }else {
		    	 $(selector)
		    	 .append($("<option></option>")
		    			 .attr("value",value.id)
		    			 .text(value.name)); 
			}
		});
	}
	

	$('.select-onchange').on('change', function () {
		$.getJSON("/filter-region/get-region", { origin: $(this).attr('id'), value: $("option:selected", this).val() }, function(data){
			populate($('#'+data.destiny), data.values)
			
			$('#'+data.destiny).change();
			if(data.values.length == 0){
				$('#div-' + data.destiny).hide();
			}else{
				$('#div-' + data.destiny).show();
			}
				
		});	
	});
	
	//$('#region-country').change();  //inicia a função change no select
	



	
	
});