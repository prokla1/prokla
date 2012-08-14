(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
  
$('#form_photo').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
		//console.log(percentVal, position, total);
    },
	complete: function(xhr) {
		status.html(xhr.responseText);
	}
}); 

})();       