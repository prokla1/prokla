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
				+ '	<div class="ads_mold_img" id="image_' + item.id_image + '"> ' 
				+ '		<img src="/ads-image/100px/' + item.url + '" /> ' 
				+ '		<a href="javascript:adsImageDelete(\'' + item.id_image + '\');">Deletar</a> '
				+ '	</div> ' 
				+ ' ';
			$('#ads-images').prepend(html);
		}
		$('#status').prepend(item.msg + '<br />');

	})
}

})();       

function adsImageDelete(idImage) {
	$.ajax({
		url: "/me/delete-image-ads", 
		type: "POST", 
		dataType : "json", 
		contentType: "application/x-www-form-urlencoded; charset=UTF-8", 
		data: {idImage: idImage},
		success: function (r) {
			console.log(r);
			if (r.status == 'ok') { 
				$('#image_' + idImage).remove();
				console.log('#image_' + idImage);
			}
			$('#status').prepend( r.msg + '<br/ >');
		}
	})	
}