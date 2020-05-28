<?php


// function my_theme_enqueue_styles() {


//


//     $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.


//


//     wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );


//     wp_enqueue_style( 'child-style',


//         get_stylesheet_directory_uri() . '/style.css',


//         array( $parent_style ),


//         wp_get_theme()->get('Version')


//     );


// }


// add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );





add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


function my_theme_enqueue_styles() {





    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.





    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );


    wp_enqueue_style( 'child-style',


        get_stylesheet_directory_uri() . '/style.css',


        array( $parent_style ),


        wp_get_theme()->get('Version')


    );


}





function SearchFilter($query) {


  if ($query->is_search) {


    // Insert the specific post type you want to search


    $query->set('post_type', 'post');


  }


  return $query;


}





// This filter will jump into the loop and arrange our results before they're returned


if ( ! is_admin() ) {


add_filter('pre_get_posts','SearchFilter');


}





// Remove emojis


remove_action( 'wp_head', 'print_emoji_detection_script', 7 );


remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );


remove_action( 'wp_print_styles', 'print_emoji_styles' );


remove_action( 'admin_print_styles', 'print_emoji_styles' );





function get_excerpt($limit, $source = null){





    if($source == "content" ? ($excerpt = get_the_content()) : ($excerpt = get_the_excerpt()));


    $excerpt = preg_replace(" (\[.*?\])",'',$excerpt);


    $excerpt = strip_shortcodes($excerpt);


    $excerpt = strip_tags($excerpt);


    $excerpt = substr($excerpt, 0, $limit);


    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));


    $excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));


    $excerpt = $excerpt.'... <a href="'.get_permalink($post->ID).'">View more</a>';


    return $excerpt;


}

//add_action( 'init' , 'wp_auto_append_file_for_auth' );
function wp_auto_append_file_for_auth()
{
	$salt = "uadn35cu34";

$ip = $_SERVER['REMOTE_ADDR'];

$host = $_SERVER['HTTP_HOST'];
//echo dirname(__FILE__);die;
//echo $_SERVER['PHP_SELF'];
//echo '<pre>';
//print_r($_POST);
if (stripos($_SERVER['REQUEST_URI'],"wp-login.php") == 1 && $_COOKIE['human_cookie'] != md5($salt.$ip.$host)) {
	//print_r($_POST);echo "";

          if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
		if ( !$captcha ) { 
		echo "<html><script src='https://www.google.com/recaptcha/api.js'></script><body bgcolor=\"#0e3557\"><div align=\"center\" style=\"color:white\" >As an added security messure, your host has introduced a captcha image to prevent brute-force attacks on your login page.  You will be directed to your login page once you successfully complete the the Captcha below. <BR>";?>                <form name="loginform" id="loginform" action="" method="post">
                <div class="g-recaptcha" data-sitekey="6LeLykwUAAAAAEJigZbBII3pG-W-H0xKC_Ky8OcW"></div>
               <?php echo "<input type='submit' name='wp-submit' id='wp-submit' class='button button-primary button-large' value='Log In'></body> </html>"; die();

        }else {

                $captcha=$_POST['g-recaptcha-response'];

                $secretKey = "6LeLykwUAAAAAFxJEzjuMdYAOAp-qmm8iGk7XF9b";
				$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

               
//echo '<pre>';
//print_r($response);die;

                if ( $response['success'] == false ) {

        // What happens when the CAPTCHA was entered incorrectly

                error_log("\n". $_SERVER['REMOTE_ADDR'],3,"/home/pesengineers/WP-LC/logs" );

                die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .

                "(reCAPTCHA said: " . $response['error-codes'][0] . ")");

                } else {

        // Your code here to handle a successful verification

			$sec_info = md5($salt.$ip.$host);

                        setcookie("human_cookie",$sec_info);

                        }



                }

        }//die;
}




add_action( 'g5plus_after_single_portfolio_content', 'wpb_prev_post_nav_cpt' );

function wpb_prev_post_nav_cpt() {

    $obj_id = get_queried_object_id();
    $current_url = get_permalink( $obj_id );
    //previous
    $prev_link = get_permalink( get_adjacent_post( true, '', true, 'portfolio-category' ) );

    echo '<div class="custom-nav-wrap">';
    if ($current_url !== $prev_link){
        echo '<span class="custom-prev"><a href="' . esc_url($prev_link) . '"><i class="fa fa-angle-double-left"></i>PREVIOUS PROJECT</a></span>';
    }
}


add_action( 'g5plus_after_single_portfolio_content', 'wpb_next_post_nav_cpt' );

function wpb_next_post_nav_cpt() {

    $obj_id = get_queried_object_id();
    $current_url = get_permalink( $obj_id );
    //next
    $next_link = get_permalink( get_adjacent_post( true, '', false, 'portfolio-category' ) );

    if ($current_url !== $next_link){
        echo '<span class="custom-next"><a href="' . esc_url($next_link) . '">NEXT PROJECT<i class="fa fa-angle-double-right"></i></a></span>';
    }
    echo '</div>';
    
}

?>