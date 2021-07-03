<?php

namespace ElementorVideoWidget\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Elementor Video
 *
 * Elementor widget for Video.
 *
 * @since 1.0.0
 */
class Video extends Widget_Base
{

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'video-widget';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('HTML5 Video', 'elementor-video-widget');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-youtube';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['video', 'player', 'embed', 'youtube', 'vimeo', 'dailymotion'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['videojs', 'waypoints', 'elementor-video-widget'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_style_depends()
    {
        return ['videojs', 'elementor-video-widget'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_video',
            [
                'label' => __('HTML5 Video', 'elementor-video-widget'),
            ]
        );

        $this->add_control(
            'source',
            [
                'label' => __('Choose a Video File', 'elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'video',
            ]
        );

        $this->add_control(
            'poster',
            [
                'label' => __('Video Poster', 'elementor'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                    'categories' => [
                        TagsModule::MEDIA_CATEGORY,
                    ],
                ],
                'media_type' => 'image',
            ]
        );

        $this->add_control(
            'video_options',
            [
                'label' => __('Video Options', 'elementor'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'elementor-video-widget'),
                'label_off' => __('No', 'elementor-video-widget'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Offset', 'plugin-domain'),
                'description' => __('When to autoplay the video? Percentage from the top of the page.', 'elementor-video-widget'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __('Loop', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'controls',
            [
                'label' => __('Player Controls', 'elementor'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Hide', 'elementor'),
                'label_on' => __('Show', 'elementor'),
                'default' => 'yes',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'elementor-video-widget'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'maxwidth',
            [
                'label' => __('Max Width', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => ['%', 'px', 'vw'],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __('Height', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $id = $this->get_id();
        // echo "<div>
        //     ID = {$settings['source']['id']}<br>
        //     Source = {$settings['source']['url']}<br>
        //     Autoplay = {$settings['autoplay']}<br>
        //     Offset = {$settings['offset']['size']}{$settings['offset']['unit']}<br>
        //     Loop = {$settings['loop']}<br>
        //     Controls = {$settings['controls']}<br>
        //     Width = {$settings['width']['size']}{$settings['width']['unit']}<br>
        //     Height = {$settings['height']['size']}{$settings['height']['unit']}<br>
        //     MaxWidth = {$settings['maxwidth']['size']}{$settings['maxwidth']['unit']}<br>
        // </div>";

        $this->add_render_attribute(
            'wrapper',
            [
                'id' => "videojs-{$id}",
                'data-offset' => $settings['offset']['size'] . $settings['offset']['unit'],
            ]
        );

        echo wp_sprintf(
            '<div %s>
            <div style="width: %s%s; max-width: %s%s">
            <div class="video-js-responsive-container">
                <video id="video-%s" class="video-js vjs-default-skin" preload="auto" muted data-setup=\'{"fluid": true, "loop": true}\' poster="%s">
                    <source src="%s" type=\'video/mp4\' />
                </video>
            </div>
        </div></div>',
            $this->get_render_attribute_string('wrapper'),
            $settings['width']['size'],
            $settings['width']['unit'],
            $settings['maxwidth']['size'],
            $settings['maxwidth']['unit'],
            $this->get_id(),
            // $settings['height']['size'],
            // $settings['height']['unit'],
            $settings['poster']['url'],
            $settings['source']['url']
        );
    }

    /**
     * Render the widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function _content_template()
    {
?>

        <# if( '' !==settings.source.url ) { #>

            <div style="width: {{settings.width.size}}{{settings.width.unit}}; max-width: {{settings.maxwidth.size}}{{settings.maxwidth.unit}}">
                <div class="video-js-responsive-container">
                    <video id="video-{{view.getID()}}" class="video-js vjs-default-skin" controls preload="auto" muted data-setup=' {"fluid": true}' poster="{{settings.poster.url}}">
                        <source src="{{settings.source.url}}" type='video/mp4' />
                    </video>
                </div>
            </div>

            <# } else { #>
                <div class="insert_video_widget">Insert a video to the widget.</div>
                <# } #>
            <?php
        }
    }
