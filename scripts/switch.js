//chargment de la page
var index;

var tabid = document.getElementsByClassName("center_illustration");



//var tabid = ['illustration_default', 'illustration_second', 'illustration_third'];

window.onload = function() {
    tabid[0].style.display ="flex";
    for (i=1; i<tabid.length;i++)
    {
        tabid.style.display ="none";
    }
   
    index=0;
}



function switchElement(direction)
{
    var i, tabElmContent, arrowLeft, arrowRight;

    document.getElementById(tabid[index]).style.display = "none";

    var idElement = document.getElementById(direction).id;
    if(idElement == 'clickLeft')
    {
        
        if(index==0){
            index=tabid.length;
        }
        else{
            index-=1;
        }
    }
    else
    {
        if(index==tabid.length)
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

