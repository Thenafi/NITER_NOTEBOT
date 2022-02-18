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
  document.querySelectorAll(".section")[1].classList.toggle("is-hidden");
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
// dropdown1.addEventListener("click", function () {
//   dropdown1.classList.toggle("is-active");
// });

// dropdown2.addEventListener("click", function () {
//   if (dropdown1.classList.contains("is-active")) {
//     window.alert("Select Level First");
//   } else {
//     dropdown2.classList.toggle("is-active");
//   }
// });

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
  var cg = parseFloat(cgpa).toFixed(2);
  console.log(SPGA_Credit);
  document.getElementById("resultCGPA").innerHTML = `Your CGPA is ${cg}  `;
}

//starting main calculation
calcCGPA.addEventListener("click", calculation_function);

var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function (e) {
      /* When an item is clicked, update the original select box,
        and the selected item: */
      var y, i, k, s, h, sl, yl;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      sl = s.length;
      h = this.parentNode.previousSibling;
      for (i = 0; i < sl; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");
          yl = y.length;
          for (k = 0; k < yl; k++) {
            y[k].removeAttribute("class");
          }
          this.setAttribute("class", "same-as-selected");
          break;
        }
      }
      h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function (e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x,
    y,
    i,
    xl,
    yl,
    arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);

var x, i, j, l, ll, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select2");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function (e) {
      /* When an item is clicked, update the original select box,
        and the selected item: */
      var y, i, k, s, h, sl, yl;
      s = this.parentNode.parentNode.getElementsByTagName("select")[0];
      sl = s.length;
      h = this.parentNode.previousSibling;
      for (i = 0; i < sl; i++) {
        if (s.options[i].innerHTML == this.innerHTML) {
          s.selectedIndex = i;
          h.innerHTML = this.innerHTML;
          y = this.parentNode.getElementsByClassName("same-as-selected");
          yl = y.length;
          for (k = 0; k < yl; k++) {
            y[k].removeAttribute("class");
          }
          this.setAttribute("class", "same-as-selected");
          break;
        }
      }
      h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function (e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x,
    y,
    i,
    xl,
    yl,
    arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i);
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
