=== Plugin Name ===
Contributors: jeffikus
Donate link: http://www.jeffikus.com/downloads/wordpress-jquery-accordion-plugin/
Tags: accordion, jquery, wordpress, ui
Requires at least: 2.0.2
Tested up to: 2.8.4
Stable tag: 0.1

This plugin display a Jquery Accordion of a certain amount of posts in a specific category.

== Description ==

This plugin will eventually form the base for a much more advanced version with configurable options and the choice of UI theme for jquery. In addition to this, it will check if jquery has already been included.

== Installation ==

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use the shortcode [jqueryaccordion posts="3" category="Featured"] in your posts to display the accordion

== Frequently Asked Questions ==

= Will there be more features added later? =

Yes.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
2. This is the second screen shot

== Changelog ==

= 0.1 =
* First version
* Alpha release

== Roadmap ==

= 0.5 =
* Admin panel menu
* Compressed Jquery libaries
* Only the necessary libraries - not the whole Jquery
* Deal with the trailing slash issue for get_bloginfo('url')
* Add some general filters and sanitation
* Styling issues with the h3 tag

= 1.0 =
* Stable version of plugin
* Configurable options for Jquery UI theme, default posts, default category
* Auto-detection of jquery already in themes

= 1.5 =
* Widget with configurable options
* Instances of widgets that dont conflict
* User choice of what WordPress tags to use when building the accordion

= 2.0 =
* Style editor
* User themes instead of Jquery UI themes