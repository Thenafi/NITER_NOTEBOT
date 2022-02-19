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

const tableArray = ["DEPT", 0];

//semister credit
const tex = [19, 20, 20, 20.5, 20, 20, 22, 22.5, 22.5];
const ipe = [1, 20, 20, 20.5, 20, 20, 22, 22.5, 22.5];
const cse = [2, 20, 20, 20.5, 20, 20, 22, 22.5, 22.5];
const eee = [3, 20, 20, 20.5, 20, 20, 22, 22.5, 22.5];
const fdae = [4, 20, 20, 20.5, 20, 20, 22, 22.5, 22.5];

//odd even checker for later
function isodd(number) {
  if (number % 2 == 0) {
    return false;
  } else {
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
      tableArray[0] = "TEX";
      document.querySelectorAll(".subtitle")[0].classList.remove("is-hidden");
    } else if (button[i].textContent === "IPE") {
      thirdsectionVisibler();
      hideSection();
      tableArray[0] = "IPE";
      document.querySelectorAll(".subtitle")[4].classList.remove("is-hidden");
    } else if (button[i].textContent === "FDAE") {
      thirdsectionVisibler();
      hideSection();
      tableArray[0] = "FDAE";
      document.querySelectorAll(".subtitle")[3].classList.remove("is-hidden");
    } else if (button[i].textContent === "EEE") {
      thirdsectionVisibler();
      hideSection();
      tableArray[0] = "EEE";
      document.querySelectorAll(".subtitle")[2].classList.remove("is-hidden");
    } else if (button[i].textContent === "CSE") {
      thirdsectionVisibler();
      hideSection();
      tableArray[0] = "CSE";
      document.querySelectorAll(".subtitle")[1].classList.remove("is-hidden");
    }
  });
}

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

// custom dropdown menu-------------------------------
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

const levelSelector = document.querySelectorAll(".select-selected")[0]; // selects the level element
const termSelector = document.querySelectorAll(".select-selected")[1]; // selects the term element
// ei duita selecteor ekhane karon eder class gula uporer javascript diya toiri hoie
// custom dropdown menu created-------------------------------------------------------

/* making function to select level first then level and then calculation***
 checking if both are selected or not and returning true or false based on that */

const isLevelSelected = function () {
  if (
    levelSelector.textContent !== "Select Level:" &&
    termSelector.textContent !== "Select Term:"
  ) {
    return true;
  } else {
    return false;
  }
};

// function to generate identifire Array for table creator
let level = 0;
let term = 0;

const tableArrayCreator = function () {
  // level
  if (levelSelector.textContent === "Level 1") {
    level = 1;
  } else if (levelSelector.textContent === "Level 2") {
    level = 2;
  } else if (levelSelector.textContent === "Level 3") {
    level = 3;
  } else if (levelSelector.textContent === "Level 4") {
    level = 4;
  }
  //term
  if (termSelector.textContent === "Term 1") {
    term = 1;
  } else if (termSelector.textContent === "Term 2") {
    term = 2;
  }
  let mimi;
  if (term === 1) {
    mimi = level * 2 - 1;
  } else {
    mimi = level * term;
  }

  tableArray[1] = mimi;
};

//showing cgpa calculation section based on level and term selected or not
startCalc.addEventListener("click", function () {
  if (isLevelSelected()) {
    sectionCalc.classList.remove("is-hidden");
    tableArrayCreator();

    //table value updater according to department
    let tempIndex = 0; // just to get the values from the tex array
    for (const [index, input] of inputSelction.entries()) {
      if (!isodd(index)) {
        if (tableArray[0] === "TEX") {
          input.value = tex[tempIndex];
        } else if (tableArray[0] === "IPE") {
          input.value = ipe[tempIndex];
        } else if (tableArray[0] === "CSE") {
          input.value = cse[tempIndex];
        } else if (tableArray[0] === "EEE") {
          input.value = eee[tempIndex];
        } else if (tableArray[0] === "FDAE") {
          input.value = fdae[tempIndex];
        }

        tempIndex++;
      }
    }
  } else {
    alert("Please Select Level and Term");
  }
});

//starting main calculation
calcCGPA.addEventListener("click", calculation_function);
