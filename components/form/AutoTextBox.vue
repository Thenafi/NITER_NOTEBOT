<template>
  <div class="form-control w-full max-w-2xl">
    <label class="label">
      <span class="label-text">{{ fieldName }}</span>
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
      type="text"
      :placeholder="placeholder"
      class="input-box"
      :name="inputBoxName"
      @click="opppsssClicked"
    />
  </div>
</template>

<script setup>
//defining stores
const formStore = useFormStore();
const formFields = formStore.formFields;

const props = defineProps([
  "fieldName",
  "placeholder",
  "secondAlt",
  "inputBoxName",
  "propInputValue",
  "minimumLength",
  "maximumLength",
]);

//behaves weirdly when using :value=propInputValue
// fixing the undefined value caused  because being called early in the lifecycle
let inputBoxElement;
onMounted(async () => {
  inputBoxElement = document.querySelector(`input[name=${props.inputBoxName}]`);
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

let minimumInputLength = 1;
if (props.minimumLength) {
  minimumInputLength = props.minimumLength;
}
let maximumInputLength = 10000;
if (props.maximumLength) {
  maximumInputLength = props.maximumLength;
}

// validate the input length at least 1  and if the formFields with the inputBoxName has the validate property set to true
const validate = () => {
  const input = document.querySelector(`input[name=${props.inputBoxName}]`);
  console.log(formFields[props.inputBoxName].hasOwnProperty("validated"));
  if (
    input.value.length > minimumInputLength &&
    input.value.length < maximumInputLength &&
    formFields[props.inputBoxName].hasOwnProperty("validated")
  ) {
    formFields[props.inputBoxName].validated = true;
  }
};

const opppsssClicked = async (e) => {
  validate(e);
  e.target.placeholder = "";
  if (formFields[props.inputBoxName].hasOwnProperty("clicked")) {
    formFields[props.inputBoxName].clicked = true;
  }
};
</script>

<style scoped></style>
