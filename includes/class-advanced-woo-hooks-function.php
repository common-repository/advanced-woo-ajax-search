<?php
if (!class_exists('woocommerce')) {
    return false;
}

class Advanced_Woo_Hooks_Function
{

    public function __construct()
    {
    }

    public function advanced_add_custom_css_callback()
    {
        $basic_option = get_option('awas_woo_inf_basics');
        $adv_option   = get_option('awas_woo_inf_color');

        if (isset($basic_option)) {

            $awas_woo_title_text_size = (isset($basic_option['awas_woo_title_text_size'])) ? $basic_option['awas_woo_title_text_size'] : '';
            $awas_inner_text_size = (isset($basic_option['awas_inner_text_size'])) ? $basic_option['awas_inner_text_size'] : '';
            $awas_search_field_padding = (isset($basic_option['awas_search_field_padding'])) ? $basic_option['awas_search_field_padding'] : '';
        }

        if (isset($adv_option)) {

            $awas_heading_title_col = (isset($adv_option['title_color'])) ? $adv_option['title_color'] : '';

            $awas_title_opt_bg = (isset($adv_option['awas_title_opt_bg'])) ? $adv_option['awas_title_opt_bg'] : '';
            $search_pro_title_color = (isset($adv_option['search_pro_title_color'])) ? $adv_option['search_pro_title_color'] : '';

            $awas_title_hover_opt_bg = (isset($adv_option['awas_title_hover_opt_bg'])) ? $adv_option['awas_title_hover_opt_bg'] : '';
            $search_pro_hover_title_color = (isset($adv_option['search_pro_hover_title_color'])) ? $adv_option['search_pro_hover_title_color'] : '';
        }


        $custom_style = '';

        if ($awas_woo_title_text_size != "" || $awas_heading_title_col != "") {
            $custom_style .= ".widget .widget-title {
                font-size: $awas_woo_title_text_size!important;
                color: $awas_heading_title_col!important;
            }";
        }

        if ($awas_search_field_padding != "") {
            $custom_style .= ".live-asfw-woo-search input[type='text'],#live-asfw-woo-sku-search input[type='text'] {
                padding: $awas_search_field_padding!important;
            }";
        }

        if ($awas_title_opt_bg != "" || $search_pro_title_color != "") {
            $custom_style .= "#live_ajaxsearch_title_sec li {
                background: $awas_title_opt_bg!important;
                color: $search_pro_title_color!important;
            }";
        }

        if ($awas_title_hover_opt_bg != "" || $search_pro_hover_title_color != "") {
            $custom_style .= "#live_ajaxsearch_title_sec li:hover {
                background: $awas_title_hover_opt_bg!important;
                color: $search_pro_hover_title_color!important;
            }";
        }

        if ($awas_inner_text_size != "") {

            $custom_style .= ".widget .live-ajax-search-woo-filter-widget {
                font-size: $awas_inner_text_size!important;
            }";
            $custom_style .= ".widget .live-ajax-search-woo-filter-widget input[type='text'],input[type='search'],.widget-area .widget .live-ajax-search-woo-filter-widget ul li a{
                font-size: $awas_inner_text_size!important;
            }";
        }

        wp_register_style('live_asfw_custom_css_button', false);
        wp_enqueue_style('live_asfw_custom_css_button');
        wp_add_inline_style('live_asfw_custom_css_button', $custom_style);
    }
}
