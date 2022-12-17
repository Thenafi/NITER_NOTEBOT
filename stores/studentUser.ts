type StudentUser = {
    student_id: string;
    student_name: string;
    student_email?: string;
    student_batch: string;
    student_section?: string;
    student_dept?: string;
};
import { useStorage } from "@vueuse/core";

export const useStudentUserStore = defineStore("studentUserStore", {
    state: () => ({
        studentUser: ref(
            useStorage("student-user", {
                student_id: "",
                student_name: "",
                student_email: "",
                student_batch: "",
                student_section: "",
                student_dept: "",

            })
        ),
    }),
    getters: {
        getStudentUser: (state) => state.studentUser,
    },
    actions: {
        setStudentUserField(field: keyof StudentUser, value: any) {
            this.studentUser[field] = value;
        }


    },
});
