# shorten
A URL Shortening and Privacy Tool for ownCloud

## Installation

**Step 1: Install the add-on**

Place this app in *owncloud/apps/shorten* (Rename the extracted ZIP to "shorten" or you will receive errors)

**Step 2: Setup the shortening server**

Next, you must setup your shortening server. This can be the same webserver you are running ownCloud on, or a completely different server to enable a privacy filter for your owncloud installation. For the purpose of this guide, we will assume your setup is:
- Your owncloud server is at *https://mylongdomain.ext:port/owncloud*
- Your other, "shortening" server, is at *https://mydomain.ext*
- You want your short URLs to be *https://mydomain.ext/s?SHORTCODE*

To accomplish this, you should copy the *REMOTE-HOST/index.php* to the remote host, however you wish. In this example we use scp:
```
mlongdomain ~# scp /var/www/owncloud/apps/shorten/REMOTE-HOST/index.php root@mydomain.ext:/var/www/s/index.php
```

Next, on the shortening server, edit the file to include your ownCloud server URL and set enabled to true:
```
mydomain ~# vi /var/www/s/index.php
```
```
<?php

#
# Enter your owncloud URL below with no trailing slash
# Ex. "https://mydomain.ext/owncloud"
#
$owncloud_url = "https://mylongdomain.ext:port/owncloud";

#
# Set enabled to true when you are ready to use the application
#
$enabled = true;
#$enabled = false;
```

**Step 3: Configure the app**

Lastly, visit the administration page for owCcloud and in the *Shorten* configuration include your shortening server's URL, which is everything before *?SHORTCODE*. In this case:
```
https://mydomain.ext/s*
```
At this point, when you check the box to share a file publically, the app will replace the public share link displayed in the ownCloud web interface.
