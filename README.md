<<<<<<< HEAD
ConnectedCarousel
=================

	Connected Carousel for Omeka

	The basic connected carousel uses the thumbnails for a set of images as a navigation bar with the full size image displayed below. By clicking on a thumbnail or dragging the navigation bar, you can move from image to image.
	The only parameter required for the carousel is the ids for the items with images that you want to display. 
	You can enter those ids as comma separated values, as a range of values and in any order you like. The “ids = “ parameter will accept “ids = 1,2,34, 7-8, 17-30”. If an id you enter does not in fact exist, it will skip it and if the item with an id you entered does not have an image, it will skip that as well. Consequently, if you enter a range that has either items with no images or missing items, those items are just skipped so you don’t need to make sure that all items have images and all items exist in a given range. Additionally, all images for a given item will be displayed. So if an item has five files associated with it, all five files show up in the carousel.

	An added feature is that now when you click on the image, instead of going to a page with just the image, you get a lightbox effect, with the image popping up on the same page and then darkening the rest of the page as a lightbox does. You can move forward in lightbox mode by clicking the arrows. The carousel keeps track of your position in the carousel and when you close the lightbox, with the close button or clicking outside the lightbox, you will be takenin the carousel to the image in the lightbox.

	Use as a Shortcode

	While “ids =“ is the only required parameter, there are a variety of parameters that allow you to configure exactly how the carousel displays and behaves. This is a sample shortcode entry as it might appear on a Simple Page.

	[concarousel ids=1789,1801,1812,1868-1872 center=true slides=5 showdescription=false captionposition=center width=100% float=left slideshow=false speed=2500 focus=true navigation=false navbar=true]

	The parameters are listed below with a brief description.

ids=1789,1801,1812,1868-1872
	This shows an ids parameter with a several individual items, followed by a range. All items in the range that exist and have images will be displayed. In addition, all images for all items will be displayed, even items with multiple images.
center=true
	This determines whether the thumbnail in the navigation bar is in the center of the navigation bar (true) or whether the thumbnail is on the left end (i.e. the first item) of the navigation bar (false).
slides=5 
	This parameter determines how many full slides will display in the navigation bar. There might be partial slides to the left or right on the navigation bar but there will be 5 full slides displayed on the bar. As a general rule, you should always use an odd number of slides if center = true so that you have an even number to the right and left of the center slide.
showdescription=false
	This will display the descriptive metadata below the full size image. This uses the same code that show.php does so it will behave in a similar manner. I.e. it will only display fields with values if that is set in Settings and it pays attention to the setting in other plugins such as Hide Elements and will display elements as set by that plugin.
captionposition=center 
	This parameter has four values: left, center, right and none. The caption appears below the full size image on the left, center or right depending on the value of this parameter. The default caption is the Dublin Core Description field. If the Dublin Core Description field is not empty for the image file, it uses that value as the caption. If it is empty, then it uses the Dublin Core Description field for the item that the image belongs to. If you have showdescription = true, then you may not want the caption to display. Set captionpostion = none and no caption appears below the image.
width=100% 
	This parameter sets the size of your carousel. Any value less than 100% will cause the both the width and the height of the carousel to be reduced. And for most themes, any text on the page will then float next to the carousel.
float=left 
	This parameter is used in conjunction with the width parameter. If the width parameter is less than 100%, then you can use this parameter to determine whether the carousel will float to the left side or the right side of the page.
slideshow=false 
	This parameter allows a simple animated slide show. To pause the slideshow, just move the mouse cursor over the navigation bar. To restart, just move the mouse cursor off the navigation bar.
speed=2500 
	And this parameter determines the speed of the slideshow. The current setting is about 2 seconds.
focus=true 
	This parameter is related to slideshows in the sense that when set to true, this allows you to select an image or scroll to an image in the navigation bar. If you are doing a slide show, you may not want the user to be able interrupt the slideshow in that manner so you can set focus = false and clicking or sliding the navigation bar will not disrupt the slideshow.
navigation=false 
	It is possible to have a line of dots below the navigation bar that allows users to easily jump to the beginning, the end or any slide. Works best with 15 or fewer slides in the carousel.
navbar=true
	This parameter can be used to turn off the navigation thumbnail bar in the carousel and just display the full size image. When this is set to false, arrows will appear on the full size image so that you can navigate to the next or previous image. After a short pause, these arrows disappear but will reappear when you move the mouse over the image. 

	Use in an Exhibit

	By installing this plugin, you also get the ability to use the connected carousel with Exhibit Builder. Now as you build exhibits, you have the option to create a Connected Carousel block in an exhibit page. 

	The Connected Carousel block has a subset of the same options available for the shortcode. These parameters are all set by drop down selectors so the choices are not as flexible. 

	Use with Showing an Item

	Using the Connected Carousel to display the image file for an item can be useful, especially if that item has multiple files. Using the carousel with an item involves modifying show.php and replacing the line of code that displays an image (it often looks like this) 

	<?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
	<?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
	<?php endif; ?>

	with the following:

	<?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
	<?php echo $this->shortcodes('[concarousel ids='.metadata('item','id').' center=false slides=3 showdescription=true captionposition=right width=100% float=right slideshow=false speed=2000 focus=true navigation=false navbar=false]');?>
	<?php endif; ?>
	If any item has multiple images associated with it, the carousel would display arrows to cycle through them or you could use the slideshow option to automatically display the images.

	Credits

	The coordinating work was done by William G. Cowan.

	The carousel uses Slick, the last carousel you’ll ever need, http://kenwheeler.github.io/slick/ developed by Ken Wheeler.

	The lightbox uses Fancybox, a jQuery lightbox, http://fancybox.net/home.



=======
concarousel
===========

ConnectedCarousel

Repository for Omeka shortcode plugin that creates a connected carousel of file images, with thumbnails below that can be used to navigate to the full sized images above.

Use:

[concarousel ids=12,15,45,11,17-23]

The ids should point to image files that will be used to construct the carousel. The carousel will consist of a thumbnail carousel that you can navigate through with a carousel above that will slide to the image selected in the thumbnail carousel.

The showTitles parameter will show the Title, Creator and Date from the Item record that the image is part of. Or it will show the Title, Creator and Date field from the image file instead if the Title field of the image file is not null.

[concarousel ids=12,15,45,11 showTitles=true]

The purpose of the carousel is to construct a carousel of specific file images, rather than all the file images of a given item. This allows you to put any image from any item on a simple page in a carousel.

The concarousel shortcode uses the same paramters as the shortcode carousel.

The connected carousel will need CSS adjustments depending on your theme.

Change the name of your directory to ShortcodeConnectedCarousel
>>>>>>> f49dbd0b70d397ff8895b7c2ab5fcc4fded4bb4f
