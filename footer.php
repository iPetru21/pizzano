<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PizzaHouse
 */

global $redux_config;
?>

<footer class="section footer-modern context-dark footer-modern-2">
    <div class="footer-modern-line">
        <div class="container">
        <div class="row row-50">
            <div class="col-md-6 col-lg-4">
            <?php if( ! empty($redux_config['pizzahouse-footer-menu-headings'][0] ) ): ?>
                <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft"><?= $redux_config['pizzahouse-footer-menu-headings'][0] ?></span></h5>
            <?php endif; ?>
            <?php 
                wp_nav_menu( array(
                    'theme_location'=> 'footer-primary',
                    'menu_class'    => 'footer-modern-list d-inline-block d-sm-block wow fadeInUp',
                    'container'   => ''
                ) );
            ?>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-3">
            <?php if( ! empty($redux_config['pizzahouse-footer-menu-headings'][1] ) ): ?>
                <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft"><?= $redux_config['pizzahouse-footer-menu-headings'][1] ?></span></h5>
            <?php endif; ?>
            <?php
                wp_nav_menu( array(
                    'theme_location'=> 'footer-secondary',
                    'menu_class'    => 'footer-modern-list d-inline-block d-sm-block wow fadeInUp',
                    'container'   => ''
                ) );
            ?>
            </div>
            <div class="col-lg-4 col-xl-5">
            <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">Newsletter</span></h5>
            <p class="wow fadeInRight">Sign up today for the latest news and updates.</p>
            <!-- RD Mailform-->
            <form class="rd-form rd-mailform rd-form-inline rd-form-inline-sm oh-desktop" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                <div class="form-wrap wow slideInUp">
                <input class="form-input" id="subscribe-form-2-email" type="email" name="email" data-constraints="@Email @Required"/>
                <label class="form-label" for="subscribe-form-2-email">Enter your E-mail</label>
                </div>
                <div class="form-button form-button-2 wow slideInRight">
                <button class="button button-sm button-icon-3 button-primary button-winona" type="submit"><span class="d-none d-xl-inline-block">Subscribe</span><span class="icon mdi mdi-telegram d-xl-none"></span></button>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    <div class="footer-modern-line-2">
        <div class="container">
        <div class="row row-30 align-items-center">
            <div class="col-sm-6 col-md-7 col-lg-4 col-xl-4">
            <div class="row row-30 align-items-center text-lg-center">
            <?php 
                if( ! empty( $redux_config['pizzahouse-footer-logo'] ) ):
                    $footer_logo = $redux_config['pizzahouse-footer-logo']; ?>
                    <div class="col-md-7 col-xl-6"><a class="brand" href="index.html"><img src="<?= $footer_logo['url'] ?>" alt="" width="<?= $footer_logo['width'] ?>" height="<?= $footer_logo['height'] ?>"/></a></div>
                <?php endif;
            ?>

                <div class="col-md-5 col-xl-6">
                    <div class="iso-1">
                        <?php if( ! empty( $redux_config['pizzahouse-likes-image'] ) ): 
                            $image = $redux_config['pizzahouse-likes-image']; ?>
                            <span>
                                <img src="<?= $image['url'] ?>" alt="" width="<?= $image['width'] ?>" height="<?= $image['height'] ?>"/>
                            </span>
                            <span class="iso-1-big">
                                <?php if( ! empty( $redux_config['pizzahouse-likes-text'] ) ):
                                        echo $redux_config['pizzahouse-likes-text']; 
                                    endif;
                                ?>
                            </span>
                            <?php endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-12 col-lg-8 col-xl-8 oh-desktop">
            <div class="group-xmd group-sm-justify">
                <?php 
                    if( ! empty( $redux_config['pizzahouse-contact-number'] ) ): 
                        $number = $redux_config['pizzahouse-contact-number']; ?>
                        <div class="footer-modern-contacts wow slideInUp">
                            <div class="unit unit-spacing-sm align-items-center">
                                <div class="unit-left"><span class="icon icon-24 fa fa-solid fa-phone"></span></div>
                                <div class="unit-body"><a class="phone" href="tel:<?= $number ?>"><?= $number ?></a></div>
                            </div>
                        </div>
                    <?php endif; 

                    if( ! empty( $redux_config['pizzahouse-email'] ) ): 
                        $mail = $redux_config['pizzahouse-email']; ?>

                        <div class="footer-modern-contacts wow slideInDown">
                            <div class="unit unit-spacing-sm align-items-center">
                                <div class="unit-left"><span class="icon icon-24 fa-solid fa-envelope"></span></div>
                                <div class="unit-body"><a class="mail" href="mailto:<?= $mail ?>"><?= $mail ?></a></div>
                            </div>
                        </div>
                    <?php endif; 

                    if( ! empty( $redux_config['pizzahouse-social-profiles'] ) ) : ?>
                        <div class="wow slideInRight">
                            <ul class="list-inline footer-social-list footer-social-list-2 footer-social-list-3">
                            <?php
                            $socials = $redux_config['pizzahouse-social-profiles'];
                            foreach( $socials as $social ):
                                if( $social['enabled'] == 1 ): ?>
                                    <li><a class="icon fa <?php echo $social['icon']; ?>" href="<?php echo $social['url']; ?>"></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; 
                ?>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="footer-modern-line-3">
        <div class="container">
            <div class="row row-10 justify-content-between">
                <?php if( ! empty( $redux_config['pizzahouse-address'] ) ): 
                    $address = $redux_config['pizzahouse-address']; ?>
                    <div class="col-md-6"><span><?= $address ?></span></div>
                <?php endif; ?>
                <div class="col-md-auto">
                <!-- Rights-->
                <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span></span><span>.&nbsp;</span><span><?php if( $redux_config['pizzahouse-footer-copyrigth'] ): echo($redux_config['pizzahouse-footer-copyrigth']); endif; ?></a></span></p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<?php wp_footer(); ?>

</body>
</html>
