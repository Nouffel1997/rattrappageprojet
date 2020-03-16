window.onload = function(){
{
    
        var canvas = document.all[18];
        var ctx = canvas.getContext('2d');

        ctx.fillStyle = "#fff";
        ctx.beginPath(); 
        ctx.moveTo(6, 6);
        ctx.lineTo(14, 10);
        ctx.lineTo(6,14);
        ctx.fill(); 
        ctx.stroke();
        
          




    console.log(document.all);
}

var song = new Audio("Kirameki.mp3");

document.all[18].addEventListener("click", function(){

 song.play();

}
)
document.all[20].addEventListener("click", function(){

    song.pause();


}
)
document.all[21].addEventListener("click", function(){

    song.load();


}
)
document.all[22].addEventListener("click", function(){

if(song.muted !== true)
    {
        song.muted = true;
    }
else
    {
        song.muted = false;
    }


}
)
}