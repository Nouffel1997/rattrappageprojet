var i =0;
window.onload = function()
{
document.body.childNodes[1].childNodes[1].childNodes[5].childNodes[1].addEventListener("click", function(){
    i += 1;
        document.body.childNodes[1].childNodes[1].childNodes[5].childNodes[1].innerHTML= i;
    
})
};