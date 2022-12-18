<template>
  <div class="form-control w-full max-w-2xl align-ls">
    <label class="label">
      <span v-if="state.alert" class="label-text text-red-500">{{
        state.alertString
      }}</span>
      <span v-else-if="state.check" class="label-text">Checking email...</span>
      <span v-else class="label-text">{{ fieldName }}</span>
      <span class="label-text-alt" v-if="secondAlt"
        ><div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-circle btn-ghost btn-xs text-info">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              class="w-4 h-4 stroke-current"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
              ></path>
            </svg>
          </label>
          <div
            tabindex="0"
            class="card compact dropdown-content shadow bg-cyan-100 rounded-box w-64"
          >
            <div class="card-body">
              <p>{{ secondAlt }}</p>
            </div>
          </div>
        </div></span
      >
    </label>

    <input
      @input="validate"
      type="email"
      :placeholder="placeholder"
      class="input-box"
      :name="inputBoxName"
      :class="{ 'input-success': state.success, 'input-error': state.alert }"
      @click="opppsssClicked"
    />
  </div>
</template>

<script setup lang="ts">
// defining store
const studentUserStore = useStudentUserStore();
const formStore = useFormStore();
const formFields = formStore.formFields;

//defining props and emits
const props = defineProps([
  "fieldName",
  "placeholder",
  "secondAlt",
  "inputBoxName",
  "propInputValue",
]);

//defining reactive state
let state = reactive({
  alert: false,
  check: false,
  success: false,
  alertString: "",
});

//behaves weirdly when using :value=propInputValue
// fixing the undefined value caused  because being called early in the lifecycle
let inputBoxElement: HTMLInputElement;
onMounted(async () => {
  inputBoxElement = document.querySelector(
    `input[name=${props.inputBoxName}]`
  ) as HTMLInputElement;
  if (props.propInputValue) {
    inputBoxElement.value = props.propInputValue;
  }
});
//to update the value when propInputValue changes
watch(
  () => props.propInputValue,
  (newValue) => {
    if (newValue) {
      inputBoxElement.value = newValue;
    }
  }
);

//creating validation function
const validate = async function (e: Event) {
  let enterString = "";
  if (e.target) {
    enterString = (e.target as HTMLInputElement).value;
  }

  //using regex to start initial validation
  const validEmail = String(enterString)
    .toLowerCase()
    .match(
      /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    );
  if (!validEmail) {
    state.success = false;
    state.alert = false;
    state.check = false;
    return;
  }

  // to show that we are checking the email through api and using api to validate the deliverability
  state.check = true;
  const res = await fetch(
    `https://api.eva.pingutil.com/email?email=${enterString}`
  );
  const emailValidationResult = await res.json();

  if (res.status === 200) {
    if (emailValidationResult)
      if (!emailValidationResult.data.deliverable) {
        state.alert = true;
        state.alertString =
          "Looks like we can't send email to this address. Check again or try different email.";
        return;
      }
  }
  state.alert = false;
  state.check = false;
  state.success = true;

  formFields.student_email.validated = true;
  studentUserStore.setStudentUserField("student_email", enterString);
  return;
};
const opppsssClicked = async (e: Event) => {
  validate(e);
  (e.target as HTMLInputElement).placeholder = "";
  if (formFields[props.inputBoxName].hasOwnProperty("clicked")) {
    formFields[props.inputBoxName].clicked = true;
  }
};
</script>

<style scoped></style>
