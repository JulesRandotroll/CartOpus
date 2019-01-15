$(function()
{
    $('#btn_Supprimer').confirm
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
                        location.href = $('#form_suppr').attr('action')+'/'+$('#dropAction').val();
                        //$.alert('Oui');
                    }
                },
                non: 
                {
                    btnClass:"btn-red",
                }
            }   
        }
    );

    

});