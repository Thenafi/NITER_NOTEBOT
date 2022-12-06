<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <div v-if="dataFetchInComplete">Trying to load live data . . .</div>
    <div v-if="teachersData" v-for="singleTeacher in teachersData">
      <div class="card lg:card-side bg-base-100 shadow-xl my-3">
        <div class="card-body items-center text-center">
          <h2 class="card-title">{{ singleTeacher.name }}</h2>
          <a
            class="link link-hover"
            v-for="phone in singleTeacher.phone"
            :href="'tel:' + phone"
            >{{ phone }}</a
          >
          <a
            class="link link-hover"
            v-for="email in singleTeacher.email"
            :href="'mailto:' + email"
            >{{ email }}</a
          >
        </div>
      </div>
    </div>
    <div v-else>Loading..</div>
  </div>
</template>

<script setup lang="ts">
// to do here - 1 fix the typescript issues , proper understanding of useLazy Fetch - error handling if server fails

const config = useRuntimeConfig();
const apiURL = config.baseURL + "/teacher-info/get-data";
type teacherInfo = {
  name: string;
  email: string[];
  phone: string[];
};

let dataFetchInComplete = ref(true);
// Hey future I don't know how the fuck type script works
const { pending, data } = await useLazyFetch(apiURL);
let teachersData: any = reactive(data);

const nuxtApp = useNuxtApp();
nuxtApp.hook("page:finish", async () => {
  console.log("Page Rendered");
  // for refetching Pre-rendered Static Data
  const { data } = await useFetch(apiURL);
  teachersData = data;
  dataFetchInComplete.value = false;
});
</script>

<style scoped></style>
