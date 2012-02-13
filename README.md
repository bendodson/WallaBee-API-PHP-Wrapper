This is a simple PHP5 class for interacting with the WallaBee API. You can find out more about the API at [http://wallab.ee/developers/](http://wallab.ee/developers/) - this class makes use of the cURL Library by David Hopkins ([semlabs.co.uk](semlabs.co.uk))

# Usage

For GET requests, simply create a new instance of WallaBee and pass the URL endpoint as the first parameter.

	<?php require_once('WallaBee.class.php') ?>
	<?php
	$wallabee = new WallaBee('users/1');
	if (!$wallabee->error) {
		echo "User '".$wallabee->obj->name."' has a balance of ".$wallabee->obj->balance." honeycombs.";
	} else {
		echo $wallabee;
	}
	?>
	
The WallaBee class returns an object in the `obj` property which gives you full access to the decoded JSON response.

You should always check for the presence of the `error` property as this will give you more details should the request fail for any reason (including hitting Rate Limits). If there is an error, you can echo the WallaBee object directly to get a load of debug information including the returned data, your cURL request, and the HTTP response code.

To send a POST request, a second parameter is available which accepts an array of key values you wish to submit.

	<?php require_once('WallaBee.class.php') ?>
	<?php
	
	$post = array();
	$post['name'] = 'Test Location';
	$post['category_id'] = 23;
	$post['lat'] = 52.4082334;
	$post['lng'] = -1.6011388;

	$wallabee = new WallaBee('places', $post);
	if (!$wallabee->error) {
		echo "Place has been created.";
	} else {
		echo $wallabee;
	}
	?>