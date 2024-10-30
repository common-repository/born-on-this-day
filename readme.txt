=== Plugin Name ===
Contributors: ppaquet
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5162912
Tags: birthday, birthdays, born, celebrities, celebrity, famous, history, sidebar, today, widget
Requires at least: 2.8
Tested up to: 3.8.1
Stable tag: 2.0.1

Adds a sidebar widget that display famous people born on this day in history.



== Description ==

Adds a sidebar widget that display famous people born on this day in history.



== Screenshots ==

1. Widget
2. Widget control panel





== Installation ==

1. Unpack the *.zip file and extract the /born-on-this-day/ folder and the files.
2. Using an FTP program, upload the full /born-on-this-day/ folder to your WordPress plugins directory (Example: /wp-content/plugins).
3. Go to Plugins > Installed and activate the plugin.

To add the widget: Go to Appearance > Widgets, add the widget to the sidebar of your choice and save.

To use the shortcode: Simply add [born-on-this-day] to your posts or your pages.





== Changelog ==

= 2.0.1 =
* Compatibility check with WordPress 3.8.1

= 2.0 =
* Compatibility check with WordPress 2.8.2
* Fixed a bug where there was no data for July 24
* Minor localisation work
* New [born-on-this-day] shortcode
* New WordPress 2.8 widget structure
* Use WordPress date format

= 1.6.1 =
* Compatibility check with WordPress 2.8
* Keep settings after deactivation

= 1.6 =
* Fixed a bug where there was no data for May 31

= 1.5 =
* Minor localisation work

= 1.4 =
* Faster code

= 1.3.2 =
* Files are now UTF-8, no BOM

= 1.3.1 =
* Minor localisation work

= 1.3 =
* It is now possible choose alignment in the plugin

= 1.2 =
* Faster code
* Fixed a bug where it is impossible to change the title in the widget

= 1.1 =
* Fixed a bug where the wrong date is displayed on some servers

= 1.0 =
* Initial release



== Frequently Asked Questions ==

= Why is the widget displaying the wrong date =
Currently, the plugin uses your server clock to determinate today's date. If there is a lot of difference between today's date and what the plugin displays, your server clock is probably not set correctly. If there is a one day difference between today and what the plugin displays, your server is probably in a different timezone than you are. While it is not possible to fix an incorrectly set clock, there is a fix in the work to use the browser time to compensate for time zones differences.

= Is the plugin compatible with versions of WordPress ealier to 2.8? =
No. Because of the new widget implementation, you need to use WordPress 2.8 or later. If you are using an earlier version of WordPress, you can try using Born On This Day version 1.6.1 but, really, you should upgrade.

= How can I support this plugin? =
If you enjoy this plugin and would like to help with the development, please consider [donating](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5162912). Otherwise, spread the word, report bugs and give this plugin a good rating.

= How do I report a bug? =
If you find any bugs with the plugin or if you have any suggestions, please go to [the Born On This Day plugin homepage](http://www.joeswebtools.com/wordpress-plugins/born-on-this-day/) and leave a comment to let me know.
