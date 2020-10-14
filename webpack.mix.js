const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/so_lieu_tuyen_sinh/tong_hop_so_lieu.js', 'public/js/so_lieu_tuyen_sinh')
    .js('resources/js/common/index_table.js', 'public/js/common')
    .js('resources/js/common/filter.js', 'public/js/common')
    .js('resources/js/tong_hop_ket_qua_tot_nghiep/tong_hop_ket_qua_tot_nghiep.js', 'public/js/tong_hop_ket_qua_tot_nghiep')
    .sass('resources/sass/app.scss', 'public/css');