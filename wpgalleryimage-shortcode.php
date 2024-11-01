<?php
/*
Plugin Name: WP Gallery Image Shortcode
Plugin URI: http://dpotter.net/Technical/wordpress/wp-plugins/wpgalleryimage_shortcode/
Description: Adds the [wpgalleryimage] shortcode for inserting into a post or a page one of the images you uploaded into your WordPress gallery.
Version: 1.1
Author: David Potter
Author URI: http://dpotter.net/Technical/
*/

/*  Copyright 2009  David Potter

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('WP_DEBUG', true);

function shortcode_wpgalleryimage($atts, $content = null)
{
	extract(shortcode_atts(
		array(
			"id"            => -1,
			"name"          => '',
			"title"         => '',
			"size"          => 'thumbnail',
			"width"         => -1,
			"height"        => -1,
			"float"         => 'none',
			"link"          => '',
			"padding"       => null,
			"paddingtop"    => null,
			"paddingright"  => null,
			"paddingbottom" => null,
			"paddingleft"   => null,
			"debug"			=> "false"
			),
		$atts));

	if (($id == -1) && ($name == '') && ($title == ''))
		return;

	if (($width > 0) && ($height > 0))
		$size = array($width, $height);
	if ((paddingleft != null) && (strcmp($float, 'right') == 0))
		$paddingleft = '10px';
	if ((paddingright != null) && (strcmp($float, 'left') == 0))
		$paddingright = '10px';
	if (strcmp($debug, "true") == 0)
		$debug = true;
	else
		$debug = false;

	if ($debug)
		$value .= "id = $id, name = '$name'<br/>";

	$parameters = array(
		'post_type' => 'attachment',
		'post_parent' => null,
		'post_mime_type' => 'image');
	$attachments = get_children($parameters);
	if ($attachments)
	{
		foreach ($attachments as $attachment)
		{
			if ($debug)
				$value .= "attachment: id = $attachment->ID, name = '$attachment->post_name'<br/>";
			if ( (($id != -1) && ($attachment->ID == $id)) ||
				 (strcmp($attachment->post_name, $name) == 0) ||
				 (strcmp($attachment->post_title, $title) == 0) )
			{
				$full_image = wp_get_attachment_image($attachment->ID, $size, false);
				$image_data = wp_get_attachment_image_src($attachment->ID, $size, false);
				$display_width = ($image_data[1] + 2);
				$display_height = ($image_data[2] + 2);

				$value .= '<div class="wpgalleryimage_shortcode" style="width: '.$display_width.'px; height: '.$display_height.'px; float: '.$float.';';
				if ($padding != null)
					$value .= " padding: $padding;";
				if ($paddingtop != null)
					$value .= " padding-top: $paddingtop;";
				if ($paddingright != null)
					$value .= " padding-right: $paddingright;";
				if ($paddingbottom != null)
					$value .= " padding-bottom: $paddingbottom;";
				if ($paddingleft != null)
					$value .= " padding-left: $paddingleft;";
				$value .= '">';
				if (strlen($link) > 0)
				{
					if (strcmp($link, 'full') == 0)
					{
						$link_image_data = wp_get_attachment_image_src($attachment->ID, 'full', false);
						$link = $link_image_data[0];
					}
					$value .= '<a href="'.$link.'">';
				}
				$value .= $full_image;
				if (strlen($link) > 0)
					$value .= '</a>';
				$value .= '</div>';

				return $value;
			}
		}
		if ($debug)
			$value .= "Image not found (id = $id, name = $name)";
		return $value;
	}
}
add_shortcode("wpgalleryimage", "shortcode_wpgalleryimage");
?>
