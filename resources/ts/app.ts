import "./bootstrap";

import AnimationHandler from "./modules/animation";
import PopupHandler from "./modules/popups";

document.addEventListener("DOMContentLoaded", () => {
    const animationHandler = new AnimationHandler();
    animationHandler.init();
    const popupHandler = new PopupHandler();
    popupHandler.init();
});


