var pnl = document.getElementById("pnl");
pics = [];
var content;

function loadPanel(id){ //set clicked picture as the current picture, then execute the function ChangeContent to hide elements and show the panel
getPics();
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
                url: '../public/inc/dance/panel.php',
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
pics[p].style.display = "block";
}
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
pic.style.display = 'none';
}

window.onload = function() {
$(pnl).hide();
};