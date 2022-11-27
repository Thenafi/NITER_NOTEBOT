<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <p class="text-xl">Select the template according to your need.</p>
    <br />
    <br />
    <coverCard
      :docID="singleTemplate.id"
      v-for="singleTemplate in templatesList"
    />
  </div>
</template>

<script setup>
//define stores
const coverStore = useCoverStore();

const templatesList = coverStore.templates;
</script>

<style scoped></style>
