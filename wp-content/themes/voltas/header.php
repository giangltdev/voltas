<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voltas
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory')?>/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/strok_gap_icon.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/settings.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/preset.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/responsive.css" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Lấy về logo được custom -->

<?php
	// lấy logo về
	$logo = get_theme_mod('custom_logo');
	
	// lấy về đường dẫn lấy về logo
	$logo_part = wp_get_attachment_image_src( $logo, 'full' );
?>


<div id="page" class="site">
	<!-- <div class="preloader">
        <div class="la-ball-scale-multiple la-2x">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div> -->
    <section class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-5">
                    <div class="topMenusHolder">
                        <ul class="topMenus clearfix poppins">
                            <li><a href="#"><i class="frontIcon icon-Exit"></i>Register</a></li>
                            <li><a href="#" data-toggle="collapse" data-target="#accountTogg">My Account <i
                                        class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu collapse" id="accountTogg">
                                    <li><a href="#">My wishlis</a></li>
                                    <li><a href="#">My cart</a></li>
                                    <li><a href="#">sing in</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="frontIcon icon-ShoppingCart"></i><?php echo do_shortcode("[woo_cart_but]"); ?></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-2">
                    <div class="logo text-center">
                        <a href="index-2.html"><img src="<?php echo $logo_part[0] ?>" alt="Volta" /></a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-5">
                    <div class="topLanguangeSearch clearfix">
                        <form action="<?php echo get_home_url(); ?>/" method="get">
                            <input type="text" name="s" id="s" placeholder="Search" />
                        </form>
                       <!--  <div class="langMenu">
                            <a href="#" data-toggle="collapse" data-target="#langTogg">EN <i
                                    class="fa fa-angle-down"></i></a>
                            <ul class="sub-menu collapse" id="langTogg">
                                <li><a href="#">BANGLA</a></li>
                                <li><a href="#">CHINA</a></li>
                                <li><a href="#">ENGlISH</a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <header class="header" id="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="mainMenu poppins">
                        <div class="logofixedHeader text-center">
                            <a href="index-2.html"><img alt="Volta" src="<?php echo $logo_part[0] ?>"></a>
                        </div>
                        <div class="mobileMenu">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        
                        <!-- thêm menu -->
                        <?php wp_nav_menu(); ?>
                  
                    </nav>
                </div>
            </div>
        </div>
    </header>
