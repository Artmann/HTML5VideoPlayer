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
	add_action( 'wp_print_styles', 'enqueue_my_styles' );
        add_shortcode("video", "show_video");

	function show_video($atts, $content = null)
	{
		extract( shortcode_atts( array(
			'autoplay' => '',
			'controls' => 'controls',
                        'height' => '280',
                        'loop' => '',
                        'muted' => '',
                        'poster' => '',
                        'preload' => 'metadata',
                        'width' => '320',

		), $atts ) );

		if($content == null)
		{
			return "<div class=\"alert alert-error\">No media was specified.</div>";
		}
		else
		{
			$urls = explode("\n", $content);
                         
			//Create HTML

			$html = "<div class=\"video-wrapper\">\n";
			$html .= "<video class=\"video\" ";
			$html .= " height=\"$height\" width=\"$width\" ";
			if($autoplay != "")
				$html .= "autoplay=\"$autoplay\" ";
                        if($controls != "")
                                $html .= "controls=\"$controls\" ";
                        if($loop != "")
                                $html .= "loop=\"$loop\" ";
                        if($muted != "")
                                $html .= "muted=\"$muted\" ";
                        if($poster != "")
                                $html .= "poster=\"$poster\" ";
                        if($preload != "")
                                $html .= "preload=\"$preload\" ";
			$html .= "> \n";

			foreach($urls as $url)
			{
				$url = trim($url);
                                //$url = str_replace("<br />", "", $url);
                                $url = strip_tags($url);
                                
                                if(strlen($url) != "")
                                {
                                    
                                    $pieces = explode(".", $url);
                                    $extension = strtolower($pieces[ (sizeof($pieces) - 1) ]);
                                    $html .= "<source src=\"$url\" ";
                                    if($extension == "mp4" || $extension == "ogg")
                                            $html .= " type=\"video/$extension\"  ";
                                    $html .= " />\n";
                                }
			}

			$html .= "Your browser does not support the video tag.\n";
			$html .= "</video>\n</div>";

			return $html;
		}
	}

	function enqueue_my_styles()
	{
		wp_register_style( 'prefix-style', plugins_url('css/style.css', __FILE__) );
        	wp_enqueue_style( 'prefix-style' );
                wp_enqueue_script('myscript', plugins_url('js/html5videoplayer.js', __FILE__) );
	}

?>
