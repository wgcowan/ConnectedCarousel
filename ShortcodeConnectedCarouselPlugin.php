<?php

class ShortcodeConnectedCarouselPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
		'public_head',
		'exhibit_builder_page_head');

    protected $_filters = array(
        'exhibit_layouts'
    );

    public function setUp()
    {
        add_shortcode('concarousel', array('ShortcodeConnectedCarouselPlugin', 'carousel'));
        parent::setUp();
    }

    public function hookPublicHead($args)
    {
        /**queue_css_file('jcarousel.connected-carousels');
        queue_css_file('carousel');
        queue_js_file('jcarousel.responsive');
        queue_js_file('jquery.jcarousel.min');
		**/
		queue_css_file('slick');
		queue_js_file('slick');
		queue_css_file('jquery.fancybox');
		queue_css_file('jquery.fancybox-buttons');
		queue_js_file('jquery.fancybox');?>
		<script type="text/javascript">
			jQuery(document).ready(function(){

				jQuery("a.iframe").fancybox({
			             'type': 'iframe'
				});
				});
		</script>
	<?php	
    }

    public function hookExhibitBuilderPageHead($args)
    {
           	queue_css_file('slick');
			queue_js_file('slick');
			queue_css_file('jquery.fancybox');
			queue_css_file('jquery.fancybox-buttons');
			queue_js_file('jquery.fancybox'); 
    }

    public function filterExhibitLayouts($layouts)
    {
        $layouts['concarousel'] = array(
            'name' => __('Connected Carousel'),
            'description' => __('Select images ids to display in a carousel')
        );
        return $layouts;
    }

    /**
     * Build HTML for the carousel
     * @param array $args
     * @param Zend_View $view
     * @return string HTML to display
     */
    public static function carousel($args, $view)
    {
        static $id_suffix = 0;
        if (isset($args['float'])) {
            $params['float'] = $args['float'];
        }else{
			$params['float'] = 'left';
		}

        if (isset($args['width'])) {
            $params['width'] = $args['width'];
        }else{
			$params['width'] = '100%';
		}

        if (isset($args['navbar'])) {
            $params['noNav'] = $args['navbar'];
        }else{
			$params['noNav'] = 'true';
		}
		
        if (isset($args['ids'])) {
            $params['range'] = $args['ids'];
        }

        if (isset($args['captionposition'])) {
            $params['captionLocation'] = $args['captionposition'];
        }else{
	 		$params['captionLocation'] = 'left';
		}
		
		if (isset($args['showdescription'])) {
            $params['showDescr'] = $args['showdescription'];
        }else{
	 		$params['showDescr'] = 'false';
		}
		
		$params['hasImage'] = 1;
		$result = preg_replace_callback('/(\d+)-(\d+)/', function($m) {
		    return implode(',', range($m[1], $m[2]));
		}, $args['ids']);
		$ids = explode(',',$result);
		foreach ($ids as $key => $item){
			if (get_record_by_id('item',$item)):
        		$items[$key] = get_record_by_id('item', $item);
			endif;
		};
       //handle the configs for Slick
        //$configs = array('slick' => array());

        //carousel configs
        if (isset($args['slides'])) {
            $configs['slidesToShow'] = $args['slides'];
		}else{
			$configs['slidesToShow'] = 5;
        }
        if (isset($args['scroll'])) {
            $configs['slidesToScroll'] = $args['scroll'];
		}else{
			$configs['slidesToScroll'] = 1;
        }

        if (isset($args['center'])) {
            $configs['centerMode'] = $args['center'];
		}else{
			$configs['centerMode'] = 'false';
        }

        if (isset($args['slideshow'])) {
            $configs['autoPlay'] = $args['slideshow'];
		}else{
			$configs['autoPlay'] = 'false';
        }

        if(isset($args['speed'])) {
            if(is_numeric($args['speed'])) {
                $configs['autoplaySpeed'] = (int) $args['speed'];
            } else {
                $configs['autoplaySpeed'] = $args['speed'];
            }
        }else{
			$configs['autoplaySpeed'] = 2000;
		}
        if(isset($args['focus'])){
            $configs['focusOnSelect'] = $args['focus'];
		}else{
			$configs['focusOnSelect'] = 'true';
        }

        if (isset($args['navigation'])){
            $configs['arrows'] = $args['navigation'];
		}else{
			$configs['arrows'] = 'false';
        }

        $html = $view->partial('carousel.php', array('items' => $items, 'id_suffix' => $id_suffix, 'params' => $params, 'configs' => $configs));
        $id_suffix++;
        return $html;
    }
}
