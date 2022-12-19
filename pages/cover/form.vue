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
        fieldName="Your ID"
        placeholder="TE-1808036"
        inputBoxName="student_id"
        :propInputValue="studentUser.student_id"
      />
      <FormZeroTextBox
        fieldName="Your Batch"
        placeholder="8|9|10"
        inputBoxName="student_batch"
        :propInputValue="studentUser.student_batch"
      />

      <FormZeroTextBox
        fieldName="Your Name"
        placeholder="Doremon"
        inputBoxName="student_name"
        :propInputValue="studentUser.student_name"
      />

      <FormEmailTextBox
        fieldName="Your Email"
        placeholder="doremon@box.com"
        inputBoxName="student_email"
        secondAlt="We prefer gmail. Don't put your college email."
        :prop-input-value="studentUser.student_email"
      />
      <FormAutoTextBox
        fieldName="Type of Cover"
        placeholder="Assignment | Lab Report"
        inputBoxName="type_of_cover"
        secondAlt="Leave a space if you want it to blank."
      />
      <FormInputGrpBox
        fieldName="Your Section"
        placeholder="A | B | C"
        inputBoxName="student_section"
        secondAlt="Leave a space if you want it to blank. Then the whole section part will be removed from the cover. We will automatically add the 'Section:' before the section name. So, if you put 'A' here, it will be 'Section: A'"
        inputGroupSpan="Section:"
        :propInputValue="studentUser.student_section"
      />
      <button
        id="submitButtonId"
        type="submit"
        class="btn w-full mt-7 max-w-2xl"
        @click.prevent="formSubmit"
      >
        {{ buttonState }}
      </button>
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

const config = useRuntimeConfig();
const apiURL = config.baseURL;

if (!coverStore.selectedTemplate) {
  await navigateTo("/cover");
}

coverStore.$reset();

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

    //submission part
    submitButton.classList.remove("btn-error");
    buttonState.value = "Generating...";
    sendData(formData);
  }
};

//sending data to the server
const sendData = async function (dataToBeSent: FormData) {
  const url = apiURL + "/console";
  const { data } = await useFetch(url, {
    method: "POST",
    body: dataToBeSent,
  });
  console.log(data.value);

  buttonState.value = "Generated";
  submitButton.classList.toggle("loading");
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
