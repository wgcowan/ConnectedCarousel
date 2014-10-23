<div class="connected-carousels">
	<div class="carousel carousel-stage" data-jcarousel="true">
		<ul style="left: 0px; top: 0px;">
			<?php foreach($files as $file): ?>
				<li>

					<?php
    				set_current_record('File',$file);
					$item_id = metadata('File', 'item_id');
					$item = get_record_by_id('Item', $item_id);
					set_current_record('Item', $item);?>
					<?php if(isset($configs['carousel']['showTitles']) && $configs['carousel']['showTitles'] ): ?>
					<div class="item-file image-jpeg" style="height:auto; width: auto; max-height:100%;max-width:100%;">
						<a class="download-file" href="<?php echo file_display_url($file,'fullsize');?>">
							<?php echo file_image('fullsize',array('height'=>'auto','max-height'=>'100%','max-width'=>'100%'));?>
						</a>
					</div>
						<p class="desc" style="padding-left:1em;width:25em;">
						<?php if (metadata('File', array('Dublin Core', 'Title'))):
							echo __('<b>Title:</b> '), metadata('File', array('Dublin Core', 'Title')),"<br/>";
							echo __('<b>Creator:</b> '), metadata('File',array('Dublin Core','Creator')),'<br/> ';
							echo __('<b>Date:</b> '), metadata('File',array('Dublin Core','Date')),'<br/>';							
						else:
					 		echo  __('<b>Title:</b> '), metadata('Item', array('Dublin Core', 'Title')),' ';    
							echo __('<b>Creator:</b> '), metadata('Item',array('Dublin Core','Creator')),' ';
							echo __('<b>Date:</b> '), metadata('Item',array('Dublin Core','Date')),'<br/>';
						endif;?> 
						</p>
					<?php else: ?>
						<div class="item-file image-jpeg" style="height:auto; width: auto; max-height:100%;max-width:100%;">
							<a class="download-file" href="<?php echo file_display_url($file,'fullsize');?>">
								<?php echo file_image('fullsize',array('height'=>'480','width'=>'auto','max-height'=>'100%','max-width'=>'100%'));?>
							</a>
						</div>
					<?php endif; ?>
    			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="stage">
		<div class="navigation">
			<a class="prev prev-navigation inactive" href="#" data-jcarouselcontrol="true">‹</a>
			<a class="next next-navigation" href="#" data-jcarouselcontrol="true">›</a>
			<div class="carousel carousel-navigation" data-jcarousel="true">
				<ul style="left: 0px; top: 0px;">
        			<?php foreach($files as $file): ?>
            			<li>

							<?php
            				set_current_record('File',$file);
							$item_id = metadata('File', 'item_id');
							$item = get_record_by_id('Item', $item_id);
							set_current_record('Item', $item);?>
							<div class="item-file image-jpeg">
							<a class="download-file" href="<?php echo file_display_url($file,'fullsize');?>">
							<?php echo file_image('square_thumbnail')?>
							</a>
							</div>
            			</li>
					<?php endforeach; ?>
        		</ul>
	    	</div>		
    	</div>
	</div>
</div>

<script type='text/javascript'>
var carouselConfig = <?php echo json_encode($configs['carousel']);?>;
var configs = <?php echo json_encode($configs);?>;
var carousel = jQuery('#jcarousel-<?php echo $id_suffix; ?>').jcarousel(carouselConfig);
<?php if(isset($configs['autoscroll'])): ?>
var autoscrollConfig = <?php echo json_encode($configs['autoscroll']);?>;
carousel.jcarouselAutoscroll(autoscrollConfig);
<?php endif; ?>
</script>
