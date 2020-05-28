<?php get_header(); ?>

<?php

global $g5plus_options;



$layout_style = g5plus_get_post_meta($post->ID, 'g5plus_page_layout', true);

if (($layout_style === '') || ($layout_style == '-1')) {

	$layout_style = $g5plus_options['page_layout'];

}



$sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_sidebar', true);

if (($sidebar === '') || ($sidebar == '-1')) {

	$sidebar = $g5plus_options['page_sidebar'];

}



$left_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_left_sidebar', true);

if (($left_sidebar === '') || ($left_sidebar == '-1')) {

	$left_sidebar = $g5plus_options['page_left_sidebar'];



}



$right_sidebar = g5plus_get_post_meta($post->ID, 'g5plus_page_right_sidebar', true);

if (($right_sidebar === '') || ($right_sidebar == '-1')) {

	$right_sidebar = $g5plus_options['page_right_sidebar'];

}



$sidebar_width = g5plus_get_post_meta($post->ID, 'g5plus_sidebar_width', true);

if (($sidebar_width === '') || ($sidebar_width == '-1')) {

	$sidebar_width = $g5plus_options['page_sidebar_width'];

}



$page_comment = $g5plus_options['page_comment'];



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



$main_class = array('site-content-page');



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

<main role="main" class="<?php echo join(' ',$main_class) ?>">

	<?php if ($layout_style != 'full'): ?>

	<div class="<?php echo esc_attr($layout_style) ?> clearfix">

		<?php endif;?>

		<?php if (($content_col_number != 12) || ($layout_style != 'full')): ?>

		<div class="row clearfix">

			<?php endif;?>

			<?php if (is_active_sidebar( $left_sidebar ) && (($sidebar == 'left') || ($sidebar == 'both'))): ?>

				<div class="sidebar left-sidebar <?php echo esc_attr($sidebar_col) ?>">

					<?php dynamic_sidebar( $left_sidebar );?>

				</div>

			<?php endif;?>

			<div class="site-content-page-inner <?php echo esc_attr($content_col) ?>">

				<div class="page-content">

          <?php

          // Start the Loop.

          while (have_posts()) : the_post();

              // Include the page content template.

              g5plus_get_template('content', 'page');

          endwhile;

          wp_reset_postdata(); // Reset post_data after each loop

          ?>

            <div class="vc_grid">

            <?php

            global $query_string; //Need this to make pagination work



            $query1 = new WP_Query( array('posts_per_page'=>9, 'category_name'=>'News') );



            if( $query1->have_posts()) :  while( $query1->have_posts()) : $query1->the_post();

            ?>

                <div class="darna-post vc_grid-item vc_clearfix vc_col-sm-4 vc_visible-item fadeIn animated" style="margin-bottom:20px;">

									<div class="darna-post-image">

										<div class="entry-thumbnail">

											<a class="entry-thumbnail_overlay" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">

												<div class="vc_gitem-zone" style="background-image: url('<?php the_post_thumbnail_url('large') ?>') !important; height: 200px; z-index:-10">

												</div>

											</a>

										</div>

									</div>

									<div class="darna-post-content">

	                  <a class="darna-post-title" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>

										<i class="fa fa-calendar"><span><?php the_time('F j, Y') ?></span></i>

										<i class="fa fa-user"><span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></span></i>

										<p><?php echo get_excerpt(140); ?></p>

									</div>

                </div>

            <?php

            endwhile;

            //Pagination can go here if you want it.

            endif;

            wp_reset_postdata(); // Reset post_data after each loop

            ?>

          </div><!-- End VC Grid -->

				</div><!-- End Page Content -->

                <?php if ($page_comment == 1) {

                    comments_template();

                } ?>

			</div>

			<?php if (is_active_sidebar( $right_sidebar ) && (($sidebar == 'right') || ($sidebar == 'both'))): ?>

				<div class="sidebar right-sidebar <?php echo esc_attr($sidebar_col) ?>">

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

