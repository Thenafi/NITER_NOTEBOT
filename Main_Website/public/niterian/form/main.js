fetch("https://niternotebot.herokuapp.com/");

console.log("hello 💛, I am Nafi from 8th batch, a NITERian");

const form = document.getElementById("form");
const fname = document.getElementById("fname");
const batch = document.getElementById("batch");
const clid = document.getElementById("clid");
const dept = document.getElementById("dept");
const sec = document.getElementById("sec");
const male = document.getElementById("male");
const female = document.getElementById("female");
const donor = document.getElementById("y");
const notdonor = document.getElementById("n");
const blood = document.getElementById("blood");
const clg = document.getElementById("clg");
const htown = document.getElementById("htown");
const link = document.getElementById("link");
const email = document.getElementById("email");
const phone = document.getElementById("phone");
const submit = document.getElementById("submit");
const smallmessageElement = document.getElementById("smallMessage");
const urlParams = new URLSearchParams(
  "?".concat(atob(window.location.search.substring(1)))
);
console.log(atob(window.location.search.substring(1)));
const clid_from_query = urlParams.get("clid");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  fname.value = fname.value.toUpperCase().trim();
  clid.value = clid.value.toUpperCase().trim();
  blood.value = blood.value.toUpperCase().trim();
  sec.value = sec.value.toUpperCase().trim();
  clg.value = clg.value.toUpperCase().trim();
  dept.value = dept.value.toUpperCase().trim();
  if (checkInputs()) {
    new FormData(form);
    submit.style.backgroundColor = "#8e44ad";
    submit.style.border = "2px solid #8e44ad";
    submit.innerHTML = "<center><div class='loader'></div><center>";
  } else {
    console.log("error");
  }
});

if (clid_from_query) {
  console.log(clid_from_query);
  fname.value = urlParams.get("fname");
  batch.value = urlParams.get("batch");
  clid.value = clid_from_query;
  dept.value = urlParams.get("dept");
  sec.value = urlParams.get("sec");
  phone.value = urlParams.get("phone");
  if (urlParams.get("gender") === "M") {
    male.checked = true;
  } else if (urlParams.get("gender") === "F") {
    female.checked = true;
  }
  if (urlParams.get("active_donor") === "YES") {
    donor.checked = true;
  } else if (urlParams.get("active_donor") === "NO") {
    notdonor.checked = true;
  }
  blood.value = urlParams.get("blood");
  clg.value = urlParams.get("clg");
  htown.value = urlParams.get("htown");
  email.value = urlParams.get("email");
  link.value = urlParams.get("link");
}

form.addEventListener("formdata", (e) => {
  if (clid_from_query) {
    url = `https://niternotebot.herokuapp.com/update_api/${clid_from_query}`;
  } else {
    url = "https://niternotebot.herokuapp.com/entry_api/";
  }
  fetch(url, {
    method: "POST",
    body: e.formData,
  }).then((response) => {
    if (response.ok) {
      fetch("https://niternotebot.herokuapp.com/mail/", {
        method: "POST",
        body: e.formData,
      });
      window.location.href = "./redirect.html";
    } else {
      console.log("error");
      submit.innerHTML = "Failed";
      submit.style.backgroundColor = "red";
      submit.style.border = "2px solid red";
      smallmessageElement.innerHTML = `<p style="color: Tomato;font-style: italic; padding = 10px" >Try Again with correct Id or check our id with database <p>`;
      setErrorFor(clid, "Sorry, this ID is already registered");
      //add delay
      setTimeout(() => {
        clid.scrollIntoView({ behavior: "smooth", block: "center" });
      }, 175);
    }
  });
});

function checkInputs() {
  // trim to remove the whitespaces
  const fnameValue = fname.value.trim();
  const batchValue = batch.value.trim();
  const clidValue = clid.value.trim();
  const deptValue = dept.value.trim();
  const secValue = sec.value.trim();
  const clgValue = clg.value.trim();
  const bloodValue = blood.value.trim();
  const htownValue = htown.value.trim();
  const linkValue = link.value.trim();
  const emailValue = email.value.trim();
  const phoneValue = phone.value.trim();

  let fnameValue_state = false;
  let batchValue_state = false;
  let clidValue_state = false;
  let deptValue_state = false;
  let secValue_state = false;
  let genderValue_state = false;
  let donorValue_state = false;
  let bloodValue_state = false;
  let clgValue_state = false;
  let htownValue_state = false;
  let linkValue_state = false;
  let emailValue_state = false;
  let phoneValue_state = false;

  // -----------Name Entry---------------
  if (fnameValue === "") {
    setErrorFor(fname, "Name field cannot be blank");
  } else {
    setSuccessFor(fname);
    fnameValue_state = true;
  }

  // ---------- Batch Entry ---------------
  if (batchValue === "") {
    setErrorFor(batch, "Batch field cannot be blank");
  } else {
    setSuccessFor(batch);
    batchValue_state = true;
  }

  // ------------- Class Id Entry --------------
  if (clidValue === "") {
    setErrorFor(clid, "Class ID should be like: TE-1808015");
  } else if (isFormatedId(clidValue) === "Lenght Wrong") {
    setErrorFor(clid, "Not Valid Lenght");
  } else if (isFormatedId(clidValue) === "Format Wrong") {
    setErrorFor(clid, "Invalid Formart, try this fromat 'TE-1808151'");
  } else {
    setSuccessFor(clid);
    clidValue_state = true;
  }

  // ----------- department entry ------------------
  if (deptValue === "") {
    setErrorFor(dept, "Department cannot be blank");
  } else if (isValidDepartment(deptValue) === "Too Lengthy") {
    setErrorFor(dept, "Too long, write abbreviation only");
  } else if (isValidDepartment(deptValue) === "Too Short") {
    setErrorFor(dept, "Too short, write abbreviation only");
  } else {
    setSuccessFor(dept);
    deptValue_state = true;
  }

  // ----------- Section entry ---------------
  if (secValue === "") {
    sec.value = "-";
  } else if (isseclen(secValue) === "erro") {
    setErrorFor(sec, " Please write Only Section. eg: A");
  } else {
    setSuccessFor(sec);
    secValue_state = true;
  }

  // -------------- Gender Entry ---------------

  if (female.checked) {
    setSuccessForGender();
    genderValue_state = true;
  } else if (male.checked) {
    setSuccessForGender();
    genderValue_state = true;
  } else {
    setErrorForGender("Please select your gender");
  }

  // -------------- donor Entry ---------------

  if (y.checked) {
    setSuccessForDonor();
    donorValue_state = true;
  } else if (n.checked) {
    setSuccessForDonor();
    donorValue_state = true;
  } else {
    setErrorForDonor("Please select");
  }
  // ------------- blood group entry ---------------

  if (bloodValue === "") {
    setErrorFor(blood, "Blood Group field cannot be blank");
  } else if (bloodValue.length > 3) {
    setErrorFor(blood, "Lengthy than usual.");
  } else {
    setSuccessFor(blood);
    bloodValue_state = true;
  }

  // college entry--------------
  if (clgValue === "") {
    setErrorFor(clg, "Please Enter Your College Name");
  } else {
    setSuccessFor(clg);
    clgValue_state = true;
  }

  // ----------- hometown entry -----------------

  if (htownValue === "") {
    setErrorFor(htown, "Hometown cannot be blank");
  } else {
    setSuccessFor(htown);
    htownValue_state = true;
  }

  // ------------ phone entry ---------------
  if (phoneValue === "") {
    setErrorFor(phone, "Phone should be like: 01723111111");
  } else if (phoneValue === "Phone no. will not be collected for females") {
    setSuccessFor(phone);
    phoneValue_state = true;
  } else if (isPhoneValid(phoneValue) === "Lenght Wrong") {
    setErrorFor(phone, "Not Valid Lenght");
  } else if (isFormatedId(phoneValue) === "Format Wrong") {
    setErrorFor(phone, "Start with 01");
  } else {
    setSuccessFor(phone);
    phoneValue_state = true;
  }

  // ----------- Email entry ------------------
  if (emailValue === "") {
    setErrorFor(email, "Email cannot be blank");
  } else if (!isEmail(emailValue)) {
    setErrorFor(email, "Not a valid email");
  } else {
    setSuccessFor(email);
    emailValue_state = true;
  }

  // ----------------- social media link entry --------------

  if (linkValue === "") {
    setErrorFor(link, "Link field cannot be blank");
  } else if (!isURL(linkValue)) {
    setErrorFor(link, "Not a valid link");
  } else {
    setSuccessFor(link);
    linkValue_state = true;
  }

  // ---------- condition to check missing info ----------------
  if (
    fnameValue_state &&
    batchValue_state &&
    clidValue_state &&
    deptValue_state &&
    secValue_state &&
    genderValue_state &&
    donorValue_state &&
    bloodValue_state &&
    htownValue_state &&
    linkValue_state &&
    emailValue_state &&
    clgValue_state &&
    phoneValue_state === true
  ) {
    return true;
  } else {
    smallmessageElement.innerHTML = `<p style="color: Tomato;font-style: italic; padding = 10px" >Some Values are fields are still empty above. Please fill them up correctly <p>`;
    console.log("Still Something is missing");
    return false;
  }
}

//   --------- Error message -----------------
function setErrorFor(input, message) {
  const formControl = input.parentElement;
  const small = formControl.querySelector("small");
  formControl.className = "form-control error";
  small.innerText = message;
}
function setErrorForGender(message) {
  const formControl = document.getElementById("gender");
  const small = formControl.querySelector("small");
  formControl.className = "form-control error";
  small.innerText = message;
}

function setErrorForDonor(message) {
  const formControl = document.getElementById("donor");
  const small = formControl.querySelector("small");
  formControl.className = "form-control error";
  small.innerText = message;
}

function setSuccessFor(input) {
  const formControl = input.parentElement;
  formControl.className = "form-control success";
}
function setSuccessForGender() {
  const formControl = document.getElementById("gender");
  formControl.className = "form-control success";
}

function setSuccessForDonor() {
  const formControl = document.getElementById("donor");
  formControl.className = "form-control success";
}

function isEmail(email) {
  return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
    email
  );
}
function isFormatedId(clid) {
  if (clid.length === 10) {
    let re = new RegExp(/[A-Z]{2}-[0-9]{7}/, "i");
    if (re.test(clid)) {
      return "OK";
    } else {
      return "Format Wrong";
    }
  } else {
    return "Lenght Wrong";
  }
}

function isseclen(sec) {
  if (sec.length > 1) {
    return "erro";
  } else {
    return "OK";
  }
}
function isValidDepartment(dept) {
  if (dept.length < 3) {
    return "Too Short";
  } else if (dept.length > 4) {
    return "Too Lengthy";
  } else {
    return "OK";
  }
}

function isPhoneValid(phone) {
  if (phone.length === 11) {
    if (/01[0-9]{9}/.test(phone)) {
      return "OK";
    } else {
      return "Format Wrong";
    }
  } else {
    return "Lenght Wrong";
  }
}

// -------------Automated Batch finder using class id-----------------
function batchFinder(clid) {
  let ls = {};
  let year = 10;
  let bt = 0;
  for (let i = 0; i < 50; i++) {
    ls[year++] = `${bt + i}`;
  }

  batch.value = +ls[clid[3] + clid[4]];

  shortDepartment = (clid[0] + clid[1]).toUpperCase();
  switch (shortDepartment) {
    case "TE":
      dept.value = "TEX";
      break;
    case "IP":
      dept.value = "IPE";
      break;
    case "FD":
      dept.value = "FDAE";
      break;
    case "EE":
      dept.value = "EEE";
      break;
    case "CS":
      dept.value = "CSE";
      break;
    default:
      dept.value = "";
  }
}

//  ----------------- Phone number field enabler & disabler ----------------------
function numberDisabler() {
  phone.value = "Phone no. will not be collected for females";
  phone.disabled = true;
}

function numberEnabler() {
  phone.value = "";
  phone.removeAttribute("disabled");
}

//   ____________url validator_________________
function isURL(url) {
  if (!url) return false;
  var pattern = new RegExp(
    "^(https?:\\/\\/)?" +
      "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|" +
      "((\\d{1,3}\\.){3}\\d{1,3}))|" +
      "localhost" +
      "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" +
      "(\\?[;&a-z\\d%_.~+=-]*)?" +
      "(\\#[-a-z\\d_]*)?$",
    "i"
  ); // fragment locator
  return pattern.test(url);
}

// autocomplete
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function (e) {
    var a,
      b,
      i,
      val = this.value;
    /*close any already open lists of autocompleted values*/
    closeAllLists();
    if (!val) {
      return false;
    }
    currentFocus = -1;
    /*create a DIV element that will contain the items (values):*/
    a = document.createElement("DIV");
    a.setAttribute("id", this.id + "autocomplete-list");
    a.setAttribute("class", "autocomplete-items");
    /*append the DIV element as a child of the autocomplete container:*/
    this.parentNode.appendChild(a);
    /*for each item in the array...*/
    for (i = 0; i < arr.length; i++) {
      /*check if the item starts with the same letters as the text field value:*/
      if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
        /*create a DIV element for each matching element:*/
        b = document.createElement("DIV");
        /*make the matching letters bold:*/
        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
        b.innerHTML += arr[i].substr(val.length);
        /*insert a input field that will hold the current array item's value:*/
        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
        /*execute a function when someone clicks on the item value (DIV element):*/
        b.addEventListener("click", function (e) {
          /*insert the value for the autocomplete text field:*/
          inp.value = this.getElementsByTagName("input")[0].value;
          /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
          closeAllLists();
        });
        a.appendChild(b);
      }
    }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function (e) {
    var x = document.getElementById(this.id + "autocomplete-list");
    if (x) x = x.getElementsByTagName("div");
    if (e.keyCode == 40) {
      /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
      currentFocus++;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 38) {
      //up
      /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
      currentFocus--;
      /*and and make the current item more visible:*/
      addActive(x);
    } else if (e.keyCode == 13) {
      /*If the ENTER key is pressed, prevent the form from being submitted,*/
      e.preventDefault();
      if (currentFocus > -1) {
        /*and simulate a click on the "active" item:*/
        if (x) x[currentFocus].click();
      }
    }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = x.length - 1;
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
    closeAllLists(e.target);
  });
}

var countries = [
  "Dhaka",
  "Faridpur",
  "Gazipur",
  "Gopalganj",
  "Jamalpur",
  "Kishoreganj",
  "Madaripur",
  "Manikganj",
  "Munshiganj",
  "Mymensingh",
  "Narayanganj",
  "Narsingdi",
  "Netrokona",
  "Rajbari",
  "Shariatpur",
  "Sherpur",
  "Tangail",
  "Bogra",
  "Joypurhat",
  "Naogaon",
  "Natore",
  "Nawabganj",
  "Pabna",
  "Rajshahi",
  "Sirajgonj",
  "Dinajpur",
  "Gaibandha",
  "Kurigram",
  "Lalmonirhat",
  "Nilphamari",
  "Panchagarh",
  "Rangpur",
  "Thakurgaon",
  "Barguna",
  "Barisal",
  "Bhola",
  "Jhalokati",
  "Patuakhali",
  "Pirojpur",
  "Bandarban",
  "Brahmanbaria",
  "Chandpur",
  "Chittagong",
  "Comilla",
  "Cox''s Bazar",
  "Feni",
  "Khagrachari",
  "Lakshmipur",
  "Noakhali",
  "Rangamati",
  "Habiganj",
  "Maulvibazar",
  "Sunamganj",
  "Sylhet",
  "Bagerhat",
  "Chuadanga",
  "Jessore",
  "Jhenaidah",
  "Khulna",
  "Kushtia",
  "Magura",
  "Meherpur",
  "Narail",
  "Satkhira",
];

var bg = ["A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-"];

autocomplete(document.getElementById("htown"), countries);
autocomplete(document.getElementById("blood"), bg);
