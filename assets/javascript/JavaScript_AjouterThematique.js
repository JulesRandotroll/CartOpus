$(document).ready(function(){
    $(".myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".dropdown-menu li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

$(function() 
{
    var txt_Dropdown_Migrer = 'Selectionnez une sous-thématique';

    // dropdown function création ssthematique
    $(".ajouter_SsThematique").on('click',function()
    {
        //alert(nomSousThematique);
        noSousThematique = $(this).val();
        nomSousThematique = $(this).find("a").eq(0).html();
        //alert(nomSousThematique);
        document.getElementById('Dropdown_Ajouter_SsThematique').innerHTML=nomSousThematique; 
        document.getElementById('Dropdown_Ajouter_SsThematique').value=noSousThematique;
        //alert('ALL IS OK');
    });
    $("#btn_ajout_SsThematique").on('click',function()
    {
        if($('#Dropdown_Ajouter_SsThematique').val())
        {
            noThematique = $('#Dropdown_Ajouter_SsThematique').val()
        }
        else{
            noThematique = '0';
        }
        $("#form_crea_ssThematique").attr('action',$("#form_crea_ssThematique").attr('action') + "/" + noThematique );
    });

    // dropdown function liaison ssthematique et thematique
    $(".lier_Thematique").on('click',function()
    {
        //alert(nomSousThematique);
        noSousThematique = $(this).val();
        nomSousThematique = $(this).find("a").eq(0).html();
        //alert(nomSousThematique);
        document.getElementById('Dropdown_Lier_Thematique').innerHTML=nomSousThematique; 
        document.getElementById('Dropdown_Lier_Thematique').value=noSousThematique;
        //alert('ALL IS OK');
        
    });
    $(".lier_SsThematique").on('click',function()
    {
        //alert(nomSousThematique);
        noSousThematique = $(this).val();
        nomSousThematique = $(this).find("a").eq(0).html();
        //alert(nomSousThematique);
        document.getElementById('Dropdown_Lier_SsThematique').innerHTML=nomSousThematique; 
        document.getElementById('Dropdown_Lier_SsThematique').value=noSousThematique;
        //alert('ALL IS OK');
    });
    $("#btn_lierThematiques").on('click',function()
    {
        var noSsThematique;
        var noThematique;

        if($('#Dropdown_Lier_SsThematique').val())
        {
           noSsThematique =  $('#Dropdown_Lier_SsThematique').val()
        }
        else
        {
            noSsThematique = '0';
        }

        if($('#Dropdown_Lier_Thematique').val())
        {
            noThematique = $('#Dropdown_Lier_Thematique').val() ;
        }
        else
        {
            noThematique = '0';
        }

        alert(noSsThematique + "/" + noThematique );
        $("#form_lier_Thematiques").attr('action',$("#form_lier_Thematiques").attr('action')+"/"+noSsThematique + "/" + noThematique);
    });

    
    //Dropdown function migrer sous thematique
    $(".migrer_ssThematique").on('click',function()
    {
        //alert(nomSousThematique);
        noSousThematique = $(this).val();
        nomSousThematique = $(this).find("a").eq(0).html();
        //alert(nomSousThematique);
        document.getElementById('Dropdown_Migrer').innerHTML=nomSousThematique; 
        document.getElementById('Dropdown_Migrer').value=noSousThematique;
        //alert('ALL IS OK');
    });
    $('#btnMigrer').confirm({
        icon: 'glyphicon glyphicon-alert' ,
        title: 'Attention : Irréversible' ,
        content: 'Voulez-vous réellement faire migrer cette sous thématique en thématique ?',
        type: 'red' ,
        typeAnimated: true ,
        autoClose: 'cancel|10000' , 
        buttons: 
        {
            confirm:
            { 
                text:"Confirmer",
                action: function () 
                {
                    if($('#Dropdown_Migrer').val())
                    {
                        noSousThematique = $('#Dropdown_Migrer').val();
                    }
                    else
                    {
                        noSousThematique ='0';
                    }
                    location.href = $('#form_Migrer').attr('action')+'/'+noSousThematique;
                    //alert($('#form_Migrer').attr('action'));   
                }
            },
            cancel:
            {
                text:"Annuler",
                btnClass: 'btn-red',
                
            }
        }
    });
    
    

    
    
});
