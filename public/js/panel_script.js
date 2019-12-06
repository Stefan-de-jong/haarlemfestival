src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js";

var back = document.getElementById('back');
back.onclick = function goBack(){
nr.style.display = 'block';
t.style.display = 'block';
aj.style.display = 'block';
hw.style.display = 'block';
avb.style.display = 'block';
mx.style.display = 'block';
if (pnl.style.display == "block") {
pnl.style.display = "none";
} else {
pnl.style.display = "block";
}
}
