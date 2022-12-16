type StudentUser = {
    student_id: string;
    student_name: string;
    email?: string;
    batch: string;
    section?: string;
    dept?: string;
};
import { useStorage } from "@vueuse/core";

export const useStudentUserStore = defineStore("studentUserStore", {
    state: () => ({
        studentUser: ref(
            useStorage("student-user", {
                student_id: "",
                student_name: "",
                email: "",
                batch: "",
                section: "",
                dept: "",

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
