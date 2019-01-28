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

    $('.trash_SupprimerSousAction').confirm(
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
                        index=$(this).attr('id');
                        alert(index);
                        //location.href = $('#form_supprSousAction'+i).attr('action');
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                },
            }   
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
        }
    );
});