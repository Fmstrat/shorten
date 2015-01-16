function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

$(document).ready(function() {
	$('#shorten-host-url').change(function() {
		var val = $(this).val();
		if (endsWith(val, "/")) {
			val = val.substring(0, val.length-1);
			$(this).val(val);
		}
	        $.post(OC.linkTo("shorten","ajax/setval.php"), { host: val }, function (data) {
			 console.log('response', data);
        	});
	});
	$('#shorten-api').change(function() {
		var val = $(this).val();
	        $.post(OC.linkTo("shorten","ajax/setval.php"), { api: val }, function (data) {
			 console.log('response', data);
        	});
	});
	$('#shorten-type').change(function() {
		var val = $(this).val();
	        $.post(OC.linkTo("shorten","ajax/setval.php"), { type: val }, function (data) {
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

