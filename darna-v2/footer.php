			<?php


			/**


			 **/


			do_action('g5plus_main_wrapper_content_end');


			?>





			</div>


			<!-- Close Wrapper Content -->





            <?php


                global $g5plus_options;


                $main_footer_class = array('main-footer-wrapper');


                if(isset($g5plus_options['footer_parallax']) && $g5plus_options['footer_parallax']=='1') {


	                $main_footer_class[] = 'enable-parallax';


                }





	            if($g5plus_options['collapse_footer']=='1') {


		            $main_footer_class[] = 'footer-collapse-able';


	            }








	            // SHOW HEADER


                $prefix = 'g5plus_';


	            $footer_show_hide = rwmb_meta($prefix . 'footer_show_hide');


	            if (($footer_show_hide === '')) {


		            $footer_show_hide = '1';


	            }











            ?>


			<?php if ($footer_show_hide == '1'): ?>


	            <footer class="<?php echo join(' ', $main_footer_class) ?>">


	                <div id="wrapper-footer">


	                    <?php


	                    /**


	                     * @hooked - g5plus_footer_widgets - 10


	                     * @hooked - g5plus_footer_copyright - 20


	                     **/


	                    do_action('g5plus_main_wrapper_footer');


	                    ?>


	                </div>


	            </footer>


			<?php endif;?>


		</div>


		<!-- Close Wrapper -->





		<?php


		/**


		 * @hooked - g5plus_back_to_top - 5


		 **/


		do_action('g5plus_after_page_wrapper');


		?>


	<?php wp_footer(); ?>


</body>


</html> <!-- end of site. what a ride! -->