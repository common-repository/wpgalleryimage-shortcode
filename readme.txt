=== Plugin Name ===
Contributors: DavidPotter
Tags: images, gallery, shortcode
Requires at least: 2.5
Tested up to: 2.8.5
Stable tag: 1.1

Adds the [wpgalleryimage] shortcode for inserting into a post or a page one of the images you uploaded into your WordPress gallery.

== Description ==

Lets you add an image to a post or page from the WordPress gallery on your site using a shortcode.  Simply add the wppgalleryimage shortcode and specify the image you want to add by name or ID.

When you insert an image using the built-in WordPress editor, the full URL to the image on your site is inserted into the page or post. Using the shortcode, all you need to specify is the name or ID of the image and the URL is generated automatically.

When an image is uploaded to the gallery, the file is stored under wp-content/uploads and metadata about the image is stored in the `wp_posts` table with a `post_type` of `attachment`.  The image is added to post or page within a `<div>` tag that specifies the `wpgalleryimage_shortcode` class, which allows you to define a style for all images added by the shortcode.

= Parameters =

*   **id** - The ID of the image in the `wp_posts` table.

*   **name** - The name of the image from the `post_name` field in the `wp_posts` table.
	The name must match exactly.

*   **title** - The titlee of the image from the `post_title` field in the `wp_posts` table.
	The title must match exactly.

*   **size** - The size of the image.
	This value is passed to the
	[`wp_get_attachment_image`](http://codex.wordpress.org/Function_Reference/wp_get_attachment_image "Function Reference/wp get attachment image")
	function.
	Valid values include:
	* `thumbnail` (default)
	* `medium`
	* `large`
	* `full`

*   **width** and **height** - The width and height of the image to display.
	The most appropriate image file will be used to display the image.
	Both must be specified or they will be ignored.
	If these parameters are specified, the **size** parameter is ignored.

*   **float** - How to float the image on the page.  Valid values include:
	* `none` (default)
	* `left`
	* `right`

*   **link** - The URL to link to when the image is clicked on.  You can also specify `full` to link to the full-size image.

*   **padding**, **paddingtop**, **paddingright**, **paddingbottom**, **paddingleft** - The amount of padding around the image.
	If floating left, defaults to `10px` on the right.
	If floating right, defaults to `10px` on the left.

= Examples =

>   [wpgalleryimage id="19"]

>   [wpgalleryimage name="my-logo"]

>   [wpgalleryimage title="My Logo"]

>   [wpgalleryimage name="my-logo" size="medium"]

>   [wpgalleryimage name="my-logo" width="100" height="100"]

>   [wpgalleryimage name="my-logo" float="right"]

>   [wpgalleryimage name="my-logo" link="full"]

>   [wpgalleryimage name="my-logo" link="http://www.example.com/"]

>   [wpgalleryimage name="my-logo" paddingbottom="10px"]

== Installation ==

1. Download the `wpgalleryimage-shortcode.zip` file.
2. Unzip the zip file and copy the contents to a folder below `/wp-content/plugins`.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Place the `[wpgalleryimage]` shortcode in your posts and pages.

== Frequently Asked Questions ==

= How do I display an image without a link? =

Omit the `link` parameter.  A link is only added if you specify the `link` parameter.

== Changelog ==

= 1.1 =
* Added support for specifying the image by title.
* Fixed the attachment query to be more reliable.

= 1.0 =
* Initial release.
