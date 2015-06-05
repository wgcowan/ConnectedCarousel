 <?php
$captionPosition = isset($options['captions-position'])
    ? html_escape($options['captions-position'])
    : 'center';
$centerMode = isset($options['center-mode'])
    ? html_escape($options['center-mode'])
    : 'false';
$dotsNav = isset($options['dots'])
    ? html_escape($options['dots'])
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
if ($Nav == 'true'){
	$shoArrows = 'false';
	$setPos = 'block';
}else{
	$shoArrows = 'true'; 
	$setPos = 'none';
};
if ($width != '100%'){
	$tempwidth = '95%';
}else{
	$tempwidth = '100%';
};
if ($options['start-slideshow'] == 'true'){
	$shoArrows = 'false';
}else{
	$shoArrows = 'true';
};
?>
<div  style="max-width:100%; max-height:100%; width:<?php echo $width;?>; float:<?php echo $float;?>;">
<div class="carousel-navigation" style="display:<?php echo $setPos;?>; width:<?php echo $tempwidth;?>;">

   	<?php 
	foreach($attachments as $attItem): 
	    $item = $attItem->getItem();
		set_current_record('Item', $item);
		if (metadata('Item','has files'))
		{ ?>
			<?php echo files_for_item(
			array(
				'linkToFile' => false,
		    	'imageSize' => 'square_thumbnail'
			)
			);?>
	<?php };?>
	<?php endforeach; ?>		
</div>

	<div class="carousel-stage" style="width:<?php echo $tempwidth;?>;">
		<?php foreach($attachments as $attItem):
			$item = $attItem->getItem();
			set_current_record('Item', $item);
			if (metadata($item,'has files'))
			{ 
				$itemFiles = $item->Files;
				foreach($itemFiles as $itemfile):?>
				<div>
					<?php echo file_markup($itemfile,array('imageSize' => 'fullsize','linkToFile' => true, 'imgAttributes' => array('max-height'=>'100%','max-width'=>'100%','width'=>'100%')));?>
					<p class="desc caption-<?php echo $captionPosition; ?>">			
						<?php if (metadata($itemfile,array('Dublin Core','Title'))){
							echo metadata($itemfile,array('Dublin Core','Title'));
						}else{
							echo html_escape(metadata('Item', array('Dublin Core', 'Title'))),' ';    
						} ?>		    
					</p>
				</div>
				<?php endforeach; ?>
			<?php }; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php echo $text; ?>
	
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.carousel-stage')
		        .on('init', function(event, slick){
					jQuery('img.full')[0].onmouseover = (function() {
					    var onmousestop = function() {
					       jQuery('input.slick-next').css('display', 'none');
					       jQuery('input.slick-prev').css('display', 'none');
					    }, thread;

				    return function() {
				       jQuery('input.slick-next').css('display', 'block');
				       jQuery('input.slick-prev').css('display', 'block');
					        clearTimeout(thread);
					        thread = setTimeout(onmousestop, 2000);
					    };
					})();
		        });
	jQuery('.carousel-navigation').slick({
		centerPadding: '40px',
	    slidesToShow: 3,
	    slidesToScroll: 1,
	    asNavFor: '.carousel-stage',
		accessibility:true,
	    dots: <?php echo $dotsNav;?>,
	    centerMode: <?php echo $centerMode;?>,
	    focusOnSelect: true,
		swipeToSlide: true,
		variableWidth: false,
		adaptiveHeight: false,
		autoplay: <?php echo $autoplay;?>,
		autoplaySpeed: <?php echo $autoplaySpeed;?>,
		arrows: false,
	});
	 jQuery('.carousel-stage').slick({
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    arrows: <?php echo $shoArrows;?>,
	    fade: true,
		centerMode: true,
		variableWidth: false,
		adaptiveHeight: true,
	    asNavFor: '.carousel-navigation',
		prevArrow: '<input class="slick-prev" type="submit" value="&laquo;" />',
		nextArrow: '<input class="slick-next" type="submit" value="&raquo;" />',
	});
	jQuery(".download-file")
		.attr('rel', 'gallery')
		.fancybox({
	   		openEffect	: 'elastic',
	    	closeEffect	: 'elastic',
			fitToView: 'true',
			arrows: 'true',

	    	helpers : {
	    		title : {
	    			type : 'inside'
	    		}
	    	},
			'afterClose': function(current){
									jQuery('.carousel-navigation').slick('slickGoTo',this.index);
							}
				});

				jQuery('.carousel-stage').on('afterChange',function(event, slick, currentSlide, nextSlide){

				jQuery('img.full')[jQuery('.carousel-stage').slick('slickCurrentSlide')].onmouseover = (function() {
				    var onmousestop = function() {
				       jQuery('input.slick-next').css('display', 'none');
				       jQuery('input.slick-prev').css('display', 'none');
				    }, thread;

			    return function() {
			       jQuery('input.slick-next').css('display', 'block');
			       jQuery('input.slick-prev').css('display', 'block');
				        clearTimeout(thread);
				        thread = setTimeout(onmousestop, 2000);
				    };
				})();
				});

	});
</script>