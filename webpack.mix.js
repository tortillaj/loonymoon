const mix = require('laravel-mix');
const path = require('path');
const prefix = mix.inProduction() ? '.min' : '';

const postCssPlugins = [
    require('postcss-nested-ancestors'),
    require('postcss-nested'),
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]

mix.setPublicPath(path.resolve('./'));

mix.js('resources/js/app.js', 'js');

mix.postCss("resources/css/app.css", "css");
mix.postCss("resources/css/editor-style.css", "/");

if (mix.inProduction()) {
    mix.options({
        postCss: [
            ...postCssPlugins,
            require("@fullhuman/postcss-purgecss")({
                content: ["./**.php", "./**/**.php", "./**.html", "./**.js"],
                // Use Extractor configuration from Tailwind Docs
                // https://tailwindcss.com/docs/controlling-file-size#setting-up-purge-css-manually
                defaultExtractor: content => {
                    // Capture as liberally as possible, including things like `h-(screen-1.5)`
                    const broadMatches = content.match(/[^<>"'`\s]*[^<>"'`\s:]/g) || []

                    // Capture classes within other delimiters like .block(class="w-1/2") in Pug
                    const innerMatches = content.match(/[^<>"'`\s.()]*[^<>"'`\s.():]/g) || []

                    return broadMatches.concat(innerMatches)
                },
                whitelistPatterns: getCSSWhitelistPatterns(),
            }),
        ]
    });
} else {
    mix.options({
        postCss: postCssPlugins,
    });
}

mix.browserSync({
    proxy: 'http://loony.test',
    host: 'loony.test',
    open: 'external',
    port: 8000,
    files: [
        '**/*.php',
        '**/*.css',
        '**/*.js',
    ]
});

mix.version();

/**
 * List of RegExp patterns for PurgeCSS
 * @returns {RegExp[]}
 */
function getCSSWhitelistPatterns() {
    return [
        /^home(-.*)?$/,
        /^blog(-.*)?$/,
        /^archive(-.*)?$/,
        /^date(-.*)?$/,
        /^error404(-.*)?$/,
        /^admin-bar(-.*)?$/,
        /^search(-.*)?$/,
        /^nav(-.*)?$/,
        /^wp(-.*)?$/,
        /^screen(-.*)?$/,
        /^navigation(-.*)?$/,
        /^(.*)-template(-.*)?$/,
        /^(.*)?-?single(-.*)?$/,
        /^postid-(.*)?$/,
        /^post-(.*)?$/,
        /^attachmentid-(.*)?$/,
        /^attachment(-.*)?$/,
        /^page(-.*)?$/,
        /^(post-type-)?archive(-.*)?$/,
        /^author(-.*)?$/,
        /^category(-.*)?$/,
        /^tag(-.*)?$/,
        /^menu(-.*)?$/,
        /^tags(-.*)?$/,
        /^tax-(.*)?$/,
        /^term-(.*)?$/,
        /^date-(.*)?$/,
        /^(.*)?-?paged(-.*)?$/,
        /^depth(-.*)?$/,
        /^children(-.*)?$/,
    ];
}
