<template>
  <div class="grid place-items-center">
    <img src="~assets/images/logo.svg" alt="NITER NOTEBOT" />
    <h1>NITER NOTEBOT</h1>
  </div>

  <div class="lg:px-96 px-10">
    <!-- Logo and Title of Notebot -->

    <div class="grid grid-cols-2 gap-x-10 lg:gap-x-36">
      <NuxtLink to="notes" class="btn" noPrefetch> Notes </NuxtLink>
      <NuxtLink to="questions" class="btn"> questions </NuxtLink>
    </div>

    <div>
      <NuxtLink to="cover" class="btn"> Cover </NuxtLink>
      <a href="https://rxresu.me/" class="btn">CV Maker</a>
    </div>

    <div>
      <NuxtLink to="teachers" class="btn">Teachers</NuxtLink>
      <NuxtLink class="btn">Blank</NuxtLink>
    </div>

    <div>
      <NuxtLink class="btn">Blank</NuxtLink>
      <NuxtLink class="btn">Blank</NuxtLink>
    </div>
  </div>
  <!-- 
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
      Waves Container-->
</template>
