/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import './styles/filter.css';

// start the Stimulus application
import './bootstrap';

// import '../public/js/invitGameroom';

import noUiSlider from 'nouislider';
import 'nouislider/dist/nouislider.css';
import 'nouislider/dist/nouislider.js';


console.log('test noUiSlider Hello');

const slider = document.getElementById('player-slider');

if (slider) {
    noUiSlider.create(slider, {
        start: [1, 10],
        step: 1,
        margin: 10,
        direction: 'rtl',
        behaviour: 'tap-drag',
        connect: true,
        range: {
            'min': 0,
            'max': 10
        }
    });
}


