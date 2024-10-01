import "./bootstrap";

import AnimationHandler from "./modules/animation";
import addBoardHandler from "./modules/add-board";
import editBoardHandler from "./modules/edit-board";

document.addEventListener("DOMContentLoaded", () => {
    const animationHandler = new AnimationHandler();
    animationHandler.init();
    const newBoardHandler = new addBoardHandler();
    newBoardHandler.init();
    const currentBoardHandler = new editBoardHandler();
    currentBoardHandler.init();
});


