<?php 

// Creating the widget
class pizzahouse_filter_category extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'pizzahouse_filter_category', 
        
        // Widget name will appear in UI
        __('Pizzahouse Product Filter', 'pizzahouse'), 
        
        // Widget description
        array( 'description' => __( 'The main products filter in the Shop page.', 'pizzahouse' ), )
        );
    }
    
    // Creating widget front-end
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $orderby = apply_filters( 'widget_orderby', $instance['orderby'] );
        $count = apply_filters( 'widget_count', $instance['count'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        ?>
        <div class="aside-item col-sm-6 col-lg-12">
            <h6 class="aside-title"><?= $title ?></h6>
            <ul class="list-marked-2">
            <?php
                $taxonomy     = 'product_cat';
                $show_count   = 0;      // 1 for yes, 0 for no
                $pad_counts   = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title_cat    = '';  
                $empty        = 0;
        
                $args = array(
                        'taxonomy'     => $taxonomy,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title_cat,
                        'hide_empty'   => $empty
                );
                $all_categories = get_categories( $args );
                foreach ($all_categories as $cat) {
                    if($cat->category_parent == 0) {
                        $category_id = $cat->term_id;   
                        $category_link = get_category_link( $category_id );

                        $parent_html = '<li class="product-category-child"><a href="'. $category_link .'">'. $cat->name;
                        if( $count === 'on' )
                            $parent_html .= ' ('.$cat->count.')';
                        $parent_html .= '</a></li>';
                        echo $parent_html;   
        
                        $args2 = array(
                                'taxonomy'     => $taxonomy,
                                'child_of'     => 0,
                                'parent'       => $category_id,
                                'orderby'      => $orderby,
                                'show_count'   => $show_count,
                                'pad_counts'   => $pad_counts,
                                'hierarchical' => $hierarchical,
                                'title_li'     => $title,
                                'hide_empty'   => $empty
                        );
                        $sub_cats = get_categories( $args2 );
                        if($sub_cats) {
                            foreach($sub_cats as $sub_category) {
                                $sub_category_link = get_category_link( $sub_category->cat_ID );

                                $child_html = '<li class="product-category-child"><a href="'. $sub_category_link .'">'. $sub_category->name .' ('.$sub_category->count.')</a></li>';
                                if( $count === 'on' )
                                    $child_html .= ' ('.$sub_category->count.')';
                                $child_html .= '</a></li>';
                                echo $child_html;
                            }   
                        }
                    }       
                }
            ?>
            </ul>
            <!-- RD Search Form-->
            <form class="form-search rd-search form-search" action="" method="GET">
                <div class="form-wrap">
                    <label class="form-label" for="search-form">Search..</label>
                    <input class="form-input" id="search-form" type="text" name="s" autocomplete="off">
                    <input type="hidden" name="post_type" value="product">
                    <button class="button-search fl-bigmug-line-search74" type="submit"></button>
                </div>
            </form>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Category', 'pizzahouse' );

        $selected = array(
            'name'      => '',
            'slug'      => '',
            'term_id'   => '',
            'parent'    => '',
        );
        if( isset( $instance[ 'orderby' ] ) )
            $selected[ $instance[ 'orderby' ] ] = 'selected';

        if( isset( $instance['count'] ) )
            $checked = 'checked';
            
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order by:' ); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
                <option <?= $selected['name'] ?> value="name"><?php esc_html_e( 'Name', 'pizzahouse' ); ?></option>
                <option <?= $selected['slug'] ?> value="slug"><?php esc_html_e( 'Slug', 'pizzahouse' ); ?></option>
                <option <?= $selected['term_id'] ?> value="term_id"><?php esc_html_e( 'Id', 'pizzahouse' ); ?></option>
                <option <?= $selected['parent'] ?> value="parent"><?php esc_html_e( 'Parent', 'pizzahouse' ); ?></option>
            </select>
        </p>
        <p>
            <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count'); ?>" <?= $checked ?>>
            <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Show count' ); ?></label>
        </p>
        <?php
    }
    
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
        $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
        return $instance;
    }
    
    // Class wpb_widget ends here
} 

// Creating the widget
class pizzahouse_filter_price extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'pizzahouse_filter_price', 
        
        // Widget name will appear in UI
        __('Pizzahouse Price Filter', 'pizzahouse'), 
        
        // Widget description
        array( 'description' => __( 'The main products filter in the Shop page.', 'pizzahouse' ), )
        );
    }
    
    // Creating widget front-end
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        $products = wc_get_products( array(
            'limit' => -1, 
            'status' => 'publish'
        ));

        foreach( $products as $product ) {
            $prices[] = $product->get_price();
        }

        //Get minimum & maximum value from the price array
        $min_price = min($prices);
        $max_price = max($prices);
        $min_price_range = round( $min_price * 0.9 );
        $max_price_range = round( $max_price * 1.1 );

        $min_price_range_start = ( isset( $_GET['min_price'] ) ) ? $_GET['min_price'] : $min_price;
        $max_price_range_start = ( isset( $_GET['max_price'] ) ) ? $_GET['max_price'] : $max_price;
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        ?>
        <div class="aside-item col-12">
            <h6 class="aside-title"><?= $title ?></h6>
            <!-- RD Range-->
            <div class="rd-range" data-min="<?= $min_price_range ?>" data-max="<?= $max_price_range ?>" data-min-diff="1" data-start="[<?php echo $min_price_range_start . ',' . $max_price_range_start ?>]" data-step="1" data-tooltip="false" data-input=".rd-range-input-value-1" data-input-2=".rd-range-input-value-2"></div>
            <div class="group-md group-justify">
            <div>
                <button id="filter_button" class="button button-xs button-gray-8 button-winona" type="button"><?php _e( 'Filter', 'pizzahouse' ); ?></button>
            </div>
            <div>
                <div class="rd-range-wrap">
                <div class="rd-range-title"><?php _e( 'Price:', 'woocommerce' ); ?></div>
                <div class="rd-range-form-wrap"><span><?php echo get_woocommerce_currency_symbol(); ?></span>
                    <input class="rd-range-input rd-range-input-value-1" id="min_price_value" type="text" name="value-1">
                </div>
                <div class="rd-range-divider"></div>
                <div class="rd-range-form-wrap"><span><?php echo get_woocommerce_currency_symbol(); ?></span>
                    <input class="rd-range-input rd-range-input-value-2" id="max_price_value" type="text" name="value-2">
                </div>
                </div>
            </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Filter by Price', 'pizzahouse' );

        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
    
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
    
    // Class wpb_widget ends here
} 

// Creating the widget
class pizzahouse_popular_products extends WP_Widget {
 
    function __construct() {
        parent::__construct(
        
        // Base ID of your widget
        'pizzahouse_popular_products', 
        
        // Widget name will appear in UI
        __('Pizzahouse Popular Products', 'pizzahouse'), 
        
        // Widget description
        array( 'description' => __( 'The main products filter in the Shop page.', 'pizzahouse' ), )
        );
    }
    
    // Creating widget front-end
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        $args_popular_products = array(
        'post_type' 	=> array( 'product' ),
        'meta_key'  	=> 'total_sales',
        'orderby'   	=> 'meta_value_num',
        'order' 		=> 'desc',
        'posts_per_page'		=> 5
        );

        $popular_products = new WP_Query( $args_popular_products );
        ?>

        <div class="aside-item col-sm-6 col-lg-12 order-lg-2">
            <h6 class="aside-title"><?= $title ?></h6>
            <div class="list-popular-product">
                <?php if ( $popular_products->have_posts() ) :
                    while ( $popular_products->have_posts() ) : $popular_products->the_post();?>
                        <div class="list-popular-product-item">
                            <!-- Product Minimal-->
                            <article class="product-minimal unit unit-spacing-md">
                            <div class="unit-left">
                                <a class="product-minimal-figure" href="<?php the_permalink(); ?>">
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product_id ), 'single-post-thumbnail' );?>
                                    <img src="<?php echo $image[0]; ?>" alt="" width="106" height="104"/>
                                </a>
                            </div>
                            <div class="unit-body">
                                <p class="product-minimal-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                <?php $product = wc_get_product( get_the_ID() ); ?>
                                <p class="product-minimal-price"><?php echo $product->get_price_html(); ?></p>
                            </div>
                            </article>
                        </div>
                    <?php endwhile;
                endif;

                wp_reset_postdata();
                ?>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Popular Products', 'pizzahouse' );

        // Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }
    
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
    
    // Class wpb_widget ends here
} 