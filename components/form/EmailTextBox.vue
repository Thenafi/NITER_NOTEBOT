<template>
  <div class="form-control w-full max-w-2xl align-ls">
    <label class="label">
      <span v-if="state.alert" class="label-text text-red-500">{{
        state.alert
      }}</span>
      <span v-else-if="state.check" class="label-text">Checking email...</span>
      <span v-else class="label-text">{{ fieldName }}</span>
      <span class="label-text-alt" v-if="secondAlt">{{ secondAlt }}</span>
    </label>

    <input
      @input="validate"
      type="email"
      :placeholder="placeholder"
      class="input-box"
      :class="{ 'input-success': state.success, 'input-error': state.alert }"
    />
  </div>
</template>

<script setup>
// defining store
const formStore = useFormStore();

//defining props and emits
const props = defineProps(["fieldName", "placeholder", "secondAlt"]);

//defining reactive state
let state = reactive({ alert: false, check: false, success: false });

//creating validation function
const validate = async function (e) {
  const enterString = e.target.value;

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
    formStore.updateFormSubmittableState(false);
    return;
  }

  // to show that we are checking the email through api and using api to validate the deliverability
  state.check = true;
  const { data: emailValidationResult } = await $fetch(
    `https://api.eva.pingutil.com/email?email=${enterString}`
  );
  if (!emailValidationResult.deliverable) {
    state.alert =
      "Looks like we can't send email to this address. Check again or try different email.";
    formStore.updateFormSubmittableState(false);
    return;
  }
  state.alert = false;
  state.check = false;
  state.success = true;
  formStore.updateFormSubmittableState(true);
  return;
};
</script>

<style scoped></style>
