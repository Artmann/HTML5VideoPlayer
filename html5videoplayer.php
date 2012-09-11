<?php
/*
Plugin Name: HTML5VideoPlayer
Plugin URI: https://github.com/Artmann/HTML5VideoPlayer
Description: A simple HTML5 Video Player
Version: 1.0
Author: Christoffer Artmann
Author URI: http://www.artmann.co
License: GPL2
*/
?>

<?php
/*  Copyright 2012  Christoffer Artmann  (email : christoffer@artmann.co)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>

<?php

	function show_video($atts, $content = null)
	{
		$width = 320;
		$height = 320;

		if($content == null)
		{
			return "<div class=\"alert alert-error\">No media was specified.</div>";
		}
		else
		{
			$urls = explode("\n", $content);

			//Create HTML

			$html = "<div class=\"video-wrapper\">\n";
			$html .= "<video class=\"video\" width=\"$width\" height=\"$height\"> \n";

			foreach($urls as $url)
			{
				$url = trim($url);
				$html .= "<source src=\"$url\">\n";
			}

			$html .= "Your browser does not support the video tag.\n";
			$html .= "</video>\n</div>";

			return $html;
		}
	}

	add_shortcode("video", "show_video");

?>
