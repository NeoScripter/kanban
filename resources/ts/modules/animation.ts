export default class AnimationHandler {
    themeLabels: NodeListOf<HTMLElement>;
    themeCheckboxes: NodeListOf<HTMLInputElement>;

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

    constructor() {
        // Theme setup
        this.themeLabels = document.querySelectorAll(
            ".header label"
        ) as NodeListOf<HTMLElement>;
        this.themeCheckboxes = document.querySelectorAll(
            '.header input[type="checkbox"]'
        ) as NodeListOf<HTMLInputElement>;

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
    }

    init() {
        this.setupTheme();
        this.toggleMenuPopup();
        this.toggleEditBoardPopup();
        this.toggleSidebar();
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

    // Edit Board Popup Toggler

    toggleSidebar() {
        if (!this.sidebarParent || !this.hideSidebarBtn || !this.showSidebarBtn) {
            console.warn("Sidebar btns or sidebar parents are not in the DOM!");
            return;
        }

        this.showSidebarBtn.addEventListener("click", () => {
            this.sidebarParent?.classList.remove(
                this.invisibleSidebarClassName
            );
        });

        this.hideSidebarBtn.addEventListener("click", () => {
            this.sidebarParent?.classList.add(
                this.invisibleSidebarClassName
            );
        });
    }

    // Theme setup

    setupTheme() {
        this.checkThemePreference();
        this.applySavedTheme();
        this.themeCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", () => {
                const selectedTheme = checkbox.checked ? "dark" : "light";
                localStorage.setItem("theme", selectedTheme);
                this.applyTheme(selectedTheme);
            });
        });
    }

    // Theme setup helpers

    changeLabelContent(selectedTheme: string) {
        this.themeLabels.forEach((label) => {
            label.textContent =
                selectedTheme === "dark" ? "Dark Mode" : "Light Mode";
        });
    }

    applyTheme(selectedTheme: string) {
        if (selectedTheme === "dark") {
            document.body.setAttribute("data-theme", "dark");
            this.themeCheckboxes.forEach((checkbox) => {
                checkbox.checked = true;
            });
            this.changeLabelContent("dark");
        } else {
            document.body.setAttribute("data-theme", "light");
            this.themeCheckboxes.forEach((checkbox) => {
                checkbox.checked = false;
            });
            this.changeLabelContent("light");
        }
    }

    checkThemePreference() {
        const prefersDarkScheme = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;

        if (prefersDarkScheme) {
            this.themeCheckboxes.forEach((checkbox) => {
                checkbox.checked = true;
            });
            this.changeLabelContent("dark");
        }
    }

    applySavedTheme() {
        const savedTheme = localStorage.getItem("theme") || "light";
        this.applyTheme(savedTheme);
        this.changeLabelContent(savedTheme);
    }
}
