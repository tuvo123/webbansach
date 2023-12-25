<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Books Printing
 */

get_header(); ?>

<div class="header-image-box text-center">
  <div class="container">
  <?php if ( get_theme_mod('books_printing_header_page_title' , true)) : ?>
      <?php the_archive_title('<h1 class="mb-0">', '</h1>') ?> <?php the_archive_description(); ?>
  <?php endif; ?>
  <?php if ( get_theme_mod('books_printing_header_breadcrumb' , true)) : ?>
    <div class="crumb-box mt-3">
      <?php books_printing_the_breadcrumb(); ?>
    </div>
  <?php endif; ?>
  </div>
</div>

<div id="content" class="mt-5">
  <div class="container">
    <?php $books_printing_post_layout = get_theme_mod( 'books_printing_post_layout','Right Sidebar');
    if($books_printing_post_layout == 'Right Sidebar'): ?>
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                esc_html_e( 'Sorry, no post found on this archive.', 'books-printing' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
      </div>
    <?php elseif ($books_printing_post_layout == 'Left Sidebar') : ?>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-8 col-md-8">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                esc_html_e( 'Sorry, no post found on this archive.', 'books-printing' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
      </div>
    <?php elseif ($books_printing_post_layout == 'One Column') : ?>
      <div class="row">
        <?php
          if ( have_posts() ) :

            while ( have_posts() ) :

              the_post();
              get_template_part( 'template-parts/content' );

            endwhile;

          else:

            esc_html_e( 'Sorry, no post found on this archive.', 'books-printing' );

          endif;

          get_template_part( 'template-parts/pagination' );
        ?>
      </div>
    <?php elseif ($books_printing_post_layout == 'Three Columns') : ?>
      <div class="row">
        <div class="col-lg-4 col-md-4">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                esc_html_e( 'Sorry, no post found on this archive.', 'books-printing' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="sidebar-area">
            <?php
              dynamic_sidebar('sidebar-2');
            ?>
          </div>
        </div>
      </div>
    <?php elseif ($books_printing_post_layout == 'Four Columns') : ?>
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <?php get_sidebar(); ?>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="row">
            <?php
              if ( have_posts() ) :

                while ( have_posts() ) :

                  the_post();
                  get_template_part( 'template-parts/content' );

                endwhile;

              else:

                esc_html_e( 'Sorry, no post found on this archive.', 'books-printing' );

              endif;

              get_template_part( 'template-parts/pagination' );
            ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="sidebar-area">
            <?php
              dynamic_sidebar('sidebar-2');
            ?>
          </div>
        </div>
        <div class="col-lg-3 col-md-3">
          <div class="sidebar-area sidebar-three">
            <?php
              dynamic_sidebar('sidebar-3');
            ?>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>