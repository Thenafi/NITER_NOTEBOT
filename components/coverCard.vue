<template>
  <div class="card mt-12 lg:card-side bg-base-100 shadow-xl">
    <div class="card-body">
      <h2 class="card-title">{{ title }}</h2>
      <p class="my-5">{{ templateDescription }}</p>
      <div class="card-actions justify-evenly items-center">
        <NuxtLink :href="googleDocUrl" target="_blank" class="link link-primary"
          >Google Doc Link</NuxtLink
        >
        <NuxtLink :href="imageLink" target="_blank" class="link link-primary"
          >Image Preview</NuxtLink
        >
        <NuxtLink
          @click="coverStore.setTemplate(docID)"
          href="/cover/form"
          class="btn btn-wide"
          >Generate</NuxtLink
        >
      </div>
    </div>
  </div>
</template>

<script setup>
//setting props
const props = defineProps(["docID"]);

//define stores
const coverStore = useCoverStore();

const templateInfo = coverStore.getTemplate(props.docID);
const title = templateInfo.name;
const templateDescription = templateInfo.description;
const googleDocUrl = `https://docs.google.com/document/d/${props.docID}`;
const imageLink = templateInfo.image;
</script>
