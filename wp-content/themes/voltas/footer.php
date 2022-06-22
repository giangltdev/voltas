<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voltas
 */
?>
<!-- li#custom_html-4 {
    list-style-type: none;
} -->

	<footer class="footer" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-4 col-xs-12 noPaddingRight">
                    <aside class="widget">
                        
                            <?php dynamic_sidebar('widget_1'); ?>
                       
                    </aside>
                </div>
                <div class="clearfix hidden-lg hidden-md hidden-sm"></div>
                <div class="col-lg-6 col-sm-5 col-xs-12">
                    <aside class="widget">
                        <div class="footerLogo text-center">
                            <a href="index-2.html"><img src="images/footerLogo.png" alt="" /></a>
                        </div>
                        <?php dynamic_sidebar('widget_2'); ?>

                        <?php dynamic_sidebar('widget_3'); ?>
                        
                        <?php dynamic_sidebar('widget_5'); ?>

                    </aside>
                </div>
                <div class="col-lg-3 col-sm-3 col-xs-12">
                    <aside class="widget">
                        <?php dynamic_sidebar('widget_4'); ?>
                    </aside>
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/mixer.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.appear.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/theme.js"></script>

</body>
</html>
