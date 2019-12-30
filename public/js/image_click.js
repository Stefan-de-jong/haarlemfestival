var pnl = document.getElementById("pnl");
pics = [];
var content;
var padding = document.getElementById("padding");

function loadPanel(id){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
getPics();
hidePicturePadding(padding, dropdown);
$(pnl).ready(function(){
sendIDWithAjax(id);
$(pnl).show();
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

function showPics(pics)
{
for (p in pics)
{
$(pics[p]).show();
}
}

function hidePicturePadding()
{
$(padding).hide();
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