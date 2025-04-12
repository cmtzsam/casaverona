<?php

/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage starter
 * @since starter 1.0
 */

get_header(); ?>

<div class="content_wrapper" role="main">

  <?php
  $fondo = get_field('imagen_fondo');
  $titulo = get_field('titulo');
  ?>

  <section class="homePageBanner" style="background-image: url('<?php echo esc_url($fondo); ?>');">
    <div class="container">
      <h1 class="homePageBanner--title"><?php echo esc_html($titulo); ?></h1>
    </div>
  </section>

  <!-- categorias -->
  <section class="theCollectionsGrid">
    <div class="container z-index-common ">

      <h2 class="sec-title text-center ">ESTILOS PARA <span>TODOS</span> LOS ESPACIOS</h2>

      <div class="row gy-30 justify-content-center theCollectionsGrid--grid">

        <?php
        $categorias = get_terms(array(
          'taxonomy'   => 'product_cat',
          'hide_empty' => true,
          'exclude'    => array(get_term_by('slug', 'mejor-vendidos', 'product_cat')->term_id)
        ));

        if (!empty($categorias) && !is_wp_error($categorias)) :

          $count = 0;

          foreach ($categorias as $categoria) :
            if ($categoria->count > 0) :

              $categoria_imagen_id = get_term_meta($categoria->term_id, 'thumbnail_id', true);

              // Solo mostrar si tiene imagen
              if (!$categoria_imagen_id) continue;

              $count++;
              if ($count > 4) break;

              $categoria_link = get_term_link($categoria);
              $categoria_imagen_url = wp_get_attachment_url($categoria_imagen_id);
        ?>
              <div class="col col-12 col-sm-6 col-md-6 col-lg-3 d-flex">
                <div class="offer-card w-100">

                  <a href="<?php echo esc_url($categoria_link); ?>" class="offer-card--img">
                    <img
                      src="<?php echo esc_url($categoria_imagen_url); ?>"
                      alt="<?php echo esc_attr($categoria->name); ?>"
                      loading="lazy"
                      class="img-fluid">
                  </a>

                  <div class="offer-card--data">
                    <h3 class="box-title my-0 pb-3">
                      <a href="<?php echo esc_url($categoria_link); ?>">
                        <?php echo esc_html($categoria->name); ?>
                      </a>
                    </h3>
                    <p>
                      <?php echo esc_html($categoria->description); ?>
                    </p>
                  </div>

                </div>
              </div>
        <?php
            endif;
          endforeach;
        else :
          echo '<p>No hay categorías disponibles.</p>';
        endif;
        ?>




      </div>


    </div>
  </section>
  <!-- categorias -->




  <?php
  $fondo_cta = get_field('imagen_fondo_redes');
  $titulo_redes = get_field('field_titulo_redes');
  $cta_desc = get_field('field_descripcion_redes');
  $cta_btn_link = get_field('field_url_boton_redes');
  $cta_btn_text = get_field('field_texto_boton_redes');
  ?>

  <!-- cta -->
  <section class="homePageCta" style="background-image: url('<?php echo esc_url($fondo_cta); ?>');">
    <div class="container">
      <div class="homePageCta--data">
        <h2 class="homePageCta--title"><?php echo esc_html($titulo_redes); ?></h2>
        <div class="homePageCta--desc">
          <p><?php echo esc_html($cta_desc); ?></p>
          <div class="homePageCta--desc-links">
            <a href="<?php echo esc_html($cta_btn_link); ?>" class="boton">
              <?php echo esc_html($cta_btn_text); ?>
            </a>
            <div class="social">
              <a href="#!"><i class="bi bi-facebook"></i></a>
              <a href="#!"><i class="bi bi-instagram"></i></a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
  <!-- cta -->


  <?php
  $imagen_1 = get_field('imagen_1');
  $enlace_1 = get_field('enlace_1');
  $imagen_2 = get_field('imagen_2');
  $enlace_2 = get_field('enlace_2');
?>

<!-- other collections -->
<section class="homePageEndCollections py-3">
  <div class="container">
    <div class="row">

      <?php if ($imagen_1 && $enlace_1): ?>
        <div class="col col-12 col-md-6 col-lg-6">
          <a href="<?php echo esc_url($enlace_1); ?>" class="d-flex justify-content center">
            <span>Nombre coleccion</span>
            <img src="<?php echo esc_url($imagen_1); ?>" alt="Colección 1" class="img-fluid" style="width: 100%;">
          </a>
        </div>
      <?php endif; ?>

      <?php if ($imagen_2 && $enlace_2): ?>
        <div class="col col-12 col-md-6 col-lg-6">
          <a href="<?php echo esc_url($enlace_2); ?>" class="d-flex justify-content center">
            <span>Nombre coleccion</span>
            <img src="<?php echo esc_url($imagen_2); ?>" alt="Colección 2" class="img-fluid" style="width: 100%;">
          </a>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<!-- other collections -->

</div><!-- .content_wrapper -->

<?php
get_footer();
