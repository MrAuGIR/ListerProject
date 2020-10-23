//chargment de la page
var index;

var tabid = document.getElementsByClassName("center_illustration");

/* au chargement de la page  on 'des-affiche' les bloc de class 'center_illustration' sauf le premier */
window.onload = function() {
    tabid[0].style.display ="flex";
    for (i=1; i<tabid.length;i++)
    {
        tabid[i].style.display ="none";
    }
    index=0;
}

/* au clic sur une des deux flèche, décalage de l'index du tabid à gauche ou a droite, 
disparition de l'ancien bloc, affichage du nouveau */
function switchElement(direction)
{
    
    tabid[index].style.display = "none";

    var idElement = document.getElementById(direction).id;
    if(idElement == 'clickLeft')
    {
        index = (index===0) ? (tabid.length-1) : index-=1;
    }
    else
    {
        index = (index===tabid.length-1) ? 0 : index+=1;
    }
    tabid[index].style.display = "flex";

}

