<?php

if(!class_exists('Kopa_Page_Builder'))
    return;

add_action('init', 'divine_page_builder_init');
add_filter('kopa_page_builder_get_layouts', 'divine_page_builder_set_layouts');
add_filter('kopa_page_builder_get_areas', 'divine_page_builder_set_areas');
add_filter('kopa_page_builder_get_section_fields', 'divine_page_builder_set_section_fields');
add_filter('body_class', 'divine_page_builder_set_body_class');
add_action('wp_enqueue_scripts', 'divine_page_builder_enqueue_script', 20);
add_filter('kopa_page_builder_get_customize_fields', 'divine_page_builder_set_customize_fields');

function divine_page_builder_init(){
	add_filter('kopa_get_template_part', 'divine_page_builder_get_template_part');
}

function divine_page_builder_set_areas($areas){

    $areas['area-1']     = __( 'Area 1', divine_get_domain() );
    
    $areas['area-2']     = __( 'Area 2', divine_get_domain() );
    $areas['area-2-1']   = __( 'Area 2.1', divine_get_domain() );
    $areas['area-2-2']   = __( 'Area 2.2', divine_get_domain() );
    $areas['area-2-3']   = __( 'Area 2.3', divine_get_domain() );
    $areas['area-2-4']   = __( 'Area 2.4', divine_get_domain() );
    
    $areas['area-3']     = __( 'Area 3', divine_get_domain() );
    $areas['area-3-1']   = __( 'Area 3.1', divine_get_domain() );
    $areas['area-3-2']   = __( 'Area 3.2', divine_get_domain() );
    $areas['area-3-3']   = __( 'Area 3.3', divine_get_domain() );
    $areas['area-3-4']   = __( 'Area 3.4', divine_get_domain() );
    
    $areas['area-3-1-1'] = __( 'Area 3.1.1', divine_get_domain() );
    $areas['area-3-1-2'] = __( 'Area 3.1.2', divine_get_domain() );
    $areas['area-3-1-3'] = __( 'Area 3.1.3', divine_get_domain() );
    $areas['area-3-1-4'] = __( 'Area 3.1.4', divine_get_domain() );
    
    $areas['area-3-2']   = __( 'Area 3.2', divine_get_domain() );
    
    $areas['area-4']     = __( 'Area 4', divine_get_domain() );
    $areas['area-4-1']   = __( 'Area 4.1', divine_get_domain() );
    $areas['area-4-2']   = __( 'Area 4.2', divine_get_domain() );
    $areas['area-4-3']   = __( 'Area 4.3', divine_get_domain() );
    $areas['area-4-4']   = __( 'Area 4.4', divine_get_domain() );
    
    $areas['area-5']     = __( 'Area 5', divine_get_domain() );
    $areas['area-5-1']   = __( 'Area 5.1', divine_get_domain() );
    $areas['area-5-2']   = __( 'Area 5.2', divine_get_domain() );
    $areas['area-5-3']   = __( 'Area 5.3', divine_get_domain() );
    
    $areas['area-6']     = __( 'Area 6', divine_get_domain() );
    
    $areas['area-7']     = __( 'Area 7', divine_get_domain() );	
    
    $areas['area-8']     = __( 'Area 8', divine_get_domain() );

	return $areas;
}

function divine_page_builder_set_layouts($layouts){
    $layouts['disable'] = array(
       'title' => __('-- Disable --', divine_get_domain())        
    );
	
    $layouts['front-page-1'] = array(
		'title' => __('Front page 1', divine_get_domain()),
        'preview' => get_template_directory_uri() . '/images/layouts/front-page-1.png',
        'customize' => array( 
            'custom' => array(
                'title' => __('Custom', divine_get_domain()),
                'params' => array(                  
                    'css' => array(     
                        'type' => 'textarea',
                        'title' => __('CSS code', divine_get_domain()),
                        'default' => '',
                        'rows' => 10,       
                        'class' => 'kpb-ui-textarea-guide-line',                        
                    ),
                )
            )
        ),
        'section' => array(
        	'row-1' => array(
        		'title' => __('Row 1', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-1',
        		)
         	),
         	'row-2' => array(
        		'title' => __('Row 2', divine_get_domain()),
        		'grid' => array(3, 3, 3, 3),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-2-1',
        			'area-2-2',
        			'area-2-3',
        			'area-2-4',
        		)
         	),
         	'row-3' => array(
        		'title' => __('Row 3', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-3',
        		)
         	),
         	'row-4' => array(
        		'title' => __('Row 4', divine_get_domain()),
        		'grid' => array(4,4,4),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-4-1',
        			'area-4-2',
        			'area-4-3',
        		)
         	),
         	'row-5' => array(
        		'title' => __('Row 5', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-5',        			
        		)
         	),
         	'row-6' => array(
        		'title' => __('Row 6', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-6',        			
        		)
         	),
         	'row-7' => array(
        		'title' => __('Row 7', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-7',        			
        		)
         	),         	
        )       
	);
	
	$layouts['front-page-2'] = array(
		'title' => __('Front page 2', divine_get_domain()),
        'preview' => get_template_directory_uri() . '/images/layouts/front-page-2.png',
        'customize' => array(        	
        	'custom' => array(
                'title' => __('Custom', divine_get_domain()),
                'params' => array(                  
                    'css' => array(     
                        'type' => 'textarea',
                        'title' => __('CSS code', divine_get_domain()),
                        'default' => '',
                        'rows' => 10,       
                        'class' => 'kpb-ui-textarea-guide-line',                        
                    ),
                )
            )
        ),
        'section' => array(
        	'row-1' => array(
        		'title' => __('Row 1', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-1',
        		)
         	),
         	'row-2' => array(
        		'title' => __('Row 2', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-2',
        		)
         	),
         	'row-3' => array(
        		'title' => __('Row 3', divine_get_domain()),
        		'description' => '',
        		'grid' => array(9,3),
        		'customize' => array(),        		
        		'area' => array(
        			array(
        				'grid' => array(
        					array(12),
        					array(4, 4, 4)        					
        				),
        				'area' => array(
        					array('area-3-1-1'),
        					array(
        						'area-3-1-2',
        						'area-3-1-3',
        						'area-3-1-4',
        					),        					
        				)
        			),        			
        			'area-3-2',
        		)
         	),
         	'row-4' => array(
        		'title' => __('Row 4', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-4',        			
        		)
         	),
         	'row-5' => array(
        		'title' => __('Row 5', divine_get_domain()),
        		'description' => '',
        		'grid' => array(3,9),
        		'customize' => array(),        		
        		'area' => array(
        			'area-5-1',
        			'area-5-2',
        		)
         	),         	
         	'row-6' => array(
        		'title' => __('Row 6', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-6',
        			
        		)
         	),         	
		)
	);

	$layouts['front-page-3'] = array(
		'title' => __('Front page 3 (parallax header)', divine_get_domain()),
        'preview' => get_template_directory_uri() . '/images/layouts/front-page-3.png',
        'customize' => array(
        	'parallax' => array(
        		'title' => __('Parallax', divine_get_domain()),
        		'params' => array(
        			'background-image' => array(		
						'type' => 'image',
						'title' => __('Background image', divine_get_domain()),
						'default' => '',								
					),
					'overlay-color' => array(		
						'type' => 'color',
						'title' => __('Overlay color', divine_get_domain()),
						'default' => '',								
					),
					'overlay-opacity' => array(		
						'type' => 'select',
						'title' => __('Overlay opacity', divine_get_domain()),
						'default' => 30,
						'options' => array(
                            0   => __('0 %', divine_get_domain()),
                            5   => __('5 %', divine_get_domain()),
                            10  => __('10 %', divine_get_domain()),
                            15  => __('15 %', divine_get_domain()),
                            20  => __('20 %', divine_get_domain()),
                            25  => __('25 %', divine_get_domain()),
                            30  => __('30 %', divine_get_domain()),
                            35  => __('35 %', divine_get_domain()),
                            40  => __('40 %', divine_get_domain()),
                            45  => __('45 %', divine_get_domain()),
                            50  => __('50 %', divine_get_domain()),
                            55  => __('55 %', divine_get_domain()),
                            60  => __('60 %', divine_get_domain()),
                            65  => __('65 %', divine_get_domain()),
                            70  => __('70 %', divine_get_domain()),
                            75  => __('75 %', divine_get_domain()),
                            80  => __('80 %', divine_get_domain()),
                            85  => __('85 %', divine_get_domain()),
                            90  => __('90 %', divine_get_domain()),
                            95  => __('95 %', divine_get_domain()),
                            100 => __('100 %', divine_get_domain()),
						),
					),
        		),
        	),
			'custom' => array(
				'title' => __('Custom', divine_get_domain()),
				'params' => array(					
					'css' => array(		
						'type' => 'textarea',
						'title' => __('CSS code', divine_get_domain()),
						'default' => '',
						'rows' => 10,		
						'class' => 'kpb-ui-textarea-guide-line',						
					),
				)
			)
        ),
        'section' => array(
        	'row-1' => array(
        		'title' => __('Row 1', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-1',
        		)
         	),
         	'row-2' => array(
        		'title' => __('Row 2', divine_get_domain()),
        		'description' => '',
        		'grid' => array(12),
        		'customize' => array(),        		
        		'area' => array(
        			'area-2',
        		)
         	),
         	'row-3' => array(
        		'title' => __('Row 3', divine_get_domain()),
        		'description' => '',
        		'grid' => array(3,3,3,3),
        		'customize' => array(),        		
        		'area' => array(        			
					'area-3-1',
					'area-3-2',
					'area-3-3',        						
        			'area-3-4',
        		)
         	),
         	'row-4' => array(
        		'title' => __('Row 4', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-4',
        		)
         	),
         	'row-5' => array(
        		'title' => __('Row 5', divine_get_domain()),
        		'grid' => array(4,4,4),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-5-1',
        			'area-5-2',
        			'area-5-3',
        		)
         	),
         	'row-6' => array(
        		'title' => __('Row 6', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-6',        			
        		)
         	),
         	'row-7' => array(
        		'title' => __('Row 7', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-7',        			
        		)
         	),
         	'row-8' => array(
        		'title' => __('Row 8', divine_get_domain()),
        		'grid' => array(12),
        		'description' => '',
        		'customize' => array(),        		
        		'area' => array(
        			'area-8',        			
        		)
         	),         	
        )
	);   

    $layouts['about-page'] = array(
        'title' => __('About page', divine_get_domain()),
        'preview' => get_template_directory_uri() . '/images/layouts/about-page.png',
        'customize' => array( 
            'custom' => array(
                'title' => __('Custom', divine_get_domain()),
                'params' => array(                  
                    'css' => array(     
                        'type' => 'textarea',
                        'title' => __('CSS code', divine_get_domain()),
                        'default' => '',
                        'rows' => 10,       
                        'class' => 'kpb-ui-textarea-guide-line',                        
                    ),
                )
            )
        ),
        'section' => array(
            'row-1' => array(
                'title' => __('Row 1', divine_get_domain()),
                'description' => '',
                'grid' => array(12),
                'customize' => array(),             
                'area' => array(
                    'area-1',
                )
            ),
            'row-2' => array(
                'title' => __('Row 2', divine_get_domain()),
                'grid' => array(6, 6),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-2-1',
                    'area-2-2',                    
                )
            ),
            'row-3' => array(
                'title' => __('Row 3', divine_get_domain()),
                'grid' => array(12),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-3',
                )
            ),
            'row-4' => array(
                'title' => __('Row 4', divine_get_domain()),
                'grid' => array(6, 6),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-4-1',
                    'area-4-2',                    
                )
            ),
            'row-5' => array(
                'title' => __('Row 5', divine_get_domain()),
                'grid' => array(12),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-5',                   
                )
            ),
        )       
    );    

    $layouts['contact-page'] = array(
        'title' => __('Contact page', divine_get_domain()),
        'preview' => get_template_directory_uri() . '/images/layouts/contact-page.png',
        'customize' => array( 
            'custom' => array(
                'title' => __('Custom', divine_get_domain()),
                'params' => array(                  
                    'css' => array(     
                        'type' => 'textarea',
                        'title' => __('CSS code', divine_get_domain()),
                        'default' => '',
                        'rows' => 10,       
                        'class' => 'kpb-ui-textarea-guide-line',                        
                    ),
                )
            )
        ),
        'section' => array(
            'row-1' => array(
                'title' => __('Row 1', divine_get_domain()),
                'description' => '',
                'grid' => array(12),
                'customize' => array(),             
                'area' => array(
                    'area-1',
                )
            ),
            'row-2' => array(
                'title' => __('Row 2', divine_get_domain()),
                'grid' => array(6,6),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-2-1',
                    'area-2-2',                    
                )
            ),
            'row-3' => array(
                'title' => __('Row 3', divine_get_domain()),
                'grid' => array(4,4,4),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-3-1',
                    'area-3-2',
                    'area-3-3',
                )
            ),
            'row-4' => array(
                'title' => __('Row 4', divine_get_domain()),
                'grid' => array(3,3,3,3),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-4-1',
                    'area-4-2',
                    'area-4-3',
                    'area-4-4',
                )
            ),
            'row-5' => array(
                'title' => __('Row 5', divine_get_domain()),
                'grid' => array(12),
                'description' => '',
                'customize' => array(),             
                'area' => array(
                    'area-5',                   
                )
            ),
        )       
    );

	return $layouts;
}

function divine_page_builder_set_customize_fields($fields){
	$fields['title']['title'] =  __('Title', divine_get_domain());	
	$fields['title']['params'] = array(        
		'style' => array(		
			'type' => 'select',
			'title' => __('Style', divine_get_domain()),
			'default' => 'default',								
			'options' => array(
				'default' => __('-- Default (H3 size 1) --', divine_get_domain()),
				'position-absolute' => __('Title with position:absolute', divine_get_domain()),
				'with-background' => __('Title with background color', divine_get_domain()),
				'with-sub-title' => __('Title with sub title', divine_get_domain()),
				'with-bottom-border' => __('Title with bottom border (3px)', divine_get_domain()),
				'with-bottom-border-1px' => __('Title with bottom border (1px)', divine_get_domain()),
			)
		),
		'subtitle' => array(
			'type' => 'textarea',
			'title' => __('Sub title', divine_get_domain()),
			'default' => '',
		),
		'icon' => array(		
			'type' => 'icon',
			'title' => __('Icon', divine_get_domain()),
			'default' => '',				
		),
		'top' => array(		
			'type' => 'number',
			'title' => __('Top', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),		
		'bottom' => array(		
			'type' => 'number',
			'title' => __('Bottom', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'left' => array(		
			'type' => 'number',
			'title' => __('Left', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'right' => array(		
			'type' => 'number',
			'title' => __('Right', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),		
	);		

	$fields['effect']['title'] =  __('Effect', divine_get_domain());	
	$fields['effect']['params'] = array(
		'effect' => array(		
			'type' => 'select',
			'title' => __('Effect', divine_get_domain()),
			'default' => 'default',								
			'options' => array(
				'' => __('-- Select a effect --', divine_get_domain()),
				"bounce" => "bounce",
	            "flash" => "flash",
	            "pulse" => "pulse",
	            "rubberBand" => "rubberBand",
	            "shake" => "shake",
	            "swing" => "swing",
	            "tada" => "tada",
	            "wobble" => "wobble",
	            "bounceIn" => "bounceIn",
	            "bounceInDown" => "bounceInDown",
	            "bounceInLeft" => "bounceInLeft",
	            "bounceInRight" => "bounceInRight",
	            "bounceInUp" => "bounceInUp",
	            "bounceOut" => "nceOut",
	            "bounceOutDown" => "bounceOutDown",
	            "bounceOutLeft" => "bounceOutLeft",
	            "bounceOutRight" => "bobouunceOutRight",
	            "bounceOutUp" => "bounceOutUp",
	            "fadeIn" => "fadeIn",
	            "fadeInDown" => "fadeInDown",
	            "fadeInDownBig" => "fadeInDownBig",
	            "fadeInLeft" => "fadeInLeft",
	            "fadeInLeftBig" => "fadeInLeftBig",
	            "fadeInRight" => "fadeInRight",
	            "fadeInRightBig" => "fadeInRightBig",
	            "fadeInUp" => "fadeInUp",
	            "fadeInUpBig" => "fadeInUpBig",
	            "fadeOut" => "fadeOut",
	            "fadeOutDown" => "fadeOutDown",
	            "fadeOutDownBig" => "fadeOutDownBig",
	            "fadeOutLeft" => "fadeOutLeft",
	            "fadeOutLeftBig" => "fadeOutLeftBig",
	            "fadeOutRight" => "fadeOutRight",
	            "fadeOutRightBig" => "fadeOutRightBig",
	            "fadeOutUp" => "fadeOutUp",
	            "fadeOutUpBig" => "fadeOutUpBig",
	            "flip" => "flip",
	            "flipInX" => "flipInX",
	            "flipInY" => "flipInY",
	            "flipOutX" => "flipOutX",
	            "flipOutY" => "flipOutY",
	            "lightSpeedIn" => "lightSpeedIn",
	            "lightSpeedOut" => "lightSpeedOut",
	            "rotateIn" => "rotateIn",
	            "rotateInDownLeft" => "rotateInDownLeft",
	            "rotateInDownRight" => "rotateInDownRight",
	            "rotateInUpLeft" => "rotateInUpLeft",
	            "rotateInUpRight" => "rotateInUpRight",
	            "rotateOut" => "rotateOut",
	            "rotateOutDownLeft" => "rotateOutDownLeft",
	            "rotateOutDownRight" => "rotateOutDownRight",
	            "rotateOutUpLeft" => "rotateOutUpLeft",
	            "rotateOutUpRight" => "rotateOutUpRight",
	            "hinge" => "hinge",
	            "rollIn" => "rollIn",
	            "rollOut" => "rollOut",
	            "zoomIn" => "zoomIn",
	            "zoomInDown" => "zoomInDown",
	            "zoomInLeft" => "zoomInLeft",
	            "zoomInRight" => "zoomInRight",
	            "zoomInUp" => "zoomInUp",
	            "zoomOut" => "zoomOut",
	            "zoomOutDown" => "zoomOutDown",
	            "zoomOutLeft" => "zoomOutLeft",
	            "zoomOutRight" => "zoomOutRight",
	            "zoomOutUp" => "zoomOutUp"
			)
		),
		'duration' => array(		
			'type' => 'select',
			'title' => __('Duration', divine_get_domain()),
			'default' => '0.5s',
			'options' => array(
                '0.1s'  => '0.1s',
                '0.2s'  => '0.2s',
                '0.3s'  => '0.3s',
                '0.4s'  => '0.4s',
                '0.5s'  => '0.5s',
                '0.6s'  => '0.6s',
                '0.7s'  => '0.7s',
                '0.8s'  => '0.8s',
                '0.9s'  => '0.9s',
                '1.0s'  => '1.0s',
                '1.25s' => '1.25s',
                '1.5s'  => '1.5s',
                '1.75s' => '1.75s',
                '2.0s'  => '2.0s',                
			)							
		),
		'delay' => array(		
			'type' => 'select',
			'title' => __('Delay', divine_get_domain()),
			'default' => '0.5s',
			'options' => array(
                '0.1s'  => '0.1s',
                '0.2s'  => '0.2s',
                '0.3s'  => '0.3s',
                '0.4s'  => '0.4s',
                '0.5s'  => '0.5s',
                '0.6s'  => '0.6s',
                '0.7s'  => '0.7s',
                '0.8s'  => '0.8s',
                '0.9s'  => '0.9s',
                '1.0s'  => '1.0s',
                '1.25s' => '1.25s',
                '1.5s'  => '1.5s',
                '1.75s' => '1.75s',
                '2.0s'  => '2.0s', 
			)							
		),
	);

	$fields['margin']['title'] =  __('Margin', divine_get_domain());	
	$fields['margin']['params'] = array(
		'top' => array(		
			'type' => 'number',
			'title' => __('Top', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),		
		'bottom' => array(		
			'type' => 'number',
			'title' => __('Bottom', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'left' => array(		
			'type' => 'number',
			'title' => __('Left', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'right' => array(		
			'type' => 'number',
			'title' => __('Right', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),
	);

	$fields['padding']['title'] =  __('Padding', divine_get_domain());	
	$fields['padding']['params'] = array(
		'top' => array(		
			'type' => 'number',
			'title' => __('Top', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),		
		'bottom' => array(		
			'type' => 'number',
			'title' => __('Bottom', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'left' => array(		
			'type' => 'number',
			'title' => __('Left', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),	
		'right' => array(		
			'type' => 'number',
			'title' => __('Right', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',	
		),
	);

	$fields['custom']['title'] =  __('Custom CSS', divine_get_domain());	
	$fields['custom']['params'] = array(
		'css' => array(		
			'type' => 'textarea',
			'title' => __('CSS code', divine_get_domain()),
            'default' => '',
            'rows' => 10,       
            'class' => 'kpb-ui-textarea-guide-line', 
			'help' => __('Example: <code>ID a {color: red; }</code> <br/> ID: The ID of this widget.', divine_get_domain()),
		),
	);

    /*
    $fields['reponsive']['title'] =  __('Reponsive', divine_get_domain());
    $fields['reponsive']['params'] = array();
    $screens = array(        
    );
    */

	return $fields;
}

function divine_page_builder_set_section_fields($fields){
	$fields['outer']['title'] =  __('Outer', divine_get_domain());	
	$fields['outer']['params'] = array(
		'status' => array(		
			'type' => 'radio',
			'title' => __('Show outer', divine_get_domain()),
			'default' => 'false',								
			'options' => array(
				'true' => __('Yes', divine_get_domain()),
				'false' => __('No', divine_get_domain()),
			)
		),
		'background-color' => array(		
			'type' => 'color',
			'title' => __('Background color', divine_get_domain()),
			'default' => '',								
		),				
		'margin-top' => array(		
			'type' => 'number',
			'title' => __('Margin top', divine_get_domain()),
			'default' => '',		
			'affix' => 'px',						
		),
		'margin-bottom' => array(		
			'type' => 'number',
			'title' => __('Margin bottom', divine_get_domain()),
			'default' => '',
			'affix' => 'px',								
		),
		'padding-top' => array(		
			'type' => 'number',
			'title' => __('Padding top', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',								
		),
		'padding-bottom' => array(		
			'type' => 'number',
			'title' => __('Padding bottom', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',								
		),
		'custom' => array(
			'type' => 'textarea',
			'title' => __('CSS code', divine_get_domain()),
            'default' => '',
            'rows' => 5,       
            'class' => 'kpb-ui-textarea-guide-line',
			'help' => __('Example: <code>ID a {color: red; }</code> <br/> ID: The ID of outer tag.', divine_get_domain()),
		),
	);	

	$fields['container']['title'] =  __('Container', divine_get_domain());
	$fields['container']['params'] = array(
		'layout' => array(		
			'type' => 'select',
			'title' => __('Layout', divine_get_domain()),
			'default' => 'boxes',								
			'options' => array(
				'wide' => __('Wide', divine_get_domain()),
				'boxes' => __('Boxes', divine_get_domain()),
			)
		),
		'custom' => array(
			'type' => 'textarea',
			'title' => __('CSS code', divine_get_domain()),
            'default' => '',
            'rows' => 5,       
            'class' => 'kpb-ui-textarea-guide-line',
			'help' => __('Example: <code>ID a {color: red; }</code> <br/> ID: The ID of container tag.', divine_get_domain()),
		),
	);

	$fields['parallax']['title'] =  __('Parallax', divine_get_domain());
	$fields['parallax']['params'] = array(
		'status' => array(		
			'type' => 'radio',
			'title' => __('Use parallax', divine_get_domain()),
			'default' => 'false',								
			'options' => array(
				'true' => __('Yes', divine_get_domain()),
				'false' => __('No', divine_get_domain()),
			)
		),
		'background-image' => array(		
			'type' => 'image',
			'title' => __('Background image', divine_get_domain()),
			'default' => '',								
		),
		'overlay-color' => array(		
			'type' => 'color',
			'title' => __('Overlay color', divine_get_domain()),
			'default' => '',								
		),
		'overlay-opacity' => array(		
			'type' => 'select',
			'title' => __('Overlay opacity', divine_get_domain()),
			'default' => 30,
			'options' => array(
                0   => __('0 %', divine_get_domain()),
                5   => __('5 %', divine_get_domain()),
                10  => __('10 %', divine_get_domain()),
                15  => __('15 %', divine_get_domain()),
                20  => __('20 %', divine_get_domain()),
                25  => __('25 %', divine_get_domain()),
                30  => __('30 %', divine_get_domain()),
                35  => __('35 %', divine_get_domain()),
                40  => __('40 %', divine_get_domain()),
                45  => __('45 %', divine_get_domain()),
                50  => __('50 %', divine_get_domain()),
                55  => __('55 %', divine_get_domain()),
                60  => __('60 %', divine_get_domain()),
                65  => __('65 %', divine_get_domain()),
                70  => __('70 %', divine_get_domain()),
                75  => __('75 %', divine_get_domain()),
                80  => __('80 %', divine_get_domain()),
                85  => __('85 %', divine_get_domain()),
                90  => __('90 %', divine_get_domain()),
                95  => __('95 %', divine_get_domain()),
                100 => __('100 %', divine_get_domain()),
			),
		),
		'custom' => array(
			'type' => 'textarea',
			'title' => __('CSS code', divine_get_domain()),
            'default' => '',
            'rows' => 5,       
            'class' => 'kpb-ui-textarea-guide-line',
			'help' => __('Example: <code>ID a {color: red; }</code> <br/> ID: The ID of parallax tag.', divine_get_domain()),
		),
	);

	$fields['inner']['title'] =  __('Inner', divine_get_domain());
	$fields['inner']['params'] = array(
		'status' => array(		
			'type' => 'radio',
			'title' => __('Show inner', divine_get_domain()),
			'default' => 'false',								
			'options' => array(
				'true' => __('Yes', divine_get_domain()),
				'false' => __('No', divine_get_domain()),
			)
		),		
		'background-color' => array(		
			'type' => 'color',
			'title' => __('Background color', divine_get_domain()),
			'default' => '',										
		),
		'margin-top' => array(		
			'type' => 'number',
			'title' => __('Margin top', divine_get_domain()),
			'default' => '',		
			'affix' => 'px',						
		),
		'margin-bottom' => array(		
			'type' => 'number',
			'title' => __('Margin bottom', divine_get_domain()),
			'default' => '',
			'affix' => 'px',								
		),
		'padding-top' => array(		
			'type' => 'number',
			'title' => __('Padding top', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',								
		),
		'padding-bottom' => array(		
			'type' => 'number',
			'title' => __('Padding bottom', divine_get_domain()),
			'default' => '',	
			'affix' => 'px',								
		),
		'custom' => array(
			'type' => 'textarea',
			'title' => __('CSS code', divine_get_domain()),
            'default' => '',
            'rows' => 5,       
            'class' => 'kpb-ui-textarea-guide-line',
			'help' => __('Example: <code>ID a {color: red; }</code> <br/> ID: The ID of inner tag.', divine_get_domain()),
		),
	);	

	return $fields;
}

function divine_page_builder_get_template_part($template){
	if(is_page()){
		global $post;				
        $current_layout = Kopa_Page_Builder::get_current_layout($post->ID);
	 	
        if(!in_array($current_layout, array('', 'disable'))){
	 		$template = "pages/{$current_layout}";
	 	}
	}
    
	return $template;
}

function divine_page_builder_set_body_class($classes){
	if(is_page()){
		global $post;
		if( $current_layout = Kopa_Page_Builder::get_current_layout($post->ID) ){
			switch ($current_layout) {
				case 'front-page-1':
					array_push($classes, 'kopa-home-1');
					break;		
				case 'front-page-2':
					array_push($classes, 'kopa-home-1');
					break;
				case 'front-page-3':
					array_push($classes, 'kopa-home-parallax');
					break;	
			}
		}
	}

	return $classes;
}

function divine_print_before_section($current_layout, $section_slug){
	global $post;

	$out = '';

	ob_start();
	
	if($wrap = Kopa_Page_Builder::get_current_wrapper_data($post->ID, $current_layout, $section_slug)){		

		if('true' == $wrap['outer']['status']): ?>
			<section id="<?php echo "divine-section-{$section_slug}"; ?>" class="kopa-area">
			<?php endif; ?>
			
			<?php if('true' == $wrap['parallax']['status']): ?>
				<div id="<?php echo "divine-parallax-{$section_slug}"; ?>" class="kopa-parallax widget">
					<div class="parallax clearfix">
						<?php if(!empty($wrap['parallax']['overlay-color'])): ?>
							<div class="kopa-bg"></div>
						<?php endif; ?>
			<?php endif; ?>

				<?php if('boxes' == $wrap['container']['layout']): ?>
					<div id="<?php echo "divine-wrap-{$section_slug}"; ?>" class="wrapper">
				<?php else: ?>
					<div id="<?php echo "divine-wrap-{$section_slug}"; ?>">
				<?php endif; ?>
				
					<?php if('true' == $wrap['inner']['status']): ?>
						<div id="<?php echo "divine-area-{$section_slug}"; ?>" class="area-inner">
					<?php endif;
	}

	$out = ob_get_clean();

	return apply_filters('divine_print_before_section', $out, $current_layout, $section_slug);					
}

function divine_print_after_section($current_layout, $section_slug){
	global $post;

	$out = '';

	ob_start();
	
	if($wrap = Kopa_Page_Builder::get_current_wrapper_data($post->ID, $current_layout, $section_slug)){

		if('true' == $wrap['inner']['status']): ?>
			</div>
		<?php endif;?>
			</div> <!-- container -->

		<?php if('true' == $wrap['parallax']['status']): ?>										
				</div>
			</div>
		<?php endif;?>

		<?php if('true' == $wrap['outer']['status']): ?>
			</section>
		<?php endif;
	
	}

	$out = ob_get_clean();

	return apply_filters('divine_print_after_section', $out, $current_layout, $section_slug);		
}

function divine_page_builder_enqueue_script(){
	if(is_page()){
		global $post;
		$current_layout = Kopa_Page_Builder::get_current_layout($post->ID);		

        if(!empty($current_layout) && $current_layout != 'disable'){
          
            $page_data = Kopa_Page_Builder::get_current_layout_data($post->ID); 
            $layouts = apply_filters('kopa_page_builder_get_layouts', array());             
            $layout_customize_data = Kopa_Page_Builder::get_layout_customize_data($post->ID, $current_layout);               

            $style = '';

            foreach ($layouts as $layout_slug => $layout) {
                if($layout_slug == $current_layout){
                    $sections = $layout['section'];
                    if(count($sections) > 0){
                        foreach($sections as $section_slug => $section){
                            if( $wrap = Kopa_Page_Builder::get_current_wrapper_data($post->ID, $layout_slug, $section_slug)){

                                if('true' == $wrap['outer']['status']){
                                    if(!empty($wrap['outer']['background-color'])){
                                        $style .= sprintf('#divine-section-%s { background-color: %s; }', $section_slug, $wrap['outer']['background-color']);
                                    }

                                    if(trim($wrap['outer']['margin-top']) != ''){
                                        $style .= sprintf('#divine-section-%s { margin-top: %s%s; }', $section_slug, $wrap['outer']['margin-top'], 'px');
                                    }

                                    if(trim($wrap['outer']['margin-bottom']) != ''){
                                        $style .= sprintf('#divine-section-%s { margin-bottom: %s%s; }', $section_slug, $wrap['outer']['margin-bottom'], 'px');
                                    }

                                    if(trim($wrap['outer']['padding-top']) != ''){
                                        $style .= sprintf('#divine-section-%s { padding-top: %s%s; }', $section_slug, $wrap['outer']['padding-top'], 'px');
                                    }

                                    if(trim($wrap['outer']['padding-bottom']) != ''){
                                        $style .= sprintf('#divine-section-%s { padding-bottom: %s%s; }', $section_slug, $wrap['outer']['padding-bottom'], 'px');
                                    }

                                    if(!empty($wrap['outer']['custom'])){
                                        $style .= str_replace('ID', "#divine-section-{$section_slug}", $wrap['outer']['custom']);                               
                                    }                           
                                }

                                if(!empty($wrap['container']['custom'])){
                                    $style .= str_replace('ID', "#divine-wrap-{$section_slug}", $wrap['container']['custom']);                                                      
                                }                           

                                if('true' == $wrap['parallax']['status']){

                                    if(!empty($wrap['parallax']['background-image'])){
                                        $style .= sprintf('#divine-parallax-%s .parallax { background-image: url("%s"); }', $section_slug, do_shortcode( $wrap['parallax']['background-image'] ));
                                    }

                                    if(!empty($wrap['parallax']['overlay-color'])){
                                        $style .= sprintf('#divine-parallax-%s .kopa-bg { background-color: %s; }', $section_slug, $wrap['parallax']['overlay-color']);
                                        $style .= sprintf('#divine-parallax-%s .kopa-bg { opacity: %s;}', $section_slug, (int) $wrap['parallax']['overlay-opacity'] / 100);                                             
                                    }

                                    if(!empty($wrap['parallax']['custom'])){
                                        $style .= str_replace('ID', "#divine-parallax-{$section_slug}",$wrap['parallax']['custom']);                                    
                                    }
                                }   

                                if('true' == $wrap['inner']['status']){
                                    if(!empty($wrap['inner']['background-color'])){
                                        $style .= sprintf('#divine-area-%s { background-color: %s; }', $section_slug, $wrap['inner']['background-color']);
                                    }

                                    if(trim($wrap['inner']['margin-top']) != ''){
                                        $style .= sprintf('#divine-area-%s { margin-top: %s%s; }', $section_slug, $wrap['inner']['margin-top'], 'px');
                                    }

                                    if(trim($wrap['inner']['margin-bottom']) != ''){
                                        $style .= sprintf('#divine-area-%s { margin-bottom: %s%s; }', $section_slug, $wrap['inner']['margin-bottom'], 'px');
                                    }

                                    if(trim($wrap['inner']['padding-top']) != ''){
                                        $style .= sprintf('#divine-area-%s { padding-top: %s%s; }', $section_slug, $wrap['inner']['padding-top'], 'px');
                                    }

                                    if(trim($wrap['inner']['padding-bottom']) != ''){
                                        $style .= sprintf('#divine-area-%s { padding-bottom: %s%s; }', $section_slug, $wrap['inner']['padding-bottom'], 'px');
                                    }

                                    if(!empty($wrap['inner']['custom'])){                                   
                                        $style .= str_replace('ID', "#divine-area-{$section_slug}", $wrap['inner']['custom']);
                                    }
                                }                                                       
                            }               
                        }
                    }
                }
            }

            if(!empty($page_data)){
                foreach($page_data as $section_id => $section){
                    if(!empty($section)){
                        foreach ($section as $area_id => $area) {
                            if(!empty($area)){
                                foreach ($area as $widget_id => $widget) {
                                    if($widget_data = get_post_meta($post->ID, $widget_id, true)){                                  
                                        foreach(array('margin', 'padding') as $box_mode){
                                            foreach(array('top', 'bottom', 'left', 'right') as $position){
                                                if(isset($widget_data['customize'][$box_mode][$position])){
                                                    if(trim($widget_data['customize'][$box_mode][$position]) != ''){
                                                        $style .= sprintf('#%s.widget { %s-%s: %s%s; }', $widget_id, $box_mode, $position, $widget_data['customize'][$box_mode][$position], 'px');
                                                    }
                                                }                                           
                                            }
                                        }

                                        if(isset($widget_data['customize']['custom']['css']) && !empty($widget_data['customize']['custom']['css'])){
                                            $style .= str_replace('ID', "#{$widget_id}.widget", $widget_data['customize']['custom']['css']);
                                        }                               
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if(!empty($layout_customize_data)){
                if(isset($layout_customize_data['parallax']['background-image']) && !empty($layout_customize_data['parallax']['background-image'])){
                    $style .= sprintf('body.kopa-home-parallax #parallax-header{ background: url("%s") top left repeat transparent; }', do_shortcode($layout_customize_data['parallax']['background-image']));
                }

                if(isset($layout_customize_data['parallax']['overlay-color']) && !empty($layout_customize_data['parallax']['overlay-color'])){                
                    $style .= sprintf('body.kopa-home-parallax #parallax-header .kopa-bg { background-color: %s; }', $layout_customize_data['parallax']['overlay-color']);
                }

                if(isset($layout_customize_data['parallax']['overlay-opacity']) && !empty($layout_customize_data['parallax']['overlay-opacity'])){                
                    $style .= sprintf('body.kopa-home-parallax #parallax-header .kopa-bg { opacity: %s; }', (int)$layout_customize_data['parallax']['overlay-opacity'] / 100);
                }

                if(isset($layout_customize_data['custom']['css']) && !empty($layout_customize_data['custom']['css'])){                
                    $style .= $layout_customize_data['custom']['css'];
                }            
            }

            if(!empty($style)){         
                wp_add_inline_style(KOPA_PREFIX . 'style', $style);
            }

        }

	}
}

function divine_dynamic_area($post_id, $data){
	if($data){

		foreach($data as $widget_id => $widget){

			if($widget_data = get_post_meta($post_id, $widget_id, true)){
				$class_name = $widget['class_name'];	                                    

				if(class_exists($class_name)){

					$instance = $widget_data['widget'];

					$obj = new $class_name;

		            $obj->id = $widget_id;
		            $obj->number = rand(0, 9999);

		            $widget_wrap = array(
		                'before_widget' => sprintf('<div id="%1$s" class="widget %2$s clearfix">', $obj->id, $obj->widget_options['classname']),                                                
		                'after_widget' => '</div>',
		                'before_title' => '<h3 class="widget-title">',
		                'after_title' => '</h3>'
		            );

		            if(isset($widget_data['customize'])){
		            	$customize_data = $widget_data['customize'];
		            	switch ( $customize_data['title']['style'] ) {
		            		case 'with-background':	
		            			$widget_wrap['before_title'] = '<h3 class="widget-title style1">';
                				$widget_wrap['after_title'] = '</h3>';
                				if(!empty($customize_data['title']['icon']))       			
                					$widget_wrap['before_title'] .= sprintf("<i class='icon-title %s'></i>", $customize_data['title']['icon']);
		            			break;

		            		case 'position-absolute':
		            			$style = 'position:absolute;';
		            			if('' != trim($customize_data['title']['top']))
		            				$style .= sprintf("top: %s%s;", $customize_data['title']['top'], 'px');
		            			
		            			if('' != trim($customize_data['title']['bottom']))
		            				$style .= sprintf("bottom: %s%s;", $customize_data['title']['bottom'], 'px');
		            			
		            			if('' != trim($customize_data['title']['left']))
		            				$style .= sprintf("left: %s%s;", $customize_data['title']['left'], 'px');
		            			
		            			if('' != trim($customize_data['title']['right']))
		            				$style .= sprintf("right: %s%s;", $customize_data['title']['right'], 'px');
		            			
		            			$widget_wrap['before_title'] = sprintf('<h3 class="widget-title" style="%s">', $style);                				
		            			break;		            		

		            		case 'with-sub-title':		            							                
								$widget_wrap['before_title'] = '<header class="widget-title-with-subtitle"><h3 class="widget-title">';				                
								$widget_wrap['after_title']  = '</h3>';

				                if ($sub_title = $customize_data['title']['subtitle']) {
				                    $widget_wrap['after_title'] .= sprintf('<p>%s</p>', strip_tags($sub_title));
				                }
				                $widget_wrap['after_title'] .= '</header>';

		            			break;

		            		case 'with-bottom-border':
		            			$widget_wrap['before_title'] = '<h3 class="widget-title style3">';
								$widget_wrap['after_title']  = '</h3>';
		            			break;

		            		case 'with-bottom-border-1px':
		            			$widget_wrap['before_title'] = '<h4 class="widget-title style4">';
								$widget_wrap['after_title']  = '</h4>';
		            			break;
		            	}
		            	
		            	if(!empty($customize_data['effect']['effect'])){
		            		$widget_wrap['before_widget'] = sprintf('<div id="%1$s" class="widget %2$s clearfix wow animated %3$s" data-wow-duration="%4$s" data-wow-delay="%5$s">', $obj->id, $obj->widget_options['classname'], $customize_data['effect']['effect'], $customize_data['effect']['duration'], $customize_data['effect']['delay']);		            		
		            	}		            		            
		            }


		            $obj->widget($widget_wrap, $instance);

				}	            

			}		

		}

	}
}