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
			$('#ads-images').prepend('<img src="/ads-image/100px/'+ item.url +'" />');
		}
		$('#status').prepend(item.msg + '<br />');

	})
}
})();       