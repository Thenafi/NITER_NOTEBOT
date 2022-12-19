<template>
  {{ placeholder }}
</template>

<script setup lang="ts">
const placeholder = ref(".");

// add 1 dot every 1 second until 5 dots then rest to 1 dot
let interval = setInterval(() => {
  if (placeholder.value.length < 5) {
    placeholder.value += ".";
  } else {
    placeholder.value = ".";
  }
}, 1000);
</script>

<style scoped></style>
