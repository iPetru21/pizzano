<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://devs.redux.io/
 *
 * @package Redux Framework
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'redux_config';  // YOU MUST CHANGE THIS.  DO NOT USE 'redux_demo' IN YOUR PROJECT!!!

// Uncomment to disable demo mode.
/* Redux::disable_demo(); */  // phpcs:ignore Squiz.PHP.CommentedOutCode

$dir = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

/*
 * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
 */

// Background Patterns Reader.
$sample_patterns_path = Redux_Core::$dir . '../sample/patterns/';
$sample_patterns_url  = Redux_Core::$url . '../sample/patterns/';
$sample_patterns      = array();

if ( is_dir( $sample_patterns_path ) ) {
	$sample_patterns_dir = opendir( $sample_patterns_path );

	if ( $sample_patterns_dir ) {

		// phpcs:ignore WordPress.CodeAnalysis.AssignmentInCondition
		while ( false !== ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) ) {
			if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
				$name              = explode( '.', $sample_patterns_file );
				$name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
				$sample_patterns[] = array(
					'alt' => $name,
					'img' => $sample_patterns_url . $sample_patterns_file,
				);
			}
		}
	}
}

// Used to except HTML tags in description arguments where esc_html would remove.
$kses_exceptions = array(
	'a'      => array(
		'href' => array(),
	),
	'strong' => array(),
	'br'     => array(),
	'code'   => array(),
);

/*
 * ---> BEGIN ARGUMENTS
 */

/**
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://devs.redux.io/core/arguments/
 */
$theme = wp_get_theme(); // For use with some settings. Not necessary.

// TYPICAL -> Change these values as you need/desire.
$args = array(
	// This is where your data is stored in the database and also becomes your global variable name.
	'opt_name'                  => $opt_name,

	// Name that appears at the top of your panel.
	'display_name'              => $theme->get( 'Name' ),

	// Version that appears at the top of your panel.
	'display_version'           => $theme->get( 'Version' ),

	// Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only).
	'menu_type'                 => 'menu',

	// Show the sections below the admin menu item or not.
	'allow_sub_menu'            => true,

	// The text to appear in the admin menu.
	'menu_title'                => esc_html__( 'Theme Settings', 'pizzahouse' ),

	// The text to appear on the page title.
	'page_title'                => esc_html__( 'Theme Settings', 'pizzahouse' ),

	// Disable to create your own Google fonts loader.
	'disable_google_fonts_link' => false,

	// Show the panel pages on the admin bar.
	'admin_bar'                 => true,

	// Icon for the admin bar menu.
	'admin_bar_icon'            => 'dashicons-portfolio',

	// Priority for the admin bar menu.
	'admin_bar_priority'        => 50,

	// Sets a different name for your global variable other than the opt_name.
	'global_variable'           => $opt_name,

	// Show the time the page took to load, etc. (forced on while on localhost or when WP_DEBUG is enabled).
	'dev_mode'                  => true,

	// Enable basic customizer support.
	'customizer'                => true,

	// Allow the panel to open expanded.
	'open_expanded'             => false,

	// Disable the save warning when a user changes a field.
	'disable_save_warn'         => false,

	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_priority'             => 90,

	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters.
	'page_parent'               => 'themes.php',

	// Permissions needed to access the options panel.
	'page_permissions'          => 'manage_options',

	// Specify a custom URL to an icon.
	'menu_icon'                 => '',

	// Force your panel to always open to a specific tab (by id).
	'last_tab'                  => '',

	// Icon displayed in the admin panel next to your menu_title.
	'page_icon'                 => 'dashicons-admin-customizer',

	// Page slug used to denote the panel, will be based off page title, then menu title, then opt_name if not provided.
	'page_slug'                 => $opt_name,

	// On load save the defaults to DB before user clicks save.
	'save_defaults'             => true,

	// Display the default value next to each field when not set to the default value.
	'default_show'              => false,

	// What to print by the field's title if the value shown is default.
	'default_mark'              => '*',

	// Shows the Import/Export panel when not used as a field.
	'show_import_export'        => true,

	// The time transients will expire when the 'database' arg is set.
	'transient_time'            => 60 * MINUTE_IN_SECONDS,

	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output.
	'output'                    => true,

	// Allows dynamic CSS to be generated for customizer and google fonts,
	// but stops the dynamic CSS from going to the page head.
	'output_tag'                => true,

	// Disable the footer credit of Redux. Please leave if you can help it.
	'footer_credit'             => '',

	// If you prefer not to use the CDN for ACE Editor.
	// You may download the Redux Vendor Support plugin to run locally or embed it in your code.
	'use_cdn'                   => true,

	// Set the theme of the option panel.  Use 'wp' to use a more modern style, default is classic.
	'admin_theme'               => 'wp',

	// Enable or disable flyout menus when hovering over a menu with submenus.
	'flyout_submenus'           => true,

	// Mode to display fonts (auto|block|swap|fallback|optional)
	// See: https://developer.mozilla.org/en-US/docs/Web/CSS/@font-face/font-display.
	'font_display'              => 'swap',

	// HINTS.
	'hints'                     => array(
		'icon'          => 'el el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	),

	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'database'                  => '',
	'network_admin'             => true,
	'search'                    => true,
);


// ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
// PLEASE CHANGE THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['admin_bar_links'][] = array(
	'id'    => 'redux-docs',
	'href'  => '//devs.redux.io/',
	'title' => __( 'Documentation', 'pizzahouse' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-support',
	'href'  => '//github.com/ReduxFramework/redux-framework/issues',
	'title' => __( 'Support', 'pizzahouse' ),
);

$args['admin_bar_links'][] = array(
	'id'    => 'redux-extensions',
	'href'  => 'redux.io/extensions',
	'title' => __( 'Extensions', 'pizzahouse' ),
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
// PLEASE CHANGE THEME BEFORE RELEASING YOUR PRODUCT!!
// If these are left unchanged, they will not display in your panel!
$args['share_icons'][] = array(
	'url'   => '//github.com/ReduxFramework/ReduxFramework',
	'title' => 'Visit us on GitHub',
	'icon'  => 'el el-github',
);
$args['share_icons'][] = array(
	'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
	'title' => 'Like us on Facebook',
	'icon'  => 'el el-facebook',
);
$args['share_icons'][] = array(
	'url'   => '//twitter.com/reduxframework',
	'title' => 'Follow us on Twitter',
	'icon'  => 'el el-twitter',
);
$args['share_icons'][] = array(
	'url'   => '//www.linkedin.com/company/redux-framework',
	'title' => 'Find us on LinkedIn',
	'icon'  => 'el el-linkedin',
);

// Panel Intro text -> before the form.
if ( ! isset( $args['global_variable'] ) || false !== $args['global_variable'] ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}

	// translators:  Panel opt_name.
	$args['intro_text'] = '<p>' . sprintf( esc_html__( 'Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: $%1$s', 'pizzahouse' ), '<strong>' . $v . '</strong>' ) . '<p>';
} else {
	$args['intro_text'] = '<p>' . esc_html__( 'This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.', 'pizzahouse' ) . '</p>';
}

// Add content after the form.
$args['footer_text'] = '<p>' . esc_html__( 'This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.', 'pizzahouse' ) . '</p>';

Redux::set_args( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */
$help_tabs = array(
	array(
		'id'      => 'redux-help-tab-1',
		'title'   => esc_html__( 'Theme Information 1', 'pizzahouse' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'pizzahouse' ) . '</p>',
	),
	array(
		'id'      => 'redux-help-tab-2',
		'title'   => esc_html__( 'Theme Information 2', 'pizzahouse' ),
		'content' => '<p>' . esc_html__( 'This is the tab content, HTML is allowed.', 'pizzahouse' ) . '</p>',
	),
);
Redux::set_help_tab( $opt_name, $help_tabs );

// Set the help sidebar.
$content = '<p>' . esc_html__( 'This is the sidebar content, HTML is allowed.', 'pizzahouse' ) . '</p>';

Redux::set_help_sidebar( $opt_name, $content );

/*
 * <--- END HELP TABS
 */

/*
 * ---> START SECTIONS
 */

// -> START Basic Fields
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Global Settings', 'pizzahouse' ),
		'id'               => 'global',
		'desc'             => esc_html__( 'These are really basic settings!', 'pizzahouse' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-cogs',
	)
);

// Redux::set_section(
// 	$opt_name,
// 	array(
// 		'title'      => esc_html__( 'Social Profiles', 'pizzahouse' ),
// 		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-extensions/social-profiles.html" target="_blank">https://devs.redux.io/core-extensions/social-profiles.html</a>',
// 		'id'         => 'socials',
//         'subtitle'   => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'pizzahouse' ),
// 		'subsection' => true,
// 		'fields'     => array(
// 			array(
// 				'id'              => 'pizzahouse-social-profiles',
// 				'type'            => 'social_profiles',
// 				'title'           => esc_html__( 'Social Profiles', 'pizzahouse' ),
// 				'subtitle'        => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'pizzahouse' ),
// 				'hide_widget_msg' => true,
// 			),
// 		),
// 	)
// );

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Personal Information', 'pizzahouse' ),
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/text.html" target="_blank">https://devs.redux.io/core-fields/text.html</a>',
		'id'               => 'personal_informations',
		'subsection'       => true,
		'customizer_width' => '700px',
		'fields'           => array(
			array(
				'id'       => 'pizzahouse-contact-number',
				'type'     => 'text',
				'title'    => esc_html__( 'Contact Number', 'pizzahouse' ),
				'subtitle' => esc_html__( '', 'pizzahouse' ),
				'desc'     => esc_html__( 'Field Description', 'pizzahouse' ),
				'default'  => '',
				'hint'     => array(
					'title'   => 'Hint Title',
					'content' => 'Hint content about this field!',
				),
			),
            array(
				'id'       => 'pizzahouse-email',
				'type'     => 'text',
				'title'    => esc_html__( 'Email Address', 'pizzahouse' ),
				'subtitle' => esc_html__( '', 'pizzahouse' ),
				'desc'     => esc_html__( 'Field Description', 'pizzahouse' ),
				'default'  => 'example@gmail.com',
				'hint'     => array(
					'title'   => 'Hint Title',
					'content' => 'Hint content about this field!',
				),
			),
            array(
				'id'       => 'pizzahouse-address',
				'type'     => 'text',
				'title'    => esc_html__( 'Location Address', 'pizzahouse' ),
				'subtitle' => esc_html__( '', 'pizzahouse' ),
				'desc'     => esc_html__( 'Field Description', 'pizzahouse' ),
				'default'  => '',
				'hint'     => array(
					'title'   => 'Hint Title',
					'content' => 'Hint content about this field!',
				),
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Footer', 'pizzahouse' ),
		'desc'             => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/text.html" target="_blank">https://devs.redux.io/core-fields/text.html</a>',
		'id'               => 'footer',
		'subsection'       => true,
		'customizer_width' => '700px',
		'fields'           => array(
            array(
				'id'           => 'pizzahouse-footer-logo',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Media w/ URL', 'pizzahouse' ),
				'compiler'     => 'true',
				'desc'         => esc_html__( 'Basic media uploader with disabled URL input field.', 'pizzahouse' ),
				'subtitle'     => esc_html__( 'Upload any media using the WordPress native uploader', 'pizzahouse' ),
				'preview_size' => 'full',
			),
			array(
				'id'           => 'pizzahouse-likes-image',
				'type'         => 'media',
				'url'          => true,
				'title'        => esc_html__( 'Likes image', 'pizzahouse' ),
				'compiler'     => 'true',
				'desc'         => esc_html__( 'Recomended size 58x25 px.', 'pizzahouse' ),
				'subtitle'     => esc_html__( 'Upload any media using the WordPress native uploader', 'pizzahouse' ),
				'preview_size' => 'full',
			),
            array(
				'id'          => 'pizzahouse-likes-text',
				'type'        => 'text',
				'title'       => esc_html__( 'Likes text.', 'pizzahouse' ),
				'subtitle'    => esc_html__( '', 'pizzahouse' ),
				'desc'        => esc_html__( 'Write for example the number of likes', 'pizzahouse' ),
				'placeholder' => 'Placeholder Text',
			),
            array(
				'id'          => 'pizzahouse-footer-menu-headings',
				'type'        => 'text',
				'title'       => esc_html__( 'Footer menu headings.', 'pizzahouse' ),
				'subtitle'    => esc_html__( '', 'pizzahouse' ),
				'desc'        => esc_html__( '', 'pizzahouse' ),
				'placeholder' => 'Placeholder Text',
				'data'        => array( 'Heading menu 1', 'Heading menu 2' ),
			),
            array(
				'id'      => 'pizzahouse-footer-copyrigth',
				'type'    => 'editor',
				'title'   => esc_html__( 'Copyrigth', 'pizzahouse' ),
				'default' => 'Powered by Redux Framework.',
				'args'    => array(
					'wpautop'       => false,
					'media_buttons' => false,
					'textarea_rows' => 5,
					'teeny'         => false,
					'quicktags'     => false,
				),
			),
        ),
    )
);

// Home Page
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Home Page', 'pizzahouse' ),
		'id'               => 'home',
		'desc'             => esc_html__( 'These are home page settings!', 'pizzahouse' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-home-alt',
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Slides', 'pizzahouse' ),
		'id'         => 'slides',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/slides.html" target="_blank">https://devs.redux.io/core-fields/slides.html</a>',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'pizzahouse-additional-slides',
				'type'        => 'slides',
				'title'       => esc_html__( 'First page slider', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited slides with drag and drop sortings.', 'pizzahouse' ),
				'desc'        => esc_html__( 'This field will store all slides values into a multidimensional array to use into a foreach loop.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'This is a title', 'pizzahouse' ),
                    'height'      => esc_html__( 'This is a button text', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
			array(
				'id'          => 'pizzahouse-slides-button-text',
				'type'        => 'text',
				'title'       => esc_html__( 'Button text', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => esc_html__( 'Click here!', 'pizzahouse' ),
			),
            array(
				'id'          => 'pizzahouse-slides-button-url',
				'type'        => 'text',
				'title'       => esc_html__( 'Button url', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => esc_html__( 'https://pizzano.ro', 'pizzahouse' ),
                'validate'    => array( 'url' )
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Menu', 'pizzahouse' ),
		'id'         => 'menu',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/slides.html" target="_blank">https://devs.redux.io/core-fields/slides.html</a>',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'pizzahouse-menu-title',
				'type'        => 'text',
				'title'       => esc_html__( 'Title', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'This is a title', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Banner', 'pizzahouse' ),
		'id'         => 'banner',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/slides.html" target="_blank">https://devs.redux.io/core-fields/slides.html</a>',
		'subsection' => true,
		'fields'     => array(
            array(
				'id'          => 'pizzahouse-banner-image',
				'type'        => 'media',
				'title'       => esc_html__( 'Background image', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Suggested dimension 1920x503.', 'pizzahouse' ),
			),
			array(
				'id'          => 'pizzahouse-banner-title',
				'type'        => 'text',
				'title'       => esc_html__( 'Title', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'This is a title', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
            array(
				'id'          => 'pizzahouse-banner-textarea',
				'type'        => 'textarea',
				'title'       => esc_html__( 'Description', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => 'This is a description', 'pizzahouse',
			),
            array(
				'id'          => 'pizzahouse-banner-author',
				'type'        => 'text',
				'title'       => esc_html__( 'Author', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'Author\' full name', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
            array(
				'id'          => 'pizzahouse-banner-button-text',
				'type'        => 'text',
				'title'       => esc_html__( 'Button text', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'View our services', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
            array(
				'id'          => 'pizzahouse-banner-button-link',
				'type'        => 'text',
				'title'       => esc_html__( 'Button link', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => '',
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Banner 2', 'pizzahouse' ),
		'id'         => 'banner2',
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-fields/slides.html" target="_blank">https://devs.redux.io/core-fields/slides.html</a>',
		'subsection' => true,
		'fields'     => array(
            array(
				'id'          => 'pizzahouse-banner2-image',
				'type'        => 'media',
				'title'       => esc_html__( 'Background image', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Suggested dimension 1920x503.', 'pizzahouse' ),
			),
			array(
				'id'          => 'pizzahouse-banner2-title',
				'type'        => 'text',
				'title'       => esc_html__( 'Title', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'This is a title', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
            array(
				'id'          => 'pizzahouse-banner2-textarea',
				'type'        => 'textarea',
				'title'       => esc_html__( 'Description', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => 'This is a description', 'pizzahouse',
			),
            array(
				'id'          => 'pizzahouse-banner2-button-text',
				'type'        => 'text',
				'title'       => esc_html__( 'Button text', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => array(
					'title'       => esc_html__( 'View our services', 'pizzahouse' ),
					'description' => esc_html__( 'Description Here', 'pizzahouse' ),
					'url'         => esc_html__( 'Give us a link!', 'pizzahouse' ),
				),
			),
            array(
				'id'          => 'pizzahouse-banner2-button-link',
				'type'        => 'text',
				'title'       => esc_html__( 'Button link', 'pizzahouse' ),
				'subtitle'    => esc_html__( 'Unlimited items with drag and drop sortings.', 'pizzahouse' ),
				'placeholder' => '',
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => __( 'Gallery', 'pizzahouse' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-extensions/repeater.html" target="_blank">https://devs.redux.io/core-extensions/repeater.html</a>',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'pizzahouse_gallery',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Gallery items', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => '',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
				'fields'      => array(
					array(
						'id'          => 'pizzahouse_gallery_title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),		
					),
                    array(
						'id'          => 'pizzahouse_gallery_url',
						'type'        => 'text',
						'placeholder' => esc_html__( 'https://example.com/', 'pizzahouse' ),
						'title'		  => esc_html__( 'URL', 'pizzahouse' ),	
                        'validate'    => array( 'url' )	
					),
					array(
						'id'          => 'pizzahouse_gallery_description',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Text Field', 'pizzahouse' ),
						'default'     => 'Text Field here',
						'title'       => esc_html__( 'Description', 'your-domain-here' ),
					),
					array(
						'id'          => 'pizzahouse_gallery_image',
						'type'        => 'media',
						'placeholder' => esc_html__( '', 'pizzahouse' ),
						'title'		  => esc_html__( 'Thumb Image', 'pizzahouse' ),
					),
                    array(
						'id'          => 'pizzahouse_gallery_full_image',
						'type'        => 'media',
						'placeholder' => esc_html__( '', 'pizzahouse' ),
						'title'		  => esc_html__( 'Full Image', 'pizzahouse' ),
					),
                    array(
                        'id'       => 'pizzahouse-gallery_image_sm',
                        'type'     => 'select',
                        'title'    => esc_html__('Select dimension on small Screen.', 'pizzahouse'), 
                        'subtitle' => esc_html__('No validation can be done on this field type', 'your-textdomain-here'),
                        'desc'     => esc_html__('This is the description field, again good for additional info.', 'your-textdomain-here'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '4' => 'Small - col-sm-4',
                            '6' => 'Medium - col-sm-6',
                            '8' => 'Big - col-sm-8'
                        ),
                        'default'  => '4',
                    ),
                    array(
                        'id'       => 'pizzahouse-gallery_image_lx',
                        'type'     => 'select',
                        'title'    => esc_html__('Select dimension on large Screen.', 'pizzahouse'), 
                        'subtitle' => esc_html__('No validation can be done on this field type', 'your-textdomain-here'),
                        'desc'     => esc_html__('This is the description field, again good for additional info.', 'your-textdomain-here'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            '2' => 'Small - col-lx-2',
                            '4' => 'Medium - col-lx-4',
                            '6' => 'Big - col-lx-6'
                        ),
                        'default'  => '2',
                    ),
				),
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Contact Form', 'pizzahouse' ),
		'desc'			=> esc_html__( 'Contact form for booking the table.' ),
		'subsection'	=> true,
		'fields'		=> array(
			array(
				'id'          => 'pizzahouse_contact_form_title',
				'type'        => 'text',
				'placeholder' => esc_html__( 'Booking contact form', 'pizzahouse' ),
				'title'		  => esc_html__( 'Title', 'pizzahouse' ),
			),
			array(
				'id'          => 'pizzahouse_contact_form_hint',
				'type'        => 'textarea',
				'placeholder' => esc_html__( 'Please keep clean.', 'pizzahouse' ),
				'title'		  => esc_html__( 'Hint', 'pizzahouse' ),
			),
			array(
				'id'		  => 'pizzahouse_contact_form_shortcode',
				'type'		  => 'text',
				'placeholder' => esc_html__( '[ example ]', 'pizzahouse' ),
				'title'		  => esc_html__( 'Shortcode', 'pizzahouse' ),	
			)
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => __( 'Advantages', 'pizzahouse' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-extensions/repeater.html" target="_blank">https://devs.redux.io/core-extensions/repeater.html</a>',
		'subsection' => true,
		'fields'     => array(
			array(
				'id'          => 'pizzahouse_advantages',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Gallery items', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => '',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
				'fields'      => array(
					array(
						'id'          => 'pizzahouse_advantages_title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),		
					),
					array(
						'id'          => 'pizzahouse_advantages_description',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Text Field', 'pizzahouse' ),
						'default'     => 'Text Field here',
						'title'       => esc_html__( 'Description', 'your-domain-here' ),
					),
					array(
						'id'          => 'pizzahouse_advantages_icon',
						'type'        => 'text',
						'placeholder' => esc_html__( 'fa-icon', 'pizzahouse' ),
						'title'		  => esc_html__( 'Icon', 'pizzahouse' ),
					),
				),
			),
		),
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Testimonials', 'pizzahouse' ),
		'desc'			=> esc_html__( 'What people say about us.' ),
		'subsection'	=> true,
		'fields'		=> array(
			array(
				'id'          => 'pizzahouse_testimonials_title',
				'type'        => 'text',
				'placeholder' => esc_html__( 'Testimonials', 'pizzahouse' ),
				'title'		  => esc_html__( 'Title', 'pizzahouse' ),
			),
		),
	),
);

// About Us
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'About Us', 'pizzahouse' ),
		'id'               => 'pizzahouse_about-us',
		'desc'             => esc_html__( 'These are about us settings!', 'pizzahouse' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-address-book',
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Tabs', 'pizzahouse' ),
		'desc'			=> esc_html__( 'About us.' ),
		'subsection'	=> true,
        'fields'        => array(
			array(
                'id'             => 'pizzahouse_about-us__title',
                'type'           => 'text',
                'title'          => 'Tabs Title',
                'placeholder'    => 'Title'
            ),
            array(
                'id'             => 'pizzahouse_about-us__button-text',
                'type'           => 'text',
                'title'          => 'Button Text',
                'placeholder'    => 'Text'
            ),
            array(
                'id'             => 'pizzahouse_about-us__button-link',
                'type'           => 'text',
                'title'          => 'Button Link',
                'placeholder'    => 'https://'
            ),
            array(
				'id'          => 'pizzahouse_about-us__tabs',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Tabs items', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => 'items',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
                'limit'       => 10,
				'fields'      => array(
					array(
						'id'          => 'title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),		
					),
                    array(
						'id'          => 'tabs_title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Tabs title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),		
					),
					array(
						'id'          => 'description',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Text Field', 'pizzahouse' ),
						'default'     => 'Text Field here',
						'title'       => esc_html__( 'Description', 'your-domain-here' ),
					),
					array(
						'id'          => 'image',
						'type'        => 'media',
						'placeholder' => esc_html__( 'Image', 'pizzahouse' ),
						'title'		  => esc_html__( 'Image', 'pizzahouse' ),
					),
				),
			),
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Icon List', 'pizzahouse' ),
		'desc'			=> esc_html__( 'About us.' ),
		'subsection'	=> true,
        'fields'        => array(
            array(
				'id'          => 'pizzahouse_about-us__icons',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Icons items', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => 'items',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
                'limit'       => 9,
				'fields'      => array(
					array(
						'id'          => 'title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),		
					),
                    array(
						'id'          => 'url',
						'type'        => 'text',
						'placeholder' => esc_html__( 'https://pizzano.ro', 'pizzahouse' ),
						'title'		  => esc_html__( 'URL', 'pizzahouse' ),	
                        'validate'    => array( 'url' )	
					),
					array(
						'id'          => 'description',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Text Field', 'pizzahouse' ),
						'default'     => 'Text Field here',
						'title'       => esc_html__( 'Description', 'your-domain-here' ),
					),
					array(
						'id'          => 'icon',
						'type'        => 'text',
						'placeholder' => esc_html__( 'linearicons-icon', 'pizzahouse' ),
						'title'		  => esc_html__( 'Icon', 'pizzahouse' ),
					),
				),
			),
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Our Team', 'pizzahouse' ),
		'desc'			=> esc_html__( 'About us.', 'pizzahouse' ),
		'subsection'	=> true,
        'fields'        => array(
			array(
				'id'          => 'pizzahouse_about-us__team-title',
				'type'        => 'text',
				'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
				'title'		  => esc_html__( 'Title', 'pizzahouse' ),	
			),
            array(
				'id'          => 'pizzahouse_about-us__team',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Our Team', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => 'items',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
                'limit'       => 9,
				'fields'      => array(
					array(
						'id'          => 'name',
						'type'        => 'text',
						'placeholder' => esc_html__( 'John Kardashian', 'pizzahouse' ),
						'title'		  => esc_html__( 'Name', 'pizzahouse' ),	
						'required'	  => true,	
					),
					array(
						'id'          => 'role',
						'type'        => 'text',
						'placeholder' => esc_html__( 'About its role in the team', 'pizzahouse' ),
						'title'		  => esc_html__( 'Role', 'pizzahouse' ),
						'required'	  => true,	
					),
					array(
						'id'          => 'image',
						'type'        => 'media',
						'title'		  => esc_html__( 'Photo', 'pizzahouse' ),
						'required'	  => true,
					),
					array(
						'id'          => 'facebook',
						'type'        => 'text',
						'validate' 	  => array(
							'url'
						),
						'default'	  => '#',
						'title'		  => esc_html__( 'Facebook URL', 'pizzahouse' ),		
					),
					array(
						'id'          => 'instagram',
						'type'        => 'text',
						'validate' => array(
							'url'
						),
						'default'	  => '#',
						'title'		  => esc_html__( 'Instagram URL', 'pizzahouse' ),		
					),
					array(
						'id'          => 'twitter',
						'type'        => 'text',
						'validate' => array(
							'url'
						),
						'default'	  => '#',
						'title'		  => esc_html__( 'Twitter URL', 'pizzahouse' ),		
					),
					array(
						'id'          => 'google',
						'type'        => 'text',
						'validate' => array(
							'url'
						),
						'default'	  => '#',
						'title'		  => esc_html__( 'Google URL', 'pizzahouse' ),		
					),
				),
			),
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Our History', 'pizzahouse' ),
		'desc'			=> esc_html__( 'Our History.', 'pizzahouse' ),
		'subsection'	=> true,
        'fields'        => array(
			array(
				'id'          => 'pizzahouse_about-us__history-title',
				'type'        => 'text',
				'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
				'title'		  => esc_html__( 'Title', 'pizzahouse' ),	
			),
			array(
				'id'          => 'pizzahouse_about-us__history-image',
				'type'        => 'media',
				'title'		  => esc_html__( 'Video Image', 'pizzahouse' ),	
			),
			array(
				'id'          => 'pizzahouse_about-us__history-video',
				'type'        => 'text',
				'title'		  => esc_html__( 'Video Link', 'pizzahouse' ),	
				'validate' => array(
					'url'
				),
			),
            array(
				'id'          => 'pizzahouse_about-us__history',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Our History', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => 'items',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
                'limit'       => 9,
				'fields'      => array(
					array(
						'id'          => 'year',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Year', 'pizzahouse' ),
						'title'		  => esc_html__( 'Year', 'pizzahouse' ),	
						'validate' 	  => array( 'numeric', 'not_empty' ),
					),
					array(
						'id'          => 'title',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
						'title'		  => esc_html__( 'Title', 'pizzahouse' ),	
					),
					array(
						'id'          => 'description',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Description History', 'pizzahouse' ),
						'title'		  => esc_html__( 'Description', 'pizzahouse' ),
					),
				),
			),
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Our Testimonials', 'pizzahouse' ),
		'desc'			=> esc_html__( 'Our Testimonials.', 'pizzahouse' ),
		'subsection'	=> true,
        'fields'        => array(
			array(
				'id'          => 'pizzahouse_about-us__testimonials-title',
				'type'        => 'text',
				'placeholder' => esc_html__( 'Title', 'pizzahouse' ),
				'title'		  => esc_html__( 'Title', 'pizzahouse' ),	
			),
			array(
				'id'          => 'pizzahouse_about-us__testimonials-image',
				'type'        => 'media',
				'title'		  => esc_html__( 'Image', 'pizzahouse' ),	
			),
            array(
				'id'          => 'pizzahouse_about-us__testimonials',
				'type'        => 'repeater',
				'title'       => esc_html__( 'Our Testimonials', 'pizzahouse' ),
				'full_width'  => true,
				'subtitle'    => esc_html__( 'Repeater', 'pizzahouse' ),
				'item_name'   => 'items',
				'sortable'    => true,
				'active'      => false,                                                                     
				'collapsible' => false,
                'group_values'=> true,
                'limit'       => 9,
				'fields'      => array(
					array(
						'id'          => 'client-name',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Client Name', 'pizzahouse' ),
						'title'		  => esc_html__( 'Client Name', 'pizzahouse' ),	
					),
					array(
						'id'          => 'client-role',
						'type'        => 'text',
						'placeholder' => esc_html__( 'Client Role', 'pizzahouse' ),
						'title'		  => esc_html__( 'Client Role', 'pizzahouse' ),	
					),
					array(
						'id'          => 'opinion',
						'type'        => 'textarea',
						'placeholder' => esc_html__( 'Client Opinion', 'pizzahouse' ),
						'title'		  => esc_html__( 'Client Opinion', 'pizzahouse' ),
					),
					array(
						'id'          => 'client-image',
						'type'        => 'media',
						'placeholder' => esc_html__( 'Client Photo', 'pizzahouse' ),
						'title'		  => esc_html__( 'Client Photo', 'pizzahouse' ),
					),
				),
			),
		),
	),
);

// Social Media
Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Social media', 'pizzahouse' ),
		'id'               => 'global',
		'desc'             => esc_html__( 'These are really basic settings!', 'pizzahouse' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-comment-alt',
	)
);

Redux::set_section(
	$opt_name,
	array(
		'title'      => esc_html__( 'Social Profiles', 'your-textdomain-here' ),
		'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'your-textdomain-here' ) . '<a href="https://devs.redux.io/core-extensions/social-profiles.html" target="_blank">https://devs.redux.io/core-extensions/social-profiles.html</a>',
		'subtitle'   => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'your-textdomain-here' ),
		'subsection' => true,
		'fields'     => array(
			array(
				'id'              => 'pizzahouse-social-profiles',
				'type'            => 'social_profiles',
				'title'           => esc_html__( 'Social Profiles', 'your-textdomain-here' ),
				'subtitle'        => esc_html__( 'Click an icon to activate it, drag and drop to change the icon order.', 'your-textdomain-here' ),
				'hide_widget_msg' => true,
			),
		),
	)
);
/*
Redux::set_section(
	$opt_name,
	array(
		'title'			=> __( 'Header Background Banner', 'pizzahouse' ),
		'desc'			=> esc_html__( 'Banner on single product page.' ),
		'subsection'	=> true,
		'fields'		=> array(
			array(
				'id'          => 'pizzahouse_single_product_background',
				'type'        => 'media',
				'placeholder' => esc_html__( 'Image', 'pizzahouse' ),
				'title'		  => esc_html__( 'Image', 'pizzahouse' ),
			),
		),
	),
);

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Basic Fields', 'pizzahouse' ),
		'id'               => 'basic',
		'desc'             => esc_html__( 'These are really basic fields!', 'pizzahouse' ),
		'customizer_width' => '400px',
		'icon'             => 'el el-home',
	)
);

require_once Redux_Core::$dir . '../sample/sections/basic-fields/checkbox.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/radio.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/sortable.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/text.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/multi-text.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/password.php';
require_once Redux_Core::$dir . '../sample/sections/basic-fields/textarea.php';

// -> START Editors.

Redux::set_section(
	$opt_name,
	array(
		'title'            => esc_html__( 'Editors', 'pizzahouse' ),
		'id'               => 'editor',
		'customizer_width' => '500px',
		'icon'             => 'el el-edit',
	)
);

require_once Redux_Core::$dir . '../sample/sections/editors/wordpress-editor.php';
require_once Redux_Core::$dir . '../sample/sections/editors/ace-editor.php';

// -> START Color Selection.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Color Selection', 'pizzahouse' ),
		'id'    => 'color',
		'icon'  => 'el el-brush',
	)
);

require_once Redux_Core::$dir . '../sample/sections/color-selection/color.php';
require_once Redux_Core::$dir . '../sample/sections/color-selection/color-gradient.php';
require_once Redux_Core::$dir . '../sample/sections/color-selection/color-rgba.php';
require_once Redux_Core::$dir . '../sample/sections/color-selection/link-color.php';
require_once Redux_Core::$dir . '../sample/sections/color-selection/palette.php';
require_once Redux_Core::$dir . '../sample/sections/color-selection/color-palette.php';

// -> START Design Fields.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Design Fields', 'pizzahouse' ),
		'id'    => 'design',
		'icon'  => 'el el-wrench',
	)
);

//require_once Redux_Core::$dir . '../sample/sections/design-fields/background.php';
// require_once Redux_Core::$dir . '../sample/sections/design-fields/box-shadow.php';
// require_once Redux_Core::$dir . '../sample/sections/design-fields/border.php';
// require_once Redux_Core::$dir . '../sample/sections/design-fields/dimensions.php';
// require_once Redux_Core::$dir . '../sample/sections/design-fields/spacing.php';

// -> START Media Uploads.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Media Uploads', 'pizzahouse' ),
		'id'    => 'media',
		'icon'  => 'el el-picture',
	)
);

require_once Redux_Core::$dir . '../sample/sections/media-uploads/gallery.php';
require_once Redux_Core::$dir . '../sample/sections/media-uploads/media.php';
require_once Redux_Core::$dir . '../sample/sections/media-uploads/multi-media.php';
require_once Redux_Core::$dir . '../sample/sections/media-uploads/slides.php';

// -> START Presentation Fields.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Presentation Fields', 'pizzahouse' ),
		'id'    => 'presentation',
		'icon'  => 'el el-screen',
	)
);

require_once Redux_Core::$dir . '../sample/sections/presentation-fields/divide.php';
require_once Redux_Core::$dir . '../sample/sections/presentation-fields/info.php';
require_once Redux_Core::$dir . '../sample/sections/presentation-fields/section.php';

Redux::set_section(
	$opt_name,
	array(
		'id'   => 'presentation-divide-sample',
		'type' => 'divide',
	)
);

// -> START Switch & Button Set.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Switch / Button Set', 'pizzahouse' ),
		'id'    => 'switch_buttonset',
		'icon'  => 'el el-cogs',
	)
);

require_once Redux_Core::$dir . '../sample/sections/switch-button/button-set.php';
require_once Redux_Core::$dir . '../sample/sections/switch-button/switch.php';

// -> START Select Fields.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Select Fields', 'pizzahouse' ),
		'id'    => 'select',
		'icon'  => 'el el-list-alt',
	)
);

require_once Redux_Core::$dir . '../sample/sections/select-fields/select.php';
require_once Redux_Core::$dir . '../sample/sections/select-fields/image-select.php';
require_once Redux_Core::$dir . '../sample/sections/select-fields/select-image.php';

// -> START Slider / Spinner.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Slider / Spinner', 'pizzahouse' ),
		'id'    => 'slider_spinner',
		'icon'  => 'el el-adjust-alt',
	)
);

require_once Redux_Core::$dir . '../sample/sections/slider-spinner/slider.php';
require_once Redux_Core::$dir . '../sample/sections/slider-spinner/spinner.php';

// -> START Typography.
require_once Redux_Core::$dir . '../sample/sections/typography/typography.php';

// -> START Additional Types.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Additional Types', 'pizzahouse' ),
		'id'    => 'additional',
		'icon'  => 'el el-magic',
	)
);

require_once Redux_Core::$dir . '../sample/sections/additional-types/date.php';
require_once Redux_Core::$dir . '../sample/sections/additional-types/date-time-picker.php';
require_once Redux_Core::$dir . '../sample/sections/additional-types/sorter.php';
require_once Redux_Core::$dir . '../sample/sections/additional-types/raw.php';

Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Advanced Features', 'pizzahouse' ),
		'icon'  => 'el el-thumbs-up',
	)
);

require_once Redux_Core::$dir . '../sample/sections/advanced-features/callback.php';

// -> START Validation.
require_once Redux_Core::$dir . '../sample/sections/advanced-features/field-validation.php';

// -> START Sanitizing.
require_once Redux_Core::$dir . '../sample/sections/advanced-features/field-sanitizing.php';

// -> START Required.
require_once Redux_Core::$dir . '../sample/sections/advanced-features/field-required-linking.php';

require_once Redux_Core::$dir . '../sample/sections/advanced-features/wpml-integration.php';

// -> START Disabling.
Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Disabling', 'pizzahouse' ),
		'icon'  => 'el el-lock',
	)
);

require_once Redux_Core::$dir . '../sample/sections/disabling/disable-field.php';
require_once Redux_Core::$dir . '../sample/sections/disabling/disable-section.php';

// -> START Pro Fields.

Redux::set_section(
	$opt_name,
	array(
		'title' => esc_html__( 'Redux Extensions', 'pizzahouse' ),
		'id'    => 'redux-extensions',
		'icon'  => 'el el-redux',
		'class' => 'pro_highlight',
		'desc'  => esc_html__( 'For full documentation on this field, visit: ', 'pizzahouse' ) . '<a href="https://devs.redux.io/core-extensions/" target="_blank">https://devs.redux.io/core-extensions/</a>',
	)
);

require_once Redux_Core::$dir . '../sample/sections/extensions/accordion.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/custom-fonts.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/google-maps.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/js-button.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/repeater.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/search.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/shortcodes.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/social-profiles.php';
require_once Redux_Core::$dir . '../sample/sections/extensions/widget-areas.php';

if ( class_exists( 'Redux_Pro' ) ) {
	require_once Redux_Core::$dir . '../sample/sections/extensions/color-scheme.php';
	require_once Redux_Core::$dir . '../sample/sections/extensions/icon-select.php';
	require_once Redux_Core::$dir . '../sample/sections/extensions/taxonomy.php';
	require_once Redux_Core::$dir . '../sample/sections/extensions/users.php';
}

/**
 * Metaboxes
 */
require_once Redux_Core::$dir . '../sample/metaboxes.php';

/**
 * Raw README
 */
if ( file_exists( $dir . '/../README.md' ) ) {
	$section = array(
		'icon'   => 'el el-list-alt',
		'title'  => esc_html__( 'Documentation', 'pizzahouse' ),
		'fields' => array(
			array(
				'id'           => 'opt-raw-documentation',
				'type'         => 'raw',
				'markdown'     => true,
				'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please.
			),
		),
	);

	Redux::set_section( $opt_name, $section );
}

Redux::set_section(
	$opt_name,
	array(
		'icon'            => 'el el-list-alt',
		'title'           => esc_html__( 'Customizer Only', 'pizzahouse' ),
		'desc'            => '<p class="description">' . esc_html__( 'This Section should be visible only in Customizer', 'pizzahouse' ) . '</p>',
		'customizer_only' => true,
		'fields'          => array(
			array(
				'id'              => 'opt-customizer-only',
				'type'            => 'select',
				'title'           => esc_html__( 'Customizer Only Option', 'pizzahouse' ),
				'subtitle'        => esc_html__( 'The subtitle is NOT visible in customizer', 'pizzahouse' ),
				'desc'            => esc_html__( 'The field desc is NOT visible in customizer.', 'pizzahouse' ),
				'customizer_only' => true,
				'options'         => array(
					'1' => esc_html__( 'Opt 1', 'pizzahouse' ),
					'2' => esc_html__( 'Opt 2', 'pizzahouse' ),
					'3' => esc_html__( 'Opt 3', 'pizzahouse' ),
				),
				'default'         => '2',
			),
		),
	)
);

/*
 * <--- END SECTIONS
 */

/*
 * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR OTHER CONFIGS MAY OVERRIDE YOUR CODE.
 */

/*
 * --> Action hook examples.
 */

// Function to test the compiler hook and demo CSS output.
// Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
// add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);
//
// Change the arguments after they've been declared, but before the panel is created.
// add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );
//
// Change the default value of a field after it's been set, but before it's been used.
// add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );
//
// Dynamically add a section. Can be also used to modify sections/fields.
// add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');
// .
if ( ! function_exists( 'compiler_action' ) ) {
	/**
	 * This is a test function that will let you see when the compiler hook occurs.
	 * It only runs if a field's value has changed and compiler=>true is set.
	 *
	 * @param array  $options        Options values.
	 * @param string $css            Compiler selector CSS values  compiler => array( CSS SELECTORS ).
	 * @param array  $changed_values Any values changed since last save.
	 */
	function compiler_action( array $options, string $css, array $changed_values ) {
		echo '<h1>The compiler hook has run!</h1>';
		echo '<pre>';
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions
		print_r( $changed_values ); // Values that have changed since the last save.
		// echo '<br/>';
		// print_r($options); //Option values.
		// echo '<br/>';
		// print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS ).
		echo '</pre>';
	}
}

if ( ! function_exists( 'redux_validate_callback_function' ) ) {
	/**
	 * Custom function for the callback validation referenced above
	 *
	 * @param array $field          Field array.
	 * @param mixed $value          New value.
	 * @param mixed $existing_value Existing value.
	 *
	 * @return array
	 */
	function redux_validate_callback_function( array $field, $value, $existing_value ): array {
		$error   = false;
		$warning = false;

		// Do your validation.
		if ( 1 === (int) $value ) {
			$error = true;
			$value = $existing_value;
		} elseif ( 2 === (int) $value ) {
			$warning = true;
			$value   = $existing_value;
		}

		$return['value'] = $value;

		if ( true === $error ) {
			$field['msg']    = 'your custom error message';
			$return['error'] = $field;
		}

		if ( true === $warning ) {
			$field['msg']      = 'your custom warning message';
			$return['warning'] = $field;
		}

		return $return;
	}
}


if ( ! function_exists( 'dynamic_section' ) ) {
	/**
	 * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
	 * Simply include this function in the child themes functions.php file.
	 * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
	 * so you must use get_template_directory_uri() if you want to use any of the built-in icons.
	 *
	 * @param array $sections Section array.
	 *
	 * @return array
	 */
	function dynamic_section( array $sections ): array {
		$sections[] = array(
			'title'  => esc_html__( 'Section via hook', 'pizzahouse' ),
			'desc'   => '<p class="description">' . esc_html__( 'This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.', 'pizzahouse' ) . '</p>',
			'icon'   => 'el el-paper-clip',

			// Leave this as a blank section, no options just some intro text set above.
			'fields' => array(),
		);

		return $sections;
	}
}

if ( ! function_exists( 'change_arguments' ) ) {
	/**
	 * Filter hook for filtering the args.
	 * Good for child themes to override or add to the args array. Can also be used in other functions.
	 *
	 * @param array $args Global arguments array.
	 *
	 * @return array
	 */
	function change_arguments( array $args ): array {
		$args['dev_mode'] = true;

		return $args;
	}
}

if ( ! function_exists( 'change_defaults' ) ) {
	/**
	 * Filter hook for filtering the default value of any given field. Very useful in development mode.
	 *
	 * @param array $defaults Default value array.
	 *
	 * @return array
	 */
	function change_defaults( array $defaults ): array {
		$defaults['str_replace'] = esc_html__( 'Testing filter hook!', 'pizzahouse' );

		return $defaults;
	}
}

if ( ! function_exists( 'redux_custom_sanitize' ) ) {
	/**
	 * Function to be used if the field sanitize argument.
	 * Return value MUST be the formatted or cleaned text to display.
	 *
	 * @param string $value Value to evaluate or clean.  Required.
	 *
	 * @return string
	 */
	function redux_custom_sanitize( string $value ): string {
		$return = '';

		foreach ( explode( ' ', $value ) as $w ) {
			foreach ( str_split( $w ) as $k => $v ) {
				if ( ( $k + 1 ) % 2 !== 0 && ctype_alpha( $v ) ) {
					$return .= mb_strtoupper( $v );
				} else {
					$return .= $v;
				}
			}

			$return .= ' ';
		}

		return $return;
	}
}
