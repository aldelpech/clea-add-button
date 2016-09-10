=== Clea Add Button ===
Contributors: Anne-Laure
Tags: button, post
Requires at least: 4.0.1
Tested up to: 4.6
Stable tag: 
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A test plugin which adds a button at the end of all posts. 
The admin sets the button settings in a setting page. 

== Description ==

This is a *test* plugin, used to learn about plugin settings and plugin best practices. 
The plugin adds a button at the end of each post, with background color, text color, text content and link when pressed set in a settings page. 
Note that this plugin's README.md base comes from [WordPress](https://wordpress.org/plugins/about/readme.txt "WordPress.org : readme.txt") 

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/clea-add-button` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the Settings->Add button screen to configure the plugin
1. Go to the front end of the website : each post will now have a clickable button at the end of it


== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.



== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets 
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png` 
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 0.3 =
* the definition of sections and fields to display on the settings page is now in /admin/clea-add-button-admin-settings.php
* 3 new types of fields may be processed : date-picker, email and url
* validation and sanitation of user inputs is done and the user gets a notice in case of a bad email

= 0.2 =
* Added a settings page able to display all types of field

= 0.1 =
* Setup the base plugin

== Upgrade Notice ==

= 0.2 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](http://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: http://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`