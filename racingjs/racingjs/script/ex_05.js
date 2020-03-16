
window.onload = function()
{
    var i = 16;
    document.all[16].addEventListener("click", function()
    {
       
        //i+= 20;
        i++;
        document.body.style.fontSize = i + "px";
        


    });
    document.all[17].addEventListener("click", function()
    {
       
        //i+= "10px";
        i--;
        document.body.style.fontSize = i + "px";
    });
    document.all[20].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#bdc3c7";
    });
    document.all[21].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#1abc9c";
    });
    document.all[22].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#f1c40f";
    });
    document.all[23].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#d35400";
    });
    document.all[24].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#e74c3c";
    });
    document.all[25].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#40d47e";
    });
    document.all[26].addEventListener("click", function()
    {
       
        
        
        document.body.style.backgroundColor= "#3498db";
    });
    
    
    
    
    console.log(document.all);

};