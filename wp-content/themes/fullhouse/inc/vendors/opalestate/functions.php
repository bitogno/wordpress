<?php

if( defined("WPOPAL_CAPTCHA_LOAED") ){
    add_action( 'fullhouse_quick_register_after', array('OpalEstate_Nocaptcha_Recaptcha','show_captcha') , 99 );
    add_action( 'fullhouse_quick_register_process_before', array( "OpalEstate_Nocaptcha_Recaptcha" ,'ajax_verify_captcha'), 99 );
}

 

function fullhouse_fnc_get_template_link_by_file( $file ){
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => $file
    ));

    if( $pages ){
        $pageLink = get_permalink( $pages[0]->ID);
    }else{
        $pageLink = home_url();
    }
    return $pageLink;
}

/**
 * Hook to account menu which displaying in Top Right.
 */

add_action('opal_account_dropdown_content', 'opalestate_management_user_menu');
/**
 * Hook Layout
 */
function fullhouse_fnc_get_single_property_sidebar_configs( $configs='' ){

	$left  =  fullhouse_fnc_theme_options( 'opalestate-single-left-sidebar' ); 

	$right =  fullhouse_fnc_theme_options( 'opalestate-single-right-sidebar' );

	return fullhouse_fnc_get_layout_configs( $left, $right );
}

add_filter( 'fullhouse_fnc_get_single_property_sidebar_configs', 'fullhouse_fnc_get_single_property_sidebar_configs', 1, 1 );

function fullhouse_fnc_get_archive_property_sidebar_configs( $configs='' ){

	$left  =  fullhouse_fnc_theme_options( 'opalestate-archive-left-sidebar' ); 

	$right =  fullhouse_fnc_theme_options( 'opalestate-archive-right-sidebar' );

	return fullhouse_fnc_get_layout_configs( $left, $right );
}

add_filter( 'fullhouse_fnc_get_archive_property_sidebar_configs', 'fullhouse_fnc_get_archive_property_sidebar_configs', 1, 1 );

function fullhouse_fnc_add_social_share(){
    get_template_part( 'page-templates/parts/sharebox' );
}
add_action( 'opalestate_single_content_bottom',  'fullhouse_fnc_add_social_share', 9999  );
add_action( 'opalestate_single_agent_content_bottom',  'fullhouse_fnc_add_social_share', 9999  );
add_action( 'opalestate_single_office_content_bottom',  'fullhouse_fnc_add_social_share', 9999  );


if( class_exists("WPBakeryShortCode") ){


add_action( 'init', 'fullhouse_fnc_visualcomposer_opalestate' );

    function fullhouse_fnc_visualcomposer_opalestate(){


        vc_map( array(
          "name"        => __("Grid List Style Properties", "opalestate"),
          "base"        => "pbr_gridlisttyle_properties",
          "class"       => "",
          "description" => __('Display Property in Grid Column with List Stype Of Property', "opalestate"),
          "category"    => __('OpalEstate', "opalestate"),
          "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", "opalestate"),
                "param_name" => "title",
                "value" => '',
                  "admin_label" => true
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__( 'Title Color', 'opalestate' ),
                'param_name' => 'title_color',
                'description' => esc_html__( 'Select font color', 'opalestate' )
            ),
             array(
                "type" => "textfield",
                "heading" => __("Description", "opalestate"),
                "param_name" => "description",
                "value" => '',
                'description' =>  ''
            ),
             array(
                "type" => "textfield",
                "heading" => __("Column", "opalestate"),
                "param_name" => "column",
                "value" =>  2,
                'description' =>  ''
              ),
            array(
                "type" => "textfield",
                "heading" => __("Limit", "opalestate"),
                "param_name" => "limit",
                "value" => 6,
                'description' =>  __('Limit featured properties showing', 'opalestate')
            ),
            array(
                "type" => "checkbox",
                "heading" => __("Pagination", "opalestate"),
                "param_name" => "pagination"
            ),
             array(
                "type" => "checkbox",
                "heading" => __("Show Featured Only", "opalestate"),
                "param_name" => "onlyfeatured"
            ),
          )
        ));
    }
    class WPBakeryShortCode_Pbr_gridlisttyle_properties  extends WPBakeryShortCode {}
}
