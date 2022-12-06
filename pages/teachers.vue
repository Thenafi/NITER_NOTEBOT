<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <div class="input-group">
      <input
        id="searchBox"
        @input="searchForTeacher"
        type="text"
        placeholder="Search…"
        style=""
        class="input input-bordered w-full bg-white"
      />
      <button class="btn btn-square">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-6 w-6"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
          />
        </svg>
      </button>
    </div>

    <div v-if="dataFetchInComplete" class="text-center">
      <progress class="progress w-56"></progress>
    </div>
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
// to do here - 1 fix the typescript issues , proper understanding of useLazy Fetch - error handling if server fails - use reactive
const nuxtApp = useNuxtApp();
const config = useRuntimeConfig();
const apiURL = config.baseURL + "/teacher-info/get-data";

type teacherInfo = {
  name: string;
  email: string[];
  phone: string[];
};
const dataFetchInComplete = ref(true);
// Hey future I don't know how the fuck type script works
const { pending, data } = await useLazyFetch(apiURL);
let teachersData: any = reactive(data);

nuxtApp.hook("page:finish", async () => {
  console.log("Page Rendered");
  // for refetching Pre-rendered Static Data
  const { data } = await useFetch(apiURL);
  teachersData = data;
  dataFetchInComplete.value = false;
});

//search functionality
const searchForTeacher = function (e: Event) {
  const inputData = (e.target as HTMLInputElement).value.toUpperCase();
  const allNames = document.querySelectorAll<HTMLElement>(".card");

  for (let i = 0; i < allNames.length; i++) {
    const elementCard = allNames[i];
    const elementCardTitle =
      allNames[i].querySelector<HTMLElement>(".card-title");

    if (!elementCardTitle) return;
    let textValue = elementCardTitle.textContent || elementCardTitle.innerText;
    if (textValue.toUpperCase()?.indexOf(inputData) > -1) {
      elementCard.style.display = "";
    } else {
      elementCard.style.display = "none";
    }
  }
};
</script>

<style scoped></style>
