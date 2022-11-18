<template>
  <div>
    <div class="wrapper">
      <!-- Logo and Title of Notebot -->
      <div class="title">
        <img src="~assets/images/logo.svg" alt="NITER NOTEBOT" />
        <h1>NITER NOTEBOT</h1>
      </div>

      <!-- Buttons to to navigate features of Notebot -->
      <div class="">
        <!-- Buttons for first row -->
        <div>
          <a
            href="https://niternotebot.chest.workers.dev/"
            class="btn btn-outline nafi"
            >Notes</a
          >
          <a
            href="https://drive.google.com/drive/folders/1R7Wr7MbxlEHXQfjBLTcsk9m1TZjXdjLb"
            class="btnop bg-slate-300"
            >Questions</a
          >
        </div>

        <!-- Buttons for second row -->
        <div class="btnrow">
          <a href="./cgpa" class="button">CGPA</a>
          <a href="https://rxresu.me/" class="button">CV Maker</a>
        </div>

        <!-- Buttons for third row -->
        <div class="btnrow">
          <div class="dropdown">
            <a href="#" class="button">Niterian List</a>
            <div class="dropdown-content">
              <a href="./niterian/form/" style="text-align: left">Add Data</a>
              <a href="./niterian/update" style="text-align: left"
                >Update Data</a
              >
              <a href="./niterian/search" style="text-align: left"
                >Search Data</a
              >
              <a href="./niterian/" style="text-align: left">View Database</a>
            </div>
          </div>
          <a href="./teachers/" class="button">Teachers</a>
        </div>

        <!-- Buttons for fourth row -->
        <div class="btnrow">
          <a
            href="https://docs.google.com/forms/d/1QScbhYVbZ7Vd3WOEfkBZoRcb0Y4JQYof8TubXy5Ubec/edit?usp=drivesdk"
            class="button"
            >Submit Notes</a
          >
          <a href="./join" class="button">Join us</a>
        </div>
      </div>

      <!-- Waves Container-->
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
  </div>
</template>
