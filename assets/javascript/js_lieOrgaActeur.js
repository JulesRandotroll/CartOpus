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
        document.getElementById("Dropdown_Organisation").value=noOrga;

        appelBDDSelect(noOrga);
    });

    
    $('#ici').on('click','.secteur',function()
    {
        noSecteur=$(this).val();
        //alert(noSecteur);
        nomSecteur=$(this).find("a").eq(0).html();// trouver la 1ere occurance de <a> et stocker la partie html aka ce qu'il y a entre les balises a
        document.getElementById("Dropdown_Secteur").innerHTML=nomSecteur;
        document.getElementById("Dropdown_Secteur").value=noSecteur;

        noOrga=$('#Dropdown_Organisation').val();

        if(noSecteur =='0')
        {
            //alert("plop");
            $.confirm({
                title: 'Ajouter',
                content: '' +
                '<form action="" class="formName">' +
                '<div class="form-group">' +
                '<label>Entrer le nouveau secteur</label>' +
                '<input type="text" placeholder="Secteur" class="name form-control" required />' +
                '</div>' +
                '</form>',
                buttons: {
                    formAjout: {
                        text: 'Ajouter',
                        btnClass: 'btn-blue',
                        action: function () {
                            var nomSecteur = this.$content.find('.name').val();
                            if(!nomSecteur){
                                $.alert('Veuillez rentrer un nom de secteur correct');
                                return false;
                            }
                            $.alert('Le nouveau secteur est ' + nomSecteur);
                            appelBDDInsert(noOrga,nomSecteur);
                            appelBDDSelect(noOrga);
                            document.getElementById("Dropdown_Secteur").innerHTML=nomSecteur;
                            var reponse = requete.responseText;
                            echo (reponse);
                        }
                    },
                    Annuler: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // bind to events
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) {
                        // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });

        }
    });

    
});

function appelBDDInsert(noOrga,noSecteur)
{
    var origin = window.location.origin;

    Folder = '';
    //Folder = '';

    path = origin + Folder + '/CartOpus/assets/javascript/InsertSecteurOrga.php?noOrganisation=' + noOrga+'&nomSecteur='+noSecteur; 
    alert(path);

    var requete = new XMLHttpRequest();
    requete.open('GET',path,false);
    requete.send(null)

    var reponse = requete.responseText;

        //appel requete BDD 
};

function appelBDDSelect(noOrga)
{
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
}