function OTPInput() {
  const inputs = document.querySelectorAll("#otp > *[id]");
  for (let i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("keydown", function (event) {
      if (event.key === "Backspace") {
        inputs[i].value = "";
        if (i !== 0) inputs[i - 1].focus();
      } else {
        if (i === inputs.length - 1 && inputs[i].value !== "") {
          return true;
        } else if (
          (event.keyCode > 47 && event.keyCode < 58) ||
          (event.keyCode > 95 && event.keyCode < 106)
        ) {
          inputs[i].value = event.key;
          if (i !== inputs.length - 1) inputs[i + 1].focus();
          event.preventDefault();
        } else if (event.keyCode > 64 && event.keyCode < 91) {
          inputs[i].value = String.fromCharCode(event.keyCode);
          if (i !== inputs.length - 1) inputs[i + 1].focus();
          event.preventDefault();
        }
      }
    });
  }
}
OTPInput();

function combineInput() {
  var mergedOtp =
    document.getElementById("first").value +
    document.getElementById("second").value +
    document.getElementById("third").value +
    document.getElementById("fourth").value +
    document.getElementById("fifth").value +
    document.getElementById("sixth").value;
  document.getElementById("otpParse").setAttribute("value", mergedOtp);
}

