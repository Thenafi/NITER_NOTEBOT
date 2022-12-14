<template>
  <div class="form-control w-full max-w-2xl">
    <label class="label">
      <span class="label-text">{{ fieldName }}</span>

      <span class="label-text-alt" v-if="secondAlt">{{ secondAlt }}</span>
    </label>
    <input
      type="text"
      :placeholder="placeholder"
      class="input-box"
      :name="inputBoxName"
      value=""
      @click="(e) => (e.target.placeholder = '')"
    />
  </div>
</template>

<script setup>
defineProps(["fieldName", "placeholder", "secondAlt", "inputBoxName"]);
</script>

<style scoped></style>
