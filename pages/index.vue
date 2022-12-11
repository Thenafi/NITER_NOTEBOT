<template>
  <div class="wrapper">
    <div
      class="flex items-center justify-center gap-x-6 lg:gap-x-10 pt-20 pb-5"
    >
      <img height="50" width="50" src="/logos/logo.svg" alt="NITER NOTEBOT" />
      <h1 class="text-2xl lg:text-4xl">NITER NOTEBOT</h1>
    </div>
    <div class="toast">
      <div class="alert alert-error">
        <div>
          <span>Going through development. Helps are welcome.</span>
          <NuxtLink class="link" href="https://github.com/Thenafi/NITER_NOTEBOT"
            >Github Link</NuxtLink
          >
        </div>
      </div>
    </div>
    <div class="grid grid-rows-4 justify-center gap-y-10 py-10">
      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink to="notes" class="glass btn-disabled btn-custom" noPrefetch>
          Notes
        </NuxtLink>
        <NuxtLink
          to="questions"
          class="glass btn-disabled btn-custom"
          noPrefetch
        >
          Questions
        </NuxtLink>
      </div>

      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink to="cover" class="glass btn-disabled btn-custom" noPrefetch>
          Cover
        </NuxtLink>
        <a href="https://rxresu.me/" class="glass btn-disabled btn-custom"
          >CV Maker</a
        >
      </div>

      <div class="grid grid-cols-2 gap-x-20 lg:gap-x-32">
        <NuxtLink to="teachers" class="btn-custom" :external="true"
          >Teachers</NuxtLink
        >
        <NuxtLink href="#" class="glass btn-disabled btn-custom" noPrefetch
          >Blank</NuxtLink
        >
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
