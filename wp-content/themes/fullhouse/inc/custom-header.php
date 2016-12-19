<?php
/**
 * Implement Custom Header functionality for mode
 *
 * @package WpOpal
 * @subpackage fullhouse
 * @since fullhouse 1.0
 */

/**
 * Set up the WordPress core custom header settings.
 *
 * @since fullhouse 1.0
 *
 * @uses fullhouse_fnc_header_style()
 * @uses fullhouse_fnc_admin_header_style()
 * @uses fullhouse_fnc_admin_header_image()
 */
function fullhouse_fnc_custom_header_setup() {
	/**
	 * Filter mode custom-header support arguments.
	 *
	 * @since fullhouse 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type bool   $header_text            Whether to display custom header text. Default false.
	 *     @type int    $width                  Width in pixels of the custom header image. Default 1260.
	 *     @type int    $height                 Height in pixels of the custom header image. Default 240.
	 *     @type bool   $flex_height            Whether to allow flexible-height header images. Default true.
	 *     @type string $admin_head_callback    Callback function used to style the image displayed in
	 *                                          the Appearance > Header screen.
	 *     @type string $admin_preview_callback Callback function used to create the custom header markup in
	 *                                          the Appearance > Header screen.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'fullhouse_fnc_custom_header_args', array(
		'default-text-color'     => 'fff',
		'width'                  => 1260,
		'height'                 => 240,
		'flex-height'            => true,
		'wp-head-callback'       => 'fullhouse_fnc_header_style',
		'admin-head-callback'    => 'fullhouse_fnc_admin_header_style',
		'admin-preview-callback' => 'fullhouse_fnc_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'fullhouse_fnc_custom_header_setup' );

if ( ! function_exists( 'fullhouse_fnc_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see fullhouse_fnc_custom_header_setup().
 *
 */
function fullhouse_fnc_header_style() {  
	$text_color = get_header_textcolor(); 

	// If no custom color for text is set, let's bail.
	

	// If we get this far, we have custom styles.
	?>
	<style type="text/css" id="fullhouse-header-css">
		<?php 
		$theme_color = get_option('theme_color');
		if( !empty($theme_color) && preg_match("#\##", $theme_color) ) :  ?>
		#pbr-masthead.header-absolute, #pbr-masthead, .search-properies-form , .opalestate-rows article .property-meta-list, 
		.pbr-footer, .bg-navy,.search-properies-form #opalestate-search-form > .row:first-child, .search-properies-form .opalestate-search-form > .row:first-child{
			background-color:<?php echo trim($theme_color); ?>!important;
		}
		<?php endif; ?>

		<?php 
		$sencondary_color = get_option('sencondary_color');
		if( !empty($sencondary_color) && preg_match("#\##", $sencondary_color) ) :  ?>
		.team-header .agent-levels, .scrollup,   .search-properies-form ul.list-property-status li.active , .noUi-connect, .bg-primary,
		.comment-form .form-submit .btn, button.btn-danger, button.btn-primary ,
		#property-filter-status .list-property-status li.active, #property-filter-status .list-property-status li:hover
		 {
			background-color:<?php echo trim($sencondary_color); ?>!important;
			border-color:<?php echo trim($sencondary_color); ?>!important;
		}
		.search-properies-form ul.list-property-status li.active::before, #property-filter-status .list-property-status li::after{
			border-top: solid 9px <?php echo trim($sencondary_color); ?>!important;
		}
		a:hover, .navbar-mega .navbar-nav li.active > a,  .text-primary, article.post .post-sub-content .entry-date, .navbar-mega .navbar-nav li.active > a .caret{
			color:<?php echo trim($sencondary_color); ?>!important;
		}
		<?php endif; ?>

		<?php 
		$page_bg = get_option('page_bg');
		if( !empty($page_bg) && preg_match("#\##", $page_bg) ) :  ?>
		#page{ background-color:<?php echo trim($page_bg); ?>; }
		<?php endif; ?>
		<?php 
		$footer_bg = get_option('footer_bg');
		if( !empty($footer_bg) && preg_match("#\##", $footer_bg) ) :  ?>
		#pbr-footer { background-color:<?php echo trim($footer_bg); ?> ; }
		<?php endif; ?>
		<?php 
		$footer_color = get_option('footer_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#pbr-footer , #pbr-footer a{ color: <?php echo trim($footer_color); ?> }
		<?php endif; ?>
		<?php
		$footer_color = get_option('footer_heading_color');
		if( !empty($footer_color) && preg_match("#\##", $footer_color) ) :  ?>
		#pbr-footer h2, #pbr-footer h3, #pbr-footer h4{ color: <?php echo trim($footer_color); ?> }
		<?php endif; ?>
		<?php $topnav_bg = get_option('topnav_bg'); if( !empty($topnav_bg) && preg_match("#\##", $topnav_bg) ) :  ?>
		#pbr-masthead.header-absolute, #pbr-masthead{ background-color:<?php echo trim($topnav_bg); ?> !important; }
		<?php endif; ?>
		<?php $topnav_color = get_option('topnav_color'); if( !empty($topnav_color) && preg_match("#\##", $topnav_color) ) :  ?>
		.navbar-mega .navbar-nav li > a, .navbar-mega .navbar-nav li.active > a{ color: <?php echo trim($topnav_color); ?> }
		<?php endif; ?>
		<?php 
		$copyright_bg = get_option('copyright_bg');
		if( !empty($copyright_bg) && preg_match("#\##", $copyright_bg) ) :  ?>
		.pbr-copyright { background-color:<?php echo trim($copyright_bg); ?> ;}
		<?php endif; ?>

		<?php 
		$copyright_color = get_option('copyright_color');
		if( !empty($copyright_color) && preg_match("#\##", $copyright_color) ) :  ?>
		.pbr-copyright , .pbr-copyright  a{ color:<?php echo trim($copyright_color); ?> ; }
		<?php endif; ?>

	</style>

	<?php if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
		return; ?>
	<?php
}
endif; // fullhouse_fnc_header_style


if ( ! function_exists( 'fullhouse_fnc_admin_header_style' ) ) :
/**
 * Style the header image displayed on the Appearance > Header screen.
 *
 * @see fullhouse_fnc_custom_header_setup()
 *
 * @since fullhouse 1.0
 */
function fullhouse_fnc_admin_header_style() {  
?>
	<style type="text/css" id="fullhouse-admin-header-css">
	.appearance_page_custom-header #headimg {
		background-color: #000;
		border: none;
		max-width: 1260px;
		min-height: 48px;
	}
	#headimg h1 {
		font-family: Lato, sans-serif;
		font-size: 18px;
		line-height: 48px;
		margin: 0 0 0 30px;
	}
	.rtl #headimg h1  {
		margin: 0 30px 0 0;
	}
	#headimg h1 a {
		color: #fff;
		text-decoration: none;
	}
	#headimg img {
		vertical-align: middle;
	}

<?php
}
endif; // fullhouse_fnc_admin_header_style

if ( ! function_exists( 'fullhouse_fnc_admin_header_image' ) ) :
/**
 * Create the custom header image markup displayed on the Appearance > Header screen.
 *
 * @see fullhouse_fnc_custom_header_setup()
 *
 * @since fullhouse 1.0
 */
function fullhouse_fnc_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name" style="<?php echo esc_attr( sprintf( 'color: #%s;', get_header_textcolor() ) ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>" tabindex="-1"><?php bloginfo( 'name' ); ?></a></h1>
	</div>
<?php
}
endif; // fullhouse_fnc_admin_header_image