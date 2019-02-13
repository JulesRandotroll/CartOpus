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
        //$('#modif').prop('disabled', false);
        $('#modif').attr('class','btn btn-default form-control');
        $('#secteur').attr('class','btn btn-default dropdown-toggle form-control');

        noOrga=this.id;
        nomOrga=$(this).find("a").eq(0).html();// trouver la 1ere occurance de <a> et stocker la partie html aka ce qu'il y a entre les balises a
        document.getElementById("Dropdown_Organisation").innerHTML=nomOrga;
        document.getElementById("Dropdown_Organisation").value=noOrga;

        appelBDDSelect(noOrga);
    });

    $('#modif').on("click",function()
    {

        noOrga=$('#Dropdown_Organisation').val();

       // var test=$('#form_modif').attr('action')+'/'+noOrga;
        //alert(test);
        location.href = $('#form_modif').attr('action')+'/'+noOrga;
        
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
                        action: function () 
                        {
                            var nomSecteur = this.$content.find('.name').val();
                            if(!nomSecteur)
                            {
                                $.alert('Veuillez rentrer un nom de secteur correct');
                                return false;
                            }
                            appelBDDInsert(noOrga,nomSecteur);
                            appelBDDSelect(noOrga);
                            document.getElementById("Dropdown_Secteur").innerHTML=nomSecteur;
                            //var reponse = requete.responseText;
                           // echo (reponse);
                        }
                    },
                    Annuler: function () 
                    {
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
        $('#lier').attr('class','btn btn-danger form-control');
    });

    $('#lier').on("click",function()
    {
        noOrga=$('#Dropdown_Organisation').val();
        noSecteur=$('#Dropdown_Secteur').val();
        //alert(noOrga);
        //alert(noSecteur);
        location.href = $('#form_lier').attr('action')+'/'+noOrga+'/'+noSecteur;
    });
});

function appelBDDInsert(noOrga,noSecteur)
{
    var origin = window.location.origin;

    Folder = '';

    path = origin + Folder + '/CartOpus/assets/javascript/InsertSecteurOrga.php?noOrganisation=' + noOrga+'&nomSecteur='+noSecteur; 
    //alert(path);

    var requete = new XMLHttpRequest();
    requete.open('GET',path,false);
    requete.send(null)

    var reponse = requete.responseText;
   
    if (reponse =="Ce secteur existe déjà dans cette organisation")
    {
        alert(reponse);
    }
    else
    {
        $.alert('Insertion effectuée');
        //alert('miou');
    }
  
 
 
}

function appelBDDSelect(noOrga)
{
    var origin = window.location.origin;

    Folder = '';

    path = origin + Folder + '/CartOpus/assets/javascript/SelectSecteurOrga.php?noOrganisation=' + noOrga; 
    //alert(path);

    var requete = new XMLHttpRequest();
    requete.open('GET',path,false);
    requete.send(null)

    var reponse = requete.responseText;
    //alert(reponse);

    document.getElementById('ici').innerHTML=reponse;
}