<template>
  <div class="form-control w-full max-w-2xl">
    <label class="label">
      <span class="label-text">{{ username }}</span>

      <span class="label-text-alt" v-if="secondAlt">{{ secondAlt }}</span>
    </label>
    <input type="text" :placeholder="placeholder" class="input-box" />
  </div>
</template>

<script setup>
defineProps(["username", "placeholder", "secondAlt"]);
</script>

<style scoped></style>
