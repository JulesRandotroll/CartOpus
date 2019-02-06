$(document).ready(function()
{
    $(".dropdown-menu").on("keyup",'.myInput', function() 
    {
        var value = $(this).val().toLowerCase();
        $(".dropdown-menu li").filter(function() 
        {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $('.Orga').on("click",function()
    {
        noOrga=this.id;
        nomOrga=$(this).find("a").eq(0).html();// trouver la 1ere occurance de <a> et stocker la partie html aka ce qu'il y a entre les balises a
        document.getElementById("Dropdown_Organisation").innerHTML=nomOrga;
        //document.getElementById("Dropdown_Organisation").value=noOrga;


        var origin = window.location.origin;

        Folder = '';
        //Folder = '';

        path = origin + Folder + '/CartOpus/assets/javascript/SelectSecteurOrga.php?noOrganisation=' + noOrga; 

        //alert(path);
    
        var requete = new XMLHttpRequest();
        requete.open('GET',path,false);
        requete.send(null)

        var reponse = requete.responseText;


        //alert(reponse);
        document.getElementById('ici').innerHTML=reponse;
            //appel requete BDD 
    });

});