function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function ocUrl(url) {
	var newurl = OC.linkTo("shorten",url).replace("apps/shorten","index.php/apps/shorten");
	return newurl;
}

$(document).ready(function() {
	$('#shorten-host-url').change(function() {
		var val = $(this).val();
		if (endsWith(val, "/")) {
			val = val.substring(0, val.length-1);
			$(this).val(val);
		}
	        $.post(ocUrl("setval"), { host: val }, function (data) {
			 console.log('response', data);
        	});
	});
	$('#shorten-api').change(function() {
		var val = $(this).val();
	        $.post(ocUrl("setval"), { api: val }, function (data) {
			 console.log('response', data);
        	});
	});
	$('#shorten-type').change(function() {
		var val = $(this).val();
	        $.post(ocUrl("setval"), { type: val }, function (data) {
			 console.log('response', data);
        	});
		if (val == "internal") {
			$('#shorten-internal-settings').css('display', 'block');
			$('#shorten-googl-settings').css('display', 'none');
		}
		if (val == "googl") {
			$('#shorten-internal-settings').css('display', 'none');
			$('#shorten-googl-settings').css('display', 'block');
		}
	});
});

