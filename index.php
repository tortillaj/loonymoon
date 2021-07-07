<?php get_header(); ?>

<?php if (have_posts()) : ?>

    <div class="container mx-auto md:grid md:grid-cols-4 md:grid-flow-col md:gap-4 md:auto-rows-200">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', get_post_format()); ?>

        <?php endwhile; ?>

    </div>

<?php endif; ?>

<?php
get_footer();
