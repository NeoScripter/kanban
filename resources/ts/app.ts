import "./bootstrap";

import AnimationHandler from "./modules/animation";

document.addEventListener("DOMContentLoaded", () => {
    const animationHandler = new AnimationHandler();
    animationHandler.init();
/*     handleFlashMessage('loginSuccess', 'Logged in successfully!');
    handleFlashMessage('logoutSuccess', 'Logged out successfully!'); */
});


function handleFlashMessage(eventName, successMessage) {
    window.addEventListener(eventName, () => {
        document.querySelectorAll(".overlay").forEach((el) => {
            el.classList.remove("overlay--visible");
        });

        const flashMessage: HTMLElement | null = document.querySelector(".flash-message");
        if (flashMessage) {
            flashMessage.style.display = "block";
            flashMessage.textContent = successMessage;

            setTimeout(() => {
                flashMessage.style.opacity = "0";
            }, 3000);

            setTimeout(() => {
                flashMessage.style.display = "none";
                flashMessage.textContent = "";
            }, 3500);
        }
    });
}
