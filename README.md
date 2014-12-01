This is a simple PHP5 class for interacting with the WallaBee API. You can find out more about the API at [http://wallab.ee/developers/](http://wallab.ee/developers/) - this class makes use of the cURL Library by David Hopkins ([semlabs.co.uk](semlabs.co.uk))

# Usage

Simply create a new instance of WallaBee and pass the URL endpoint as the first parameter.

	<?php require_once('WallaBee.class.php') ?>
	<?php
	$wallabee = new WallaBee('sets/2');
	if (!$wallabee->error) {
		echo "The set '".$wallabee->obj->name."' was designed by ".$wallabee->obj->designer;
	} else {
		echo $wallabee;
	}
	?>
	
The WallaBee class returns an object in the `obj` property which gives you full access to the decoded JSON response.

You should always check for the presence of the `error` property as this will give you more details should the request fail for any reason (including hitting Rate Limits). If there is an error, you can echo the WallaBee object directly to get a load of debug information including the returned data, your cURL request, and the HTTP response code.