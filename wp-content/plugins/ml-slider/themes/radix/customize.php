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
                'label' => esc_html__('Background', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Default', 'ml-slider'),
                        'name' => 'arrows_color',
                        'type' => 'color',
                        'default' => 'rgba(255,255,255,0.75)',
                        'css' => '[ms_id] .flexslider ul.flex-direction-nav li a { background: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__( 'Hover', 'ml-slider' ),
                        'name' => 'arrows_color_hover',
                        'type' => 'color',
                        'default' => 'rgba(255,255,255,0.75)',
                        'css' => '[ms_id] .flexslider ul.flex-direction-nav li a:hover { background: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Text', 'ml-slider'),
                        'name' => 'arrows_text_color',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider ul.flex-direction-nav li a { color: [ms_value] }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Icon Colors', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Default', 'ml-slider'),
                        'name' => 'arrows_icon',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider .flex-direction-nav li a:before { background: [ms_id] !important }'
                    ),
                    array(
                        'label' => esc_html__('Hover', 'ml-slider'),
                        'name' => 'arrows_icon_hover',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider .flex-direction-nav li a:hover:before { background: [ms_id] !important }'
                    )
                )
            )
        )
    ),
    array(
        'label' => esc_html__('Navigation', 'ml-slider'),
        'name' => 'navigation',
        'type' => 'section',
        'default' => 'on',
        'settings' => array(
            array(
                'label' => esc_html__('Numbers', 'ml-slider'),
                'type' => 'fields',
                'fields' => array(
                    array(
                        'label' => esc_html__('Color', 'ml-slider'),
                        'name' => 'navigation_color',
                        'type' => 'color',
                        'default' => '#ffffff',
                        'css' => '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a, [ms_id] .flexslider .flex-slide-count { color: [ms_value] !important }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Font Size for Active Number ', 'ml-slider'),
                'name' => 'navigation_size_active',
                'type' => 'range',
                'default' => 60,
                'metric' => 'px',
                'min' => 10,
                'max' => 80,
                'css' => '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a { font-size: [ms_value]px }'
            ),
            array(
                'label' => esc_html__('Line Height for Active Number ', 'ml-slider'),
                'name' => 'navigation_line_height_active',
                'type' => 'range',
                'default' => 0.7,
                'metric' => '',
                'min' => 0.3,
                'max' => 3,
                'step' => 0.1,
                'css' => '[ms_id] .flexslider ol.flex-control-nav:not(.flex-control-thumbs) li a { line-height: [ms_value] }'
            ),
            array(
                'label' => esc_html__('Font Size for Count Number ', 'ml-slider'),
                'name' => 'navigation_size_count',
                'type' => 'range',
                'default' => 25,
                'metric' => 'px',
                'min' => 10,
                'max' => 80,
                'css' => '[ms_id] .flex-slide-count { font-size: [ms_value]px !important }'
            ),
            array(
                'label' => esc_html__('Line Height for Count Number ', 'ml-slider'),
                'name' => 'navigation_line_height_count',
                'type' => 'range',
                'default' => 1.2,
                'metric' => '',
                'min' => 0.3,
                'max' => 3,
                'step' => 0.1,
                'css' => '[ms_id] .flex-slide-count { line-height: [ms_value] }'
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
                        'label' => esc_html__('Background', 'ml-slider'),
                        'name' => 'caption_background',
                        'type' => 'color',
                        'default' => 'rgba(255,255,255,0.75)',
                        'css' =>  '[ms_id] .flexslider ul.slides .caption-wrap { background: [ms_value] }'
                    ),
                    array(
                        'label' => esc_html__('Text', 'ml-slider' ),
                        'name' => 'caption_text_color',
                        'type' => 'color',
                        'default' => '#000000',
                        'css' => '[ms_id] .flexslider ul.slides .caption-wrap { color: [ms_value] }'
                    )
                )
            ),
            array(
                'label' => esc_html__('Font Size', 'ml-slider'),
                'name' => 'caption_font_size',
                'type' => 'range',
                'default' => 0.9,
                'metric' => 'rem',
                'min' => 0.5,
                'max' => 3,
                'step' => 0.1,
                'css' => '[ms_id] .flexslider .caption-wrap .caption { font-size: [ms_value]rem }'
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
                'default' => 'center',
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