
$(document).ready(function() {
	if(/(public)\.php/i.exec(window.location.href)!=null) return;
	setTimeout(addShareListener, 1000);
});

function addShareListener() {
	if (OC.config && OC.config.version && parseFloat(OC.config.version) >= 8.2) {
		replaceShare();
	} else {
		addGlobalListener('.nav-files');
		addGlobalListener('.nav-sharingin');
		addGlobalListener('.nav-sharingout');
		addGlobalListener('.nav-sharinglinks');
		addGlobalListener('.name');
		addGlobalListener('.crumb');
		$('.action-share').ready(function() {
			$('.action-share').click(function() {
				addListener('#linkCheckbox');
				setTimeout(replaceUrl, 750);
			});
		});
	}
}

function addListener(o) {
	$(o).ready(function() {
		$(o).change(function() {
			setTimeout(replaceUrl, 750);
		});
	});
}

function addGlobalListener(o) {
	$(o).ready(function() {
		$(o).click(function() {
			setTimeout(addShareListener, 1000);
		});
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
	var shortenurl = OC.linkTo("shorten","makeurl").replace("apps/shorten","index.php/apps/shorten");
	$.post(shortenurl, { curUrl: curUrl }, function (data) {
		$('#linkText').val(data);
	});
}

function makeUrl2(curUrl, linkText) {
	var shortenurl = OC.linkTo("shorten","makeurl").replace("apps/shorten","index.php/apps/shorten");
	$.post(shortenurl, { curUrl: curUrl }, function (data) {
		linkText.val(data);
	});
}

function replaceUrl2(linkText) {
		var curUrl = linkText.val();
		linkText.val('Please wait...');
		makeUrl2(curUrl, linkText);
		lastRun = curUrl;
}

function determineLinkBox(linkText) {
	var found = false;
	if (typeof linkText !== 'undefined')
		if (typeof linkText.val() !== 'undefined')
			found = true;
	return found;
}

function replaceShare() {
	OC.Share.ShareDialogLinkShareView.prototype.originitialize = OC.Share.ShareDialogLinkShareView.prototype.initialize;
	OC.Share.ShareDialogLinkShareView.prototype.initialize = function(options) {
		this.originitialize(options);
		var view = this;
		this.model.on('change:permissions', function() {
			if (determineLinkBox(view.$el.find('#linkText'))) {
				replaceUrl2(view.$el.find('#linkText'));
			} else if (determineLinkBox(view.$el.find('#linkText-view15'))) {
				replaceUrl2(view.$el.find('#linkText-view15'));
			}
		});
		this.model.on('change:linkShare', function() {
			if (determineLinkBox(view.$el.find('#linkText'))) {
				replaceUrl2(view.$el.find('#linkText'));
			} else if (determineLinkBox(view.$el.find('#linkText-view15'))) {
				replaceUrl2(view.$el.find('#linkText-view15'));
			}
		});
	}
}

