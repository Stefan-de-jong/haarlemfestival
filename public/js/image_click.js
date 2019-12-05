src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";

var image = document.getElementById('nr');
image.onclick = function changeContent() {
image.style.display = 'none';
document.getElementById('t').style.display = 'none';
document.getElementById('aj').style.display = 'none';
document.getElementById('hw').style.display = 'none';
document.getElementById('avb').style.display = 'none';
document.getElementById('mx').style.display = 'none';
var x = document.getElementById("pnl");
if (x.style.display === "none") {
    x.style.display = "block";
} else {
    x.style.display = "none";
}
$(x).load("../public/inc/dance/panel_1.php");
}

document.getElementById('t').onclick = function changeContent() {
  document.getElementById('nr').style.display = 'none';
      document.getElementById('t').style.display = 'none';
  document.getElementById('aj').style.display = 'none';
      document.getElementById('hw').style.display = 'none';
  document.getElementById('avb').style.display = 'none';
      document.getElementById('mx').style.display = 'none';
  var x = document.getElementById("pnl");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

document.getElementById('aj').onclick = function changeContent() {
  document.getElementById('nr').style.display = 'none';
      document.getElementById('t').style.display = 'none';
  document.getElementById('aj').style.display = 'none';
      document.getElementById('hw').style.display = 'none';
  document.getElementById('avb').style.display = 'none';
      document.getElementById('mx').style.display = 'none';
  var x = document.getElementById("pnl");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

document.getElementById('hw').onclick = function changeContent() {
  document.getElementById('nr').style.display = 'none';
      document.getElementById('t').style.display = 'none';
  document.getElementById('aj').style.display = 'none';
      document.getElementById('hw').style.display = 'none';
  document.getElementById('avb').style.display = 'none';
      document.getElementById('mx').style.display = 'none';
  var x = document.getElementById("pnl");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

document.getElementById('avb').onclick = function changeContent() {
  document.getElementById('nr').style.display = 'none';
      document.getElementById('t').style.display = 'none';
  document.getElementById('aj').style.display = 'none';
      document.getElementById('hw').style.display = 'none';
  document.getElementById('avb').style.display = 'none';
      document.getElementById('mx').style.display = 'none';
  var x = document.getElementById("pnl");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

document.getElementById('mx').onclick = function changeContent() {
  document.getElementById('nr').style.display = 'none';
      document.getElementById('t').style.display = 'none';
  document.getElementById('aj').style.display = 'none';
      document.getElementById('hw').style.display = 'none';
  document.getElementById('avb').style.display = 'none';
      document.getElementById('mx').style.display = 'none';
  var x = document.getElementById("pnl");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

window.onload = function() {
document.getElementById('pnl').style.display = 'none';
};