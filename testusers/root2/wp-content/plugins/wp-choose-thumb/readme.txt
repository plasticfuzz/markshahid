=== WP-Choose-Thumb ===
Contributors:
Donate link: http://www.daveligthart.com
Tags: thumbnail, chooser, thumb, thumbnails, attachments
Requires at least: 2.7
Tested up to: 2.8.2
Stable tag: trunk

A simple way to add a default thumbnail to your post.

== Description ==
A simple way to add a default thumbnail to your post.
This plugin uses the default wordpress image upload.
Choose from all thumbnails in the edit post view.

For theme usage:

= Add this function where you want the thumbnail to appear =

`<?php if(function_exists('wct_display_thumb')){ if(!wct_display_thumb()){ /* Optionally add code for no thumbnail. */  } } ?>`

= When placed outside "the loop" =

`<?php
if(function_exists('wct_display_thumb')):
	$style = 'style="padding:5px;"'; // extra styling.
	$postId = $post->ID; // the id of the post.
	if(!wct_display_thumb($style, $postId)): 
	/* Optionally add code for no thumbnail. */
	endif;
endif;
?>`

== Installation ==

1. Extract zip in the `/wp-content/plugins/` directory
2. Activate the plugin through the 'plugins' menu in WordPress

== Screenshots ==

1. Choose from thumbnails in the edit post view.
2. Display thumbnail in post.
3. Overview demo

== Frequently Asked Questions ==

= I see the choose thumb window right of my 'write post' screen, but It says 'Choose thumbnail for post' . And there is no thumb below this. =

You have to attach images to your post: first icon after Upload/Insert in the "Edit Post" view.

WordPress generates a thumbnail based on those images automatically.

If you have uploaded the images it is best practice to publish your post first.

Click the "refresh" link in de WP-Choose-Thumb sidebar window.

Afterwards the thumbnails will automatically appear in de sidebar window.

= How can i change the thumbnail size =

You can define the size of the generated thumbnails here:
http://yoursite/wp-admin/options-media.php

