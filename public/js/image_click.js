var pnl = document.getElementById("pnl");
pics = [];
var content;
var day;
var padding = document.getElementById("padding");
var pass = document.getElementById("pass");
var footer = document.getElementsByTagName('footer');
var selection = document.getElementById("pass-select");

function loadPanel(id){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
$(footer).hide();
setTimeout(function(){$(footer).show();}, 100); //footer needs some time to change it's position
hidePAll();
getPics();
$(pnl).ready(function(){
sendIDWithAjax(id);
$(pnl).show();
smoothAnimation(pnl);
});
}
function sendIDWithAjax(id)
{
    $(document).ready(function(){

              $.ajax({
                type: 'POST',
                url: 'panel',
                data: {panelid:id},
                success: function(response) {
                  $(pnl).append(response)
                  content = response;
                }
            });
});
}

function addPass()
{
  $(document).ready(function(){
    $.ajax({
    type: 'POST',
    url: 'newticket',
    data: {passday:day},
    success: function(response)
    {
    alert(response);
    }
    });
    });
}

function smoothAnimation(element)
{
  var counter = 100;
  element.style.opacity = 0;
  var intervalid = setInterval(function()
  {
  var opacity = counter / 1000;
  element.style.opacity = opacity;
  counter+= 100;
  if (counter == 1100)
  clearInterval(intervalid);
  }, 50);
}

function showPics(pics)
{
for (p in pics)
{
$(pics[p]).show();
smoothAnimation(pics[p]);
}
}

function hidePAll()
{
$(pass).hide();
$(padding).hide();
}

function showPass()
{
$(pass).show();
smoothAnimation(pass);
}

function showPicturePadding()
{
$(padding).show();
}

function getPics(){
for (i = 0; i < piccount; i++)
{
var pic = document.getElementById('pic' + (i+1));
hidePic(pic);
pics.push(pic); 
}
}

function hidePic(pic)
{
$(pic).hide();
}

window.onload = function() {
$(pnl).hide();
}

selection.onchange = function getValueDropdown(){
day = selection.options[selection.selectedIndex].value;
var displaydate;
var price;
switch(day)
{
case 'fri':
price = 125;
displaydate = "Friday";
break;
case 'sat':
price = 150;
displaydate = "Saturday";
break;
case 'sun':
price = 150;
displaydate = "Sunday";
break;
case 'all':
price = 250;
displaydate = "all days";
break;
}
var pricebox = document.getElementById('pricebox');
pricebox.innerHTML = "This pass costs € " + price + "<br> and is for " + displaydate;
}