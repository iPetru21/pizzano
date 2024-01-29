<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PizzaHouse
 */

 global $redux_config;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>
    <div class="page">
      <!-- Page Header-->
      <header class="section page-header">
        <!-- RD Navbar-->
        <div class="rd-navbar-wrap">
          <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px" data-xl-stick-up-offset="56px" data-xxl-stick-up-offset="56px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
            <div class="rd-navbar-inner-outer">
              <div class="rd-navbar-inner">
                <!-- RD Navbar Panel-->
                <div class="rd-navbar-panel">
                  <!-- RD Navbar Toggle-->
                  <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                  <!-- RD Navbar Brand-->
                    <?php
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

                        <div class="rd-navbar-brand"><a class="brand" href="/"><img class="brand-logo-dark" src="<?= $image[0] ?>" alt="" width="<?= $image[1] ?>" height="<?= $image[2] ?>"/></a></div>
                    <?php ?>
                </div>
                <div class="rd-navbar-right rd-navbar-nav-wrap">
                  <div class="rd-navbar-aside">
                    <ul class="rd-navbar-contacts-2">
                        <?php 
                            if( ! empty( $redux_config['pizzahouse-contact-number'] ) ): 
                                $number = $redux_config['pizzahouse-contact-number']; ?>
                                <li>
                                    <div class="unit unit-spacing-xs">
                                        <div class="unit-left"><span class="icon icon-24 fa fa-solid fa-phone"></span></div>
                                        <div class="unit-body"><a class="phone" href="tel:<?= $number ?>"><?= $number ?></a></div>
                                    </div>
                                </li>
                            <?php endif; 

                            if( ! empty( $redux_config['pizzahouse-address'] ) ): 
                                $address = $redux_config['pizzahouse-address']; ?>
                                <li>
                                    <div class="unit unit-spacing-xs">
                                        <div class="unit-left"><span class="icon icon-24 fa-solid fa-location-dot"></span></div>
                                        <div class="unit-body"><a class="address" href="#"><?= $address ?></a></div>
                                    </div>
                                </li>
                            <?php endif; 
                        ?>
                    </ul>
                    <?php 
                        if( ! empty( $redux_config['pizzahouse-social-profiles'] ) ) : ?>
                            <ul class="list-share-2">
                            <?php
                            $socials = $redux_config['pizzahouse-social-profiles'];
                            foreach( $socials as $social ):
                                if( $social['enabled'] == 1 ): ?>
                                    <li><a class="icon fa <?php echo $social['icon']; ?>" href="<?php echo $social['url']; ?>"></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                  </div>
                  <div class="rd-navbar-main">
                    <!-- RD Navbar Nav-->
                    <?php 
                        wp_nav_menu( array(
                            'theme_location'=> 'header',
                            'menu_class'    => 'rd-navbar-nav',
                            'link_class'    => 'rd-nav-link',
                            'container'     => ''
                        ) ); 
                    ?>
                  </div>
                </div>
                <div class="rd-navbar-project-hamburger rd-navbar-project-hamburger-open rd-navbar-fixed-element-1" data-multitoggle=".rd-navbar-inner" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate">
                  <div class="project-hamburger">
                    <svg class="project-hamburger__icon" fill="#3098b1" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        width="34px" height="24px" viewBox="0 0 902.86 902.86"
                        xml:space="preserve">
                        <g>
                            <g>
                                <path d="M671.504,577.829l110.485-432.609H902.86v-68H729.174L703.128,179.2L0,178.697l74.753,399.129h596.751V577.829z
                                    M685.766,247.188l-67.077,262.64H131.199L81.928,246.756L685.766,247.188z"/>
                                <path d="M578.418,825.641c59.961,0,108.743-48.783,108.743-108.744s-48.782-108.742-108.743-108.742H168.717
                                    c-59.961,0-108.744,48.781-108.744,108.742s48.782,108.744,108.744,108.744c59.962,0,108.743-48.783,108.743-108.744
                                    c0-14.4-2.821-28.152-7.927-40.742h208.069c-5.107,12.59-7.928,26.342-7.928,40.742
                                    C469.675,776.858,518.457,825.641,578.418,825.641z M209.46,716.897c0,22.467-18.277,40.744-40.743,40.744
                                    c-22.466,0-40.744-18.277-40.744-40.744c0-22.465,18.277-40.742,40.744-40.742C191.183,676.155,209.46,694.432,209.46,716.897z
                                    M619.162,716.897c0,22.467-18.277,40.744-40.743,40.744s-40.743-18.277-40.743-40.744c0-22.465,18.277-40.742,40.743-40.742
                                    S619.162,694.432,619.162,716.897z"/>
                            </g>
                        </g>
                    </svg>
                    <span id="header-cart-totals" class="project-hamburger__counter"><?php echo WC()->cart->get_cart_contents_count() ?></span>
                </div>
                </div>
                <div class="rd-navbar-project">
                  <div class="rd-navbar-project-header">
                    <h5 class="rd-navbar-project-title"><?php _e( 'Cart', 'pizzahouse' ); ?></h5>
                    <div class="rd-navbar-project-hamburger rd-navbar-project-hamburger-close" data-multitoggle=".rd-navbar-inner" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate">
                      <div class="project-close"><span></span><span></span></div>
                    </div>
                  </div>
                  <div class="rd-navbar-project-content rd-navbar-content">
                    <div>
                        <div id="navbar-minicart" class="rd-navbar-cart cart_list widget_shopping_cart_content">
                            <?php 
                              woocommerce_mini_cart(); 
                            ?>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>