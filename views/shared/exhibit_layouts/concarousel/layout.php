 <?php
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
$centerMode = isset($options['center-mode'])
    ? html_escape($options['center-mode'])
    : 'false';
$autoplay = isset($options['start-slideshow'])
    ? html_escape($options['start-slideshow'])
    : 'false';
$autoplaySpeed = isset($options['slideshow-speed'])
    ? html_escape($options['slideshow-speed'])
    : '2000';
$float = isset($options['carousel-float'])
	? html_escape($options['carousel-float'])
	: 'left';
$width = isset($options['carousel-width'])
	? html_escape($options['carousel-width'])
	: '100%';
$Nav = isset($options['navs'])
	? html_escape($options['navs'])
	: 'true';
?>

   	<?php 
	$sitems='';
	$slides=3;
	$file_count=0;
	foreach($attachments as $attItem):
		$item = $attItem->getItem();
		set_current_record('Item',$item);
		$file_count=$file_count + metadata('item','file count');
		$sitems = $sitems.','.metadata('item','id');
	endforeach;
	if ($file_count < 3 && $Nav=='true'){
		$Nav = 'false';
	};
	echo $this->shortcodes('[concarousel ids='.$sitems.' slides='.$slides.' navigation='.'false'.' navbar='.$Nav.' width='.$width.' float='.$float.' captionposition='.$captionPosition.' slideshow='.$autoplay.' speed='.$autoplaySpeed.' focus='.'true'.' center='.$centerMode.']');
	?>


