<?php
$post_image_id = get_post_thumbnail_id();
$post_image_src = wp_get_attachment_image_src($post_image_id, 'medium');

$span_class = "md:row-span-1 md:col-span-1";
if ($post_image_src[1] > 2 * $post_image_src[2]) {
    $span_class = "md:col-span-2 md:row-span-1";
} else if ($post_image_src[2] > 2 * $post_image_src[1]) {
    $span_class = "md:row-span-2 md:col-span-1";
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser relative mb-5 md:mb-0 h-40 md:h-auto ' . $span_class); ?>>
    <a href="<?php echo get_permalink() ?>" class="block w-full h-full">
        <div class="relative overflow-hidden w-full h-full">
            <?php the_post_thumbnail(
                'medium',
                [
                    'class' => 'absolute top-0 left-0 w-full h-full object-cover',
                    'title' => the_title_attribute(array('echo' => false))
                ]
            ); ?>
        </div>
        <span role="presentation" class="absolute w-full h-full top-0 left-0 post-teaser__overlay"></span>
        <div class="absolute w-full h-full top-0 left-0 flex">
            <div class="m-auto">
                <h2 class="text-center font-extrabold text-white"><?php the_title(); ?></h2>
                <p class="text-center text-xs text-white uppercase"><?php the_date(); ?></p>
            </div>
        </div>
    </a>
</article>