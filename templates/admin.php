<?php

$host = $_['host'];

?>

<div class="section">
        <h2>Shorten</h2>
	<label for="shorten-host-url">The URL that contains the <i>index.php</i> file for the shortener. If you are unaware of what this file is, please read the <a target="_new" href="https://github.com/Fmstrat/shorten/blob/master/README.md"><u>installation instructions</u></a>.</label><br>
        <input type="text" style="width: 300pt" name="shorten-host-url" id="shorten-host-url" value="<?php echo $host ?>" />
</div>
