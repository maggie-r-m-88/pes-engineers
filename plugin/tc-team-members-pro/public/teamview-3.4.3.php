<?php
/**
 * Handle Team shortcode.
 *
 * @param  array $attr Array of shortcode attributes.
 * @return string $output HTML
 */
 /* Convert hexdec color string to rgb(a) string */

 function themescode_hex2rgba($color, $opacity = false) {

 	$default = 'rgb(0,0,0)';

 	//Return default if no color provided
 	if(empty($color))
           return $default;
 	//Sanitize $color if "#" is provided
         if ($color[0] == '#' ) {
         	$color = substr( $color, 1 );
         }

         //Check if color has 6 or 3 characters and get values
         if (strlen($color) == 6) {
                 $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
         } elseif ( strlen( $color ) == 3 ) {
                 $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
         } else {
                 return $default;
         }

         //Convert hexadec to rgb
         $rgb =  array_map('hexdec', $hex);

         //Check if opacity is set(rgba or rgb)
         if($opacity){
         	if(abs($opacity) > 1)
         		$opacity = 1.0;
         	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
         } else {
         	$output = 'rgb('.implode(",",$rgb).')';
         }

         //Return rgb(a) color string
         return $output;
 }

function maintainn_team_shortcode( $attr = array() ) {

  $teamid=$attr['teamid'];
  $post = get_post();

// Get team members attached to this page.
$members = get_post_meta($teamid , '_tcode_teammeta', true );
// dynamic style
$bg_color= get_post_meta($teamid , '_tcode_bgcolor', '#000' );
$bg_trrate= get_post_meta($teamid , '_tcode_transparency-rate',0.6);

if($bg_trrate==3){
  $bg_trrate=0.3;
}elseif($bg_trrate==4) {
  $bg_trrate=0.4;
}elseif($bg_trrate==5) {
  $bg_trrate=0.5;
}elseif($bg_trrate==6) {
  $bg_trrate=0.6;
}elseif($bg_trrate==7) {
  $bg_trrate=0.7;
}elseif($bg_trrate==8) {
  $bg_trrate=0.8;
}elseif($bg_trrate==9) {
  $bg_trrate=0.9;
}else{
  $bg_trrate=1;
}
$rgba_bg_color= themescode_hex2rgba($bg_color,$bg_trrate);

$bcolor=get_post_meta($teamid , '_tcode_bordercolor', '#60646D' );
 if(!empty($bcolor)){
   $border='border: 1px solid '.$bcolor.';';
 }else{
    $border='';
 }
$text_color= get_post_meta($teamid , '_tcode_textcolor', '#60646D' );
$text_alignment=get_post_meta($teamid , '_tcode_textalignment', true );
$hidesocialicon=get_post_meta($teamid , '_tcode_hidesocialicon', true );
$social_icon_style=get_post_meta($teamid , '_tcode_sicon', 'fill');
//die($bg_color);
$layout=get_post_meta($teamid , '_tcode_layout', 1);
$hover=get_post_meta($teamid , '_tcode_imghover', 'tczoomin' );

$hide_iam=get_post_meta($teamid , '_tcode_hide-iam', 'off' );

$tc_column=get_post_meta($teamid , '_tcode_memberscolumn', 'tc_member-col4' );
$dscharnum=get_post_meta($teamid , '_tcode_dschrnum',110);
if(empty($dscharnum)){
  $dscharnum=80;
}
if(empty($tc_column)){
$tc_column='tc_member-col4';
}

$tchover_icon=get_post_meta($teamid , '_tcode_tchovericon', 'fa-info' );
if(empty($tchover_icon)){
$tchover_icon='fa-info-circle';
}
?>

<style media="screen">

h3.tc-team-title-lg{
color:<?php echo $text_color= get_post_meta($teamid , '_tcode_name-textcolor', '#282830' )?>!important;
line-height: 18px;
font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_namefs', '18' )?>px!important;
}
h3.tc-team-title-lg:hover{
  color:<?php echo $text_color= get_post_meta($teamid , '_tcode_name-textcolor-hover', '#60646D' ); ?>!important;
}

h4.tc-team-title-sm{
color:<?php echo $text_color= get_post_meta($teamid , '_tcode_role-textcolor', '#282830' ); ?>!important;
line-height:20px;
font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_rfs', '16' )?>px!important;
}
h4.tc-team-title-sm:hover{
  color:<?php echo $text_color= get_post_meta($teamid , '_tcode_role-textcolor-hover', '#60646D' ); ?>!important;
}
p.tc-meam-p{
  color:<?php echo $text_color= get_post_meta($teamid , '_tcode_textcolor', '#282830' ); ?>!important;
  font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_dfs', '14' )?>px!important;
  padding:0 10px;
}
p.tc-meam-p:hover{color:<?php echo $text_color= get_post_meta($teamid , '_tcode_textcolor-hover', '#60646D' ); ?>!important;}

/* overlay */
.tc_overlay h3.tc-team-title-lg{
  color:<?php echo $text_color= get_post_meta($teamid , '_tcode_oname-textcolor', '#ffffff' ); ?>!important;
}
.tc_overlay h3.tc-team-title-lg:hover{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_oname-textcolor-hover', '#d7d7d7' ); ?> !important;
}
.tc_overlay h4.tc-team-title-sm{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_orole-textcolor', '#ffffff' ); ?> !important;
}
.tc_overlay h4.tc-team-title-sm:hover{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_orole-textcolor-hover', '#d7d7d7' ); ?>!important;
}
.tc_overlay span.tc-pu{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_viewlink-color', '#ffffff' ); ?> !important;
  font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_ifs', '28' )?>px!important;
}
.tc_overlay span.tc-pu:hover{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_viewlink-hcolor', '#d7d7d7' ); ?>!important;
}
span.tc-pu{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_viewlink-color', '#ffffff' ); ?> !important;
  font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_ifs', '28' )?>px!important;
}
span.tc-pu:hover{
  color: <?php echo $text_color= get_post_meta($teamid , '_tcode_viewlink-hcolor', '#d7d7d7' ); ?>!important;
}
/* End overlay */

.tc_teambox{
    background-color:<?php echo $bg_color= get_post_meta($teamid , '_tcode_bgcolor', '#282830' ); ?>!important;
    -webkit-transition: background-color 0.3s ease-in-out;
 -moz-transition: background-color 0.3s ease-in-out;
 -o-transition: background-color 0.3s ease-in-out;
 transition: background-color 0.3s ease-in-out;
 margin-bottom:20px;
}
.tc_teambox:hover{
    background-color:<?php echo $bg_hover_color= get_post_meta($teamid , '_tcode_bg-hover-color', '#60646D' ); ?>!important;
}
.overlay-six .mask, .overlay-five .mask{
  background-color:<?php echo $rgba_bg_color; ?>!important;
}

h1.tc-pu-team-title-lg{
  font-size:<?php echo $pnamefs= get_post_meta($teamid , '_tcode_pnamefs', '18' )?>px!important;
  color: <?php echo $pnamecolor= get_post_meta($teamid , '_tcode_pnamec', '#d7d7d7' ); ?>!important;
}
h1.tc-pu-team-title-lg:hover{
  color: <?php echo $pnamecolor= get_post_meta($teamid , '_tcode_pnamehc', '#E76B6B' ); ?>!important;
}

h2.tc-pu-team-title-sm{
  font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_prolefs', '16' )?>px!important;
  color: <?php echo $pnamecolor= get_post_meta($teamid , '_tcode_prolec', '#d7d7d7' ); ?>!important;
}
h2.tc-pu-team-title-sm:hover{
  color: <?php echo $pnamecolor= get_post_meta($teamid , '_tcode_prolehc', '#E76B6B' ); ?>!important;
}

p.tc-pu-meam-p{
font-size:<?php echo $text_color= get_post_meta($teamid , '_tcode_pdescriptionfs', '14' )?>px!important;
color: <?php echo $pdscolor= get_post_meta($teamid , '_tcode_pdsc', '#d7d7d7' ); ?>!important;
line-height: 24px;
}
p.tc-pu-meam-p:hover{
color: <?php echo $pdscolor= get_post_meta($teamid , '_tcode_pdshc', '#E76B6B' ); ?>!important;

}
.tc_member-col3,.tc_member-col4,.tc_member-col5,.tc_team-members3,.tc_team-member5-box,.tc_team-member6-box{
  height:<?php echo  $tc_mcolumnbox=get_post_meta($teamid , '_tcode_mcolumnheight',390); ?>px;
}
</style>

<?php
$output = '';
// Return empty string, if we don't have members.
if ( empty( $members ) ) {
return $output;
}

if ($layout==1) {
  $output .= '<div class="tc_team-members clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-member1 '.$tc_column.' tc_text-center">';
        $output .= '<div class="tc_member-thumb1 tc_pu_box">';
         if(!empty($member['member_image'])){
         $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /> </a>';
          }
          $output .= '<div class="tc_overlay" style="background-color:'.$rgba_bg_color.';color:'.$text_color.';">';


           $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3></a>';
           if(!empty($member['job_role'])){
            $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';

            }
             if(!empty($member['description'])){

             $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in">
             <span class=" tc-meam-p tc-pu"><i class="fa '.$tchover_icon.'"></i></span>  </a>';

            }
            if (! $hidesocialicon) {
            $output .= '<ul class="tc_social-links">';

                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }

            $output .= '</ul>';
            }
        $output .= '</div>';
      $output .= '</div>';
    $output .= '<h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
    if(isset($member['job_role'])){
    $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
      }

  ?>
 <!-- start pop up -->

  <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim tcpopup">

          <div class="tc_pu_left_block">


          <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

 <?php
   if (! $hidesocialicon) {
     $qv_output='';
  $qv_output .='<div class="social-box-3">';
 $qv_output .= '<ul class="tc_social-links">';


                   if(!empty($member['smurl-one'])){

                     if($member['sm-one']=='envelope'){

                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                     }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                  }

                   }
                     if(!empty($member['smurl-two'])){

                       if($member['sm-two']=='envelope'){
                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                       }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                      }

                   }
                     if(!empty($member['smurl-third'])){

                       if($member['sm-third']=='envelope'){

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                       }else{

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                       }
                   }
                 if(!empty($member['smurl-fourth'])){

                   if($member['sm-fourth']=='envelope'){

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                   }else{

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                   }

                 }
 $qv_output .= '</ul>';
 $qv_output .= '</div>';
 echo $qv_output;

 }
 ?>
    </div>  <!-- tc_qv_left_block  -->
    <div class="tc_pu_right_block">


        <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
        <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
        <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


 </div>  <!-- tc_qv_left_block  -->
    </div>
 <!-- End POp up -->
  <?php
  $output .= '</div>';

}
  $output .= '</div>';
}
// Start Layout
if ($layout==2) {
  $output .='<div class="tc_wrap  clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
  $members_loop ++;
    $output .= '<div class="tc_team-members2-box tc_teambox">';
        $output .= '<div class="tc_team-member2  '.$tc_column.'  tc_text-center">';

            $output .= '<div class="tc_member-thumb2-img tc_pu_box">';
              $output .= '<div class="tc_member-thumb2-box '.$hover.'">';
               if(!empty($member['member_image'])){
                $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /> </a>';
               }
               $output .= '</div>'; // end tc_member-thumb2-box div
            $output .= '</div>';  // end tc_member-thumb2-img div

          $output .='<div class="text-block" style="text-align:'.$text_alignment.'">';
           if(!empty($member['full_name'])){
            $output .= '<h3  class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
            }
             if(!empty($member['job_role'])){
              $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
             }
               if(!empty($member['description'])){
              $output .= '<p  class="tc-meam-p">'. substr($member['description'],0,$dscharnum) .'</p>';
               }
              if (! $hidesocialicon) {
          $output .= '<ul class="tc_social-links">';

                  if(!empty($member['smurl-one'])){

                    if($member['sm-one']=='envelope'){

                      $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                    }else{
                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                 }

                  }
                    if(!empty($member['smurl-two'])){

                      if($member['sm-two']=='envelope'){
                        $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                      }else{
                  $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                     }

                  }
                    if(!empty($member['smurl-third'])){

                      if($member['sm-third']=='envelope'){

                        $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                      }else{

                        $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                      }
                  }
                if(!empty($member['smurl-fourth'])){

                  if($member['sm-fourth']=='envelope'){

                    $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                  }else{

                    $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                  }

                }
      $output .= '</ul>';
              }
      $output .= '</div>';  // End text-block
    $output .= '</div>'; // single tc_team-member2
 ?>
<!-- start pop up -->

 <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

         <div class="tc_pu_left_block">


         <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

<?php
  if (! $hidesocialicon) {
    $qv_output='';
 $qv_output .='<div class="social-box-3">';
$qv_output .= '<ul class="tc_social-links">';


                  if(!empty($member['smurl-one'])){

                    if($member['sm-one']=='envelope'){

                      $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                    }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                 }

                  }
                    if(!empty($member['smurl-two'])){

                      if($member['sm-two']=='envelope'){
                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                      }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                     }

                  }
                    if(!empty($member['smurl-third'])){

                      if($member['sm-third']=='envelope'){

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                      }else{

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                      }
                  }
                if(!empty($member['smurl-fourth'])){

                  if($member['sm-fourth']=='envelope'){

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                  }else{

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                  }

                }
$qv_output .= '</ul>';
$qv_output .= '</div>';
echo $qv_output;

}
?>
   </div>  <!-- tc_qv_left_block  -->
   <div class="tc_pu_right_block">


       <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
       <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
       <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


</div>  <!-- tc_qv_left_block  -->
   </div>
<!-- End POp up -->
 <?php

    $output .= '</div>'; // End tc_team-members2-box

 }

  $output .= '</div>'; // wrap
}
if ($layout==3) {
  $output .='<div class="tc_wrap  clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-members3 tc_teambox">';
       $output .= '<div class="tc_member-thumb3-img">';
             $output .= '<div class="tc_member-thumb3 tc_pu_box '.$hover.'">';
             if(!empty($member['member_image'])){
              $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"> <img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /></a>';
              }
          $output .= '</div>'; //tc_member-thumb3
        $output .= '</div>'; //tc_member-thumb3-img

          $output .='<div class="text-box-3">';
              $output .= '<h3  class="tc-team-title3-lg">'. esc_attr( $member['full_name'] ).'</h3>';
              if(!empty($member['job_role'])){
               $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
              }
                if(!empty($member['description'])){
               $output .= '<p  class="tc-meam-p">'. substr($member['description'],0,$dscharnum) .'</p>';
                }
         $output .= '</div>'; // text-box-3

              if (! $hidesocialicon) {
             $output .='<div class="social-box-3">';
            $output .= '<ul class="tc_social-links">';


                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }
         $output .= '</ul>';
     $output .= '</div>';
      }
      ?>
     <!-- start pop up -->

      <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

              <div class="tc_pu_left_block">


              <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

     <?php
       if (! $hidesocialicon) {
         $qv_output='';
      $qv_output .='<div class="social-box-3">';
     $qv_output .= '<ul class="tc_social-links">';


                       if(!empty($member['smurl-one'])){

                         if($member['sm-one']=='envelope'){

                           $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                         }else{
                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                      }

                       }
                         if(!empty($member['smurl-two'])){

                           if($member['sm-two']=='envelope'){
                             $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                           }else{
                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                          }

                       }
                         if(!empty($member['smurl-third'])){

                           if($member['sm-third']=='envelope'){

                             $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                           }else{

                             $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                           }
                       }
                     if(!empty($member['smurl-fourth'])){

                       if($member['sm-fourth']=='envelope'){

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                       }else{

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                       }

                     }
     $qv_output .= '</ul>';
     $qv_output .= '</div>';
     echo $qv_output;

     }
     ?>
        </div>  <!-- tc_qv_left_block  -->
        <div class="tc_pu_right_block">


            <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
            <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
            <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


     </div>  <!-- tc_qv_left_block  -->
        </div>
     <!-- End POp up -->
      <?php

     $output .= '</div>'; // text-box-3

  }

  $output .= '</div>'; // wrap
}
if ($layout==4) {
$output .='<div class="tc_wrap  clearfix">';
 $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-members4 tc_teambox">';

         $output .= '<div class="tc_member-thumb4-img tc_pu_box">';
            $output .= '<div class="tc_member-thumb4 '.$hover.'">';
            if(!empty($member['member_image'])){
              $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"> <img class="tc-member-4" src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /></a>';
             }
           $output .= '</div>'; //tc_member-thumb4
         $output .= '</div>'; //tc_member-thumb4-img

          $output .='<div class="text-box-4">';
           $output .= '<h3  class="tc-team-title4-lg">'. esc_attr( $member['full_name'] ).'</h3>';

            if(!empty($member['job_role'])){
             $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
            }
              if(!empty($member['description'])){

             $output .= '<p  class="tc-meam-p">'. substr($member['description'],0,$dscharnum) .'</p>';
              }

              if (! $hidesocialicon) {
           $output .= '<ul class="tc_social-links">';

                             if(!empty($member['smurl-one'])){

                               if($member['sm-one']=='envelope'){

                                 $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                               }else{
                             $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                            }

                             }
                               if(!empty($member['smurl-two'])){

                                 if($member['sm-two']=='envelope'){
                                   $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                 }else{
                             $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                }

                             }
                               if(!empty($member['smurl-third'])){

                                 if($member['sm-third']=='envelope'){

                                   $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                 }else{

                                   $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                 }
                             }
                           if(!empty($member['smurl-fourth'])){

                             if($member['sm-fourth']=='envelope'){

                               $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                             }else{

                               $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                             }

                         }
        $output .= '</ul>';
     }
    $output .= '</div>'; // text-box-4

    ?>
<!-- start pop up -->

 <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

         <div class="tc_pu_left_block">


         <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

<?php
  if (! $hidesocialicon) {
    $qv_output='';
 $qv_output .='<div class="social-box-3">';
$qv_output .= '<ul class="tc_social-links">';


                  if(!empty($member['smurl-one'])){

                    if($member['sm-one']=='envelope'){

                      $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                    }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                 }

                  }
                    if(!empty($member['smurl-two'])){

                      if($member['sm-two']=='envelope'){
                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                      }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                     }

                  }
                    if(!empty($member['smurl-third'])){

                      if($member['sm-third']=='envelope'){

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                      }else{

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                      }
                  }
                if(!empty($member['smurl-fourth'])){

                  if($member['sm-fourth']=='envelope'){

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                  }else{

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                  }

                }
$qv_output .= '</ul>';
$qv_output .= '</div>';
echo $qv_output;

}
?>
   </div>  <!-- tc_qv_left_block  -->
   <div class="tc_pu_right_block">


       <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
       <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
       <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


</div>  <!-- tc_qv_left_block  -->
   </div>
<!-- End POp up -->
 <?php

    $output .= '</div>'; // tc_team-members4
  }

  $output .= '</div>'; // wrap
}
if ($layout==5) {
  $output .= '<div class="tc_team-members clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-member5-box  tc_pu_box">';

      $output .= '<div class="tc_team-member5  overlay-five '.$hover.'">';
        if(!empty($member['member_image'])){
         $output .= '<img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" />';
        }
         $output .= '<div class="mask">';

             if(!empty($member['job_role'])){
              $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
             }
               if(!empty($member['description'])){
              $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in">
              <span class=" tc-meam-p tc-pu"><i class="fa '.$tchover_icon.'" aria-hidden="true"></i></span></a>';

               }


            if (! $hidesocialicon) {
            $output .= '<ul class="tc_social-links">';


                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }

            $output .= '</ul>';
            }
        $output .= '</div>'; // end mask

      $output .= '</div>'; // tc_team-member5
      $output .= '<div class="team5_title">';

      $output .= '<h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
      if(isset($member['job_role'])){
      $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
      $output .= '</div>';


      $output .= '</div>';

      }

      ?>
 <!-- start pop up -->

  <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

          <div class="tc_pu_left_block">


          <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

 <?php
   if (! $hidesocialicon) {
     $qv_output='';
  $qv_output .='<div class="social-box-3">';
 $qv_output .= '<ul class="tc_social-links">';


                   if(!empty($member['smurl-one'])){

                     if($member['sm-one']=='envelope'){

                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                     }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                  }

                   }
                     if(!empty($member['smurl-two'])){

                       if($member['sm-two']=='envelope'){
                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                       }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                      }

                   }
                     if(!empty($member['smurl-third'])){

                       if($member['sm-third']=='envelope'){

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                       }else{

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                       }
                   }
                 if(!empty($member['smurl-fourth'])){

                   if($member['sm-fourth']=='envelope'){

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                   }else{

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                   }

                 }
 $qv_output .= '</ul>';
 $qv_output .= '</div>';
 echo $qv_output;

 }
 ?>
    </div>  <!-- tc_qv_left_block  -->
    <div class="tc_pu_right_block">


        <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
        <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
        <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


 </div>  <!-- tc_qv_left_block  -->
    </div>
 <!-- End POp up -->
  <?php

  }

  $output .= '</div>'; //  tc_team-members
}
if ($layout==6) {
  $output .= '<div class="tc_team-members clearfix">';
$members_loop=rand(5, 500);
  foreach ( $members as $member ) {
     $members_loop ++;
    $output .= '<div class="tc_team-member6-box tc_pu_box">';
   // $output .= '<div class="tc_team-member6 '.$tc_column.'  overlay-six '.$hover.'">';
    $output .= '<div class="tc_team-member6   overlay-six '.$hover.'">';
       if(!empty($member['member_image'])){
         $output .= '<img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" />';
        }
         $output .= '<div class="mask">';

           if(!empty($member['job_role'])){
            $output .= '<h2 class="tc-team-title-sm6">'.esc_attr( $member['job_role'] ).'</h2>';

            }
             if(!empty($member['description'])){

              // $output .= '<p class="tc-meam-p">'. $member['description'] .'</p>'; removed in version 1.9
              $output .= '<div class="tc-pu-box"> <a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in">
              <span class=" tc-meam-p tc-pu"><i class="fa '.$tchover_icon.'" aria-hidden="true"></i></span></a></div>';
            }
            if (! $hidesocialicon) {
            $output .= '<ul class="tc_social-links">';


                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }

            $output .= '</ul>';
            }
        $output .= '</div>'; // end mask

      $output .= '</div>'; // tc_team-member6
      $output .= '<div class="team6_title">';

      $output .= '<h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
      if(!empty($member['job_role'])){
      $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
       }
      $output .= '</div>';

      ?>
 <!-- start pop up -->

  <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

          <div class="tc_pu_left_block">


          <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

 <?php
   if (! $hidesocialicon) {
     $qv_output='';
  $qv_output .='<div class="social-box-3">';
 $qv_output .= '<ul class="tc_social-links">';


                   if(!empty($member['smurl-one'])){

                     if($member['sm-one']=='envelope'){

                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                     }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                  }

                   }
                     if(!empty($member['smurl-two'])){

                       if($member['sm-two']=='envelope'){
                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                       }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                      }

                   }
                     if(!empty($member['smurl-third'])){

                       if($member['sm-third']=='envelope'){

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                       }else{

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                       }
                   }
                 if(!empty($member['smurl-fourth'])){

                   if($member['sm-fourth']=='envelope'){

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                   }else{

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                   }

                 }
 $qv_output .= '</ul>';
 $qv_output .= '</div>';
 echo $qv_output;

 }
 ?>
    </div>  <!-- tc_qv_left_block  -->
    <div class="tc_pu_right_block">


        <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
        <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
        <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


 </div>  <!-- tc_qv_left_block  -->
    </div>
 <!-- End POp up -->
  <?php
      $output .= '</div>';



  }

  $output .= '</div>'; //  tc_team-members
}

if ($layout==7) {
  $output .='<div class="tc_wrap  clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-members7 tc_teambox">';
    $output .= '<div class="tc_team-member7 '.$tc_column.'  tc_text-center">';

        $output .= '<div class="tc_member-thumb7-img tc_pu_box">';
            $output .= '<div class="tc_member-thumb7 '.$hover.'">';
            if(!empty($member['member_image'])){
              $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"> <img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /></a>';
            }
            $output .= '</div>'; //tc_member-thumb7
        $output .= '</div>'; //tc_member-thumb7-img

          $output .='<div class="text-block" style="text-align:'.$text_alignment.'">';
           $output .= '<h3  class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
            if(!empty($member['job_role'])){
            $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
            }
             if(!empty($member['description'])){
            $output .= '<p  class="tc-meam-p">'. substr($member['description'],0,$dscharnum) .'</p>';
            }
            if (! $hidesocialicon) {
            $output .= '<ul class="tc_social-links">';

                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }
         $output .= '</ul>';
       }
      $output .= '</div>';
      ?>
<!-- start pop up -->

 <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

         <div class="tc_pu_left_block">


         <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

<?php
  if (! $hidesocialicon) {
    $qv_output='';
 $qv_output .='<div class="social-box-3">';
$qv_output .= '<ul class="tc_social-links">';


                  if(!empty($member['smurl-one'])){

                    if($member['sm-one']=='envelope'){

                      $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                    }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                 }

                  }
                    if(!empty($member['smurl-two'])){

                      if($member['sm-two']=='envelope'){
                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                      }else{
                  $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                     }

                  }
                    if(!empty($member['smurl-third'])){

                      if($member['sm-third']=='envelope'){

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                      }else{

                        $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                      }
                  }
                if(!empty($member['smurl-fourth'])){

                  if($member['sm-fourth']=='envelope'){

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                  }else{

                    $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                  }

                }
$qv_output .= '</ul>';
$qv_output .= '</div>';
echo $qv_output;

}
?>
   </div>  <!-- tc_qv_left_block  -->
   <div class="tc_pu_right_block">


       <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
       <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
       <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


</div>  <!-- tc_qv_left_block  -->
   </div>
<!-- End POp up -->
 <?php
    $output .= '</div>'; // single tc_team-member7

    $output .= '</div>'; // tc_team-members7
  }

  $output .= '</div>'; // wrap
}
// Start Layout 8
if ($layout==8) {
  $output .= '<div class="tc_team-members clearfix">';
  $members_loop=rand(5, 500);
  foreach ( $members as $member ) {
    $members_loop ++;
    $output .= '<div class="tc_team-member1 '.$tc_column.' tc_text-center">';
        $output .= '<div class="tc_member-thumb1 tc_pu_box">';
         if(!empty($member['member_image'])){
         $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in">
              <img src="' . esc_attr( $member['member_image'] ) . '" alt="' . esc_attr( $member['full_name'] ) . '" /> </a>';
          }
          $output .= '<div class="tc_overlay" style="background-color:'.$rgba_bg_color.';color:'.$text_color.';">';


           // $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3></a>';
           if(!empty($member['job_role'])){
            //$output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';

            }
             if(!empty($member['description'])){

             //$output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><span class=" tc-meam-p tc-pu"><i class="fa fa-plus" aria-hidden="true"></i></span></a>';

              // $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in"><h3 class="tc-team-title-lg"><p class="tc-meam-p">'.substr($member['description'],0,$dscharnum).'</p></a>';
            //$output .= substr($member['description'],0,140);
            $output .= '<p  class="tc-meam-p">'. substr($member['description'],0,120) .'</p>';
            $output .= '<a class="tc_pu_views open-popup-link" href="#tc_pu_view_'.$members_loop.'" data-effect="mfp-zoom-in">
            <span class=" tc-meam-p tc-pu"><i class="fa '.$tchover_icon.'" aria-hidden="true"></i></span></a>';
            }
            if (! $hidesocialicon) {
            $output .= '<ul class="tc_social-links">';

                              if(!empty($member['smurl-one'])){

                                if($member['sm-one']=='envelope'){

                                  $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                                }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                             }

                              }
                                if(!empty($member['smurl-two'])){

                                  if($member['sm-two']=='envelope'){
                                    $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                                  }else{
                              $output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                                 }

                              }
                                if(!empty($member['smurl-third'])){

                                  if($member['sm-third']=='envelope'){

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                                  }else{

                                    $output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                                  }
                              }
                            if(!empty($member['smurl-fourth'])){

                              if($member['sm-fourth']=='envelope'){

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                              }else{

                                $output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                              }

                            }

            $output .= '</ul>';
            }
        $output .= '</div>';
      $output .= '</div>';
    $output .= '<h3 class="tc-team-title-lg">'. esc_attr( $member['full_name'] ).'</h3>';
    if(isset($member['job_role'])){
    $output .= '<h4 class="tc-team-title-sm">'.esc_attr( $member['job_role'] ).'</h4>';
      }

  ?>
 <!-- start pop up -->

  <div id="tc_pu_view_<?php echo $members_loop; ?>" class="white-popup mfp-hide mfp-with-anim">

          <div class="tc_pu_left_block">


          <img class="tc-pu-team-img" src=" <?php echo  $member['member_image']?> " />

 <?php
   if (! $hidesocialicon) {
     $qv_output='';
  $qv_output .='<div class="social-box-3">';
 $qv_output .= '<ul class="tc_social-links">';


                   if(!empty($member['smurl-one'])){

                     if($member['sm-one']=='envelope'){

                       $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-one'] ).'"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                     }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-one'] ).' '.$social_icon_style.'" href="'. esc_attr( $member['smurl-one'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-one'] ).' fa-lg "></i></a></li>';

                  }

                   }
                     if(!empty($member['smurl-two'])){

                       if($member['sm-two']=='envelope'){
                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-two'] ).'"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg "></i></a></li>';

                       }else{
                   $qv_output .= '<li><a class="'. esc_attr( $member['sm-two'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-two'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-two'] ).' fa-lg"></i></a></li>';
                      }

                   }
                     if(!empty($member['smurl-third'])){

                       if($member['sm-third']=='envelope'){

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-third'] ).'"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg "></i></a></li>';
                       }else{

                         $qv_output .= '<li><a class="'. esc_attr( $member['sm-third'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-third'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-third'] ).' fa-lg"></i></a></li>';
                       }
                   }
                 if(!empty($member['smurl-fourth'])){

                   if($member['sm-fourth']=='envelope'){

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' '.$social_icon_style.'" href="mailto:'. esc_attr( $member['smurl-fourth'] ).'"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg "></i></a></li>';
                   }else{

                     $qv_output .= '<li><a class="'. esc_attr( $member['sm-fourth'] ).' ' .$social_icon_style.'" href="' . esc_attr( $member['smurl-fourth'] ).'" target="_blank"><i class="fa fa-'. esc_attr( $member['sm-fourth'] ).' fa-lg"></i></a></li>';
                   }

                 }
 $qv_output .= '</ul>';
 $qv_output .= '</div>';
 echo $qv_output;

 }
 ?>
    </div>  <!-- tc_qv_left_block  -->
    <div class="tc_pu_right_block">


        <h1  class="tc-pu-team-title-lg"> <?php if($hide_iam !='on'){ echo 'I am'; }   ?>  <?php  echo $member['full_name']; ?> </h1>
        <h2 class="tc-pu-team-title-sm"><?php  echo $member['job_role']; ?> </h2>
        <p  class="tc-pu-meam-p"> <?php  echo $member['description']; ?>  </p>


 </div>  <!-- tc_qv_left_block  -->
    </div>
 <!-- End POp up -->
  <?php
  $output .= '</div>';

}
  $output .= '</div>';
}

return $output;
}
add_shortcode( 'tc-team-members', 'maintainn_team_shortcode' );
