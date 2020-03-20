window.onload = function()
{
	var y = document.all;
	console.log(y);

	var x = document.all[14].children;

    var orange = 0; 
    var purple = 0; 
    var noir = 0; 
    var olive = 0;

    for(i = 0 ; i < x.length ; i++)
    {
        
        var test = x[i];
        var test = window.getComputedStyle(test, null); // donne la valeur calculee finale de toutes les proprietes css 
        var property = test.getPropertyValue('background-color');

        if(property == 'rgb(255, 165, 0)')
        {
			orange++;
		}
        if(property == 'rgb(128, 0, 128)')
        {
            purple++;
		}
		if(property == 'rgb(128, 128, 0)')
        {
            olive++;
        }
        if(property == 'rgb(0, 0, 0)')
        {
            noir++;   
        }

    }

    for(i = 0 ; i < x.length; i++)
    {

		for( let i = orange + purple + noir ; i < orange + purple + noir + olive ; i++)
        {
            test = x[i]
            test.setAttribute('style', 'background-color : olive !important');
		}
		for( let i = orange ; i < orange + purple ; i++)
        {
            test = x[i]
            test.setAttribute('style', 'background-color : purple !important');
        }
        for (let i = 0; i < orange; i++) 
        {
            test = x[i];
            test.setAttribute('style', 'background-color : orange !important');
        }
        for( let i = orange + purple ; i < orange + purple + noir ; i++)
        {
            test = x[i]
            test.setAttribute('style', 'background-color : black !important');
        }

    }


}