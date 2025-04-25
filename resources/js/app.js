import './font';
import './lucide';
import './bootstrap';
import Alpine from 'alpinejs';
import Embla from 'embla-carousel'
import ClassNames from 'embla-carousel-class-names';
import Autoplay from 'embla-carousel-autoplay';

window.Alpine = Alpine;
Alpine.start();

// embla plugins
// const classnames = ClassNames()
// const autoplay = Autoplay({
//   delay: 3000,
//   playOnInit: true,
//   stopOnMouseEnter: true,
// })

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