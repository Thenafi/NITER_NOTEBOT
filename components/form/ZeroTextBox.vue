<template>
  <div class="form-control w-full max-w-xs">
    <label class="label">
      <span class="label-text">{{ username }}</span>

      <span class="label-text-alt" v-if="secondAlt">{{ secondAlt }}</span>
    </label>
    <input
      type="text"
      :placeholder="placeholder"
      class="input input-bordered bg-white w-full max-w-xs"
    />
  </div>
</template>

<script setup>
defineProps(["username", "placeholder", "secondAlt"]);
</script>

<style scoped></style>
