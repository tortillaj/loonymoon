<?php get_header( 'home' ); ?>

<?php if (have_posts()) : ?>

    <div class="container mx-auto py-4 px-5 lg:py-5 lg:px-10 2xl:px-20 2xl:pt-20 md:grid md:grid-cols-4 md:grid-flow-col md:gap-4 md:auto-rows-200">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', get_post_format()); ?>

        <?php endwhile; ?>

    </div>

<?php endif; ?>

<?php
get_footer();
