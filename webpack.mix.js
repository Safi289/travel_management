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

if (mix.inProduction()) {
    mix.options({
        terser: {
            terserOptions: {
                compress: {
                    drop_console: true
                }
            }
        }
    });
}

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .scripts([
        'public/vendor/dashboard/assets/js/kt-global.js',
        'public/vendor/dashboard/assets/plugins/global/plugins.bundle.js',
        'public/vendor/dashboard/assets/js/scripts.bundle.js',
    ], 'public/js/all.js')
    .scripts([
        'resources/views/Admin/scripts/bootstrap-pickers.js',
    ], 'public/js/pages/common/common.js')
    .scripts([
        'resources/views/Admin/customer/bootstrap-datepicker.js',
        'resources/views/Admin/customer/customer.js',
    ], 'public/js/pages/customer.js')
    .scripts([
        'resources/views/Admin/passport/bootstrap-datepicker.js',
        'resources/views/Admin/passport/passport.js',
    ], 'public/js/pages/passport.js')
    .scripts([
        'resources/views/Admin/hajj/bootstrap-datepicker.js',
    ], 'public/js/pages/haji.js')
    .scripts([
        'resources/views/Admin/hajj-payment/bootstrap-datepicker.js',
    ], 'public/js/pages/hajj-payment.js')
    .scripts([
        'resources/views/Admin/package/bootstrap-pickers.js',
    ], 'public/js/pages/package.js')
    .scripts([
        'resources/views/Admin/accounts/bootstrap-pickers.js',
    ], 'public/js/pages/accounts/bootstrap-pickers.js')
    .scripts([
        'resources/views/Admin/accounts/deposit/bootstrap-pickers.js',
        'resources/views/Admin/accounts/deposit/deposit.js',
    ], 'public/js/pages/accounts/deposit.js')
    .scripts([
        'resources/views/Admin/hotel-rate/bootstrap-datepicker.js',
    ], 'public/js/pages/hotel-rate/hotel-rate.js')
    .scripts([
        'resources/views/Admin/accounts/expense/bootstrap-pickers.js',
    ], 'public/js/pages/accounts/expense.js')
    .scripts([
        'resources/views/Admin/passport-history/bootstrap-pickers.js',
        'resources/views/Admin/passport-history/passportHistory.js',
    ], 'public/js/pages/passportHistory.js')
    .scripts([
        'resources/views/Admin/passport-collection/passport-collection.js',
    ], 'public/js/pages/passport-collection.js')
    .scripts([
        'resources/views/Admin/reports/bootstrap-pickers.js',
    ], 'public/js/pages/report-bootstrap-pickers.js');
