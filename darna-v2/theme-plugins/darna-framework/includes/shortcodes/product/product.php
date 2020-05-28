<?php


/**


 * Created by PhpStorm.


 * User: Administrator


 * Date: 6/15/2015


 * Time: 9:44 AM


 */


if ( ! defined( 'ABSPATH' ) ) die( '-1' );





if (!class_exists('g5plusFramework_Shortcode_Product')) {


    class g5plusFramework_Shortcode_Product {


        function __construct() {


            add_shortcode('darna_product', array($this, 'product_shortcode' ));


        }





        function  product_shortcode($atts) {


            $title =  $source = $filter = $category = $per_page = $columns = $slider = $orderby = $order = $el_class = $css_animation = $duration = $delay =  '';





            extract(shortcode_atts(array(


                'title' => '',


                'source' => 'feature',


                'filter' => 'sale',


                'category' => '',


                'per_page' => '12',


                'columns' => '4',


                'slider'  => '',


                'orderby' => 'date',


                'order' => 'asc',


                'el_class'      => '',


                'css_animation' => '',


                'duration'      => '',


                'delay'         => ''


            ), $atts));





            $meta_query = WC()->query->get_meta_query();


            $args = array();





            if( $source == 'feature'){


                switch($filter) {


                    case 'sale':


                        $product_ids_on_sale = wc_get_product_ids_on_sale();


                        $args = array(


                            'posts_per_page'	=> $per_page,


                            'orderby' 			=> $orderby,


                            'order' 			=> $order,


                            'no_found_rows' 	=> 1,


                            'post_status' 		=> 'publish',


                            'post_type' 		=> 'product',


                            'meta_query' 		=> $meta_query,


                            'post__in'			=> array_merge( array( 0 ), $product_ids_on_sale )


                        );


                        break;


                    case 'new-in':


                        $args = array(


                            'posts_per_page'	=> $per_page,


                            'orderby' 			=> $orderby,


                            'order' 			=> $order,


                            'no_found_rows' 	=> 1,


                            'post_status' 		=> 'publish',


                            'post_type' 		=> 'product',


                            'meta_query' 		=> $meta_query


                        );


                        break;


                    case 'featured':


                        $meta_query[] = array(


                            'key'   => '_featured',


                            'value' => 'yes'


                        );


                        $args = array(


                            'posts_per_page'	=> $per_page,


                            'orderby' 			=> $orderby,


                            'order' 			=> $order,


                            'no_found_rows' 	=> 1,


                            'post_status' 		=> 'publish',


                            'post_type' 		=> 'product',


                            'meta_query' 		=> $meta_query


                        );


                        break;


                    case 'top-rated':


                        $args = array(


                            'posts_per_page'	=> $per_page,


                            'orderby' 			=> $orderby,


                            'order' 			=> $order,


                            'no_found_rows' 	=> 1,


                            'post_status' 		=> 'publish',


                            'post_type' 		=> 'product',


                            'meta_query' 		=> $meta_query


                        );


                        add_filter( 'posts_clauses', array($this, 'order_by_rating_post_clauses' ) );


                        break;


                    case 'recent-review':


                        $args = array(


                            'no_found_rows' 	=> 1,


                            'posts_per_page'	=> $per_page,


                            'post_status' 		=> 'publish',


                            'post_type' 		=> 'product'


                        );


                        add_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' ) );


                        break;


                    case 'best-selling' :


                        $args = array(


                            'post_type'           => 'product',


                            'post_status'         => 'publish',


                            'ignore_sticky_posts' => 1,


                            'posts_per_page'      => $per_page,


                            'meta_key'            => 'total_sales',


                            'orderby'             => 'meta_value_num',


                            'meta_query'          => $meta_query


                        );


                }


            } else {


                $args = array(


                    'post_type'				=> 'product',


                    'post_status' 			=> 'publish',


                    'ignore_sticky_posts'	=> 1,


                    'orderby' 				=> $orderby,


                    'order' 				=> $order,


                    'posts_per_page' 		=> $per_page,


                    'meta_query' 			=> $meta_query,


                    'tax_query' 			=> array(


                        array(


                            'taxonomy' 		=> 'product_cat',


                            'terms' 		=>  explode(',',$category),


                            'field' 		=> 'slug',


                            'operator' 		=> 'IN'


                        )


                    )


                );


            }





            $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );


            if($filter =='top-rated'){


                remove_filter( 'posts_clauses', array($this, 'order_by_rating_post_clauses' ) );


            }





            if($filter =='recent-review' ){


                remove_filter( 'posts_clauses', array($this, 'order_by_comment_date_post_clauses' )  );


            }





            $class[]= 'woocommerce shortcode-product-wrap';


            $class[] = $el_class;


            $class[] = g5plusFramework_Shortcodes::g5plus_get_css_animation($css_animation);





            $class_name = join(' ',$class);





            global  $g5plus_woocommerce_loop;


            $g5plus_woocommerce_loop['columns'] = $columns;


            $g5plus_woocommerce_loop['layout'] = $slider;


            ob_start();


            ?>


            <?php if ($products->have_posts()) : ?>


                <div class="<?php echo esc_attr($class_name) ?>" <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay); ?>>


                    <?php if (!empty($title)) : ?>


                        <h4 class="widget-title"><span><?php echo esc_html($title);?></span></h4>


                    <?php endif; ?>


                    <?php woocommerce_product_loop_start(); ?>


                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>


                        <?php wc_get_template_part( 'content', 'product' ); ?>


                    <?php endwhile; // end of the loop. ?>


                    <?php woocommerce_product_loop_end(); ?>


                </div>


            <?php else: ?>


                <div class="item-not-found"><?php echo __('No item found','g5plus-framework') ?></div>


            <?php endif; ?>





            <?php


            wp_reset_postdata();


            $content =  ob_get_clean();


            return $content;








        }





        function  order_by_rating_post_clauses($args) {


            global $wpdb;





            $args['where'] .= " AND $wpdb->commentmeta.meta_key = 'rating' ";





            $args['join'] .= "


                LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)


                LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)


            ";





            $args['orderby'] = "$wpdb->commentmeta.meta_value DESC";





            $args['groupby'] = "$wpdb->posts.ID";





            return $args;


        }





        function order_by_comment_date_post_clauses($args){


            global $wpdb;





            $args['join'] .= "


                LEFT JOIN (


                    SELECT comment_post_ID, MAX(comment_date)  as  comment_date


                    FROM $wpdb->comments


                    WHERE comment_approved = 1


                    GROUP BY comment_post_ID


                ) as wp_comments ON($wpdb->posts.ID = wp_comments.comment_post_ID)


            ";


            $args['orderby'] = "wp_comments.comment_date DESC";


            return $args;


        }








    }


    new g5plusFramework_Shortcode_Product();


}