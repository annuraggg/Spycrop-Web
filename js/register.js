$(window).ready(function () {
  $("#divUser").hide();
  $("#divHost").hide();
  $("#divUserGreet").hide();
  $("#divHostGreet").hide();
  $("#endCard").hide();
});

function showUser() {
    $("#divMain").fadeOut(400) 
    $("#divUserGreet").delay(800).fadeIn(400);
    $("#divUserGreet").delay(1600).fadeOut(400);
    $("#divUser").delay(3400).fadeIn(400);
}

function showHost() {
    $("#divMain").fadeOut(400) 
    $("#divHostGreet").delay(800).fadeIn(400);
    $("#divHostGreet").delay(1600).fadeOut(400);
    $("#divHost").delay(3400).fadeIn(400);
}

function pageExit() {
  $("#divHost").fadeOut(400);
  $("#divUser").fadeOut(400);
  $("#endCard").delay(400).fadeIn(400);
}