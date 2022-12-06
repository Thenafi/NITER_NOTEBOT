<template>
  <div class="px-7 py-12 m-5 lg:mx-80 bg-white rounded-3xl">
    <div v-for="singleTeacher in data">
      <div class="card w-96 bg-primary text-neutral-content my-3">
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
  </div>
</template>

<script setup lang="ts">
const config = useRuntimeConfig();
const apiURL = config.baseURL + "/teacher-info/get-data";
type teacherInfo = {
  name: string;
  email: string[];
  phone: string[];
};
const data: teacherInfo[] = await $fetch(apiURL);
</script>

<style scoped></style>
