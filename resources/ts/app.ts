import './bootstrap';

import AnimationHandler from './modules/animation';

document.addEventListener('DOMContentLoaded', () => {
    const animationHandler = new AnimationHandler;
    animationHandler.init();
})
