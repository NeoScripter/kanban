export default class addBoardHandler {
    addColumnBtnSelector: string;
    addNewColumnInputWrapperSelector: string;
    deleteColumnBtnSelector: string;
    addBoardInputGroupParentSelector: string;

    addBoardForm: HTMLElement | null;
    addBoardBtn: HTMLElement | null;
    addColumnBtn: HTMLElement | null;
    addNewColumnInputWrapper: HTMLElement | null;
    createBoardPopup: HTMLElement | null;
    clonedWrapper: HTMLElement;

    constructor() {
        // Add Board Popup
        this.addBoardForm = document.querySelector('#addBoardForm');
        this.addColumnBtnSelector = '#addNewColBtn';
        this.addNewColumnInputWrapperSelector = '.webform__cat-wrapper';
        this.deleteColumnBtnSelector = '.webform__delete-cat';
        this.addBoardBtn = document.querySelector('#createBoardBtn');
        this.addBoardInputGroupParentSelector = '.webform__input-group--addBoard';
        this.createBoardPopup = document.querySelector('#createBoardPopup');

    }

    init() {
        this.addBoardInitialSetup();
        this.addBoardDeleteBtnEvent();
        this.addBoardAddColumnBtnEvent();
        this.addBoardOpenBtnEvent();
    }

    // Add Board Popup

    addBoardInitialSetup() {
        if (!this.addBoardForm) return

        this.addColumnBtn = this.addBoardForm.querySelector(this.addColumnBtnSelector);
        this.addNewColumnInputWrapper = this.addBoardForm.querySelector(this.addNewColumnInputWrapperSelector);
        this.clonedWrapper = this.addNewColumnInputWrapper?.cloneNode(true) as HTMLElement;
    }

    addBoardDeleteBtnEvent() {
        if (!this.addBoardForm) return

        this.addBoardForm.addEventListener('click', (e) => {
            const targetElement = e.target as HTMLElement | null;
            const deleteButton = targetElement?.closest(this.deleteColumnBtnSelector);
            if (deleteButton) {
                deleteButton.closest(this.addNewColumnInputWrapperSelector)?.remove();
              }
        })
    }

    addBoardAddColumnBtnEvent() {
        if (!this.addColumnBtn || !this.addNewColumnInputWrapper) return

        this.addColumnBtn.addEventListener('click', () => {
            const parentInputGroup = this.addBoardForm?.querySelector(this.addBoardInputGroupParentSelector);
            parentInputGroup?.appendChild(this.clonedWrapper.cloneNode(true));
        })
    }

    addBoardOpenBtnEvent() {
        if (!this.addBoardBtn) return

        this.addBoardBtn.addEventListener('click', () => {
            this.createBoardPopup?.classList.add('overlay--visible');
        })
    }
}
