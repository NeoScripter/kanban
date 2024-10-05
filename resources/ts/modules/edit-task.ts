export default class editTaskHandler {
    editSubtaskBtnSelector: string;
    addNewColumnInputWrapperSelector: string;
    deleteColumnBtnSelector: string;
    editTaskInputGroupParentSelector: string;

    editTaskForm: HTMLElement | null;
    editSubtaskBtn: HTMLElement | null;
    addNewColumnInputWrapper: HTMLElement | null;
    createBoardPopup: HTMLElement | null;
    clonedWrapper: HTMLElement;

    constructor() {
        this.editTaskForm = document.querySelector('#editTaskForm');
        this.editSubtaskBtnSelector = '#addNewSubtaskBtnEdit';
        this.addNewColumnInputWrapperSelector = '.webform__cat-wrapper';
        this.deleteColumnBtnSelector = '.webform__delete-cat';
        this.editTaskInputGroupParentSelector = '.webform__input-group--editTask';
        this.createBoardPopup = document.querySelector('#createBoardPopup');

    }

    init() {
        this.editTaskInitialSetup();
        this.editTaskDeleteBtnEvent();
        this.editTaskeditSubtaskBtnEvent();
    }

    editTaskInitialSetup() {
        if (!this.editTaskForm) return

        this.editSubtaskBtn = this.editTaskForm.querySelector(this.editSubtaskBtnSelector);
        this.addNewColumnInputWrapper = this.editTaskForm.querySelector(this.addNewColumnInputWrapperSelector);
        this.clonedWrapper = this.addNewColumnInputWrapper?.cloneNode(true) as HTMLElement;
        this.clonedWrapper.querySelector('input')!.value = '';
    }

    editTaskDeleteBtnEvent() {
        if (!this.editTaskForm) return

        this.editTaskForm.addEventListener('click', (e) => {
            const targetElement = e.target as HTMLElement | null;
            const deleteButton = targetElement?.closest(this.deleteColumnBtnSelector);
            if (deleteButton) {
                deleteButton.closest(this.addNewColumnInputWrapperSelector)?.remove();
              }
        })
    }

    editTaskeditSubtaskBtnEvent() {
        if (!this.editSubtaskBtn || !this.addNewColumnInputWrapper) return

        this.editSubtaskBtn.addEventListener('click', () => {
            const parentInputGroup = this.editTaskForm?.querySelector(this.editTaskInputGroupParentSelector);
            parentInputGroup?.appendChild(this.clonedWrapper.cloneNode(true));
        })
    }
}
