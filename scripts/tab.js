
function tabElement(pageName,element, color, className)
{
    var tabElement = document.getElementsByClassName(className);
    // on met le display sur none ppour faire disparaitre les blocs
    for(i=0; i<tabElement.length; i++)
    {
        tabElement[i].style.display="none";
    }

    //on enlève la couleur de fond du menu
    var tabNav = document.getElementsByClassName('tabNav');
    for(i=0; i<tabNav.length; i++)
    {
        tabNav[i].style.backgroundColor = "";
    }

    //on affiche le formulaire voulu
    document.getElementById(pageName).style.display= "flex";

    //on change la couleur du fond du bouton du menu actif
    element.style.backgroundColor = color;

}

// l'element avec l'id 'default' est mis visible par défaut
document.getElementById("default").click(); 