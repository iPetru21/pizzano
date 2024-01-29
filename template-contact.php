<?php
/**
 * Template Name: Contact Page
 */

get_header();
pizzahouse_breadcrumb();
global $redux_config;
?>
    <section class="section section-lg bg-default text-md-left">
        <div class="container">
          <div class="row row-60 justify-content-center">
            <div class="col-lg-8">
              <h4 class="text-spacing-25 text-transform-none"><?php _e('Trimite-ne un mesaj', 'pizzahouse') ?></h4>
              <?php echo do_shortcode('[contact-form-7 id="63" title="Contact form 1"]'); ?>
            </div>
            <div class="col-lg-4">
              <div class="aside-contacts">
                <div class="row row-30">
                  <div class="col-sm-6 col-lg-12 aside-contacts-item">
                    <p class="aside-contacts-title"><?php _e('Social Media', 'pizzahouse') ?></p>
                    <ul class="list-inline contacts-social-list list-inline-sm">
                      <li><a class="icon mdi mdi-facebook" href="https://www.facebook.com/pizzanoalbaiulia"></a></li>
                      <li><a class="icon fa fa-pagelines" href="https://www.tripadvisor.com/Restaurant_Review-g315903-d25271892-Reviews-Pizzano-Alba_Iulia_Alba_County_Central_Romania_Transylvania.html"></a></li>
                      <li><a class="icon mdi mdi-instagram" href="https://www.instagram.com/pizzanoalbaiulia"></a></li>
                      <li><a class="icon fa fa-openid" href="https://www.tiktok.com/@pizzano.ro"></a></li>
                    </ul>
                  </div>
                  <div class="col-sm-6 col-lg-12 aside-contacts-item">
                    <p class="aside-contacts-title"><?php _e('Telefon', 'pizzahouse') ?></p>
                    <div class="unit unit-spacing-xs justify-content-center justify-content-md-start">
                      <div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
                      <div class="unit-body"><a class="phone" href="tel:0756607777">+40-756-607-777</a></div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-12 aside-contacts-item">
                    <p class="aside-contacts-title"><?php _e('E-mail', 'pizzahouse') ?></p>
                    <div class="unit unit-spacing-xs justify-content-center justify-content-md-start">
                      <div class="unit-left"><span class="icon mdi mdi-email-outline"></span></div>
                      <div class="unit-body"><a class="mail" href="mailto:comenzi@pizzano.ro">comenzi@pizzano.ro</a></div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-12 aside-contacts-item">
                    <p class="aside-contacts-title"><?php _e('Vizitează-ne', 'pizzahouse') ?></p>
                    <div class="unit unit-spacing-xs justify-content-center justify-content-md-start">
                      <div class="unit-left"><span class="icon mdi mdi-map-marker"></span></div>
                      <div class="unit-body">Bulevardul 1 Decembrie 1918, Bloc M5-M6, Alba Iulia,</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
<?php get_footer(); ?>