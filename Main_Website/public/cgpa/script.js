"use strict";

// selecting elments

const dropdown1 = document.querySelector(".dropdown_1");
const dropdown2 = document.querySelector(".dropdown_2");
const button = document.querySelectorAll(".button");
const startCalc = document.getElementById("start_calculation");
const sectionCalc = document.getElementById("sectionCalc");
const calcCGPA = document.getElementById("calculate_cgpa");
const inputSelction = document.querySelectorAll(".input"); // selecting all input box
const inputSelctionCredit = document.querySelectorAll("#credit_input"); // selecting credit input box
const inputSelctionCGPA = document.querySelectorAll("#cgpa_input"); // selecting cgpa input box
const resultBOX = document.getElementById("result"); // result box

//odd even checker for later
function isodd(number) {
  //check if the number is even
  if (number % 2 == 0) {
    return false;
  }

  // if the number is odd
  else {
    return true;
  }
}
// hiding all hdiding all department
function hideSection() {
  for (let i = 0; i < document.querySelectorAll(".subtitle").length; i++) {
    document.querySelectorAll(".subtitle")[i].classList.add("is-hidden");
  }
}

// making the fist section visiable
function thirdsectionVisibler() {
  document.querySelectorAll(".section")[1].classList.remove("is-hidden");
}

//activating deparmetn select
for (let i = 0; i < button.length; i++) {
  button[i].addEventListener("click", function () {
    if (button[i].textContent === "TEX") {
      thirdsectionVisibler();
      hideSection();
      document.querySelectorAll(".subtitle")[0].classList.remove("is-hidden");
    } else if (button[i].textContent === "IPE") {
      thirdsectionVisibler();
      hideSection();
      document.querySelectorAll(".subtitle")[4].classList.remove("is-hidden");
    } else if (button[i].textContent === "FDAE") {
      thirdsectionVisibler();
      hideSection();
      document.querySelectorAll(".subtitle")[3].classList.remove("is-hidden");
    } else if (button[i].textContent === "EEE") {
      thirdsectionVisibler();
      hideSection();
      document.querySelectorAll(".subtitle")[2].classList.remove("is-hidden");
    } else if (button[i].textContent === "CSE") {
      thirdsectionVisibler();
      hideSection();
      document.querySelectorAll(".subtitle")[1].classList.remove("is-hidden");
    }
  });
}

//activating both dropdown
dropdown1.addEventListener("click", function () {
  dropdown1.classList.toggle("is-active");
});

dropdown2.addEventListener("click", function () {
  if (dropdown1.classList.contains("is-active")) {
    window.alert("Select Level First");
  } else {
    dropdown2.classList.toggle("is-active");
  }
});

//showing cgpa calculation section
startCalc.addEventListener("click", function () {
  sectionCalc.classList.remove("is-hidden");
});

//calculation function
function calculation_function() {
  let totalCredit = 0;
  let totalSGPA = 0;
  let SPGA_Credit = 0;
  let cgpa;
  let i;
  let p;
  for (i = 0; i < inputSelction.length; i++) {
    p = i + 1;
    if (!isodd(i)) {
      totalSGPA = Number(inputSelction[i].value) + totalSGPA;
      SPGA_Credit =
        Number(inputSelction[i].value) * Number(inputSelction[p].value) +
        SPGA_Credit;
    }
  }
  cgpa = SPGA_Credit / totalSGPA;
  console.log(SPGA_Credit);
  document.getElementById("resultCGPA").innerHTML = `Your CGPA is ${cgpa}  `;
}

//starting main calculation
calcCGPA.addEventListener("click", calculation_function);
