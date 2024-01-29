<?php
/**
 * Template Name: About Page
 */

get_header();
pizzahouse_breadcrumb();
global $redux_config;
?>

    <section class="section section-lg bg-default">
    <div class="container">
        <div class="tabs-custom row row-50 justify-content-center flex-lg-row-reverse text-center text-md-left" id="tabs-4">
            <?php
                $tabs = $redux_config['pizzahouse_about-us__tabs'];
                $title = $redux_config['pizzahouse_about-us__title'];
                $button = array(
                    'href'  => $redux_config['pizzahouse_about-us__button-link'],
                    'text'  => $redux_config['pizzahouse_about-us__button-text'],
                );
            ?>
            <div class="col-lg-4 col-xl-3">
                <h5 class="text-spacing-200 text-capitalize"><?php esc_html_e( $title, 'pizzahouse' ); ?></h5>
                <ul class="nav list-category list-category-down-md-inline-block">
                <?php 
                    $i = 0;
                    foreach( $tabs['tabs_title'] as $title ): 
                        if( $i === 0 ): ?>
                            <li class="list-category-item wow fadeInRight" role="presentation" data-wow-delay="0s"><a class="active" href="#<?php echo( esc_attr( 'about-tabs', 'pizzahouse' ) . '_' . $i ); ?>" data-toggle="tab"><?php esc_html_e( $title, 'pizzahouse' ); ?></a></li>
                        <?php else: ?>
                            <li class="list-category-item wow fadeInRight" role="presentation" data-wow-delay=".<?= $i ?>s"><a href="#<?php echo( esc_attr( 'about-tabs', 'pizzahouse' ) . '_' . $i ); ?>" data-toggle="tab"><?php esc_html_e( $title, 'pizzahouse' ); ?></a></li>
                <?php 
                        endif;
                        $i++;
                    endforeach; 
                ?>
                </ul>
                <a class="button button-xl button-primary button-winona" href="<?php esc_attr_e( $button['href']); ?>"><?php esc_html_e( $button['text'], 'pizzahouse' ); ?></a>
            </div>
            <div class="col-lg-8 col-xl-9">
                <!-- Tab panes-->
                <div class="tab-content tab-content-1">
                <?php 
                    unset( $button, $title, $i );
                    $i = 0;

                    $items      = $tabs['redux_repeater_data'];
                    $titles     = $tabs['title'];
                    $desc       = $tabs['description'];
                    $images     = $tabs['image'];

                    foreach( $items as $item ): 
                        if( $i === 0): ?>
                            <div class="tab-pane fade show active" id="<?php echo( esc_attr( 'about-tabs', 'pizzahouse' ) . '_' . $i ); ?>">
                                <h4><?php esc_html_e( $titles[$i], 'pizzahouse' ); ?></h4>
                                <?php _e( $desc[$i], 'pizzahouse' ); ?>
                                <img src="<?php echo( esc_attr( $images[$i]['url']) ); ?>" alt="" width="<?= $images[$i]['width'] ?>" height="<?= $images[$i]['height'] ?>"/>
                            </div>
                        <?php else: ?>
                            <div class="tab-pane fade" id="<?php echo( esc_attr( 'about-tabs', 'pizzahouse' ) . '_' . $i ); ?>">
                                <h4><?php esc_html_e( $titles[$i], 'pizzahouse' ); ?></h4>
                                <?php _e( $desc[$i], 'pizzahouse' ); ?>
                                <img src="<?php echo( esc_attr( $images[$i]['url']) ); ?>" alt="" width="<?= $images[$i]['width'] ?>" height="<?= $images[$i]['height'] ?>"/>
                            </div>
                        <?php 
                        endif;
                    $i++;
                    endforeach; 
                    unset( $i, $items, $titles, $desc, $images );
                ?>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Icon Classic-->
    <section class="section section-lg bg-gray-100">
    <div class="container">
        <div class="row row-md row-50">
            <?php
                $i = 0;
                $icons_list = $redux_config['pizzahouse_about-us__icons'];
                $items      = $icons_list['redux_repeater_data'];
                $titles     = $icons_list['title'];
                $desc       = $icons_list['description'];
                $icons      = $icons_list['icon'];
                $url        = $icons_list['url'];

                foreach( $items as $item ) :
            ?>
            <div class="col-sm-6 col-xl-4 wow fadeInUp" data-wow-delay="<?php echo ( $i === 0 ) ? '0s' : '.'.$i.'s'; ?>">
                <article class="box-icon-classic">
                <div class="unit unit-spacing-lg flex-column text-center flex-md-row text-md-left">
                    <div class="unit-left">
                        <div class="box-icon-classic-icon <?php echo esc_attr( $icons[$i] ); ?>"></div>
                    </div>
                    <div class="unit-body">
                        <h5 class="box-icon-classic-title"><a href="<?php esc_attr_e($url[$i]) ?>"><?php esc_html_e( $titles[$i], 'pizzahouse' ); ?></a></h5>
                        <p class="box-icon-classic-text"><?php esc_html_e( $desc[$i], 'pizzahouse' ); ?></p>
                    </div>
                </div>
                </article>
            </div>

            <?php
                $i++;
                endforeach;
                unset( $i, $icons_list, $items, $titles, $desc, $icons );
            ?>
        </div>
    </div>
    </section>
    <!-- Our Team-->
    <section class="section section-lg section-bottom-md-70 bg-default">
    <div class="container">
        <?php
            $i = 0;
            $title  = $redux_config['pizzahouse_about-us__team-title'];
            $team   = $redux_config['pizzahouse_about-us__team'];
            $items  = $team['redux_repeater_data'];
            $names  = $team['name'];
            $roles  = $team['role'];
            $images = $team['image'];
            $facebook    = $team['facebook'];
            $instagram   = $team['instagram'];
            $google      = $team['google'];
            $twitter     = $team['twitter'];
        ?>
        <h3 class="oh"><span class="d-inline-block wow slideInUp" data-wow-delay="0s"><?php esc_html_e( $title, 'pizzahouse' ); ?></span></h3>
        <div class="row row-lg row-40 justify-content-center">
            <?php foreach( $items as $item ): ?>
                <div class="col-sm-6 col-lg-3 wow fadeInLeft" data-wow-delay=".2s" data-wow-duration="1s">
                    <!-- Team Modern-->
                    <article class="team-modern">
                    <a class="team-modern-figure" href="#"><img src="<?php esc_attr_e( $images[$i]['url'] ); ?>" alt="" width="<?php esc_attr_e( $images[$i]['width'] ); ?>" height="<?php esc_attr_e( $images[$i]['height'] ); ?>"/></a>
                    <div class="team-modern-caption">
                        <h6 class="team-modern-name"><a href="#"><?php esc_html_e( $names[$i], 'pizzahouse'); ?></a></h6>
                        <div class="team-modern-status"><?php esc_html_e( $roles[$i], 'pizzahouse'); ?></div>
                        <ul class="list-inline team-modern-social-list">
                            <?php if( $facebook[$i] != '#' ): ?>
                                <li><a class="icon mdi mdi-facebook" href="<?php esc_attr_e( $facebook[$i] ); ?>"></a></li>
                            <?php endif; ?>
                            <?php if( $instagram[$i] != '#' ): ?>
                                <li><a class="icon mdi mdi-instagram" href="<?php esc_attr_e( $instagram[$i] ); ?>"></a></li>
                            <?php endif; ?>
                            <?php if( $google[$i] != '#' ): ?>
                                <li><a class="icon mdi mdi-google" href="<?php esc_attr_e( $google[$i] ); ?>"></a></li>
                            <?php endif; ?>
                            <?php if( $twitter[$i] != '#' ): ?>
                                <li><a class="icon mdi mdi-twitter" href="<?php esc_attr_e( $twitter[$i] ); ?>"></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    </article>
                </div>
            <?php $i++; endforeach; ?>
        </div>
    </div>
    </section>
    <section class="section section-lg bg-gray-100 text-left section-relative">
    <div class="container">
        <?php 
            $i  = 0;
            $title      = $redux_config['pizzahouse_about-us__history-title'];
            $image      = $redux_config['pizzahouse_about-us__history-image'];
            $video      = $redux_config['pizzahouse_about-us__history-video'];
            $history    = $redux_config['pizzahouse_about-us__history'];
            $items      = $history['redux_repeater_data'];
            $titles     = $history['title'];
            $descs      = $history['description'];
            $years      = $history['year'];
        ?>
        <div class="row row-60 justify-content-center justify-content-xxl-between">
            <div class="col-lg-6 col-xxl-5 position-static">
                <h3><?php esc_html_e( $title ); ?></h3>
                <div class="tabs-custom" id="tabs-5">
                <div class="tab-content tab-content-1">
                    <?php foreach( $items as $item ): ?>
                        <div class="tab-pane <?= ( $i == 0 ) ? 'active show' : '' ?> fade" id="tabs-5-<?= $i ?>">
                            <h5 class="font-weight-normal text-transform-none text-spacing-75"><?php esc_html_e( $titles[$i] ); ?></h5>
                            <p><?php esc_html_e( $descs[$i] ); ?></p>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
                <div class="list-history-wrap">
                    <ul class="nav list-history">
                        <?php $i = 0; foreach( $items as $item ): ?>
                            <li class="list-history-item" role="presentation">
                                <a class="<?= ( $i == 0 ) ? 'active' : '' ?>" href="#tabs-5-<?= $i ?>" data-toggle="tab">
                                <div class="list-history-circle"></div>
                                    <?php esc_html_e( $years[$i] ); ?>
                                </a>
                            </li>
                        <?php $i++; endforeach; ?>
                    </ul>
                </div>
                </div>
            </div>
            <div class="col-md-9 col-lg-6 position-static index-1">
                <div class="bg-image-right-1 bg-image-right-lg">
                <img src="<?php esc_attr_e( $image['url'] ); ?>" alt="" width="<?php esc_attr_e( $image['width'] ); ?>" height="<?php esc_attr_e( $image['height'] ); ?>"/>
                <div class="link-play-modern">
                    <a class="icon mdi mdi-play" data-lightbox="iframe" href="<?php esc_attr_e( $video ); ?>"></a>
                    <div class="link-play-modern-title"><?php _e( 'How we', 'pizzahouse' ); ?><span><?php _e( 'Work', 'pizzahouse' ); ?></span></div>
                    <div class="link-play-modern-decor"></div>
                </div>
                <div class="box-transform" style="background-image: url(<?php esc_attr_e( $image['url'] ); ?>);"></div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- Our clients-->
    <section class="section section-lg bg-default text-md-left">
    <div class="container">
        <?php 
            $i      = 0;
            $title          = $redux_config['pizzahouse_about-us__testimonials-title'];
            $image          = $redux_config['pizzahouse_about-us__testimonials-image'];
            $testimonials   = $redux_config['pizzahouse_about-us__testimonials'];
            $items      = $testimonials['redux_repeater_data'];
            $names      = $testimonials['clientname'];
            $opinions   = $testimonials['opinion'];
            $photos     = $testimonials['client-image'];
            $roles      = $testimonials['role'];
        ?>
        <div class="row row-60 justify-content-center flex-lg-row-reverse">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="offset-left-xl-70">
                <h3 class="heading-3"><?= esc_html( $title ) ?></h3>
                <div class="slick-quote">
                    <!-- Slick Carousel-->
                    <div class="slick-slider carousel-parent" data-autoplay="true" data-swipe="true" data-items="1" data-child="#child-carousel-5" data-for="#child-carousel-5" data-slide-effect="true">
                        <?php foreach( $items as $item ): ?>
                            <div class="item">
                                <!-- Quote Modern-->
                                <article class="quote-modern">
                                <h5 class="quote-modern-text"><span class="q"><?= esc_html( $opinions[$i] ); ?></span></h5>
                                <h5 class="quote-modern-author"><?= esc_html( $names[$i] ); ?></h5>
                                <p class="quote-modern-status"><?= esc_html( $roles[$i] ); ?></p>
                                </article>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                    <div class="slick-slider child-carousel" id="child-carousel-5" data-arrows="true" data-for=".carousel-parent" data-items="4" data-sm-items="4" data-md-items="4" data-lg-items="4" data-xl-items="4" data-slide-to-scroll="1">
                        <?php $i = 0; foreach( $items as $item ): ?>
                            <div class="item"><img class="img-circle" src="<?= esc_attr( $photos[$i]['url'] ) ?>" alt="" width="<?= esc_attr( $photos[$i]['width'] ) ?>" height="<?= esc_attr( $photos[$i]['height'] ) ?>"/>
                            </div>
                        <?php $i++; endforeach; ?>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-7"><img src="<?= esc_attr( $image['url'] ) ?>" alt="" width="<?= esc_attr( $image['width'] ) ?>" height="<?= esc_attr( $image['height'] ) ?>"/>
            </div>
        </div>
    </div>
    </section>

<?php
    get_footer();
?>