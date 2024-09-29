export default class AnimationHandler {
    themeLabels: NodeListOf<HTMLElement>;
    themeCheckboxes: NodeListOf<HTMLInputElement>;

    constructor() {
        // Theme setup
        this.themeLabels = document.querySelectorAll(".header label") as NodeListOf<HTMLElement>;
        this.themeCheckboxes = document.querySelectorAll('.header input[type="checkbox"]') as NodeListOf<HTMLInputElement>;
    }

    init() {
        this.setupTheme();
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
            label.textContent = selectedTheme === "dark" ? "Dark Mode" : "Light Mode";
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
        const prefersDarkScheme = window.matchMedia("(prefers-color-scheme: dark)").matches;

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
