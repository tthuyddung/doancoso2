const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
       processCssUrls: false
   });

   const mix = require('laravel-mix');

// Biên dịch file SCSS
mix.sass('resources/scss/app.scss', 'public/css');

// Biên dịch file Pug
mix.webpackConfig({
    module: {
        rules: [
            {
                test: /\.pug$/,
                loader: 'pug-plain-loader'
            }
        ]
    }
});

// Nếu bạn muốn sử dụng Laravel Mix để tự động tải lại trình duyệt
mix.browserSync('http://localhost:8000');

mix.js('resources/js/app.js', 'public/js').vue()
   .sass('resources/sass/app.scss', 'public/css')
   .sourceMaps();
