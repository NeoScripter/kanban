export default class editBoardHandler {
    addColumnBtnSelector: string;
    addNewColumnInputWrapperSelector: string;
    deleteColumnBtnSelector: string;
    editBoardInputGroupParentSelector: string;

    addBoardForm: HTMLElement | null;
    editBoardForm: HTMLElement | null;
    editBoardBtn: HTMLElement | null;
    addColumnBtn: HTMLElement | null;
    addNewColumnInputWrapper: HTMLElement | null;
    editBoardPopup: HTMLElement | null;
    clonedWrapper: HTMLElement;
    addNewColumnDashboardBtn: HTMLElement | null;


    constructor() {
        // Add Board Popup
        this.addBoardForm = document.querySelector('#addBoardForm');
        this.editBoardForm = document.querySelector('#editBoardForm');
        this.addColumnBtnSelector = '#addNewColBtn';
        this.addNewColumnInputWrapperSelector = '.webform__cat-wrapper';
        this.deleteColumnBtnSelector = '.webform__delete-cat';
        this.editBoardBtn = document.querySelector('#createBoardBtn');
        this.editBoardInputGroupParentSelector = '.webform__input-group--editBoard';
        this.editBoardPopup = document.querySelector('#editBoardPopup');
        this.editBoardBtn = document.querySelector('#editBoardBtn');
        this.addNewColumnDashboardBtn = document.querySelector('#addNewColumnDashboardBtn');

    }

    init() {
        this.editBoardInitialSetup();
        this.editBoardDeleteBtnEvent();
        this.editBoardAddColumnBtnEvent();
        this.editBoardOpenBtnEvent();
    }

    // Add Board Popup

    editBoardInitialSetup() {
        if (!this.editBoardForm || !this.addBoardForm) return

        this.addColumnBtn = this.editBoardForm.querySelector(this.addColumnBtnSelector);
        this.addNewColumnInputWrapper = this.addBoardForm.querySelector(this.addNewColumnInputWrapperSelector);
        this.clonedWrapper = this.addNewColumnInputWrapper?.cloneNode(true) as HTMLElement;
        this.clonedWrapper.querySelector('input')!.value = '';
    }

    editBoardDeleteBtnEvent() {
        if (!this.editBoardForm) return

        this.editBoardForm.addEventListener('click', (e) => {
            const targetElement = e.target as HTMLElement | null;
            const deleteButton = targetElement?.closest(this.deleteColumnBtnSelector);
            if (deleteButton) {
                deleteButton.closest(this.addNewColumnInputWrapperSelector)?.remove();
              }
        })
    }

    editBoardAddColumnBtnEvent() {
        if (!this.addColumnBtn || !this.addNewColumnInputWrapper) return

        this.addColumnBtn.addEventListener('click', () => {
            const parentInputGroup = this.editBoardForm?.querySelector(this.editBoardInputGroupParentSelector);
            parentInputGroup?.appendChild(this.clonedWrapper.cloneNode(true));
        })
    }

    editBoardOpenBtnEvent() {
        if (!this.editBoardBtn || !this.addNewColumnDashboardBtn) return

        this.editBoardBtn.addEventListener('click', () => {
            this.editBoardPopup?.classList.add('overlay--visible');
        })

        this.addNewColumnDashboardBtn.addEventListener('click', () => {
            this.editBoardPopup?.classList.add('overlay--visible');
        })
    }
}
