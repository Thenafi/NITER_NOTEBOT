<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <form
      @submit.prevent="formSubmit"
      id="dataForm"
      action="#"
      method="post"
      class="flex flex-col items-center"
    >
      <FormZeroTextBox username="Your Name" placeholder="Doremon" />
      <br />
      <FormEmailTextBox username="Email" placeholder="doremon@box.com" />
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

const config = useRuntimeConfig();
const apiURL = config.baseURL;

const formSubmit = function (e) {
  console.log(formStore.formIsSubmittable);
  if (!formStore.formIsSubmittable) return;
  const formElement = document.getElementById("dataForm");
  const formData = new FormData(formElement);
  sendData(formData);
};
const sendData = async function (dataToBeSent) {
  const url = apiURL + "/pdfapi";
  const data = await useFetch(url);
  console.log(data);
};
</script>

<style scoped></style>
