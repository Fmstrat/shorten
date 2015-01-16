# Shorten
Shorten is an add-on app for ownCloud that enables one-click URL shortening. It's features include:
- Automatic replacement of the public share URL with the shortened URL
- No need to create a seperate "Shorten" URL
- Internal shortner or goo.gl support
- Ability to completely hide the ownCloud server with the internal shortener by proxying shortened requests through another server
    - Note: While normal shares will never expose the ownCloud URL, password protected files will as the password display screen must be supplied to the user.

## Installation

### Step 1: Install the add-on

- Place this app in *owncloud/apps/shorten* (Rename the extracted ZIP to "shorten" or you will receive errors)
- Re-login to owncloud and run the update

### Step 2: Setup the shortening server

#### *Step 2 - Option A: goo.gl*
To use http://goo.gl, all you need to do is aquire an API key to use in the admin settings. You can aquire a key using these instructions from Google: *https://developers.google.com/url-shortener/v1/getting_started#APIKey*
  
#### *Step 2 - Option B: Internal shortener and privacy filter*

Next, you must setup your shortening server. This can be the same webserver you are running ownCloud on, or a completely different server to enable a privacy filter for your owncloud installation. For the purpose of this guide, we will assume your setup is:
- Your owncloud server is at *https://mylongdomain.ext:port/owncloud*
- Your other, "shortening" server, is at *https://mydomain.ext*
- You want your short URLs to be *https://mydomain.ext/s?SHORTCODE*

To accomplish this, you should copy the *REMOTE-HOST/index.php* to the remote host, however you wish. In this example we use scp:
```
mylongdomain ~# scp /var/www/owncloud/apps/shorten/REMOTE-HOST/index.php root@mydomain.ext:/var/www/s/index.php
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

### Step 3: Configure the app

Lastly, visit the administration page for ownCloud and in the *Shorten* configuration include your shortening server's URL, which is everything before *?SHORTCODE* if you are using the internal shortener. In this case:
```
https://mydomain.ext/s
```
If you're using http://goo.gl, you would need to include your API key in the provided settings box.

At this point, when you check the box to share a file publically, the app will replace the public share link displayed in the ownCloud web interface.
