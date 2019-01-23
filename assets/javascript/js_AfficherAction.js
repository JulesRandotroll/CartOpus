$(function()
{
    $('.sousAction').hide();

    $('.lienSousAction').on('click',function()
    {
        $('.sousAction').hide();
        localisation = $(this).attr('href');
        $(localisation).show();
    });

    $('.HautPage').on('click',function()
    {
        $('.sousAction').hide();
    });

    $('#trash_Supprimer').confirm(
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
});