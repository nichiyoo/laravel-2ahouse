import './font';
import './lucide';
import './bootstrap';

import alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import embla from 'embla-carousel'

window.Alpine = alpine;
alpine.plugin(focus);
alpine.start();

const slides = document.querySelector('#slides')
slides && embla(slides, {
  loop: true,
  align: 'start',
  containScroll: true,
})

const chips = document.querySelector('#chips')
chips && embla(chips, {
  loop: true,
  align: 'start',
  containScroll: true,
})