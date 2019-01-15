$(function()
{
    $('#trash_Supprimer').confirm
    (
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
                        //alert($(this).attr("href"));
                        //location.href = $(this).attr("href");
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                },
            }   
        }
    );
});