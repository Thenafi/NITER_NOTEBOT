<template>
  <NuxtLoadingIndicator />
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
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white rounded-box w-52"
        >
          <li>
            <NuxtLink to="/teachers">Teachers</NuxtLink>
          </li>
          <li>
            <NuxtLink to="#s"> Cover </NuxtLink>
          </li>
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
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24px"
            height="24px"
            viewBox="0 0 24 24"
            fill="none"
          >
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M16 9C16 11.2091 14.2091 13 12 13C9.79086 13 8 11.2091 8 9C8 6.79086 9.79086 5 12 5C14.2091 5 16 6.79086 16 9ZM14 9C14 10.1046 13.1046 11 12 11C10.8954 11 10 10.1046 10 9C10 7.89543 10.8954 7 12 7C13.1046 7 14 7.89543 14 9Z"
              fill="black"
            />
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M12 1C5.92487 1 1 5.92487 1 12C1 18.0751 5.92487 23 12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1ZM3 12C3 14.0902 3.71255 16.014 4.90798 17.5417C6.55245 15.3889 9.14627 14 12.0645 14C14.9448 14 17.5092 15.3531 19.1565 17.4583C20.313 15.9443 21 14.0524 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12ZM12 21C9.84977 21 7.87565 20.2459 6.32767 18.9878C7.59352 17.1812 9.69106 16 12.0645 16C14.4084 16 16.4833 17.1521 17.7538 18.9209C16.1939 20.2191 14.1881 21 12 21Z"
              fill="black"
            />
          </svg>
        </label>
        <ul
          tabindex="0"
          class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-white rounded-box w-52"
        >
          <li>
            <NuxtLink href="#" class="justify-between"> Blank </NuxtLink>
          </li>
          <li><NuxtLink href="#">Blank</NuxtLink></li>
          <li><NuxtLink href="#">Blank</NuxtLink></li>
        </ul>
      </div>
    </div>
  </div>
  <slot />
</template>

<script setup lang="ts">
const dropDownClose = function () {
  console.log(document.activeElement);
  if (document.activeElement instanceof HTMLElement) {
    document.activeElement.blur();
    console.log("Active");
  }
};
</script>
