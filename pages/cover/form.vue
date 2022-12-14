<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <form
      @submit.prevent="formSubmit"
      id="dataForm"
      action="#"
      method="post"
      class="flex flex-col items-center space-y-5"
    >
      <FormZeroTextBox
        fieldName="Your Name"
        placeholder="Doremon"
        input-box-name="student_name"
      />

      <FormEmailTextBox
        fieldName="Email"
        placeholder="doremon@box.com"
        input-box-name="email"
      />
      <FormAutoTextBox
        fieldName="Type of Cover"
        placeholder="Assignment | Lab Report"
        inputBoxName="type_of_cover"
      />
      <input
        class="btn w-full mt-7 max-w-2xl"
        type="submit"
        value="Submit"
        :class="{ 'btn-disabled': !formStore.formIsSubmittable }"
      />
    </form>
  </div>
</template>

<script setup>
// defining store
const formStore = useFormStore();
const coverStore = useCoverStore();

const config = useRuntimeConfig();
const apiURL = config.baseURL;

const formSubmit = function (e) {
  console.log(formStore.formIsSubmittable);
  if (!formStore.formIsSubmittable) return; // if form is not submittable, return
  const formElement = document.getElementById("dataForm");
  const formData = new FormData(formElement);
  sendData(formData);
};
const sendData = async function (dataToBeSent) {
  const url = apiURL + "/console";
  const data = await useFetch(url);
  console.log(data);
};
</script>

<style scoped></style>
