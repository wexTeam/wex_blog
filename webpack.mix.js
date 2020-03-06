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


mix.styles([
    'public/bootstrap/dist/css/bootstrap.min.css',
    'public/css/animate.css',
    'public/css/style.css',
    'public/css/colors/default.css',
    'public/css/colors/megna-dark.css'

], 'public/css/auth.css');

mix.scripts([
    'public/plugins/bower_components/jquery/dist/jquery.min.js',
    'public/bootstrap/dist/js/bootstrap.min.js',
    'public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
    'public/js/jquery.slimscroll.js',
    'public/js/waves.js',
    'public/js/custom.min.js',
    'public/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    'public/js/loadingoverlay.min.js',
], 'public/js/auth.js');

mix.styles([
    'public/bootstrap/dist/css/bootstrap.min.css',
    'public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
    'public/plugins/bower_components/toast-master/css/jquery.toast.css',
    'public/plugins/bower_components/morrisjs/morris.css',
    'public/plugins/bower_components/chartist-js/dist/chartist.min.css',
    'public/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css',
    'public/plugins/bower_components/calendar/dist/fullcalendar.css',
    'public/css/animate.css',
    'public/css/style.css',
    'public/css/colors/megna-dark.css',

], 'public/css/admin-dashboard.css');

mix.scripts([
    'public/plugins/bower_components/jquery/dist/jquery.min.js',
    'public/bootstrap/dist/js/bootstrap.min.js',
    'public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
    'public/js/jquery.slimscroll.js',
    'public/js/waves.js',
    'public/plugins/bower_components/waypoints/lib/jquery.waypoints.js',
    'public/plugins/bower_components/counterup/jquery.counterup.min.js',
    'public/plugins/bower_components/raphael/raphael-min.js',
    'public/plugins/bower_components/morrisjs/morris.js',
    'public/plugins/bower_components/chartist-js/dist/chartist.min.js',
    'public/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js',
    'public/plugins/bower_components/moment/moment.js',
    'public/plugins/bower_components/calendar/dist/fullcalendar.min.js',
    'public/plugins/bower_components/calendar/dist/cal-init.js',
    'public/js/custom.min.js',
    'public/js/dashboard1.js',
    'public/js/cbpFWTabs.js',
    'public/js/cbpFWTabs.js',
    'public/js/script.js',
    'public/plugins/bower_components/toast-master/js/jquery.toast.js',
    'public/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    'public/js/loadingoverlay.min.js',
], 'public/js/admin-dashboard.js');


mix.styles([
    'public/bootstrap/dist/css/bootstrap.min.css',
    'public/plugins/bower_components/datatables/jquery.dataTables.min.css',
    'public/plugins/bower_components/datatables/buttons.dataTables.min.css',
    'public/css/animate.css',
    'public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css',
    'public/plugins/bower_components/switchery/dist/switchery.min.css',
    'public/plugins/bower_components/sweetalert/sweetalert.css',
    'public/plugins/bower_components/custom-select/custom-select.css',
    'public/plugins/bower_components/bootstrap-select/bootstrap-select.min.css',
    'public/css/animate.css',
    'public/css/style.css',
    'public/css/colors/megna-dark.css',

], 'public/css/admin-master.css');

mix.scripts([
    'public/plugins/bower_components/jquery/dist/jquery.min.js',
    'public/bootstrap/dist/js/bootstrap.min.js',
    'public/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js',
    'public/js/jquery.slimscroll.js',
    'public/js/waves.js',
    'public/plugins/bower_components/sweetalert/sweetalert.min.js',
    'public/plugins/bower_components/switchery/dist/switchery.min.js',
    'public/plugins/bower_components/custom-select/custom-select.min.js',
    'public/plugins/bower_components/bootstrap-select/bootstrap-select.min.js',
    'public/js/custom.min.js',
    'public/plugins/bower_components/datatables/jquery.dataTables.min.js',
    'public/plugins/bower_components/datatables/dataTables.buttons.min.js',
    'public/js/jasny-bootstrap.js',
    'public/plugins/bower_components/styleswitcher/jQuery.style.switcher.js',
    'public/js/loadingoverlay.min.js',
    'public/js/vue.min.js',
    'public/js/lodash.min.js',
    'public/js/script.js',
], 'public/js/admin-master.js');
