ConnectedCarousel
=================

Repository for Omeka shortcode plugin that creates a connected carousel of file images, with thumbnails below that can be used to navigate to the full sized images above.

Use:

[concarousel ids=12,15,45,11]

The ids should point to image files that will be used to construct the carousel. The carousel will consist of a thumbnail carousel that  you can navigate through with a carousel above that will slide to the image selected in the thumbnail carousel.

The showTitles parameter will show the Title, Creator and Date from the Item record that the image is part of. Or it will show the Title, Creator and Date field from the image file instead if the Title field of the image file is not null.

[concarousel ids=12,15,45,11 showTitles=true]

The purpose of the carousel is to construct a carousel of specific file images, rather than all the file images of a given item. This allows you to put any image from any item on a simple page in a carousel.

The concarousel shortcode uses the same paramters as the shortcode carousel.

The connected carousel will need CSS adjustments depending on your theme.
