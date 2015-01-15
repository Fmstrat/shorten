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
	        $.post(OC.linkTo("shorten","ajax/sethost.php"), { host: val }, function (data) {
			 console.log('response', data);
        	});
	});
});

