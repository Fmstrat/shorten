function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

function ocUrl(url) {
	var newurl = OC.linkTo("shorten",url).replace("apps/shorten","index.php/apps/shorten");
	return newurl;
}

function shortenSave(shorten_saveurl, shorten_key, shorten_val) {
  var obj_data = {};
  obj_data[shorten_key] = shorten_val;
  $.post(shorten_saveurl, obj_data, function (data) {
     console.log('response', data);
  })
    .done(function() {
      OC.Notification.showTemporary("Settings saved");
  })
    .fail(function() {
      OC.Notification.showTemporary("Could not save settings.");
  });
}

function shortenHostURLChange(obj_elem, removeTrailing) {
  var val = $(obj_elem).val();
  if (removeTrailing && endsWith(val, "/")) {
    val = val.substring(0, val.length-1);
    $(obj_elem).val(val);
  }
  shortenSave(ocUrl("setval"), "host", val);
}

$(document).ready(function() {
	$('#shorten-host-url').change(function() {
		shortenHostURLChange(this, true);
	});
	$('#shorten-api').change(function() {
		var val = $(this).val();
    shortenSave(ocUrl("setval"), "api", val);
	});
	$('#shorten-yourls-host-url').change(function() {
		shortenHostURLChange(this, true);
	});
	$('#shorten-yourls-api').change(function() {
		var val = $(this).val();
    shortenSave(ocUrl("setval"), "api", val);
	});
	$('#shorten-polr-host-url').change(function() {
		shortenHostURLChange(this, true);
	});
	$('#shorten-polr-api').change(function() {
		var val = $(this).val();
    shortenSave(ocUrl("setval"), "api", val);
	});
	$('#shorten-type').change(function() {
		var val = $(this).val();
    shortenSave(ocUrl("setval"), "type", val);
    $('#shorten-internal-settings').css('display', 'none');
    $('#shorten-googl-settings').css('display', 'none');
    $('#shorten-yourls-settings').css('display', 'none');
    $('#shorten-polr-settings').css('display', 'none');
		if (val == "internal") {
			$('#shorten-internal-settings').css('display', 'block');
		}
		if (val == "googl") {
			$('#shorten-googl-settings').css('display', 'block');
		}
		if (val == "yourls") {
			$('#shorten-yourls-settings').css('display', 'block');
		}
		if (val == "polr") {
			$('#shorten-polr-settings').css('display', 'block');
		}
	});
});

