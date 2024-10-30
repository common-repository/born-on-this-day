<?php

/*
 *
 *	Plugin Name: Born On This Day
 *	Plugin URI: http://www.joeswebtools.com/wordpress-plugins/born-on-this-day/
 *	Description: Adds a sidebar widget that display famous people born on this day in history.
 *	Version: 2.0.1
 *	Author: Joe's Web Tools
 *	Author URI: http://www.joeswebtools.com/
 *
 *	Copyright (c) 2009-2014 Joe's Web Tools. All Rights Reserved.
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 *	If you are unable to comply with the terms of this license,
 *	contact the copyright holder for a commercial license.
 *
 *	We kindly ask that you keep links to Joe's Web Tools so
 *	other people can find out about this plugin.
 *
 */





/*
 *
 *	born_on_this_day_shortcode_handler
 *
 */

function born_on_this_day_shortcode_handler($atts, $content = nul) {

	// Load language file
	$current_locale = get_locale();
	if(!empty($current_locale)) {
		$mo_file = dirname(__FILE__) . '/languages/born-on-this-day-' . $current_locale . ".mo";
		if(@file_exists($mo_file) && is_readable($mo_file)) {
			load_textdomain('born-on-this-day', $mo_file);
		}
	}

	// Prepare the date
	$current_date = date_i18n(get_option('date_format'), strtotime('now'));
	$current_date = '<strong>' . $current_date . '</strong><br />';

	// Prepare the people
	$month_array = file(dirname(__FILE__) . '/data/' . date('n') . '.dat');
	$day = date('j');
	$day_line = $month_array[$day + 3];
	$day_array = explode('<month>', $day_line);
	$people_array = explode('<name>', $day_array[1]);
	for($i = 0; $i < sizeof($people_array); $i++) {
		$person_array = explode('<year>', $people_array[$i]);
		$people .= $person_array[0] . ' ' . $person_array[1] . '<br />';
	}

	// Display
	$content = '<table style="border-width: thin thin thin thin; border-style: solid solid solid solid;">';
	$content .= '<thead><tr><th><center><font face="arial" size="+1"><b>' . __('Born on this day', 'born-on-this-day') . '</b></center></font></th></tr></thead>';
	$content .= '<tbody><tr><td>';

	$content .= '<div style="text-align: left;">';
	$content .= $current_date;
	$content .= $people;
	$content .= '</div>';

	$content .= '</td></tr></tbody>';
	$content .= '<tfoot><tr><td><div style="text-align: right;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/born-on-this-day/">Joe\'s</a></font></div></td></tr></tfoot>';
	$content .= '</table>';

	return $content;
}

add_shortcode('born-on-this-day', 'born_on_this_day_shortcode_handler');





/*
 *
 *	WP_Widget_Born_On_This_Day
 *
 */

class WP_Widget_Born_On_This_Day extends WP_Widget {

	function WP_Widget_Born_On_This_Day() {

		parent::WP_Widget(false, $name = 'Born On This Day');
	}

	function widget($args, $instance) {

		// Load language file
		$current_locale = get_locale();
		if(!empty($current_locale)) {
			$mo_file = dirname(__FILE__) . '/languages/born-on-this-day-' . $current_locale . ".mo";
			if(@file_exists($mo_file) && is_readable($mo_file)) {
				load_textdomain('born-on-this-day', $mo_file);
			}
		}

		// Get options
		extract($args);
		$option_title = apply_filters('widget_title', empty($instance['title']) ? __('Born on this day', 'born-on-this-day') : $instance['title']);
		$option_alignment = empty($instance['alignment']) ? 'left' : $instance['alignment'];
		$option_date_style = empty($instance['date_style']) ? 'bold' : $instance['date_style'];

		// Prepare the date
		$current_date = date_i18n(get_option('date_format'), strtotime('now'));
		switch($option_date_style) {
			case 'bold':
				$current_date = '<strong>' . $current_date . '</strong><br />';
				break;
			case 'bold_italic':
				$current_date = '<strong><em>' . $current_date . '</em></strong><br />';
				break;
			case 'italic':
				$current_date = '<em>' . $current_date . '</em><br />';
				break;
			case 'regular':
				$current_date .= '<br />';
				break;
		}

		// Prepare the people
		$month_array = file(dirname(__FILE__) . '/data/' . date('n') . '.dat');
		$day = date('j');
		$day_line = $month_array[$day + 3];
		$day_array = explode('<month>', $day_line);
		$people_array = explode('<name>', $day_array[1]);

		// Help widget to conform to the active theme: before_widget, before_title and after_title
		echo $before_widget;
		echo $before_title . $option_title . $after_title;

		if($option_alignment == 'right') {

			echo '<div style="text-align: right;">';
			echo $current_date;
			for($i = 0; $i < sizeof($people_array); $i++) {
				$person_array = explode('<year>', $people_array[$i]);
				echo $person_array[1] . ' ' . $person_array[0] . '<br />';
			}
			echo '</div>';
			echo '<div style="text-align: left;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/born-on-this-day/">Joe\'s</a></font></div>';
		} else {

			echo '<div style="text-align: left;">';
			echo $current_date;
			for($i = 0; $i < sizeof($people_array); $i++) {
				$person_array = explode('<year>', $people_array[$i]);
				echo $person_array[0] . ' ' . $person_array[1] . '<br />';
			}
			echo '</div>';
			echo '<div style="text-align: right;"><font face="arial" size="-3"><a href="http://www.joeswebtools.com/wordpress-plugins/born-on-this-day/">Joe\'s</a></font></div>';
		}

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {

		return $new_instance;
	}

	function form($instance) {

		// Load language file
		$current_locale = get_locale();
		if(!empty($current_locale)) {
			$mo_file = dirname(__FILE__) . '/languages/born-on-this-day-' . $current_locale . ".mo";
			if(@file_exists($mo_file) && is_readable($mo_file)) {
				load_textdomain('born-on-this-day', $mo_file);
			}
		}

		// Get options
		$instance = wp_parse_args((array)$instance, array('title' => __('Born on this day', 'born-on-this-day'), 'date_style' => 'bold', 'alignment' => 'left'));
		$option_title = esc_attr($instance['title']);

		// Display form
		echo '<p>';
		echo 	'<label for="' . $this->get_field_id('title') . '">' . __('Title: ', 'born-on-this-day') . '</label>';
		echo 	'<input class="widefat" type="text" value="' . $option_title . '" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" />';
		echo	'<br />';
		echo	'<br />';
		echo 	'<label for="' . $this->get_field_id('date_style') . '">' . __('Date style: ', 'born-on-this-day') . '</label>';
		echo 	'<select class="widefat" id="' . $this->get_field_id('date_style') . '" name="' . $this->get_field_name('date_style') . '">';
		echo 		'<option value="bold"' . selected($instance['date_style'], 'bold') . '>' . __('Bold', 'born-on-this-day') . '</option>';
		echo 		'<option value="bold_italic"' . selected($instance['date_style'], 'bold_italic') . '>' . __('Bold + Italic', 'born-on-this-day') . '</option>';
		echo 		'<option value="italic"' . selected($instance['date_style'], 'italic') . '>' . __('Italic', 'born-on-this-day') . '</option>';
		echo 		'<option value="regular"' . selected($instance['date_style'], 'regular') . '>' . __('Regular', 'born-on-this-day') . '</option>';
		echo 	'</select>';
		echo	'<br />';
		echo	'<br />';
		echo 	'<label for="' . $this->get_field_id('alignment') . '">' . __('Alignment: ', 'born-on-this-day') . '</label>';
		echo 	'<select class="widefat" id="' . $this->get_field_id('alignment') . '" name="' . $this->get_field_name('alignment') . '">';
		echo 		'<option value="left"' . selected($instance['alignment'], 'left') . '>' . __('Left', 'born-on-this-day') . '</option>';
		echo 		'<option value="right"' . selected($instance['alignment'], 'right') . '>' . __('Right', 'born-on-this-day') . '</option>';
		echo 	'</select>';
		echo '</p>';
	}
}

add_action('widgets_init', create_function('', 'return register_widget("WP_Widget_Born_On_This_Day");'));

?>