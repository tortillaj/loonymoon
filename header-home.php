<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>

<?php do_action( 'loonymoon_site_before' ); ?>

<div id="page" class="min-h-screen flex flex-col h-full">

	<?php $header_image_url = loonymoon_get_header_image(); ?>

    <header class="relative h-52 md:h-72 lg:h-half overflow-hidden">
        <div class="absolute top-0 left-0 right-0 bottom-0">
            <img src="<?php echo $header_image_url; ?>" alt
                 class="block object-center object-cover w-full h-full"
            />
        </div>

        <span class="absolute block bg-blackOverlay w-full h-full"></span>

        <div class="absolute top-0 left-0 right-0 bottom-0 flex">
            <a class="flex flex-col items-center m-auto" href="<?php echo get_bloginfo('url'); ?>">
                <div class="w-24 md:w-36 lg:w-56">
				    <?php echo loonymoon_get_logo_image(); ?>
                </div>
                <p class="text-sm md:text-base text-white font-bold mt-2"><?php echo get_bloginfo('description'); ?></p>
            </a>
        </div>

        <div class="relative py-4 px-5 lg:py-5 lg:px-10 2xl:px-20 transition duration-75 ease-in-out">
            <div class="lg:flex lg:justify-between lg:items-center">
                <div class="flex justify-end items-center">
                    <div class="lg:hidden">
                        <a href="#" aria-label="Toggle navigation" id="primary-menu-toggle">
                            <svg viewBox="0 0 20 20" class="inline-block w-6 h-6" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd" class="text-yellow-200">
                                    <g>
                                        <path d="M0,3 L20,3 L20,5 L0,5 L0,3 Z M0,9 L20,9 L20,11 L0,11 L0,9 Z M0,15 L20,15 L20,17 L0,17 L0,15 Z"></path>
                                    </g>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>

				<?php
				wp_nav_menu(
					array(
						'container_id'    => 'primary-menu',
						'container_class' => 'hidden bg-gray-100 mt-4 p-4 lg:mt-0 lg:p-0 lg:bg-transparent lg:block',
						'menu_class'      => 'lg:flex lg:-mx-4',
						'theme_location'  => 'primary',
						'li_class'        => 'lg:mx-4 uppercase font-bold text-sm text-yellow-400',
						'fallback_cb'     => false,
					)
				);
				?>
            </div>

        </div>

    </header>

    <div id="content" class="site-content flex-grow">

        <main>
