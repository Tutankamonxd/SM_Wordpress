<?php
/**
 * Keep this file as is. 
 * You can optionally add array() values to allow to customize theme design
 * See themes/customize.php as reference
 */

return array(
    array(
        'label' => esc_html__('Arrows', 'ml-slider'),
        'name' => 'arrows',
        'type' => 'section',
        'default' => 'on',
        'settings' => array(
            array(
                'label' => esc_html__('Icon Colors', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Default', 'ml-slider'),
                        'name' => 'arrows_icon',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider .flex-direction-nav li a:before, [ms_id] .flexslider .flex-direction-nav li a:after { color: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Hover', 'ml-slider'),
                        'name' => 'arrows_icon_hover',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider .flex-direction-nav li a:hover:before, [ms_id] .flexslider .flex-direction-nav li a:hover:after { color: [ms_value] }'
                    )
                )
            ),
            /*array(
                'label' => esc_html__('Distance from Navigation', 'ml-slider'),
                'name' => 'arrows_distance_nav',
                'type' => 'range',
                'default' => 0,
                'metric' => 'px',
                'min' => 0,
                'max' => 30,
                'css' => array(
                    '[ms_id] .flexslider .flex-direction-nav li a.flex-prev { left: [ms_value]px }',
                    '[ms_id] .flexslider .flex-direction-nav li a.flex-next { right: [ms_value]px }'
                )
            ),*/
            array(
                'label' => esc_html__('Opacity', 'ml-slider'),
                'name' => 'arrows_opacity',
                'type' => 'range',
                'default' => 1,
                'min' => 0.1,
                'max' => 1,
                'step' => 0.1,
                'css' => '[ms_id] .flexslider .flex-direction-nav li a { opacity: [ms_value] }'
            ),    
        )
    ),
    array(
        'label' => esc_html__('Navigation', 'ml-slider'),
        'name' => 'navigation',
        'type' => 'section',
        'default' => 'on',
        'settings' => array(
            array(
                'label' => esc_html__('Numbers Underline', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Hover', 'ml-slider'),
                        'name' => 'navigation_color_hover',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' =>  '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a:hover:after { color: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Active', 'ml-slider'),
                        'name' => 'navigation_color_active',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' => '[ms_id] .flexslider .flex-control-nav li a.flex-active:after { color: [ms_value] }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Numbers', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Default', 'ml-slider'),
                        'name' => 'navigation_number_color',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' => '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a:not(.flex-active) { color: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Hover', 'ml-slider'),
                        'name' => 'navigation_number_color_hover',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' =>  '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a:hover { color: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Active', 'ml-slider'),
                        'name' => 'navigation_number_color_active',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' => '[ms_id] .flexslider .flex-control-nav li a.flex-active { color: [ms_value] }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Numbers Size', 'ml-slider'),
                'name' => 'navigation_number_size',
                'type' => 'range',
                'default' => 11,
                'metric' => 'px',
                'min' => 5,
                'max' => 30,
                'css' => '[ms_id] .flexslider .flex-control-nav li a { font-size: [ms_value]px }'
            ),
            array(
                'label' => esc_html__('Numbers Line Height', 'ml-slider'),
                'name' => 'navigation_line_height',
                'type' => 'range',
                'default' => 15,
                'metric' => 'px',
                'min' => 5,
                'max' => 40,
                'css' => '[ms_id] .flexslider .flex-control-nav li a { line-height: [ms_value]px }'
            ),
            array(
                'label' => esc_html__('Distance Between Numbers', 'ml-slider'),
                'name' => 'navigation_between',
                'type' => 'range',
                'default' => 5,
                'metric' => 'px',
                'min' => 0,
                'max' => 20,
                'css' => '[ms_id] .flexslider .flex-control-nav li a { margin-right: [ms_value]px }'
            ),
        )
    ),
    array(
        'label' => esc_html__('Caption', 'ml-slider'),
        'name' => 'caption',
        'type' => 'section',
        'default' => 'on',
        'settings' => array(
            array(
                'label' => esc_html__('Colors', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Text', 'ml-slider' ),
                        'name' => 'caption_text_color',
                        'type' => 'color',
                        'default' => '#28303d',
                        'css' => '[ms_id] .flexslider .caption-wrap .caption { color: [ms_value] }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Font Size', 'ml-slider'),
                'name' => 'caption_font_size',
                'type' => 'range',
                'default' => 1,
                'metric' => 'em',
                'min' => 0.5,
                'max' => 3,
                'step' => 0.1,
                'css' => '[ms_id] .flexslider .caption-wrap .caption { font-size: [ms_value]em }'
            ),
            array(
                'label' => esc_html__('Line Height', 'ml-slider'),
                'name' => 'caption_line_height',
                'type' => 'range',
                'default' => 1.4,
                'metric' => 'em',
                'min' => 0.5,
                'max' => 3,
                'step' => 0.1,
                'css' => '[ms_id] .flexslider .caption-wrap .caption { line-height: [ms_value]em }'
            ),
            array(
                'label' => esc_html__('Text Align', 'ml-slider'),
                'name' => 'caption_text_align',
                'type' => 'select',
                'default' => 'left',
                'options' => array(
                    array(
                        'label' => esc_html__('Left', 'ml-slider'),
                        'value' => 'left'
                    ),
                    array(
                        'label' => esc_html__('Right', 'ml-slider'),
                        'value' => 'right'
                    ),
                    array(
                        'label' => esc_html__('Center', 'ml-slider'),
                        'value' => 'center'
                    )
                ),
                'css' => '[ms_id] .flexslider .caption-wrap .caption { text-align: [ms_value] }'
            )
        )
    )
);