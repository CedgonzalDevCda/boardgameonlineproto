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
const sliderTime = document.getElementById('time-slider');

if (slider) {
    const range = noUiSlider.create(slider, {
        start: [min.value || 1 , max.value || 8],
        step: 1,
        margin: 1,
        behaviour: 'tap-drag',
        connect: true,
        range: {
            'min': parseInt(slider.dataset.min, 1),
            'max': parseInt(slider.dataset.max, 1)
        }
    });
    const min = document.getElementById('minPlayer');
    const max = document.getElementById('maxPlayer');
    range.on('slide', function(values, handle) {
        console.log(values, handle)
        if (handle === 0) {
            min.value = Math.round(values[0])
        }
        if (handle === 1) {
            max.value = Math.round(values[1])
        }
    })
}

// if (sliderTime) {
//     const rangeTime = noUiSlider.create(slider, {
//         start: [min.value || 2 , max.value || 180],
//         step: 1,
//         margin: 1,
//         behaviour: 'tap-drag',
//         connect: true,
//         range: {
//             'min': parseInt(slider.dataset.min, 1),
//             'max': parseInt(slider.dataset.max, 1)
//         }
//     });
//     const minTime = document.getElementById('minPlayingTime');
//     const maxTime = document.getElementById('maxPlayingTime');
//
// }


