export const useFormStore = defineStore('formStore', {
    state: () => ({
        formIsSubmittable: false
    }),
    actions: {
        updateFormSubmittableState(value: boolean) {
            this.formIsSubmittable = value
        }
    }
})

