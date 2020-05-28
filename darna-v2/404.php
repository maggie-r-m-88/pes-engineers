<?php


remove_action('g5plus_before_page_wrapper_content','g5plus_page_above_header',10);


remove_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);


remove_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);





get_header();


global $g5plus_options;


$page_404_bg = $g5plus_options['page_404_bg_image'];


$page_404_bg_url='';


if(isset($page_404_bg) && array_key_exists('url',$page_404_bg))


    $page_404_bg_url = $page_404_bg['url'];


?>





<div class="page404" style="background-image: url(<?php echo esc_url($page_404_bg_url) ?>)">


    <div class="logo">


        <img alt="Darna Logo" src="<?php echo esc_url($g5plus_options['dark_logo']['url']) ?>" />


    </div>





    <div class="container content-404">





        <span class="title secondary-font"><?php echo __('Error','g5plus-framework') ?></span>


        <h2>404</h2>


        <span class="title not-found secondary-font"><?php echo __('Page not found','g5plus-framework') ?></span>


        <div  class="description"><?php echo wp_kses_post($g5plus_options['subtitle_404']); ?></div>


        <div class="search">


           <?php the_widget('WP_Widget_Search') ?>


        </div>


        <div class="social-share">


            <?php if(isset($g5plus_options['social_sharing_404']) && $g5plus_options['social_sharing_404']['facebook']=='1'){ ?>


                <a href="<?php echo esc_url($g5plus_options['facebook_url'])?>"><i class="fa fa-facebook"></i></a>


            <?php } ?>


            <?php if(isset($g5plus_options['social_sharing_404']) && $g5plus_options['social_sharing_404']['twitter']=='1'){ ?>


                <a href="<?php echo esc_url($g5plus_options['twitter_url'])?>"><i class="fa fa-twitter"></i></a>


            <?php } ?>


            <?php if(isset($g5plus_options['social_sharing_404']) && $g5plus_options['social_sharing_404']['google']=='1'){ ?>


                <a href="<?php echo esc_url($g5plus_options['google_url'])?>"><i class="fa fa-google-plus"></i></a>


            <?php } ?>


            <?php if(isset($g5plus_options['social_sharing_404']) && $g5plus_options['social_sharing_404']['behance']=='1'){ ?>


                <a href="<?php echo esc_url($g5plus_options['behance_url'])?>"><i class="fa fa-behance"></i></a>


            <?php } ?>


            <?php if(isset($g5plus_options['social_sharing_404']) && $g5plus_options['social_sharing_404']['skype']=='1'){ ?>


                <a href="skype:<?php echo esc_attr($g5plus_options['skype_username'])?>?chat"><i class="fa fa-skype"></i></a>


            <?php } ?>


        </div>





    </div>


    <div class="copyright">


        <?php


        global $g5plus_options;


        echo wp_kses_post($g5plus_options['copyright_404']);


        ?>


    </div>





</div>


<?php


remove_action('g5plus_main_wrapper_footer','g5plus_footer_widgets',10);


get_footer();


?>





<script type="text/javascript">


    (function($) {


        "use strict";





        $(document).ready(function(){


            function setFitHeight(){


                var footer_height = $('.footer_bottom_holder').outerHeight();


                var wpadminbar = $('#wpadminbar').outerHeight();


                var windowHeight = $(window).height();


                var contentHeight = windowHeight - wpadminbar;


                if(contentHeight <700)


                    contentHeight = 700;


                var $windowWidth = $(window).width();


                //if($windowWidth>992)


                    $('.page404').css('height',contentHeight);


                //else


                   // $('.page404').css('height','auto');





                $('.page404').css('opacity','1');


            }


            setFitHeight();


            $(window).resize(function () {


                setFitHeight();


            });





        });


    })(jQuery);


</script>





