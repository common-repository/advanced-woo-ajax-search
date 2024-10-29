<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
} // exit if directly access
if ( !class_exists( 'woolive_ajax_search_widget_class' ) ) {
    class woolive_ajax_search_widget_class extends WP_Widget {
        public function __construct() {
            add_action( 'widgets_init', array( &$this, 'woolive_search_widget_func' ) );
            $widget_ops = array();

            parent::__construct( 'wooliveTitleWidget', __( 'Advanced Woo Search Product', 'awas-woo' ), $widget_ops );
        }
        public function form( $instance ) {
            $title = isset( $instance['title'] ) ? $instance['title'] : __( 'Advanced Search Product', 'awas-woo' );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'awas-woo' )?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                    name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo wp_kses_post($title); ?>">
            </p>
           <?php
        }
        public function widget( $args, $instance ) {
            if ( is_single() ) {
                return;
            }

            echo wp_kses_post($args['before_widget']);
            if ( isset( $instance['title'] ) && $instance['title'] != "" ) {
                printf("%s",$args['before_title']);
                printf("%s", apply_filters( 'widget_title', $instance['title'] ));
                printf("%s",$args['after_title']);
                ?>
                <div class="live-ajax-woo-search-widget live-asfw-woo-widget">
                    <div class="live-asfw-woo-search">
                        <input type="text" id="live_ajaxsearch_title_input_id" placeholder="<?php echo esc_attr__( 'search your product' ); ?>">
                        <span id="search_loader"></span>
                    </div>
                    <ul id="live_ajaxsearch_title_sec"></ul>
                </div>
                <?php
            }
            echo wp_kses_post($args['after_widget']);
        }
        public function woolive_search_widget_func() {
            register_widget( 'woolive_ajax_search_widget_class' );
        }
    }

}