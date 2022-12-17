<template>
  <div class="form-control w-full max-w-2xl">
    <label class="label">
      <span class="label-text">{{ fieldName }}</span>
      <span class="label-text-alt" v-if="secondAlt">
        <div class="dropdown dropdown-end">
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
        </div>
      </span>
    </label>
    <input
      @input="validate"
      type="text"
      :placeholder="placeholder"
      class="input-box"
      :name="inputBoxName"
      :class="{
        'input-success': classState.success,
        'input-error': classState.alert,
      }"
      @click="opppsssClicked"
    />
  </div>
</template>

<script setup lang="ts">
//defining stores
const studentUserStore = useStudentUserStore();
const formStore = useFormStore();
const formFields = formStore.formFields;

const props = defineProps([
  "fieldName",
  "placeholder",
  "secondAlt",
  "inputBoxName",
  "propInputValue",
]);
//defining reactive state
let classState = reactive({ alert: false, success: false });

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

//student Id format Validation
const validate = async (e: Event) => {
  const studentID = (e.target as HTMLInputElement).value;
  const regex = /[A-Z]{2}-[0-9]{7}$/i;
  if (studentID.match(regex)) {
    classState.success = true;
    classState.alert = false;

    const batch = batchFinder(studentID);
    formFields.student_id.validated = true;
    studentUserStore.setStudentUserField("student_batch", batch);
    studentUserStore.setStudentUserField("student_id", studentID);
  } else {
    classState.success = false;
    classState.alert = true;
  }
};

const batchFinder = (value: string) => {
  type listOfYearsWithBatches = {
    [key: number]: string;
  };
  let ls = {} as listOfYearsWithBatches;
  let year = 10;
  let bt = 0;
  //making all the batches
  for (let i = 0; i < 50; i++) {
    ls[year++] = `${bt + i}`;
  }
  const firstTwoDigits = +(value[3] + value[4]);
  const batch = +ls[firstTwoDigits];

  function ordinal_suffix_of(i: number) {
    var j = i % 10,
      k = i % 100;
    if (j == 1 && k != 11) {
      return i + " st";
    }
    if (j == 2 && k != 12) {
      return i + " nd";
    }
    if (j == 3 && k != 13) {
      return i + " rd";
    }
    return i + " th";
  }

  const batchWithSuffix = ordinal_suffix_of(batch);
  return batchWithSuffix;
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
