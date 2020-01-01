var pnl = document.getElementById("pnl");
pics = [];
var content;
var padding = document.getElementById("padding");
var pass = document.getElementById("pass");

function loadPanel(id){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
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
};