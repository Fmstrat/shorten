<?php

$host = $_['host'];
$type = $_['type'];
$api = $_['api'];

?>

<div class="section">
        <h2>Shorten</h2>
	<label for="shorten-host-type">Which type of URL shortener to use:</label><br>
	<select id="shorten-type">
		<option <?php if (!$type || $type == "internal" || $type == "") echo "selected"; ?> value="internal">Internal shortener and privacy filter</option>
		<option <?php if ($type == "googl") echo "selected"; ?> value="googl">goo.gl</option>
		<option <?php if ($type == "yourls") echo "selected"; ?> value="yourls">YOURLS</option>
	</select><br>
	<br>
	<div id="shorten-internal-settings" style="display: <?php if (!$type || $type == "internal" || $type == "") echo "block"; else echo "none"; ?>">
		<label for="shorten-host-url">The URL that contains the <i>index.php</i> file for the shortener. If you are unaware of what this file is, please read the <a target="_new" href="https://github.com/Fmstrat/shorten/blob/master/README.md"><u>installation instructions</u></a>.</label><br>
		<input type="text" style="width: 300pt" name="shorten-host-url" id="shorten-host-url" value="<?php echo $host ?>" />
	</div>
	<div id="shorten-googl-settings" style="display: <?php if ($type == "googl") echo "block"; else echo "none"; ?>">
		<label for="shorten-api">Your goo.gl API key. To get an API key, follow <a target="_new" href="https://developers.google.com/url-shortener/v1/getting_started#APIKey"><u>these instructions</u></a>.</label><br>
		<input type="text" style="width: 250pt" name="shorten-api" id="shorten-api" value="<?php echo $api ?>" />
	</div>
	<div id="shorten-yourls-settings" style="display: <?php if ($type == "yourls") echo "block"; else echo "none"; ?>">
		<label for="shorten-host-url">The URL that contains the <i>yourls-api.php</i> file for your YOURLS install. Do not include the trailing slash.</label><br>
		<input type="text" style="width: 300pt" name="shorten-yourls-host-url" id="shorten-yourls-host-url" value="<?php echo $host ?>" />
		<br><br>
		<label for="shorten-api">Your YOURLS signature key.</label><br>
		<input type="text" style="width: 250pt" name="shorten-yourls-api" id="shorten-yourls-api" value="<?php echo $api ?>" />
	</div>
</div>
