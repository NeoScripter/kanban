export default class AnimationHandler {
    themeCheckbox: HTMLInputElement | null;

    menuPopupVisibleClassName: string;
    menuPopupBtn: HTMLElement | null;
    menuPopup: HTMLElement | null;

    editBoardPopupVisibleClassName: string;
    editBoardPopupBtn: HTMLElement | null;
    editBoardPopup: HTMLElement | null;

    invisibleSidebarClassName: string;
    sidebarParent: HTMLElement | null;
    hideSidebarBtn: HTMLElement | null;
    showSidebarBtn: HTMLElement | null;

    popups: NodeListOf<HTMLElement> | null;
    popupVisibleClass: string;
    loginBtn: HTMLElement | null;
    signupBtn: HTMLElement | null;
    webformLoginBtn: HTMLElement | null;
    webformSignupBtn: HTMLElement | null;
    loginPopup: HTMLElement | null;
    signupPopup: HTMLElement | null;
    flashMessage: HTMLElement | null;

    loginDashboardBtn: HTMLElement | null;

    deleteBoardBtnPopup: HTMLElement | null;
    deleteBoardPopup: HTMLElement | null;
    cancelDeleteBoardBtn: HTMLElement | null;

    deleteTaskBtnPopup: HTMLElement | null;
    deleteTaskPopup: HTMLElement | null;
    cancelDeleteTaskBtn: HTMLElement | null;

    coloredSpans: NodeListOf<HTMLElement> | null;

    addTaskBtnPopup: HTMLElement | null;
    addTaskPopup: HTMLElement | null;

    editTaskPopup: HTMLElement | null;
    editTaskPopupBtn: HTMLElement | null;

    constructor() {
        // Theme setup
        this.themeCheckbox = document.querySelector("#dark-mode");

        // Menu popup
        this.menuPopupVisibleClassName = "sidebar__overlay--visible";
        this.menuPopup = document.querySelector(".sidebar__overlay");
        this.menuPopupBtn = document.querySelector(".header__board-btn");

        // Edit board popup
        this.editBoardPopupVisibleClassName = "header__board-popup--visible";
        this.editBoardPopupBtn = document.querySelector(".header__dots");
        this.editBoardPopup = document.querySelector(".header__board-popup");

        // Sidebar toggle
        this.invisibleSidebarClassName = "main--no-sidebar";
        this.sidebarParent = document.querySelector(".main");
        this.hideSidebarBtn = document.querySelector(".sidebar__hide-btn");
        this.showSidebarBtn = document.querySelector(".sidebar__show-btn");

        // Popup handler
        this.popups = document.querySelectorAll(".overlay");
        this.popupVisibleClass = "overlay--visible";
        this.loginBtn = document.querySelector("#openLoginPopup");
        this.signupBtn = document.querySelector("#openSignupPopup");
        this.webformLoginBtn = document.querySelector("#webformLoginBtn");
        this.webformSignupBtn = document.querySelector("#webformSignupBtn");
        this.loginPopup = document.querySelector("#overlayLogin");
        this.signupPopup = document.querySelector("#overlaySignup");
        this.flashMessage = document.querySelector(".flash-message");
        this.loginDashboardBtn = document.querySelector("#loginDashboardBtn");

        // Delete Board
        this.deleteBoardBtnPopup = document.querySelector(
            "#deleteBoardPopupBtn"
        );
        this.deleteBoardPopup = document.querySelector("#deleteBoardPopup");
        this.cancelDeleteBoardBtn = document.querySelector(
            "#cancelDeleteBoardBtn"
        );

        // Delete Task
        this.deleteTaskBtnPopup = document.querySelector(
            "#deleteTaskPopupBtn"
        );
        this.deleteTaskPopup = document.querySelector("#deleteTaskPopup");
        this.cancelDeleteTaskBtn = document.querySelector(
            "#cancelDeleteTaskBtn"
        );

        // Colored spans
        this.coloredSpans = document.querySelectorAll(".dashboard__color");

        // Add New Task
        this.addTaskPopup = document.querySelector("#addTaskPopup");
        this.addTaskBtnPopup = document.querySelector("#addNewTaskBtn");

        // Edit Task
        this.editTaskPopup = document.querySelector("#editTaskOverlay");
        this.editTaskPopupBtn = document.querySelector("#editTaskBtn");
    }

    init() {
        this.setupTheme();
        this.toggleMenuPopup();
        this.toggleEditBoardPopup();
        this.toggleSidebar();
        this.setupPopupCloseEvent();
        this.setupSignupPopupEvents();
        this.setupLoginPopupEvents();
        this.fadeOutFlashMessage();
        this.openDeleteBoardPopup();
        this.closeDeleteBoardPopup();
        this.openDeleteTaskPopup();
        this.closeDeleteTaskPopup();
        this.assignColorsToSpans();
        this.openAddTaskPopup();
        this. openEditTaskPopup();
    }

    // Open Add New Task Popup

    openAddTaskPopup() {
        if (!this.addTaskPopup || !this.addTaskBtnPopup) {
            return;
        }

        this.addTaskBtnPopup.addEventListener("click", () => {
            this.addTaskPopup?.classList.add(this.popupVisibleClass);
        });
    }


    // Assign colors to spans

    assignColorsToSpans() {
        const colors = ["#1abc9c", "#3498db", "#9b59b6", "#e74c3c", "#f39c12"];
        let colorIndex = 0;

        if (!this.coloredSpans) return;

        this.coloredSpans.forEach((span) => {
            span.style.backgroundColor = colors[colorIndex % colors.length];
            colorIndex++;
        });
    }

    // Flash Message

    fadeOutFlashMessage() {
        setTimeout(() => {
            if (!this.flashMessage) return;
            this.flashMessage.style.opacity = "0";
        }, 3000);

        setTimeout(() => {
            if (!this.flashMessage) return;
            this.flashMessage.style.display = "none";
        }, 3500);
    }

    // Popup handler

    setupSignupPopupEvents() {
        if (
            !this.signupPopup ||
            !this.signupBtn ||
            !this.webformLoginBtn ||
            !this.menuPopup
        ) {
            return;
        }

        this.menuPopup.addEventListener("click", (e) => {
            const targetElement = e.target as HTMLElement;
            if (targetElement.matches("#openSignupPopup")) {
                this.closeSidebarPopup();
                this.closeAllOtherPopups();
                this.signupPopup?.classList.add(this.popupVisibleClass);
            }
        });

        this.webformLoginBtn.addEventListener("click", () => {
            this.closeSidebarPopup();
            this.closeAllOtherPopups();
            this.signupPopup?.classList.add(this.popupVisibleClass);
        });
    }

    setupLoginPopupEvents() {
        if (
            !this.loginPopup ||
            !this.loginBtn ||
            !this.webformSignupBtn ||
            !this.menuPopup ||
            !this.loginDashboardBtn
        ) {
            return;
        }

        this.menuPopup.addEventListener("click", (e) => {
            const targetElement = e.target as HTMLElement;
            if (targetElement.matches("#openLoginPopup")) {
                this.closeSidebarPopup();
                this.closeAllOtherPopups();
                this.loginPopup?.classList.add(this.popupVisibleClass);
            }
        });

        this.loginDashboardBtn.addEventListener("click", () => {
            this.loginPopup?.classList.add(this.popupVisibleClass);
        });

        this.webformSignupBtn.addEventListener("click", () => {
            this.closeSidebarPopup();
            this.closeAllOtherPopups();
            this.loginPopup?.classList.add(this.popupVisibleClass);
        });
    }

    setupPopupCloseEvent() {
        if (!this.popups) {
            console.warn("Popups are not in the DOM!");
            return;
        }
        this.popups.forEach((popup) => {
            popup.addEventListener("click", (e) => {
                if (e.target === popup) {
                    popup.classList.remove(this.popupVisibleClass);
                }
            });
        });
    }

    // Popup handler helpers

    closeAllOtherPopups() {
        if (!this.popups) {
            console.warn("Popups are not in the DOM!");
            return;
        }
        this.popups.forEach((popup) => {
            popup.classList.remove(this.popupVisibleClass);
        });
    }

    closeSidebarPopup() {
        if (!this.menuPopup) {
            console.warn("Popup is not in the DOM!");
            return;
        }

        this.menuPopup.classList.remove(this.menuPopupVisibleClassName);
    }

    // Menu Popup Toggler

    toggleMenuPopup() {
        if (!this.menuPopup || !this.menuPopupBtn) {
            console.warn("Popup or popup btn are not in the DOM!");
            return;
        }

        this.menuPopupBtn.addEventListener("click", () => {
            this.menuPopup?.classList.toggle(this.menuPopupVisibleClassName);
        });
    }

    // Edit Board Popup Toggler

    toggleEditBoardPopup() {
        if (!this.editBoardPopupBtn || !this.editBoardPopup) {
            console.warn("Popup or popup btn are not in the DOM!");
            return;
        }

        this.editBoardPopupBtn.addEventListener("click", () => {
            this.editBoardPopup?.classList.toggle(
                this.editBoardPopupVisibleClassName
            );
        });
    }

    // Delete Board Popup

    openDeleteBoardPopup() {
        if (!this.deleteBoardBtnPopup || !this.deleteBoardPopup) {
            return;
        }

        this.deleteBoardBtnPopup.addEventListener("click", () => {
            this.deleteBoardPopup?.classList.add(this.popupVisibleClass);
        });
    }

    closeDeleteBoardPopup() {
        if (!this.cancelDeleteBoardBtn || !this.deleteBoardPopup) {
            return;
        }

        this.cancelDeleteBoardBtn.addEventListener("click", () => {
            this.deleteBoardPopup?.classList.remove(this.popupVisibleClass);
        });
    }

    // Delete Task Popup

    openDeleteTaskPopup() {
        if (!this.deleteTaskBtnPopup || !this.deleteTaskPopup) {
            return;
        }

        this.deleteTaskBtnPopup.addEventListener("click", () => {
            this.closeAllOtherPopups();
            this.deleteTaskPopup?.classList.add(this.popupVisibleClass);
        });
    }

    closeDeleteTaskPopup() {
        if (!this.cancelDeleteTaskBtn || !this.deleteTaskPopup) {
            return;
        }

        this.cancelDeleteTaskBtn.addEventListener("click", () => {
            this.deleteTaskPopup?.classList.remove(this.popupVisibleClass);
        });
    }

    // Edit Task Popup

    openEditTaskPopup() {
        if (!this.editTaskPopupBtn || !this.editTaskPopup) {
            return;
        }

        this.editTaskPopupBtn.addEventListener("click", () => {
            this.closeAllOtherPopups();
            this.editTaskPopup?.classList.add(this.popupVisibleClass);
        });
    }

    // Edit Board Popup Toggler

    toggleSidebar() {
        if (
            !this.sidebarParent ||
            !this.hideSidebarBtn ||
            !this.showSidebarBtn
        ) {
            console.warn("Sidebar btns or sidebar parents are not in the DOM!");
            return;
        }

        this.showSidebarBtn.addEventListener("click", () => {
            this.sidebarParent?.classList.remove(
                this.invisibleSidebarClassName
            );
        });

        this.hideSidebarBtn.addEventListener("click", () => {
            this.sidebarParent?.classList.add(this.invisibleSidebarClassName);
        });
    }

    // Theme setup

    setupTheme() {
        if (!this.themeCheckbox) return;
        this.checkThemePreference();
        this.applySavedTheme();
        this.themeCheckbox.addEventListener("change", () => {
            const selectedTheme = this.themeCheckbox?.checked
                ? "dark"
                : "light";
            localStorage.setItem("theme", selectedTheme);
            this.applyTheme(selectedTheme);
        });
    }

    // Theme setup helpers

    applyTheme(selectedTheme: string) {
        if (!this.themeCheckbox) return;
        if (selectedTheme === "dark") {
            document.body.setAttribute("data-theme", "dark");
            this.themeCheckbox.checked = true;
        } else {
            document.body.setAttribute("data-theme", "light");
            this.themeCheckbox.checked = false;
        }
    }

    checkThemePreference() {
        if (!this.themeCheckbox) return;
        const prefersDarkScheme = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;

        if (prefersDarkScheme) {
            this.themeCheckbox.checked = true;
        }
    }

    applySavedTheme() {
        if (!this.themeCheckbox) return;
        const savedTheme = localStorage.getItem("theme") || "light";
        this.applyTheme(savedTheme);
    }
}
