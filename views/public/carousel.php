<?php
$captionPosition = isset($params['captionLocation'])
    ? html_escape($params['captionLocation'])
    : 'left';
$showDesc = isset($params['showDescr'])
    ? html_escape($params['showDescr'])
    : 'false';
$float = isset($params['float'])
	? html_escape($params['float'])
	: 'left';
$width = isset($params['width'])
	? html_escape($params['width'])
	: '95%';
$Nav = isset($params['noNav'])
	? html_escape($params['noNav'])
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
if ($configs['autoPlay'] == 'true'){
	$shoArrows = 'false';
}else{
	$shoArrows = 'true';
};
?>

<div style="max-width:100%; max-height:100%; width:<?php echo $width;?>; float:<?php echo $float;?>; ">
	<div class="carousel-navigation" style="max-width:100%; max-height:100%; width:<?php echo $tempwidth;?>; display:<?php echo $setPos;?>">
		<?php foreach($items as $item): 
			set_current_record('Item', $item);
			if (metadata($item,'has files'))
			{	?>
				<?php echo files_for_item(
				array(
					'linkToFile' => false,
					'imageSize' => 'square_thumbnail'
				)
			);?>
			<?php }; ?>
		<?php endforeach; ?>
	</div>		

	<div class="carousel-stage" style="max-width:100%; max-height:100%; width:<?php echo $tempwidth;?>;" >
		<?php foreach($items as $item):
			set_current_record('Item', $item);
			if (metadata($item,'has files'))
			{ 
				$itemFiles = $item->Files;
				foreach($itemFiles as $itemfile):?>
				<div>
					<?php echo file_markup($itemfile,array('imageSize' => 'fullsize','linkToFile' => true, 'imgAttributes' => array('max-height'=>'100%','max-width'=>'100%','width'=>'100%')));?>
					<?php if ($captionPosition != 'none'){ ?>
						
					<p class="desc caption-<?php echo $captionPosition; ?>">			
						<?php if (metadata($itemfile,array('Dublin Core','Title'))){
							echo metadata($itemfile,array('Dublin Core','Title'));
						}else{
							echo html_escape(metadata($item, array('Dublin Core', 'Title'))),' ';    
						}?>
					</p>
					<?php }?>
								
						<?php if ($showDesc == 'true'):?>
								<div id="item-metadata">
									<?php echo all_element_texts('item'); ?>
								</div>
						<?php endif; ?>	
				</div>
				<?php endforeach; ?>
			<?php }; ?>
		<?php endforeach; ?>
	</div>
</div>
	
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
		centerPadding: '60px',
	    asNavFor: '.carousel-stage',
		accessibility:true,    
		swipeToSlide: true,
		variableWidth: false,
		adaptiveHeight: false,
		slidesToShow: <?php echo $configs['slidesToShow'];?>,
		slidesToScroll: <?php echo $configs['slidesToScroll'];?>,
	    centerMode: <?php echo $configs['centerMode'];?>,
		autoplay: <?php echo $configs['autoPlay'];?>,
		autoplaySpeed: <?php echo $configs['autoplaySpeed'];?>,
	    focusOnSelect: <?php echo $configs['focusOnSelect'];?>,
		arrows: <?php echo $configs['arrows'];?>,
		prevArrow: '<input class="slick-prev" type="submit" value="&laquo;" />',
		nextArrow: '<input class="slick-next" type="submit" value="&raquo;" />',
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
				'beforeClose': function(current){
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
