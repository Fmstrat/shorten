
$(document).ready(function() {
	if(/(public)\.php/i.exec(window.location.href)!=null) return;
	setTimeout(addShareListener, 1000);
});

function addShareListener() {
	$('.action-share').click(function() {
		$('#linkCheckbox').click(function() {
			setTimeout(replaceUrl, 750);
		});
		setTimeout(replaceUrl, 750);
	});
}

function replaceUrl() {
	if ($('#linkText').css('display') == 'block') {
		var curUrl = $('#linkText').val();
		$('#linkText').val('Please wait...');
		makeUrl(curUrl);
	}
}

function makeUrl(curUrl, partUrl) {
	$.post(OC.linkTo("shorten","ajax/makeurl.php"), { curUrl: curUrl }, function (data) {
		$('#linkText').val(data);
	});
}
