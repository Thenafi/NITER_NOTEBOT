type SingleFormFields = {
    clicked: boolean;
    validated?: boolean;
};
type FormFields = {
    [key: string]: SingleFormFields;
};

export const useCoverStore = defineStore("coverStore", {
    state: () => ({
        basicCoverFormFields: {
            type_of_cover: {
                clicked: false,
            },
            course_title: {
                clicked: false,
            },
            course_code: {
                clicked: false,
            },
            student_name: {
                clicked: false,
                validated: false,
            },
            student_id: {
                clicked: false,
                validated: false,
            },
            student_batch: {
                clicked: false,
            },
            student_section: {
                clicked: false,
            },
            student_email: {
                clicked: false,
                validated: false,
            },
            submitted_to: {
                clicked: false,
                validated: false,
            },
            post: {
                clicked: false,
                validated: false,
            },
            teacher_dept: {
                clicked: false,
                validated: false,
            },
        },
        templates: [
            {
                id: "11qhe5jHiKJ1ZvXbtx32NtgiqHHRP-GANXZlLGj3OUQc",
                name: "Template 1",
                image:
                    "https://f000.backblazeb2.com/file/ShareX2022/ShareX/Basic_page-0001.jpg",
                description:
                    "Basic one with course name and code and submission details.",
                type: "cover_page",
                formFields: {} as FormFields,
            },
            {
                id: "1Ahp-NEc9gn_5Ii6CkknRhVbIwKAuokZUTVnYPFdCC9M",
                name: "Template 2",
                image:
                    "https://f000.backblazeb2.com/file/ShareX2022/ShareX/exp%20and%20date_page-0001.jpg",
                description:
                    "Includes Experiment name, code ,date and submission date.",
                type: "cover_page",
                formFields: {
                    experiment_name: {
                        clicked: false,
                    },
                    experiment_no: {
                        clicked: false,
                    },
                    experiment_date: {
                        clicked: false,
                    },
                    submission_date: {
                        clicked: false,
                    },
                } as FormFields,
            },
        ],
        selectedTemplate: "",
    }),
    actions: {
        setTemplate(docID: string) {
            this.selectedTemplate = docID;
            const selection = this.getTemplate(docID); // just for type checking
            if (selection) {
                if (selection.type === "cover_page") {
                    const formStore = useFormStore();
                    (formStore.formFields as FormFields) = {
                        ...this.basicCoverFormFields,
                        ...selection.formFields,
                    };
                }
            }
        },
        getTemplate(docID: string) {
            for (let index = 0; index < this.templates.length; index++) {
                const element = this.templates[index];
                if (element.id === docID) return element;
            }
        },
    },
});
