<?php get_header();
global $g5plus_options;

$layout_style = g5plus_get_post_meta($post->ID, 'g5plus_page_layout', true);
if (($layout_style === '') || ($layout_style == '-1')) {
    $layout_style = $g5plus_options['service_layout'];
}

$sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_sidebar', true);
if (($sidebar === '') || ($sidebar == '-1')) {
    $sidebar = $g5plus_options['service_sidebar'];
}

$left_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_left_sidebar', true);
if (($left_sidebar === '') || ($left_sidebar == '-1')) {
    $left_sidebar = $g5plus_options['service_left_sidebar'];
}

$right_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_right_sidebar', true);
if (($right_sidebar === '') || ($right_sidebar == '-1')) {
    $right_sidebar = $g5plus_options['service_right_sidebar'];
}

$sidebar_width = g5plus_get_post_meta($post->ID, 'g5plus_sidebar_width', true);
if (($sidebar_width === '') || ($sidebar_width == '-1')) {
    $sidebar_width = $g5plus_options['service_sidebar_width'];
}

// Calculate sidebar column & content column
$sidebar_col = 'col-md-3';
if ($sidebar_width == 'large') {
    $sidebar_col = 'col-md-4';
}

$content_col_number = 12;
if (is_active_sidebar($left_sidebar) && (($sidebar == 'both') || ($sidebar == 'left'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
}
if (is_active_sidebar($right_sidebar) && (($sidebar == 'both') || ($sidebar == 'right'))) {
    if ($sidebar_width == 'large') {
        $content_col_number -= 4;
    } else {
        $content_col_number -= 3;
    }
}

$content_col = 'col-md-' . $content_col_number;
if (($content_col_number == 12) && ($layout_style == 'full')) {
    $content_col = '';
}

$main_class = array('single-our-services');
if ($content_col_number < 12) {
    $main_class[] = 'has-sidebar';
}
?>
<?php
/**
 * @hooked - g5plus_page_heading - 5
 **/
do_action('g5plus_before_page');
?>
    <main role="main" class="<?php echo join(' ',$main_class) ?> margin-bottom-40">
        <?php if ($layout_style != 'full'): ?>
        <div class="<?php echo esc_attr($layout_style) ?> clearfix">
            <?php endif;?>
            <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
            <div class="row clearfix">
                <?php endif;?>
                <?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>
                    <div class="sidebar services-left-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                        <?php dynamic_sidebar( $left_sidebar );?>
                    </div>
                <?php endif;?>
                <div class="site-content-archive-inner <?php echo esc_attr($content_col) ?>">
                    <div class="blog-wrap">
                        <div class="blog-inner blog-single clearfix">
                            <?php
                            if ( have_posts() ) :
                                // Start the Loop.
                                while ( have_posts() ) : the_post();?>
                                    <div class="fotorama" data-nav="thumbs" data-width="100%" data-thumbwidth="162" data-thumbheight="140" data-thumbmargin="15">
                                        <?php
                                        $prefix = 'g5plus_';
                                        $thumbnail_url='';
                                        $image_gallery=rwmb_meta($prefix.'services_gallery','type=image_advanced&size=full',get_the_ID());
                                        if($image_gallery)
                                        {
                                            foreach ( $image_gallery as $image ):
                                                if($image){
                                                    $resize = matthewruddy_image_resize($image["full_url"],870,436);
                                                    if($resize!=null )
                                                        $thumbnail_url = $resize["url"];
                                                }
                                                if( $thumbnail_url!='' ) {?>
                                                    <img alt="<?php the_title(); ?>" src="<?php echo esc_url($thumbnail_url); ?>"/>
                                            <?php
                                                }
                                            endforeach;
                                        }
                                        else
                                        {
                                            $post_thumbnail_id = get_post_thumbnail_id();
                                            $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
                                            if(count($arrImages)>0){
                                                $resize = matthewruddy_image_resize($arrImages[0],870,436);
                                                if($resize!=null )
                                                    $thumbnail_url = $resize['url'];
                                            }
                                            if( $thumbnail_url!='' ) {?>
                                                <img alt="<?php the_title(); ?>" src="<?php echo esc_url($thumbnail_url['url'])?>">
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <h4>
                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    </h4>
                                    <?php the_content();?>
                                <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
                <?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>
                    <div class="sidebar services-right-sidebar <?php echo esc_attr($sidebar_col) ?> hidden-sm hidden-xs">
                        <?php dynamic_sidebar( $right_sidebar );?>
                    </div>
                <?php endif;?>
                <?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>
            </div>
        <?php endif;?>
            <?php if ($layout_style != 'full'): ?>
        </div>
    <?php endif;?>
    </main>
<?php get_footer(); ?>