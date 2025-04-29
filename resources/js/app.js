import './font';
import './lucide';
import './bootstrap';

import Alpine from 'alpinejs';
import Embla from 'embla-carousel'

window.Alpine = Alpine;
Alpine.start();

const slides = document.querySelector('#slides')
slides && Embla(slides, {
  loop: true,
  align: 'start',
  containScroll: true,
})

const chips = document.querySelector('#chips')
chips && Embla(chips, {
  loop: true,
  align: 'start',
  containScroll: true,
})