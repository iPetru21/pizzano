<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package PizzaHouse
 */

get_header();
?>
    <section class="section section-single box-transform-wrap novi-background novi-background context-dark">
        <div class="section-single-inner">

            <div class="section-single-main">
                <div class="container">
                    <div class="title-modern"><?php _e( '404', 'pizzahouse' ); ?></div>
                    <h4 class="text-spacing-0 text-transform-none"><?php _e( 'Pagina nu a fost găsită', 'pizzahouse' ); ?></h4><a class="button button-lg button-primary button-winona" href="index.html"><?php _e( 'Către pagina principală', 'pizzahouse' ); ?></a>
                </div>
            </div>

        </div>
        <div class="box-transform" style="background-image: url('https://theme.xplication.ro/wp-content/uploads/2023/05/DSC_2974-Large-1.jpg');"></div>
    </section>
    <!-- Global Mailform Output-->
    <div class="snackbars" id="form-output-global"></div>
<?php
get_footer();
