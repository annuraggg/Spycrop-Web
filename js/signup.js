initMultiStepForm();

function initMultiStepForm() {
    const progressNumber = document.querySelectorAll(".step").length;
    const slidePage = document.querySelector(".slide-page");
    const submitBtn = document.querySelector(".submit");
    const progressText = document.querySelectorAll(".step p");
    const progressCheck = document.querySelectorAll(".step .check");
    const bullet = document.querySelectorAll(".step .bullet");
    const pages = document.querySelectorAll(".page");
    const nextButtons = document.querySelectorAll(".next");
    const prevButtons = document.querySelectorAll(".prev");
    const stepsNumber = pages.length;


    document.documentElement.style.setProperty("--stepNumber", stepsNumber);

    let current = 1;

    for (let i = 0; i < nextButtons.length; i++) {
        nextButtons[i].addEventListener("click", function (event) {
            event.preventDefault();

            inputsValid = validateInputs(this);
            // inputsValid = true;

            if (inputsValid) {
                slidePage.style.marginLeft = `-${
                    (100 / stepsNumber) * current
                }%`;
                bullet[current - 1].classList.add("active");
                progressCheck[current - 1].classList.add("active");
                progressText[current - 1].classList.add("active");
                current += 1;
            }
        });
    }

    for (let i = 0; i < prevButtons.length; i++) {
        prevButtons[i].addEventListener("click", function (event) {
            event.preventDefault();
            slidePage.style.marginLeft = `-${
                (100 / stepsNumber) * (current - 2)
            }%`;
            bullet[current - 2].classList.remove("active");
            progressCheck[current - 2].classList.remove("active");
            progressText[current - 2].classList.remove("active");
            current -= 1;
        });
    }

    function validateInputs(ths) {
        let inputsValid = true;

        const inputs =
            ths.parentElement.parentElement.querySelectorAll("input");
        for (let i = 0; i < inputs.length; i++) {
            const valid = inputs[i].checkValidity();
            if (!valid) {
                inputsValid = false;
                inputs[i].classList.add("invalid-input");
            } else {
                inputs[i].classList.remove("invalid-input");
            }
        }
        return inputsValid;
    }
}


document.addEventListener('keypress', function (e) {
            if (e.keyCode === 13 || e.which === 13) {
                e.preventDefault();
                return false;
            }

        });


var pwcheck = function() {
  if (document.getElementById('password').value ==
    document.getElementById('conpassword').value) {
    document.getElementById('pwmessage').style.color = 'black';
    document.getElementById('pwmessage').innerHTML = 'Make a <span style="font-weight:bolder;">Strong</span> and <span style="font-weight:bolder;">Memorable</span> Password that you will not use anywhere else.';
    document.getElementById("submit").disabled = false;
    document.getElementById("submit").className = "btns"
  } else {
    document.getElementById('pwmessage').style.color = 'red';
    document.getElementById('pwmessage').innerHTML = "Passwords don't match. Please double-check your input.";
    document.getElementById("submit").disabled = true;
    document.getElementById("submit").className = "disabledbutt";
  }
}

function pwValidation() {
  var minLength = 8
  var maxLength = 20
}

function phonenumber() {
  var inputtxt = document.getElementById('phone').value;
  result = /^\d{10}$/.exec(inputtxt);
  if(!result) {
    document.getElementById('phmessage').style.color = 'red';
    document.getElementById('phmessage').innerHTML = "*Phone Number Format is Incorrect";
    document.getElementById("submit").disabled = true;
    document.getElementById("phvalid").disabled = true;
    document.getElementById("phvalid").className = "disabledbutt";
    return false;
  }
  else {
    document.getElementById('phmessage').style.color = "green";
    document.getElementById('phmessage').innerHTML = '<p class="phonecheck"><i class="fas fa-check"></i>You can proceed now</p>';
    document.getElementById("phvalid").disabled = false;
    document.getElementById("phvalid").className = "btns"
    document.getElementById("submit").disabled = true;
    return true;
  }
};

function enrollnumber() {
  var enrolltxt = document.getElementById('enrollno').value;
  result1 = /^\d{10}$/.exec(enrolltxt);
  if(!result1) {
    document.getElementById('enmessage').style.color = 'red';
    document.getElementById('enmessage').innerHTML = "*Please Check Your Enrollment Number";
    document.getElementById("submit").disabled = true;
    document.getElementById("enrovalid").disabled = true;
    document.getElementById("enrovalid").className = "disabledbutt";
    return false;
  }
  else {
    document.getElementById('enmessage').style.color = "green";
    document.getElementById('enmessage').innerHTML = '<p class="phonecheck"><i class="fas fa-check"></i>You can proceed now</p>';
    document.getElementById("enrovalid").disabled = false;
    document.getElementById("enrovalid").className = "btns"
    document.getElementById("submit").disabled = true;
    return true;
  }
};

function rollnumber() {
  var rolltxt = document.getElementById('rollno').value;
  result2 = /\d{5}[abc]\d{4}/i.exec(rolltxt);
  if(!result2) {
    document.getElementById('romessage').style.color = 'red';
    document.getElementById('romessage').innerHTML = "*Please Check Your Roll Number";
    document.getElementById("enrovalid").disabled = true;
    document.getElementById("enrovalid").className = "disabledbutt";
    document.getElementById("submit").disabled = true;
    return false;
  }
  else {
    document.getElementById('romessage').style.color = "green";
    document.getElementById('romessage').innerHTML = '<p class="phonecheck"><i class="fas fa-check"></i>You can proceed now</p>';
    document.getElementById("enrovalid").disabled = false;
    document.getElementById("enrovalid").className = "btns"
    document.getElementById("submit").disabled = true;
    return true;
  }
};

function showPass() {
    var x = document.getElementById("password");
    var y = document.getElementById("conpassword");
    var a = x.type;
    var b = y.type;
    if (a = "password" && b == "password") {
        x.type = "text";
        y.type = "text";
        document.getElementById("passeye").innerHTML = 'Hide Password';
    } else {
        x.type = "password";
        y.type = "password";
        document.getElementById("passeye").innerHTML = 'Show Password';
    }
}

function otpCheck() {
  var otpno = document.getElementById('otpfield').value;
  result3 = /^\d{6}$/.exec(otpno);
  if(!result3) {
    document.getElementById('otperr').style.color = 'red';
    document.getElementById('otperr').innerHTML = "*Please Check Your OTP Number";
    document.getElementById("submit").disabled = true;
    return false;
  }
  else {
    document.getElementById('otperr').style.color = "green";
    document.getElementById('otperr').innerHTML = '<p class="phonecheck"><i class="fas fa-check"></i>You can proceed now</p>';
    document.getElementById("submit").disabled = true;
    return true;
  }
};
