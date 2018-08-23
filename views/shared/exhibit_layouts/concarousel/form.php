<?php
$formStem = $block->getFormStem();
$options = $block->getOptions();
?>
<div class="selected-items">
    <h4><?php echo __('Items'); ?></h4>
    <?php echo $this->exhibitFormAttachments($block); ?>
</div>
<div class="block-text">
    <h4><?php echo __('Text'); ?></h4>
    <?php echo $this->exhibitFormText($block); ?>
</div>
<div class="layout-options">
    <div class="block-header">
        <h4><?php echo __('Layout Options'); ?></h4>
        <div class="drawer"></div>
    </div>

    <div class="center-mode">
        <?php echo $this->formLabel($formStem . '[options][center-mode]', __('Center Thumbnails above image')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][center-mode]',
            @$options['center-mode'], array(),
            array(
                'true' => __('Yes'),
                'false' => __('No')
            ));
        ?>&nbsp;&nbsp;
        <?php echo $this->formLabel($formStem . '[options][captions-position]', __('Caption position')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][captions-position]',
            @$options['captions-position'], array(),
            array(
                'center' => __('Center'),
                'left' => __('Left'),
                'right' => __('Right')
            ));
        ?>
    </div>

    <div class="carousel-width">
        <?php echo $this->formLabel($formStem . '[options][carousel-width', __('Carousel Width')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][carousel-width]',
            @$options['carousel-width'], array(),
            array(
                '100%' => __('100%'),
	            '80%' => __('80%'),
                '70%' => __('70%'),
                '60%' => __('60%'),
                '50%' => __('50%'),
                '40%' => __('40%'),
            ));?>&nbsp;&nbsp;
        <?php echo $this->formLabel($formStem . '[options][carousel-float]', __('Float')); 
        echo $this->formSelect($formStem . '[options][carousel-float]',
            @$options['carousel-float'], array(),
            array(
                'left' => __('Left'),
	            'right' => __('Right'),
            ));
        ?>
    </div>

    <div class="start-slideshow">
        <?php echo $this->formLabel($formStem . '[options][start-slideshow]', __('Start Slideshow')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][start-slideshow]',
            @$options['start-slideshow'], array(),
            array(
                'false' => __('No'),
                'true' => __('Yes')
            ));?>&nbsp;&nbsp;
        <?php echo $this->formLabel($formStem . '[options][slideshow-speed]', __('Speed of slideshow')); 
        echo $this->formSelect($formStem . '[options][slideshow-speed]',
            @$options['slideshow-speed'], array(),
            array(
                '2000' => __('3 secs'),
	            '1500' => __('2 secs'),
                '1000' => __('1 sec'),
                '500' => __('.5 sec'),
            ));
        ?>
    </div>

	<div class="navs">
        <?php echo $this->formLabel($formStem . '[options][navs]', __('Use linked thumbnails')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][navs]',
            @$options['navs'], array(),
            array(
                'true' => __('Yes'),
                'false' => __('No')
            ));
		echo __('&nbsp;&nbsp;&nbsp;&nbsp; thumbnails are used for navigation.');
        ?>
    </div>
</div>
