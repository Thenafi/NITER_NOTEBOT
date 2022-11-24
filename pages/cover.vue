<template>
  <div class="p-10 m-5 bg-white rounded-3xl">
    <form @submit.prevent="formSubmit" id="dataForm" action="#" method="post">
      <FormZeroTextBox username="Your Name" placeholder="Doremon" />
      <br />
      <FormEmailTextBox username="Email" placeholder="doremon@box.com" />
      <input
        class="btn"
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
