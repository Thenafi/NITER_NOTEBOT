<template>
  <div class="wrapper">
    <div
      class="flex items-center justify-center gap-x-6 lg:gap-x-10 pt-20 pb-5"
    >
      <img class="w-9" src="~assets/images/logo.svg" alt="NITER NOTEBOT" />
      <h1 class="text-2xl lg:text-4xl">NITER NOTEBOT</h1>
    </div>

    <div class="grid grid-rows-4 justify-center gap-y-10 py-10">
      <!-- Logo and Title of Notebot -->

      <div class="grid grid-cols-2 gap-x-20">
        <NuxtLink to="notes" class="glass btn-disabled btn-custom" noPrefetch>
          Notes
        </NuxtLink>
        <NuxtLink to="questions" class="glass btn-disabled btn-custom">
          Questions
        </NuxtLink>
      </div>

      <div class="grid grid-cols-2 gap-x-20">
        <NuxtLink to="cover" class="glass btn-disabled btn-custom">
          Cover
        </NuxtLink>
        <a href="https://rxresu.me/" class="glass btn-disabled btn-custom"
          >CV Maker</a
        >
      </div>

      <div class="grid grid-cols-2 gap-x-20">
        <NuxtLink to="teachers" class="btn-custom">Teachers</NuxtLink>
        <NuxtLink class="glass btn-disabled btn-custom">Blank</NuxtLink>
      </div>

      <div class="grid grid-cols-2 gap-x-20">
        <NuxtLink class="glass btn-disabled btn-custom">Blank</NuxtLink>
        <NuxtLink class="glass btn-disabled btn-custom">Blank</NuxtLink>
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
