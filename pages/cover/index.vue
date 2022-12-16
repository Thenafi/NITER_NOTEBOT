<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <br />
    <div class="flex justify-center space-x-2 lg:space-x-8">
      <NuxtLink to="#" class="btn btn-sm btn-disabled" noPrefetch>
        Docs Links
      </NuxtLink>
      <NuxtLink to="#" class="btn btn-sm btn-disabled" noPrefetch>
        PDF Links
      </NuxtLink>
    </div>
    <p class="text-xl mt-10">Select the template according to your need.</p>
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
