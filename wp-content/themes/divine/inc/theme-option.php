<?php
/**
 * Extra for theme options settings
 */
add_filter( 'kopa_theme_options_settings', 'divine_extra_theme_options_settings', 1, 10);
function divine_extra_theme_options_settings( $options ) {
	#GENERAL SETTING
	$options[] = array(
		'title'   => __( 'Logo & Favicon', divine_get_domain() ),
		'type'    => 'title',		
		'id'      => 'general',
		'icon'    => ''
	);		
	// logo group
		$options[] = array(
			'title' => __( 'Main Logo', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'logo-group',			
		);
			$options[] = array(
				'title'   => __( 'Logo image', divine_get_domain() ),
				'type'    => 'upload',
				'id'      => 'logo',
				'desc'    => __( 'upload your logo image', divine_get_domain() ),
				'mimes'   => 'image',
			);
			$options[] = array(
				'title'   => __( 'Margin top (px)', divine_get_domain() ),
				'type' 	  => 'text',
				'id' 	  => 'logo-margin-top',
				'default' => '',			);
			$options[] = array(
				'title'   => __( 'Margin bottom (px)', divine_get_domain() ),
				'type' 	  => 'text',
				'id' 	  => 'logo-margin-bottom',
				'default' => '',			
			);
			$options[] = array(
				'title'   => __( 'Margin left (px)', divine_get_domain() ),
				'type' 	  => 'text',
				'id' 	  => 'logo-margin-left',
				'default' => '',			);			
			$options[] = array(
				'title'   => __( 'Margin right (px)', divine_get_domain() ),
				'type' 	  => 'text',				
				'id' 	  => 'logo-margin-right',
				'default' => '',							
			);
		// end group
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'logo-group',
		);		
		
		#Favicon
		$options[] = array(
			'title'   => __( 'Favicon', divine_get_domain() ),
			'type'    => 'upload',
			'id'      => 'favicon',
			'desc'    => __( 'upload your favicon image', divine_get_domain() ),			
			'mimes'   => 'image',
		);

		#Apple icon
		$options[] = array(
			'title'   => __( 'Apple icon', divine_get_domain() ),
			'type'    => 'upload',
			'id'      => 'apple-icon',
			'desc'    => __( 'upload icon for apple device (152x152)', divine_get_domain() ),				
			'mimes'   => 'image',
		);

	# HEADER
	$options[] = array(
		'title'   => __( 'Header', divine_get_domain() ),
		'type'    => 'title',		
		'id'      => 'header',
		'icon'    => ''
	);


		$options[] = array(			
			'type' 	  => 'checkbox',			
			'id' 	  => 'is-enable-social-links',
			'default' => 1,
			'label'   => __( 'Social links', divine_get_domain() ),
		);
		$options[] = array(			
			'type' 	  => 'checkbox',			
			'id' 	  => 'is-enable-search-form',
			'default' => 1,
			'label'   => __( 'Search form', divine_get_domain() ),
		);
		$options[] = array(			
			'type' 	  => 'checkbox',			
			'id' 	  => 'is-enable-sticky-menu',
			'default' => 1,
			'label'   => __( 'Sticky menubar', divine_get_domain() ),
		);
		$options[] = array(
			'title'   => __( 'Header information', divine_get_domain() ),
			'type' 	  => 'textarea',			
			'id' 	  => 'header-info',
			'default' => '',		
		);

	# Breadcrumb
	$options[] = array(
		'title'   => __( 'Breadcrumb', divine_get_domain() ),
		'type'    => 'title',		
		'id'      => 'breadcrumb',
		'icon'    => ''
	);
		$options[] = array(			
			'type' 	  => 'checkbox',			
			'id' 	  => 'is-enable-breadcrumb',
			'default' => 1,
			'label'   => __( 'Show / hide', divine_get_domain() ),
		);
		$options[] = array(
			'title'   => __( 'Background image', divine_get_domain() ),
			'type'    => 'upload',
			'id'      => 'breadcrumb-background-image',			
			'mimes'   => 'image'
		);

	# Footer
	$options[] = array(
		'title'   => __( 'Footer', divine_get_domain() ),
		'type'    => 'title',		'id'      => 'footer',
		'icon'    => ''
	);		
		$options[] = array(
			'title'   => __( 'Footer information', divine_get_domain() ),
			'type' 	  => 'textarea',
			'desc' 	  => __( 'e.g. your copyright info, ...', divine_get_domain() ),
			'id' 	  => 'footer-info',
			'default' => 'Copyright 2014 - Kopasoft. All Rights Reserved',		
			'validate'=> false
			);
			
		


		$options[] = array(
			'title' => __( 'Social & Newsletter', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'social-and-newsletter-group',			
		);			
			$options[] = array(
				'type' 	  => 'radio',			
				'id' 	  => 'style-social-and-newsletter',
				'default' => 1,
				'title'   => '',
				'options' => array(
					1   => __( 'Newsletter and Social are alternate location.', divine_get_domain() ),
					2   => __( 'Newsletter and Socials located on the one line.', divine_get_domain() ),
				)
			);

			$options[] = array(
				'type' 	  => 'checkbox',			
				'id' 	  => 'is-enable-social-links-footer',
				'default' => 1,
				'label'   => __( 'Social links', divine_get_domain() ),
			);
			$options[] = array(
				'type' 	  => 'checkbox',			
				'id' 	  => 'is-enable-newsletter-footer',
				'default' => 1,
				'label'   => __( 'Newsletter form', divine_get_domain() ),
				'folds'   => 1,
			);
			$options[] = array(
				'title'   => __( 'Feed Burner URI', divine_get_domain() ),
				'type'    => 'text',
				'desc'    => __( 'Please enter only URI (you can read document for more information).', divine_get_domain() ),
				'id'      => 'newsletter-feed-burner-uri',
				'default' => '',			
				'fold'   => 'is-enable-newsletter-footer'
			);
			$options[] = array(
				'title'   => __( 'Mail Chimp HTML', divine_get_domain() ),
				'type' 	  => 'textarea',			
				'id'      => 'newsletter-mail-chimp',
				'default' => '',			
				'fold'   => 'is-enable-newsletter-footer'
			);

		$options[] = array(
			'type'  => 'groupend',
			'id'    => 'social-and-newsletter-group',			
		);

		$options[] = array(
			'title' => __( 'Footer appearance effect', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'groupstart-footer-effect',			
		);	
			$options[] = array(
				'title'   => __( 'Effect', divine_get_domain() ),
				'type' 	  => 'select',				
				'id' 	  => 'footer-effect',
				'default' => '2',
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
			));
		
			$options[] = array(
				'title'   => __( 'Duration', divine_get_domain() ),
				'type' 	  => 'select',				
				'id' 	  => 'footer-effect-duration',
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
				));

			$options[] = array(
				'title'   => __( 'Delay', divine_get_domain() ),
				'type' 	  => 'select',				
				'id' 	  => 'footer-effect-delay',
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
				));

		$options[] = array(
			'type'  => 'groupend',
			'id'    => 'groupend-footer-effect',			
		);

	#BLOG POSTS
	$options[] = array(
		'title' => __( 'Blog posts', divine_get_domain() ),
		'type'  => 'title',
		'id'    => 'blog-posts',	);
		#start group "content"
		$options[] = array(
			'title' => __( 'The content', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'blog-posts-content-group',			
		);
			$options[] = array(
				'title'   => __( 'For each article in list, show:', divine_get_domain() ),
				'type' 	  => 'radio',				
				'id' 	  => 'blog-posts-content-type',
				'default' => 'excerpt',
				'options' => array(
					'excerpt'   => __( 'Excerpt', divine_get_domain()),
					'full'      => __( 'Full', divine_get_domain()),
					'max-words' => __( 'Limit number of words', divine_get_domain()),
				),			);
			$options[] = array(
				'title'   => '',
				'type'    => 'number',				
				'id'      => 'blog-posts-content-max-words',
				'default' => 40,			
			);
		#end group "content"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'blog-posts-content-group',
		);
		#start group "metadata"
		$options[] = array(
			'title' => __( 'Metadata', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'blog-posts-metadata-group',			
		);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-blog-posts-author',
				'default' => 1,
				'label'   => __( 'Author', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-blog-posts-category',
				'default' => 1,
				'label'   => __( 'Category', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-blog-posts-created-date',
				'default' => 1,
				'label'   => __( 'Created date', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-blog-posts-comment-counts',
				'default' => 1,
				'label'   => __( 'Comment counts', divine_get_domain() ),
			);
		#end group "metadata"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'blog-posts-metadata-group',
		);

	#SINGLE POST
	$options[] = array(
		'title' => __( 'Single post', divine_get_domain() ),
		'type'  => 'title',
		'id'    => 'single-post',	
		);
		#start group "metadata"
		$options[] = array(
			'title' => __( 'Metadata', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'single-post-metadata-group',			
		);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-featured-content',
				'default' => 1,
				'label'   => __( 'Featured content', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-category',
				'default' => 1,
				'label'   => __( 'Category', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-tag',
				'default' => 1,
				'label'   => __( 'Tags', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-created-date',
				'default' => 1,
				'label'   => __( 'Created date', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-comment-counts',
				'default' => 1,
				'label'   => __( 'Number of comments', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-share-buttons',
				'default' => 1,
				'label'   => __( 'Share buttons', divine_get_domain() ),
			);
			$options[] = array(
				'title'   => NULL,
				'type' 	  => 'checkbox',				
				'id' 	  => 'is-enable-post-author-info',
				'default' => 1,
				'label'   => __( 'Author information', divine_get_domain() ),
			);
		#end group "metadata"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'single-post-metadata-group',
		);
		#start group "related"
		$options[] = array(
			'title' => __( 'Related posts', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'single-post-related-group',			
		);			
			$options[] = array(
				'title'   => __( 'Get by', divine_get_domain() ),
				'type' 	  => 'select',				
				'id' 	  => 'single-post-related-by',
				'default' => '2',
				'options' => array(
					'category' => __( 'Category', divine_get_domain() ),
					'post_tag' => __( 'Tag', divine_get_domain()),
			),			);
			$options[] = array(
				'title'   => __( 'Number of posts', divine_get_domain() ),
				'type'    => 'number',				
				'id'      => 'single-post-related-limit',
				'default' => 6,			
			);
		#end group "related"
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'single-post-related-group',
		);

	#SOCIAL LINKS	
		$options[] = array(
			'title' => __( 'Social link', divine_get_domain() ),
			'type'  => 'title',
			'id'    => 'social-link',	
		);	
		$social_networks = divine_get_social_networks();	
		$options = array_merge($options, $social_networks);			
		
	#CONTACT PAGE	
		$options[] = array(
		'title' => __( 'Contact page', divine_get_domain() ),
		'type'  => 'title',
		'id'    => 'contact-page',	
		);
		// begin group
		$options[] = array(
			'title' => __( 'Contact information', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'contact-info-begin',			
		);

			$options[] = array(
				'title'   => __( 'Caption', divine_get_domain() ),
				'type' 	  => 'text',			
				'id' 	  => 'contact-info-caption',
				'default' => 'Contact',		
				);
			$options[] = array(
				'title'   => __( 'Description', divine_get_domain() ),
				'type' 	  => 'textarea',			
				'id' 	  => 'contact-info-description',
				'default' => '',		
				);
			$options[] = array(
				'title'   => __( 'Address', divine_get_domain() ),
				'type' 	  => 'text',			
				'id' 	  => 'contact-address',
				'default' => '',		
				);
			$options[] = array(
				'title'   => __( 'Phone number', divine_get_domain() ),
				'type' 	  => 'text',			
				'id' 	  => 'contact-phone',
				'default' => '',		
				);
			$options[] = array(
				'title'   => __( 'Email', divine_get_domain() ),
				'type' 	  => 'text',			
				'id' 	  => 'contact-email',
				'default' => '',		
			);
		// end group
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'contact-info-end',
		);
		

		// begin group
		$options[] = array(
			'title' => __( 'Google maps', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'contact-maps',			
		);
			$options[] = array(
				'title'   => __( 'Latitude', divine_get_domain() ),
				'type' 	  => 'text',				
				'id' 	  => 'contact-latitude',
				'default' => '40.722868',			
				);
			$options[] = array(
				'title'   => __( 'Longitude', divine_get_domain() ),
				'type' 	  => 'text',				
				'id' 	  => 'contact-longitude',
				'default' => '-73.99739',			
				);		
		// end group
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'contact-maps',
		);

		// begin group
		$options[] = array(
			'title' => __( 'Contact form', divine_get_domain() ),
			'type'  => 'groupstart',
			'id'    => 'contact-form-begin',			
		);
			$options[] = array(
				'title'   => __( 'Caption', divine_get_domain() ),
				'type' 	  => 'text',			
				'id' 	  => 'contact-form-caption',
				'default' => 'Contact',		
				);	

			$options[] = array(
			'title'   => __( 'Reply template', divine_get_domain() ),
			'type' 	  => 'textarea',			
			'id' 	  => 'contact-reply-template',
			'default' => '<p>Aloha!</p><p>You have a new message from  [contact_name] ([contact_email])</p>
<p>Website: <a href="[contact_url]" target="_blank">[contact_url]</a></p>
<div>[contact_message]</div>
<p>Thanks!</p>',		
);

		// end group
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'contact-form-end',
		);
		
	#CUSTOM COLOR	
		$options[] = array(
			'title' => __( 'Custom color', divine_get_domain() ),
			'type'  => 'title',
			'id'    => 'custom-color',	
		);
		$options[] = array(			
			'label'   => __('Enable custom color', divine_get_domain()),
			'id'      => 'is-enable-custom-color',
			'type'    => 'checkbox',
			'default' => 0,
			'folds'   => 1,
		);
		$options[] = array(
			'title' =>  __('Custom color', divine_get_domain()),
			'id'    => 'custom-color-group',
			'type'  => 'groupstart',
		);
			$colors = array(
				'color-primary' => array(
					'default' => '#0088b2',
					'title' => __('Primary', divine_get_domain()) 
				),
				'color-secondary' => array(
					'default' => '#888888',
					'title' => __('Secondary', divine_get_domain()) 
				),
			);
			foreach($colors as $key => $color){
				$options[] = array(
					'title'   => $color['title'],
					'type'    => 'color',					
					'id'      => $key,
					'default' => $color['default'],
					'fold'    => 'is-enable-custom-color',
				);
			}
		// end facebook group
		$options[] = array(
			'type' => 'groupend',
			'id'   => 'custom-color-group',
		);
	#CUSTOM FONT	
		$options[] = array(
			'title' => __( 'Custom font', divine_get_domain() ),
			'type'  => 'title',
			'id'    => 'custom-font',	
		);
		#UPLOAD YOUR FONTS
		$options[] = array(
			'title' =>  __('Upload your fonts', divine_get_domain()),
			'id'    => 'upload-your-font-group',
			'type'  => 'groupstart',
		);
			$options[] = array(				
				'id'      => 'custom_fonts',
				'type'    => 'custom_font_manager',
				'default' => array(),			);
			$all_custom_fonts = (array) get_theme_mod( 'custom_fonts' );
			$custom_font_options = array();
			foreach ( $all_custom_fonts as $custom_font ) {
				$custom_font_name = '';
				if ( isset( $custom_font['name'] ) ) {
					$custom_font_name = $custom_font['name'];
				}
				if ( $custom_font_name ) {
					$custom_font_options[ $custom_font_name ] = $custom_font_name;
				}
			}
			// groups
			$standard_groups = array(
				'system_fonts' => 'System Fonts',
				'google_fonts' => 'Google Fonts',
			);
			$custom_groups = array();
			if ( $custom_font_options ) {
				$custom_groups = wp_parse_args( $standard_groups, array(
					'custom_fonts' => 'Custom Fonts',
				) );
			}
			// fonts
			$standard_fonts = array(
				"none" => "&mdash; Select a font &mdash;",//please, always use this key: "none"
				'system_fonts' => kopa_system_font_options(),
				'google_fonts' => kopa_google_font_options(),
			);
			$custom_fonts = array();
			if ( $custom_font_options ) {
				$custom_fonts = wp_parse_args( $standard_fonts, array(
					'custom_fonts' => $custom_font_options
				) );
				unset( $custom_fonts['none'] );
				$custom_fonts =  wp_parse_args( $custom_fonts, array( 
					'none' => "&mdash; Select a font &mdash;" 
				) );
			}
		// end facebook group
		$options[] = array(
			'type' => 'groupend',
			'id'    => 'upload-your-font-group',
		);
		$fonts = divine_get_site_elements();
		foreach($fonts as $key => $font){
			$options[] = array(
				'title' => $font['title'],
				'id'    => "custom-font-{$key}",
				'type'  => 'groupstart'
			);
				$options[] = array(			
					'label'   => __('Enable', divine_get_domain()),
					'id'      => "is-enable-custom-font-{$key}",
					'type'    => 'checkbox',
					'default' => 0,
					'folds'   => 1
				);
				$options[] = array(
					"id" 		=> "{$key}_font",
					"type" 		=> "select_font",
					"preview" 	=> "Grumpy wizards make toxic brew for the evil Queen and Jack.", 
					'groups'    => ( $custom_groups ? $custom_groups : $standard_groups),
					"options" 	=> ( $custom_fonts ? $custom_fonts : $standard_fonts ),
					'default' => array(
						'family' => $font['default']['family'],
						'style'  => $font['default']['style'],
						'size'   => $font['default']['size'],
						'color'  => $font['default']['color'],
					),
					'fold'    => "is-enable-custom-font-{$key}"
				);			$options[] = array(
				'type' => 'groupend',
				'id'    => "custom-font-{$key}"
			);
		}	
		#CUSTOM FONT	
		$options[] = array(
			'title' => __( 'Custom css', divine_get_domain() ),
			'type'  => 'title',
			'id'    => 'custom-css',	
		);
		$options[] = array(
			'title'   => '',
			'type' 	  => 'textarea',			
			'id' 	  => 'custom-css',
			'default' => NULL,		
			);	

	return $options;
}
