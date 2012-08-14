(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
  
$('#form_photo').ajaxForm({
	dataType:  'json',
	success: processJson,
    beforeSend: function() {
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
		//console.log(percentVal, position, total);
    }
}); 

function processJson(data) { 
	$.each(data, function(i, item){
		if (item.status == 'ok') {
			var html = ' '  
				+ '	<div class="ads_mold_img"> ' 
				+ '		<img src="/ads-image/100px/' + item.url + '" /> ' 
				+ '	</div> ' 
				+ ' ';
			$('#ads-images').prepend(html);
		}
		$('#status').prepend(item.msg + '<br />');

	})
}
})();       