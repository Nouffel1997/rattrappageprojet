window.onload = function () {
    
      

    var str = "";
    document.addEventListener("keypress", function(e) {
        str += e.key;
       
        if (str.length == 42){
            str = str.substr(1);
        }
        document.all[14].innerHTML = str;



    })
}