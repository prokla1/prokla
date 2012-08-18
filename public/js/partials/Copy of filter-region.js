$(document).ready(function(){
	
	
	//$('#region-country, #region-state, #region-microregion, #region-city').ddslick();

	
	function populate(selector, values) {
		/*$.each(values, function(i, v) {
			$(selector).append('<option value="' + v + '">' + i + '</option>');
		});
		
			$.each(data.items, function(i,item){
				$("<img/>").attr("src", item.media.m).appendTo("#images");
					if ( i == 3 ) return false;
			});
	    		          
		*/
		$.each(values, function(key, value) { 
			console.log(value.text);
			console.log(value.value);
			console.log('==================');
		     $(selector)
		         .append($("<option></option>")
		         .attr("value",value.value)
		         .text(value.text)); 
		});
		
		$(selector).ddslick();

		
	}
	
	
/*
	var filtro = $('#filter-region-container');
	
	$('#region-country').ddslick({
	    selectText: "Selecione o pais",
	    	onSelected: function(data){
	            //console.log(data.selectedData.value);
	    		$.getJSON("/filter-region/get-states", { country: data.selectedData.value }, function(region_states){
	    			//populate($('#region-state'), region_states); //popula o form (envia o elemento e o array )
	    			
	    			console.log('tamanho: '+Object.keys(region_states).length)
	    		
	    			populate($('#region-state'), region_states)
//	    			$('#region-state').ddslick({
//	    				data:region_states,
//	    			});

	    		});
	        }
	});
*/
	/*
	 * 
	 * 
$('#region-state').on('change', function () {

*/
	
	/*
	$('#region-state').ddslick({
	    	onSelected: function(data){
	            //console.log(data.selectedData.value);
	    		$.getJSON("/filter-region/get-microregion", { state: data.selectedData.value }, function(region_microregion){
	    			//populate($('#region-state'), region_states); //popula o form (envia o elemento e o array )
	    		

	    			if(Object.keys(region_microregion).length > 0){
	    				$('#select-region-microregion').ddslick({
	    					data:region_microregion,
	    				});
	    			}else {
	    				$('#select-region-city').ddslick({
	    					data:region_microregion,
	    				});						
					}

	    		});
	        }
	});*/
/*
	*/

	
	
});