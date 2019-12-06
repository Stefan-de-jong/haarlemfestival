src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";

var nr = document.getElementById('nr');
var aj = document.getElementById('aj');
var hw = document.getElementById('hw');
var avb = document.getElementById('avb');
var mx = document.getElementById('mx');
var t = document.getElementById('t');
var pnl = document.getElementById("pnl");
var back = document.getElementById('back');
var main = document.getElementById('main');
var currentpic;

nr.onclick = function setCurrentPicNr(){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
currentpic = nr;
changeContent();
$(pnl).ready(function(){
$(pnl).load("../public/inc/dance/load_nr.php");
});
}

aj.onclick = function setCurrentPicAj(){
  currentpic = aj;
  changeContent();
  $(pnl).ready(function(){
  $(pnl).load("../public/inc/dance/load_aj.php");
  });
}

hw.onclick = function setCurrentPicHw(){
currentpic = hw;
changeContent();
$(pnl).ready(function(){
$(pnl).load("../public/inc/dance/load_hw.php");
});
}

avb.onclick = function setCurrentPicAvb(){
currentpic = avb;
changeContent();
$(pnl).ready(function(){
$(pnl).load("../public/inc/dance/load_avb.php");
});
}

mx.onclick = function setCurrentPicMx(){
currentpic = mx;
changeContent();
$(pnl).ready(function(){
$(pnl).load("../public/inc/dance/load_mx.php");
});
}

t.onclick = function setCurrentPicT(){
currentpic = t;
changeContent();
$(pnl).ready(function(){
$(pnl).load("../public/inc/dance/load_t.php");
});
}

function changeContent() {
nr.style.display = 'none';
t.style.display = 'none';
aj.style.display = 'none';
hw.style.display = 'none';
avb.style.display = 'none';
mx.style.display = 'none';
if (pnl.style.display == "none") {
    pnl.style.display = "block";
} else {
    pnl.style.display = "none";
}
}

window.onload = function() {
document.getElementById('pnl').style.display = 'none';
};