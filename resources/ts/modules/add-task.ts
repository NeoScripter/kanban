export default class addTaskHandler {
    addSubtaskBtnSelector: string;
    addNewColumnInputWrapperSelector: string;
    deleteColumnBtnSelector: string;
    addTaskInputGroupParentSelector: string;

    addTaskForm: HTMLElement | null;
    addSubtaskBtn: HTMLElement | null;
    addNewColumnInputWrapper: HTMLElement | null;
    createBoardPopup: HTMLElement | null;
    clonedWrapper: HTMLElement;

    constructor() {
        this.addTaskForm = document.querySelector('#addTaskForm');
        this.addSubtaskBtnSelector = '#addNewSubtaskBtn';
        this.addNewColumnInputWrapperSelector = '.webform__cat-wrapper';
        this.deleteColumnBtnSelector = '.webform__delete-cat';
        this.addTaskInputGroupParentSelector = '.webform__input-group--addTask';
        this.createBoardPopup = document.querySelector('#createBoardPopup');

    }

    init() {
        this.addTaskInitialSetup();
        this.addTaskDeleteBtnEvent();
        this.addTaskaddSubtaskBtnEvent();
    }

    addTaskInitialSetup() {
        if (!this.addTaskForm) return

        this.addSubtaskBtn = this.addTaskForm.querySelector(this.addSubtaskBtnSelector);
        this.addNewColumnInputWrapper = this.addTaskForm.querySelector(this.addNewColumnInputWrapperSelector);
        this.clonedWrapper = this.addNewColumnInputWrapper?.cloneNode(true) as HTMLElement;
    }

    addTaskDeleteBtnEvent() {
        if (!this.addTaskForm) return

        this.addTaskForm.addEventListener('click', (e) => {
            const targetElement = e.target as HTMLElement | null;
            const deleteButton = targetElement?.closest(this.deleteColumnBtnSelector);
            if (deleteButton) {
                deleteButton.closest(this.addNewColumnInputWrapperSelector)?.remove();
              }
        })
    }

    addTaskaddSubtaskBtnEvent() {
        if (!this.addSubtaskBtn || !this.addNewColumnInputWrapper) return

        this.addSubtaskBtn.addEventListener('click', () => {
            const parentInputGroup = this.addTaskForm?.querySelector(this.addTaskInputGroupParentSelector);
            parentInputGroup?.appendChild(this.clonedWrapper.cloneNode(true));
        })
    }
}
