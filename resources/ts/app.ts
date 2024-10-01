import "./bootstrap";

import AnimationHandler from "./modules/animation";
import addBoardHandler from "./modules/add-board";
import EditBoardHandler from "./modules/edit-board";
import addTaskHandler from "./modules/add-task";

document.addEventListener("DOMContentLoaded", () => {
    const animationHandler = new AnimationHandler();
    animationHandler.init();
    const newBoardHandler = new addBoardHandler();
    newBoardHandler.init();
    const currentBoardHandler = new EditBoardHandler();
    currentBoardHandler.init();
    const newTaskHandler = new addTaskHandler();
    newTaskHandler.init();
});


