<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <form
      id="dataForm"
      action="#"
      method="post"
      class="flex flex-col items-center space-y-5"
      autocomplete="off"
    >
      <div class="tooltip self-end" data-tip="Clear All Fields ">
        <button
          @click.prevent="clearingAllFields"
          class="btn btn-sm btn-circle btn-outline"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>
      <div
        v-if="!firstTimeCoverGenerator"
        class="alert alert-warning max-w-2xl"
      >
        <div>
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="stroke-current flex-shrink-0 h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
            />
          </svg>
          <span
            >It's mandatory to touch or click every field at least once.</span
          >
        </div>
      </div>
      <FormIdBox
        v-if="formStore.formFields.student_id"
        fieldName="Your ID"
        placeholder="TE-1808036"
        inputBoxName="student_id"
        :propInputValue="studentUser.student_id"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.student_batch"
        fieldName="Your Batch"
        placeholder="8|9|10"
        inputBoxName="student_batch"
        :propInputValue="studentUser.student_batch"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.student_name"
        fieldName="Your Name"
        placeholder="Doremon"
        inputBoxName="student_name"
        :propInputValue="studentUser.student_name"
      />
      <FormEmailTextBox
        v-if="formStore.formFields.student_email"
        fieldName="Your Email"
        placeholder="doremon@box.com"
        inputBoxName="student_email"
        secondAlt="We prefer gmail. Don't put your college email."
        :prop-input-value="studentUser.student_email"
      />
      <FormInputGrpBox
        v-if="formStore.formFields.student_section"
        fieldName="Your Section"
        placeholder="A | B | C"
        inputBoxName="student_section"
        secondAlt="Leave a space if you want it to blank. Then the whole section part will be removed from the cover. We will automatically add the 'Section:' before the section name. So, if you put 'A' here, it will be 'Section: A'"
        inputGroupSpan="Section:"
        :propInputValue="studentUser.student_section"
      />
      <FormAutoTextBox
        v-if="formStore.formFields.type_of_cover"
        fieldName="Type of Cover"
        placeholder="Assignment | Lab Report"
        inputBoxName="type_of_cover"
        secondAlt="Leave a space if you want it to blank."
      />

      <FormZeroTextBox
        v-if="formStore.formFields.course_title"
        fieldName="Course Title"
        placeholder="Doremon 101"
        inputBoxName="course_title"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.course_code"
        fieldName="Course Code"
        placeholder="DOR-101"
        inputBoxName="course_code"
      />

      <FormZeroTextBox
        v-if="formStore.formFields.experiment_date"
        fieldName="Experiment Date"
        placeholder="23-2-2102"
        inputBoxName="experiment_date"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.submission_date"
        fieldName="Submission Date"
        placeholder="30-2-2102"
        inputBoxName="submission_date"
      />

      <FormZeroTextBox
        v-if="formStore.formFields.experiment_no"
        fieldName="Experiment no"
        placeholder="1 | 2 | 3"
        inputBoxName="experiment_no"
      />

      <FormZeroTextBox
        v-if="formStore.formFields.experiment_name"
        fieldName="Experiment Title"
        placeholder="Doremon's First Take-copter Ride"
        inputBoxName="experiment_name"
      />

      <FormZeroTextBox
        v-if="formStore.formFields.submitted_to"
        fieldName="Submitted To"
        placeholder="Nobita Nobi"
        inputBoxName="submitted_to"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.designation"
        fieldName="Designation"
        placeholder="Professor | Lecturer"
        inputBoxName="designation"
      />
      <FormZeroTextBox
        v-if="formStore.formFields.teacher_department"
        fieldName="Teacher's Department"
        placeholder="Department of Gadgets"
        inputBoxName="teacher_department"
      />

      <button
        id="submitButtonId"
        type="submit"
        class="btn w-full mt-7 max-w-2xl"
        @click.prevent="formSubmit"
      >
        {{ buttonState }}
      </button>

      <NuxtLink
        class="btn w-full mt-7 max-w-2xl"
        v-if="downloadLink"
        :href="downloadLink"
        :external="true"
        download
        >Download</NuxtLink
      >
    </form>
  </div>
</template>

<script setup lang="ts">
// defining store
const formStore = useFormStore();
const coverStore = useCoverStore();
const studentUserStore = useStudentUserStore();
const studentUser = studentUserStore.studentUser;

//button State
const buttonState = ref("Submit");
const downloadLink = ref(null) as any;

const config = useRuntimeConfig();
const apiURL = config.baseURL;

if (!coverStore.selectedTemplate) {
  await navigateTo("/cover");
}

//submit button declaration
let submitButton: HTMLInputElement;
onMounted(() => {
  submitButton = document.getElementById("submitButtonId") as HTMLInputElement;
});

const formSubmit = function () {
  console.log("Form submission started");
  //Loading state showing
  submitButton.classList.toggle("loading");
  buttonState.value = "Checking...";

  //checking all inputFields If that can't be empty and if any of them is empty then show an alert
  for (const [
    inputNameKey,
    anotherObjectInsideFormFieldObject,
  ] of Object.entries(formStore.formFields)) {
    const inputHmlElement = document.querySelector(
      `input[name=${inputNameKey}]`
    ) as HTMLInputElement | null;
    if (inputHmlElement) {
      //specific validation from the formFields objects
      if ("validated" in anotherObjectInsideFormFieldObject) {
        if (!anotherObjectInsideFormFieldObject.validated) {
          console.log(`${inputNameKey} is not valid`);
          buttonState.value = `One of major field is not validated ${inputNameKey}`;
          submitButton.classList.toggle("loading");
          submitButton.classList.add("btn-error");
          return;
        }
      }

      if ("clicked" in anotherObjectInsideFormFieldObject) {
        if (!anotherObjectInsideFormFieldObject.clicked) {
          console.log(`${inputNameKey} is not valid`);
          buttonState.value = `Some or more field is not clicked  ${inputNameKey}`;
          submitButton.classList.toggle("loading");
          submitButton.classList.add("btn-error");
          return;
        }
      }
    }
  }

  //creating form data and cleaning whitespaces
  const formElement = document.getElementById("dataForm") as HTMLFormElement;
  if (formElement) {
    const formData = new FormData(formElement);

    //Cleaning whitespaces from the form data
    formData.forEach((value, key) => {
      if (typeof value == "string") formData.set(key, value.trim());
    });

    //Reformatting the section name in case of handling when the user has no section
    if (formData.get("student_section") == "") {
      formData.set("student_section", "");
    } else
      formData.set(
        "student_section",
        "Section: " + formData.get("student_section")
      );

    //adding doc id
    formData.set("docID", coverStore.selectedTemplate);
    //submission part
    submitButton.classList.remove("btn-error");
    buttonState.value = "Generating...";
    sendData(formData);
  }
};

//sending data to the server
const sendData = async function (dataToBeSent: FormData) {
  const url = apiURL + "/pdfapi/create";
  const { data, pending, error } = await useFetch(url, {
    method: "POST",
    body: dataToBeSent,
  });

  console.log(data.value);
  const response: any = data.value;
  if (error.value) {
    buttonState.value =
      "Error in server side. Please try again later or report.";
    submitButton.classList.add("btn-error");
    submitButton.classList.toggle("loading");
  }
  if (data.value) {
    downloadLink.value = response.pdfUrl;
    buttonState.value = "Generated";
    submitButton.classList.add("btn-success");
    submitButton.classList.toggle("loading");
    useLazyFetch("/api/covercount?type=increment");
  }
};

//setting up alerts for first timers and useCookie to store the cookie
const firstTimeCoverGenerator = useCookie("firstTimeCoverGenerator", {
  maxAge: 60 * 60 * 24 * 30,
});
if (firstTimeCoverGenerator.value == null) {
  //wait for 1 second after rendering the page then set the value to true
  setTimeout(() => {
    firstTimeCoverGenerator.value = "true";
  }, 30000);
}

//clearing
const clearingAllFields = () => {
  const allInputFields = document.querySelectorAll("input");
  allInputFields.forEach((inputField) => {
    inputField.value = "";
  });
};
</script>

<style scoped></style>
