
<script src="<?=ADMIN_JS_DIR?>/jquery-1.11.1.min.js"></script>
<script src="<?=ADMIN_JS_DIR?>/jquery-ui-1.9.2.custom.js"></script>      
<script src="<?=FRONT_JS_DIR?>/common.js"></script>  

			<link rel="stylesheet" href="<?=FRONT_JS_DIR?>/slideshow/css/supersized.css" type="text/css" media="screen" />
			<link rel="stylesheet" href="<?=FRONT_JS_DIR?>/slideshow/theme/supersized.shutter.css" type="text/css" media="screen" />
			

			<script type="text/javascript" src="<?=FRONT_JS_DIR?>/slideshow/js/jquery.easing.min.js"></script>
			
			<script type="text/javascript" src="<?=FRONT_JS_DIR?>/slideshow/js/supersized.3.2.7.min.js"></script>
			<script type="text/javascript" src="<?=FRONT_JS_DIR?>/slideshow/theme/supersized.shutter.min.js"></script>

		<script type="text/javascript">
			
			jQuery(function($){
				
				$.supersized({
				
					// Functionality
					slideshow               :   1,			// Slideshow on/off
					autoplay				:	1,			// Slideshow starts playing automatically
					start_slide             :   1,			// Start slide (0 is random)
					stop_loop				:	0,			// Pauses slideshow on last slide
					random					: 	0,			// Randomize slide order (Ignores start slide)
					slide_interval          :   3000,		// Length between transitions
					transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
					transition_speed		:	1000,		// Speed of transition
					new_window				:	1,			// Image links open in new window/tab
					pause_hover             :   0,			// Pause slideshow on hover
					keyboard_nav            :   1,			// Keyboard navigation on/off
					performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
					image_protect			:	1,			// Disables image dragging and right click with Javascript
															   
					// Size & Position						   
					min_width		        :   0,			// Min width allowed (in pixels)
					min_height		        :   0,			// Min height allowed (in pixels)
					vertical_center         :   1,			// Vertically center background
					horizontal_center       :   1,			// Horizontally center background
					fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
					fit_portrait         	:   1,			// Portrait images will not exceed browser height
					fit_landscape			:   0,			// Landscape images will not exceed browser width
															   
					// Components							
					slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
					thumb_links				:	1,			// Individual thumb links for each slide
					thumbnail_navigation    :   0,			// Thumbnail navigation
					slides 					:  	[			// Slideshow Images
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_01.jpg', title : ''},
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_02.jpg', title : ''},
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_03.jpg', title : ''},
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_04.jpg', title : ''},
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_05.jpg', title : ''},
														{image : '<?=FRONT_IMG_DIR?>/sub/ex_06.jpg', title : ''}
												],
												
					// Theme Options			   
					progress_bar			:	1,			// Timer for each slide							
					mouse_scrub				:	0
					
				});
		    });
		    
		</script>
		

	<!--Thumbnail Navigation-->
	<div id="prevthumb"></div>
	<div id="nextthumb"></div>
	
	<!--Arrow Navigation-->
	<a id="prevslide" class="load-item"></a>
	<a id="nextslide" class="load-item"></a>
	
	<!--div id="thumb-tray" class="load-item">
		<div id="thumb-back"></div>
		<div id="thumb-forward"></div>
	</div-->
	
	<!--Time Bar-->
	<!--div id="progress-back" class="load-item">
		<div id="progress-bar"></div>
	</div-->
	
	<!--Control Bar-->
	<div id="controls-wrapper" class="load-item" style="margin:0 auto; height:42px; width:100%; bottom:220px; left:0; z-index:4; repeat-x; position:fixed;">
		<div id="controls">
			


			<ul id="slide-list"></ul>
			
		</div>
	</div>
	
	<div style="clear:both;" ></div>

			<!--div class="visual_01">
                <div class="navi">
                	<ul>
                    	<li class="on">1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                	</ul>
                </div>		 
        	</div-->

