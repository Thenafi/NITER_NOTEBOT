<template>
  <div class="navbar w-auto m-5 lg:mx-80 bg-white rounded-3xl">
    <div class="navbar-start">
      <div class="dropdown">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h7"
            />
          </svg>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
        >
          <li><a>Teacher</a></li>
          <li><a>Cover Maker</a></li>
          <li><a>DataBase</a></li>
        </ul>
      </div>
    </div>
    <div class="navbar-center">
      <NuxtLink href="/" class="btn btn-ghost normal-case text-xl"
        >NITER NOTEBOT</NuxtLink
      >
    </div>
    <div class="navbar-end">
      <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="https://placeimg.com/80/80/people" />
          </div>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52"
        >
          <li>
            <a class="justify-between"> Profile </a>
          </li>
          <li><a>Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
  <slot />
</template>
