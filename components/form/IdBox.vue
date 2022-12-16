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
      @input="validateStudentID"
      type="text"
      :placeholder="placeholder"
      class="input-box"
      :name="inputBoxName"
      :class="{
        'input-success': classState.success,
        'input-error': classState.alert,
      }"
    />
  </div>
</template>

<script setup>
const nuxtApp = useNuxtApp();
//defining stores
const studentUserStore = useStudentUserStore();

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
onMounted(async () => {
  if (props.propInputValue) {
    document.querySelector(`input[name=${props.inputBoxName}]`).value =
      props.propInputValue;
  }
});

//student Id format Validation
const validateStudentID = (e) => {
  const studentID = e.target.value;
  const regex = /[A-Z]{2}-[0-9]{7}/i;
  if (studentID.match(regex)) {
    classState.success = true;
    classState.alert = false;

    studentUserStore.setStudentUserField("student_id", studentID);
    studentUserStore.setStudentUserField("email", studentID + "@student.com");
  } else {
    classState.success = false;
    classState.alert = true;
  }
};
</script>

<style scoped></style>
