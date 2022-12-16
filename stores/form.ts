type SingleFormFields = {
    clicked: boolean;
    lengthValid?: boolean;
};
type FormFields = {
    [key: string]: SingleFormFields;
};

export const useFormStore = defineStore("formStore", {
    state: () => ({
        formIsSubmittable: false,
        formFields: {} as FormFields,
    }),
    actions: {
        updateFormSubmittableState(value: boolean) {
            this.formIsSubmittable = value;
        },
    },
    getters: {
        getFormSubmittableState() {
            //check if formFields is empty if npt then  run rest of the code
            if (Object.keys(this.formFields).length !== 0) {
                //check if all form fields has has true value for lengthValid amd clicked
                for (const key in this.formFields) {
                    if (
                        this.formFields[key].lengthValid === false ||
                        this.formFields[key].clicked === false
                    ) {
                        return false;
                    }
                }
                return true;



            } else {
                return false;
            }
        },
    },
});
