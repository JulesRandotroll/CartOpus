$(function()
{
    $('.sousAction').hide();

    $('.lienSousAction').on('click',function()
    {
        //alert('cocuou');
        $('.sousAction').hide();
        localisation = $(this).attr('href');
        //alert(localisation);
        $(localisation).show();

    });

    $('p').hide();

    $('.HautPage').on('click',function()
    {
        $('.sousAction').hide();
    });

    $('.trash_Supprimer').confirm(
    {
        icon: 'glyphicon glyphicon-alert',
        title: 'Attention',
        content: 'Voulez vous vraiment supprimer cette action',
        type: 'red',
        typeAnimated: true,
        autoClose:"non|10000",
        buttons: 
        {
            oui:
            {
                action: function () 
                {
                    location.href = $('#form_suppr').attr('action');
                }
            },
            non: 
            {
                btnClass:"btn-red",
            },
        }   
    });
    $('.trash_SupprimerSousAction').on('click',function()
    {
        index=this.id;
        //alert(index);

        $.confirm(
        {
            icon: 'glyphicon glyphicon-alert',
            title: 'Attention',
            content: 'Voulez vous vraiment supprimer cette action',
            type: 'red',
            typeAnimated: true,
            autoClose:"non|10000",
            buttons: 
            {
                oui:
                {
                    action: function () 
                    {
                        location.href = $('#form_supprSousAction'+index).attr('action');
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                },
            }   
        });
    });


    
    $('.option').hover(
    function()
    {
        //$(this).attr('class','option active');
        $(this).attr('style','background-color:#139CBC;border-radius: 10px;');
        id=this.id;
        $(this).find('span').eq(0).hide();
        $('#txt_'+id).show();
    },
    function()
    {
        $(this).find('span').eq(0).show();
        $(this).attr('style','background-color:#B64F53;border-radius: 10px');
        $('p').hide();
    });

    
    $('.signaler').hide();
    
    $('#signalerAction').on('click',function()
    {
        $('.signaler').show();
    });
    $('#annuler').on('click',function()
    {
        $('.signaler').hide();
    });

    $('.SignalerComm').on('click',function()
    {
        var noCommentaire=this.id;
        var id = noCommentaire;
        var comm = $('#commentaire'+id).html();
        var date = $('#date'+id).html();
        var nom = $('#nom'+id).html();

        var url= $('#form_signalComm').attr('action');
        $('#form_signalComm').attr('action',url+'/'+noCommentaire);


        var retour = '<div class="media">' +
                        '<div class="media-left media-top">' +
                        '</div>' +
                        '<div class="col-sm-12">' +
                            '<div class="media-body" style="background-color:#bfbfbf; border-radius: 5px;padding:15px">' + 
                                '<table align="left">' +
                                    '<tr><td style="padding:15px">' +
                                        '<h4 class="media-heading">'+ nom + '</h4>' +
                                        '<h5 class="media-heading" style="font-style: italic;color:#000000"><strong>( Visiteur )</strong></h5></div>' +
                                    '</td><td>' +
                                        '<div class="text-center" style="padding:15px">' + comm + '</div><BR>' +
                                    '</td></td>' +
                                        '<div class = "text-right" style="font-style:italic;">' + date + '</div>' +
                                    '</td></tr>' +
                                '</table>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<BR><BR>';

        document.getElementById('commASignaler').innerHTML = retour;
    });

    $('.SignalerCommentaire').hide();
    
    $('.SignalerComm').on('click',function()
    {
        $('.SignalerCommentaire').show();
    });
    $('#annulerComm').on('click',function()
    {
        $('.SignalerCommentaire').hide();
    });

});