<?php
/**
 * Template Name: Home Page
 */

global $redux_config;

get_header(); ?>

    <?php 
      $slides = $redux_config['pizzahouse-additional-slides'];
      $button = array( 
            'text' => $redux_config['pizzahouse-slides-button-text'],
            'url'  => $redux_config['pizzahouse-slides-button-url'] 
      );
    ?>
    <section class="section swiper-container swiper-slider swiper-slider-2 swiper-slider-3" data-loop="true" data-autoplay="5000" data-simulate-touch="false" data-slide-effect="fade">
        <div class="swiper-wrapper text-sm-left">
          <?php foreach( $slides as $key => $slide ): ?>
            <div class="swiper-slide context-dark" data-slide-bg="<?= $slide['image'] ?>">
              <div class="swiper-slide-caption section-md">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-9 col-md-8 col-lg-7 col-xl-7 offset-lg-1 offset-xxl-0">
                      <h1 class="oh swiper-title"><span class="d-inline-block" data-caption-animate="slideInUp" data-caption-delay="0"><?= $slide['title'] ?></span></h1>
                      <p class="big swiper-text" data-caption-animate="fadeInLeft" data-caption-delay="300"><?= $slide['description'] ?></p>
                        <?php if( $key === array_key_first($slides) ): ?>
                            <a class="button button-lg button-primary button-winona button-shadow-2" href="<?= $button['url'] ?>" data-caption-animate="fadeInUp" data-caption-delay="300"><?= $button['text'] ?></a>
                        <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php endforeach; 
          ?>
        </div>
        <!-- Swiper Pagination-->
        <div class="swiper-pagination" data-bullet-custom="true"></div>
        <!-- Swiper Navigation-->
        <div class="swiper-button-prev">
          <div class="preview">
            <div class="preview__img"></div>
          </div>
          <div class="swiper-button-arrow fa fa-arrow-left"></div>
        </div>
        <div class="swiper-button-next">
          <div class="swiper-button-arrow fa fa-arrow-right"></div>
          <div class="preview">
            <div class="preview__img"></div>
          </div>
        </div>
      </section>
      <!-- What We Offer-->
      <section class="section section-md bg-default">
        <div class="container">
            <?php if( ! empty($redux_config['pizzahouse-menu-title'] ) ): ?>
                <h3 class="oh-desktop"><span class="d-inline-block wow slideInDown"><?= $redux_config['pizzahouse-menu-title'] ?></span></h3>
            <?php endif; ?>
            <div class="row row-md row-30">
            <?php  
              $args = array(
                'taxonomy'      => 'product_cat',
                'hide_empty'    => 0
              );

              $all_categories = get_categories( $args );
              foreach( $all_categories as $category ): 
                // Skip uncategorized category
                if( $category->slug === 'uncategorized' )
                  continue;
                $thumbnail_id = absint( get_term_meta( $category->term_id, 'thumbnail_id', true ) );

                if ( $thumbnail_id ) {
                  $image = wp_get_attachment_image( $thumbnail_id, array( 370, 278 ) );
                } else {
                  $image = '<img src="' . wc_placeholder_img_src() . '" width="370" height="278"/>';
                }
                $icon = get_term_meta( $category->term_id, 'icon', true );
                ?>
                <div class="col-sm-6 col-lg-4">
                  <div class="oh-desktop">
                    <!-- Services Terri-->
                    <article class="services-terri wow slideInUp">
                      <div class="services-terri-figure"><?= $image ?>
                      </div>
                      <div class="services-terri-caption"><span class="services-terri-icon fa fa-solid <?= $icon ?>"></span>
                        <h5 class="services-terri-title"><a href="<?= get_term_link($category->term_id, 'product_cat'); ?>"><?= $category->name; ?></a></h5>
                      </div>
                      
                    </article>
                  </div>
                </div>
              <?php endforeach;
            ?>
          </div>
        </div>
      </section>

      <!-- Section CTA-->
        <?php 
            $link = '#';
            if( ! empty( $redux_config['pizzahouse-banner-image'] ) )
                $link = $redux_config['pizzahouse-banner-image']['url'];
        ?>
      <section class="primary-overlay section parallax-container" data-parallax-img="<?= $link ?>">
        <div class="parallax-content section-xl context-dark text-md-left">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-sm-8 col-md-7 col-lg-5">
                <div class="cta-modern">
                    <?php if ( ! empty( $redux_config['pizzahouse-banner-title'] ) ): ?>
                        <h3 class="cta-modern-title wow fadeInRight"><?= $redux_config['pizzahouse-banner-title'] ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $redux_config['pizzahouse-banner-textarea'] ) ): ?>
                        <p class="lead"><?= $redux_config['pizzahouse-banner-textarea'] ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $redux_config['pizzahouse-banner-author'] ) ): ?>
                        <p class="cta-modern-text oh-desktop" data-wow-delay=".1s">
                            <span class="cta-modern-decor wow slideInLeft"></span>
                            <span class="d-inline-block wow slideInDown"><?= $redux_config['pizzahouse-banner-author'] ?></span>
                        </p>
                    <?php endif; ?>
                    <?php if ( ! empty( $redux_config['pizzahouse-banner-button-text'] ) ): ?>
                        <a class="button button-md button-secondary-2 button-winona wow fadeInUp" href="<?= $redux_config['pizzahouse-banner-button-text'] ?>" data-wow-delay=".2s">
                            <?= $redux_config['pizzahouse-banner-button-text'] ?>
                        </a>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Our Shop-->
      <section class="section section-lg bg-default">
        <div class="container">
          <h3 class="oh-desktop"><span class="d-inline-block wow slideInUp">Cele mai vândute pizza</span></h3>
          <div class="row row-lg row-30">
            <?php 
                // Default arguments
                $args = array(
                    'status'            => array( 'draft', 'pending', 'private', 'publish' ),
                    'type'              => array_merge( array_keys( wc_get_product_types() ) ),
                    'parent'            => null,
                    'sku'               => '',
                    'category'          => array('pizzas'),
                    'tag'               => array(),
                    'limit'             => 4,  // -1 for unlimited
                    'offset'            => null,
                    'page'              => 1,
                    'include'           => array(),
                    'exclude'           => array(),
                    'orderby'           => 'date',
                    'order'             => 'DESC',
                    'return'            => 'objects',
                    'paginate'          => false,
                    'shipping_class'    => array(),
                );

                // Array of product objects
                $products = wc_get_products( $args );

                foreach( $products as $product ){
                    wc_get_template_part( 'content', 'product' );
                }
            ?>
          </div>
        </div>
      </section>

      <!-- Section CTA-->
        <?php
            $url = '#';
            if( ! empty( $redux_config['pizzahouse-banner2-image'] ) )
                $url = $redux_config['pizzahouse-banner2-image']['url'];
        ?>
      <section class="primary-overlay section parallax-container" data-parallax-img="<?= $url ?>">
        <div class="parallax-content section-xxl context-dark text-md-left">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-sm-9 col-md-7 col-lg-5">
                <div class="cta-modern">
                    <?php if ( ! empty( $redux_config['pizzahouse-banner2-title'] ) ): ?>
                        <h3 class="cta-modern-title cta-modern-title-2 oh-desktop"><span class="d-inline-block wow fadeInLeft"><?= $redux_config['pizzahouse-banner2-title'] ?></span></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $redux_config['pizzahouse-banner2-textarea'] ) ): ?>
                        <p class="cta-modern-text cta-modern-text-2 oh-desktop" data-wow-delay=".1s">
                            <span class="cta-modern-decor cta-modern-decor-2 wow slideInLeft"></span>
                            <span class="d-inline-block wow slideInUp"><?= $redux_config['pizzahouse-banner2-textarea'] ?></span>
                        </p>
                    <?php endif; ?>
                    <?php if ( ! empty ( $redux_config['pizzahouse-banner2-button-text'] ) ): ?>
                        <a class="button button-lg button-secondary button-winona wow fadeInRight" href="<?= $redux_config['pizzahouse-banner2-button-link'] ?>" data-wow-delay=".2s">
                            <?= $redux_config['pizzahouse-banner2-button-text'] ?>
                        </a>
                    <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- What We Offer-->

      <?php 
        $args = array(
          'post_type' => 'testimonials',
          'posts_per_page' => -1,
        );
  
        $query = new WP_Query($args);
  
        if($query->have_posts()): ?>

          <section class="section section-xl bg-default">
            <div class="container">
              <?php if( ! empty( $redux_config['pizzahouse_testimonials_title'] ) ) : ?>
                <h3 class="wow fadeInLeft"><?= esc_html__( $redux_config['pizzahouse_testimonials_title'], 'pizzahouse' ) ?></h3>
              <?php endif; ?>
            </div>
            <div class="container container-style-1">
              <div class="owl-carousel owl-style-12" data-items="1" data-sm-items="2" data-lg-items="3" data-margin="30" data-xl-margin="45" data-autoplay="true" data-nav="true" data-center="true" data-smart-speed="400">

            <?php while($query->have_posts()):
              $query->the_post(); ?>
              
                <!-- Quote Tara-->
                <article class="quote-tara">
                  <div class="quote-tara-caption">
                    <div class="quote-tara-text">
                      <p class="q"><?= get_the_excerpt() ?></p>
                    </div>
                    <div class="quote-tara-figure">
                        <?= get_the_post_thumbnail() ?>
                    </div>
                  </div>
                  <h6 class="quote-tara-author"><?= get_the_title() ?></h6>
                  <div class="quote-tara-status">Recenzie Google</div>
                </article>
              
            <?php endwhile;
  
          /* Restore original Post Data */
          wp_reset_postdata();    
  
        endif; ?>

          </div>
        </div>
      </section>
        <?php if ( ! empty( $redux_config['pizzahouse_gallery'] ) ): ?>

      <section class="section section-last bg-default">
        <div class="container-fluid container-inset-0 isotope-wrap">
          <div class="row row-10 gutters-10 isotope" data-isotope-layout="masonry" data-isotope-group="gallery" data-lightgallery="group">
            <?php 
                
                $i = 0;
                $gallery    = $redux_config['pizzahouse_gallery'];
                $items      = $gallery['redux_repeater_data'];
                $titles     = $gallery['pizzahouse_gallery_title'];
                $urls       = $gallery['pizzahouse_gallery_url'];
                $desc       = $gallery['pizzahouse_advantages_description'];
                $images     = $gallery['pizzahouse_gallery_image'];
                $full_imgs  = $gallery['pizzahouse_gallery_full_image'];
                $images_sm  = $gallery['pizzahouse-gallery_image_sm'];
                $images_lx  = $gallery['pizzahouse-gallery_image_lx'];

                foreach( $items as $item ): 
            ?>
                <div class="col-xs-6 col-sm-<?= $images_sm[$i] ?> col-xl-<?= $images_lx[$i] ?> isotope-item oh-desktop">
                    <!-- Thumbnail Mary-->
                    <article class="thumbnail thumbnail-mary thumbnail-mary-2 wow slideInLeft"><a class="thumbnail-mary-figure" href="<?= $full_imgs[$i]['url'] ?>" data-lightgallery="item"><img src="<?= $images[$i]['url'] ?>" alt="" width="<?= $images[$i]['width'] ?>" height="<?= $images[$i]['height'] ?>"/></a>
                        <div class="thumbnail-mary-caption">
                        <div>
                            <h6 class="thumbnail-mary-title"><a href="<?= esc_attr_e($urls[$i]) ?>"><?= $titles[$i] ?></a></h6>
                            <div class="thumbnail-mary-location"><?= $desc[$i] ?></div>
                        </div>
                        </div>
                    </article>
                </div>
            <?php 
                $i++;
                endforeach; 
                unset( $i, $gallery, $items, $titles, $desc, $images, $full_imgs, $images_sm, $images_lx );
            ?>
          </div>
        </div>
      </section>
      <?php endif; ?>

      <!-- Tell-->
      <?php/* if( ! empty($redux_config['pizzahouse_contact_form_shortcode'] ) ) : ?>
      <section class="section section-sm section-first bg-default">
        <div class="container">
          <?php if( ! empty( $redux_config['pizzahouse_contact_form_title'] ) ) : ?>
            <h3 class="heading-3"><?= $redux_config['pizzahouse_contact_form_title'] ?></h3>
          <?php endif; ?>
          <?php echo do_shortcode( $redux_config['pizzahouse_contact_form_shortcode']); ?>
        </div>
      </section>
          <?php endif; */?>

      <!-- Section Services  Last section-->
      <?php if( ! empty( $redux_config['pizzahouse_advantages'] ) ) : ?>
      <section class="section section-sm bg-default">
        <div class="container">
          <div class="owl-carousel owl-style-11 dots-style-2" data-items="1" data-sm-items="1" data-lg-items="2" data-xl-items="4" data-margin="30" data-dots="true" data-mouse-drag="true" data-rtl="true">
            <?php $advantages = $redux_config['pizzahouse_advantages']; ?>
            <?php foreach( $advantages['redux_repeater_data'] as $key => $value ) : 
              $title = $advantages['pizzahouse_advantages_title'][$key]; 
              $description = $advantages['pizzahouse_advantages_description'][$key];
              $icon = $advantages['pizzahouse_advantages_icon'][$key]; ?>
            <article class="box-icon-megan wow fadeInUp">
              <div class="box-icon-megan-header">
                <div class="box-icon-megan-icon fa <?= $icon ?>"></div>
              </div>
              <h5 class="box-icon-megan-title"><a href="#"><?= $title ?></a></h5>
              <p class="box-icon-megan-text"><?= $description ?></p>
            </article>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
      <?php endif; ?>

<?php get_footer(); ?>