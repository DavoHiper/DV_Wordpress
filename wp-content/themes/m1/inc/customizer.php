<?php
/**
 * m1 Theme Theme Customizer
 *
 * @package m1 Theme
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function m1_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->add_setting( 'm1_logo' ); // Add setting for logo uploader
	$wp_customize->add_setting( 'm1_banner' ); // Home Banner Image
	$wp_customize->add_setting( 'm1_banner_text' ); // Home Banner Text
	$wp_customize->add_setting( 'm1_banner_checkbox' ); // Home Banner Checkbox
	$wp_customize->add_setting( 'm1_social_fb' ); // Facebook url
	$wp_customize->add_setting( 'm1_social_tw' ); // Twitter url
	$wp_customize->add_setting( 'm1_social_email' ); // Email
	$wp_customize->add_setting( 'm1_social_g' ); // Google Plus
	$wp_customize->add_setting( 'm1_social_li' ); // LinkedIn
	$wp_customize->add_setting( 'm1_social_pin' ); // Pinterest
	$wp_customize->add_setting( 'm1_social_rss' ); // RSS
	$wp_customize->add_setting( 'm1_social_yt' ); // Youtube
	$wp_customize->add_setting( 'm1_layout' ); // Layout Options
	$wp_customize->add_setting( 'm1_footer_credits' ); // Footer Credits
			
	// Create custom textarea control
	class m1_textarea_control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
		}
	}
	
	// Create logo upload control
	class m1_pro_control extends WP_Customize_Control {
    public $type = 'pro_only';
 
    public function render_content() {
        ?>
        <label>
			<span class="customize-control-title">Upload Custom Logo</span>
		</label>
        <p><a href="http://m1themes.com/themes/m1" target="_blank">Upgrade to Pro</a> for this feature and lots more!</p>
        <?php
		}
	}
	
	// Create new section for layouts
	$wp_customize->add_section( 'm1_layout_section' , array(
    'title'       => __( 'Layout Options', 'm1' ),
    'priority'    => 55,
    'description' => 'Choose a layout option.',
	) );
	
	$wp_customize->add_control( 'm1_layout', array(
    'label'   => 'Layout Options:',
    'section' => 'm1_layout_section',
    'type'    => 'select',
    'choices'    => array(
        'side-right' => 'Sidebar Right',
        'side-left' => 'Sidebar Left',
        ),
	) );
	
	// Create new section for footer credits
	$wp_customize->add_section( 'm1_credits_section' , array(
    'title'       => __( 'Footer Credits', 'm1' ),
    'priority'    => 195,
	) );
	
	// Add text field for footer credits
	$wp_customize->add_control( new m1_textarea_control( $wp_customize, 'm1_footer_credits', array(
    'label'   => __( 'Footer Credits (HTML allowed)', 'm1' ),
    'section' => 'm1_credits_section',
    'default' => '',
    'settings' => 'm1_footer_credits',
    ) ) );
	
	// Create new section for front page banner
	$wp_customize->add_section( 'm1_home_banner_section' , array(
    'title'       => __( 'Home Banner', 'm1' ),
    'priority'    => 30,
    'description' => 'Upload a banner to display on your front page template.',
	) );
	
	// Hide banner checkbox
	$wp_customize->add_control( 'm1_banner_checkbox', array(
    'settings' => 'm1_banner_checkbox',
    'label'    => __( 'Display Banner (shows on Front Page Template)', 'm1' ),
    'section'  => 'm1_home_banner_section',
    'type'     => 'checkbox',
	) );
	
	// Add upload control for front page banner
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm1_banner', array(
    'label'    => __( 'Home Banner Image (1100px by 350px)', 'm1' ),
    'section'  => 'm1_home_banner_section',
    'settings' => 'm1_banner',
	) ) );
	
	// Add text field for front page banner
	$wp_customize->add_control( new m1_textarea_control( $wp_customize, 'm1_banner_text', array(
    'label'   => __( 'Home Banner Text (HTML allowed)', 'm1' ),
    'section' => 'm1_home_banner_section',
    'settings' => 'm1_banner_text',
    ) ) );
    
	/* =Social Icons
	----------------------------------------------- */
    
	// Create new section for social icons
	$wp_customize->add_section( 'm1_social_section' , array(
    'title'       => __( 'Social Icons', 'm1' ),
    'priority'    => 45,
    'description' => 'Enter your full profile urls to display an icon at the top of your site.',
	) );
	
	// Add text field for Facebook
	$wp_customize->add_control( 'm1_social_fb', array(
    'type'     => 'text',
    'label'    => __( 'Facebook Profile URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_fb',
	) );
	
	// Add text field for Twitter
	$wp_customize->add_control( 'm1_social_tw', array(
    'type'     => 'text',
    'label'    => __( 'Twitter Profile URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_tw',
	) );
	
	// Add text field for Email
	$wp_customize->add_control( 'm1_social_email', array(
    'type'     => 'text',
    'label'    => __( 'Email Address', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_email',
	) );
	
	// Add text field for RSS
	$wp_customize->add_control( 'm1_social_rss', array(
    'type'     => 'text',
    'label'    => __( 'RSS Feed URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_rss',
	) );
	
	// Add text field for LinkedIn
	$wp_customize->add_control( 'm1_social_li', array(
    'type'     => 'text',
    'label'    => __( 'LinkedIn URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_li',
	) );
	
	// Add text field for Google Plus
	$wp_customize->add_control( 'm1_social_g', array(
    'type'     => 'text',
    'label'    => __( 'Google Plus URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_g',
	) );
	
	// Add text field for Pinterest
	$wp_customize->add_control( 'm1_social_pin', array(
    'type'     => 'text',
    'label'    => __( 'Pinterest URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_pin',
	) );
	
	// Add text field for Youtube
	$wp_customize->add_control( 'm1_social_yt', array(
    'type'     => 'text',
    'label'    => __( 'YouTube URL', 'm1' ),
    'section'  => 'm1_social_section',
    'settings' => 'm1_social_yt',
	) );
	
	// Add text field for front page banner
	$wp_customize->add_control( new m1_pro_control( $wp_customize, 'm1_logo', array(
    'label'   => __( 'Upload Custom Logo', 'm1' ),
    'section' => 'title_tagline',
    'settings' => 'm1_logo',
    ) ) );
	
	// Add control for logo uploader (actual uploader)
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'm1_logo', array(
    'label'    => __( 'Upload Logo (replaces text)', 'm1' ),
    'section'  => 'title_tagline',
    'settings' => 'm1_logo',
	) ) );
	
	/* =Color customizations
	----------------------------------------------- */
	
	$colors = array();
	
	$colors[] = array(
		'slug'=>'accent_color', 
		'default' => '',
		'label' => __('Accent Color', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'hdr_bg_color', 
		'default' => '',
		'label' => __('Header/Footer Background', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'nav_bg_color', 
		'default' => '',
		'label' => __('Top Menu/Drops Background', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'top_menu_link_color', 
		'default' => '',
		'label' => __('Nav Menus Link Color', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'text_color', 
		'default' => '',
		'label' => __('Text Color', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'link_color', 
		'default' => '',
		'label' => __('Body Link Color', 'm1')
	);
	
	$colors[] = array(
		'slug'=>'link_hover_color', 
		'default' => '',
		'label' => __('Link/Button Hover Color', 'm1')
	);
	
	foreach( $colors as $color ) {
		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 'edit_theme_options'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array('label' => $color['label'], 
				'section' => 'colors',
				'settings' => $color['slug'])
			)
		);
	}
}
add_action( 'customize_register', 'm1_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function m1_customize_preview_js() {
	wp_enqueue_script( 'm1_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'm1_customize_preview_js' );


/*
 * Now that the controls are set, add code to wp_head 
 */

/*
 * Applies the custom CSS for the theme.
 */
function m1_customizer_css() {
  		$hdr_bg_color = get_option('hdr_bg_color');
        $nav_bg_color = get_option('nav_bg_color');
        $text_color = get_option('text_color');
        $link_color = get_option('link_color');
        $accent_color = get_option('accent_color');
        $top_menu_link_color = get_option('top_menu_link_color');
        $link_hover_color = get_option('link_hover_color');
  ?>
  
  <style> 
        <?php if ( $hdr_bg_color ) : ?>.site-header, .site-footer { background-color:  <?php echo $hdr_bg_color; ?>; }<?php endif; ?>
        <?php if ( $nav_bg_color ) : ?>.top-menu-container, .top-menu ul ul, .navigation-main ul ul, .navigation-main li.sfHover:hover { background-color:  <?php echo $nav_bg_color; ?>; }<?php endif; ?>
        <?php if ( $text_color ) : ?>body, input, textarea, blockquote, h4 { color: <?php echo $text_color; ?>; }<?php endif; ?>
        <?php if ( $link_color ) : ?>#main a, #main a:visited, .site-footer a, .site-footer a:visited { color: <?php echo $link_color; ?>; }<?php endif; ?>
        <?php if ( $top_menu_link_color ) : ?>.top-menu a, .top-menu ul ul a, .navigation-main a, .navigation-main ul ul a, .navigation-main li.sfHover a, .m1-social-icons a { color: <?php echo $top_menu_link_color; ?>; }<?php endif; ?>
        <?php if ( $accent_color ) : ?>#main a:hover, a:focus, a:active, .site-title a, .top-menu li a:hover, .top-menu li.current_page_item > a, .top-menu li.current-menu-item > a, .navigation-main li a:hover, .navigation-main li.current_page_item > a, .navigation-main li.current-menu-item > a { color: <?php echo $accent_color; ?>; }
        button, .button, html input[type="button"], input[type="reset"], input[type="submit"], .more-link, .nav-previous a, .nav-next a, .page-links a { background-color: none; }
        .site-header { border-top-color: <?php echo $accent_color; ?>; }
        <?php endif; ?>
        <?php if ( $link_hover_color ) : ?>#main a:hover, .site-footer a:hover, .top-menu li a:hover, .navigation-main li a:hover, .m1-social-icons a:hover { color: <?php echo $link_hover_color; ?>; }
        button:hover, html input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .more-link:hover, .nav-previous a:hover, .nav-next a:hover, .page-links a:hover { background-color: none; }
        <?php endif; ?>
        <?php if ( get_theme_mod( 'm1_layout' ) == "side-left" ) : ?>
        #primary { float: right; }
        #secondary { float: left; }
        <?php endif; ?>
</style>
  <?php
}
add_action( 'wp_head', 'm1_customizer_css', 210 );