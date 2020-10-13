/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

import 'jquery';
import 'bootstrap';
import 'mdbootstrap';

require('bootstrap-datepicker/js/bootstrap-datepicker');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.fr');
require('bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css');

$(document).ready(function () {
    $('.js-datepicker').datepicker()

});


console.log('Hello Webpack Encore! Edit me in assets/js/app.js');


