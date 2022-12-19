<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <p class="italic">Still in beta mode.</p>
    <br />
    <p class="text-xl">
      Total <Icon name="carbon:generate-pdf" />
      <span v-if="pending"> <Dotdotdot /> </span
      ><span v-else>{{}} {{ count }} <br /> </span>
      <br />
      Select the template according to your need.
    </p>
    <coverCard
      :docID="singleTemplate.id"
      v-for="singleTemplate in templatesList"
    />
    <div class="flex justify-center space-x-2 lg:space-x-8 mt-10">
      <NuxtLink to="#" class="btn btn-sm btn-disabled" noPrefetch>
        Generated Google Docs
      </NuxtLink>
      <NuxtLink to="#" class="btn btn-sm btn-disabled" noPrefetch>
        Generated PDF
      </NuxtLink>
    </div>
  </div>
</template>

<script setup>
import Dotdotdot from "~~/components/dotdotdot.vue";

//define stores
const coverStore = useCoverStore();

const templatesList = coverStore.templates;

coverStore.$reset(); // for clearing the previous states revalidation

//cover count
const { pending, data: count } = await useLazyFetch("/api/covercount");
</script>

<style scoped></style>
