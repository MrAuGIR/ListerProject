//chargment de la page
var index;

var tabid = ['illustration_default', 'illustration_second', 'illustration_third'];

window.onload = function() {
    document.getElementById("illustration_default").style.display ="flex";
    document.getElementById("illustration_second").style.display ="none";
    document.getElementById("illustration_third").style.display ="none";
    index=0;
}



function switchElement(direction)
{
    var i, tabElmContent, arrowLeft, arrowRight;

    document.getElementById(tabid[index]).style.display = "none";

    var idElement = document.getElementById(direction).id;
    if(idElement == 'clickLeft')
    {
        
        if(index==0)
        {
            index=2;
        }
        else
        {
            index-=1;
        }
    }
    else
    {
        if(index==2)
        {
            index=0;
        }
        else
        {
            index+=1;
        }
    }
    var textId = tabid[index];
    var element = document.getElementById(textId);
    element.style.display = "flex";
    /*
    tabElmContent = document.getElementsByClassName("center_illustration");
    for(i = 0; i<tabElmContent.length; i++)
    {
        tabElmContent[i].style.display ="none";
    }
    
    */
    
    

}

