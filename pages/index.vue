<template>
  <div class="wrapper">
    <div
      class="flex items-center justify-center gap-x-6 lg:gap-x-10 pt-20 pb-5"
    >
      <img height="50" width="50" src="/logos/logo.svg" alt="NITER NOTEBOT" />
      <h1 class="text-2xl lg:text-4xl">NITER NOTEBOT</h1>
    </div>

    <div class="grid justify-center gap-y-10 py-10">
      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink
          to="https://drive.google.com/drive/mobile/folders/12FV_Q6_9JcZDMqQLQCp14toT-jk2nImM?utm_source=messenger&utm_medium=29661974437205&utm_campaign=botsurfer"
          class="btn-custom"
          noPrefetch
        >
          Notes
        </NuxtLink>
        <NuxtLink
          to="https://drive.google.com/drive/u/0/folders/1R7Wr7MbxlEHXQfjBLTcsk9m1TZjXdjLb?fbclid=IwAR1N3SpvTyh-Ct-x0JX_xoVi7anGK9YSc0xQxs3_gRp-hVHfpE9qjsx8LZw"
          class="btn-custom"
          noPrefetch
        >
          Questions
        </NuxtLink>
      </div>

      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink to="/blog" class="btn-custom" noPrefetch>
          Cover Gen
        </NuxtLink>
        <a href="https://rxresu.me/" class="btn-custom">CV Maker</a>
      </div>

      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink to="/teachers" class="btn-custom" :external="true"
          >Teachers</NuxtLink
        >
        <NuxtLink href="/contact" class="btn-custom" noPrefetch>Blank</NuxtLink>
      </div>

      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink href="#" class="glass btn-disabled btn-custom" noPrefetch
          >Blank</NuxtLink
        >
        <NuxtLink href="#" class="glass btn-disabled btn-custom" noPrefetch
          >Blank</NuxtLink
        >
      </div>
    </div>
    <div>
      <svg
        class="waves"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        viewBox="0 24 150 28"
        preserveAspectRatio="none"
        shape-rendering="auto"
      >
        <defs>
          <path
            id="gentle-wave"
            d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"
          />
        </defs>
        <g class="parallax">
          <use
            xlink:href="#gentle-wave"
            x="48"
            y="0"
            fill="rgba(0,157,196,0.7"
          />
          <use
            xlink:href="#gentle-wave"
            x="48"
            y="3"
            fill="rgba(255,255,255,0.5)"
          />
          <use
            xlink:href="#gentle-wave"
            x="48"
            y="5"
            fill="rgba(255,255,255,0.3)"
          />
          <use xlink:href="#gentle-wave" x="48" y="7" fill="#d0efff" />
        </g>
      </svg>
    </div>
  </div>
</template>

<script>
definePageMeta({
  layout: "frontpage",
});
</script>
