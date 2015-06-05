<div style="margin-left:.5em; margin-right:.5em; width:<?php echo $params['width'];?>;float:<?php echo $params['float'];?>;">
<div class="carousel-navigation">

   	<?php foreach($files as $file): 
	if ($file)
		{ ?>
    	<div>
			<?php set_current_record('File',$file);
			$item_id = metadata('File', 'item_id');
			$item = get_record_by_id('Item', $item_id);
			set_current_record('Item', $item);?>
				<?php echo file_image('thumbnail',array('title'=>''));?>
		</div>
	<?php };?>
	<?php endforeach; ?>		
</div>
</div>

<div style="margin-left:.5em; margin-right:.5em; width:<?php echo $params['width'];?>;float:<?php echo $params['float'];?>">
<div class="carousel-stage">
	<?php foreach($files as $file):
		if ($file)
		{ ?>
		<div >
			<?php
			set_current_record('File',$file);
			$item_id = metadata('File', 'item_id');
			$item = get_record_by_id('Item', $item_id);
			set_current_record('Item', $item);?>
			<div class="item-file image-jpeg">
				<a class="download-file" href="<?php echo file_display_url($file,'fullsize');?>">
				<?php echo file_image('fullsize',array('max-height'=>'100%','max-width'=>'100%','width'=>'100%','title'=>''));?>
				</a>
				<p class="desc">
				<?php if (metadata('File', array('Dublin Core', 'Title'))):
					echo metadata('File', array('Dublin Core', 'Title')),"<br/>";
				else:
			 		echo html_escape(metadata('Item', array('Dublin Core', 'Title'))),' ';    
				endif;?> 
				</p>
			</div>
 		</div>
		<?php }; ?>
	<?php endforeach; ?>
</div>
</div>
	
<script type="text/javascript">
	jQuery(document).ready(function(){
	jQuery('.carousel-navigation').slick({
	    slidesToShow: 3,
	    slidesToScroll: 1,
	    asNavFor: '.carousel-stage',
		accessibility:true,
	    dots: false,
	    centerMode: true,
		centerPadding: '20%',
	    focusOnSelect: true,
		swipeToSlide: true,
		variableWidth: true,
		adaptiveHeight: true,
		arrows: false,
	});
	 jQuery('.carousel-stage').slick({
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    arrows: false,
	    fade: true,
		centerMode: true,
		centerPadding:'20%',
		variableWidth: false,
		adaptiveHeight: true,
	    asNavFor: '.carousel-navigation'
	});
	});
</script>
