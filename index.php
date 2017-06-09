<?php get_header(); ?>
<hr>
<section id="content">

    <?php if (have_posts()) : ?>

        <?php while (have_posts()) : the_post(); ?>

            <?php
            
              if (is_home()) {
             echo  get_template_part('loop', 'list');
             var_dump("hello");
              }

              if (is_page() || is_single()) {
              get_template_part('loop', 'single');
              var_dump("single page");
              }

              if (is_archive() || is_tag()) {
              get_template_part('loop', 'list');
              }

            ?>

        <?php endwhile; ?>

    <?php endif; ?>

</section>

<hr>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>